<?php
$mensagem = '';
if (isset($_GET['status'])) {
    switch ($_GET['status']) {
        case 'success':
            $mensagem = '<div class="alert alert-success mt-4">Ação executada com sucesso!</div>';
            break;
        case 'error':
            $mensagem = '<div class="alert alert-danger mt-4">Ação não executada!</div>';
            break;
    }
}

$resultados = '';
foreach ($usuarios as $usuario) {
    $resultados .=
        '<tr>
            <td>' . $usuario->id . '</td>
            <td>' . $usuario->nome . '</td>
            <td>' . $usuario->email . '</td>
            <td class="text-center">' . date('d/m/Y', strtotime($usuario->nasc)) . '</td>
            <td class="d-grid gap-1 d-md-flex justify-content-center">
            <button onclick="location.href=\'editar_usuario.php?id=' . $usuario->id . '\';" class="btn btn-success btn-sm me-md-2"> <i class="bi bi-pencil-fill"></i> Editar </button>
            <button onclick="location.href=\'excluir_usuario.php?id=' . $usuario->id . '\';" class="btn btn-danger btn-sm"> <i class="bi bi-trash-fill"></i> Excluir</button>
            </td>
        </tr>';
}

$resultados = strlen($resultados) ? $resultados : '<tr> <td colspan="6" class="text-center">Nenhum Usuário Encontrado</td> </tr>';


//GETS

unset($_GET['status']);
unset($_GET['pagina']);
$gets = http_build_query($_GET);


//PAGINAÇÃO
$paginacao = '';
$paginas = $obPagination->getPages();
foreach ($paginas as $key => $pagina) {
    $class = $pagina['atual'] ? 'active' : ' ';
    $paginacao .= '<li class="page-item ' . $class . '">
                        <a class="page-link" href="?pagina=' . $pagina['pagina'] . '&' . $gets . '">' . $pagina['pagina'] . '</a></li>';
}


//LÓGICA DE ORDENAÇÃO

//LIMPA E ORGANIZA OS PARAMETROS DA URL
$gets = $_GET;
unset($gets['order'], $gets['dir']);
$gets = http_build_query($gets);

$colunasPermitidas = ['id', 'nome', 'email', 'nasc'];

$ordemAtual = $_GET['order'] ?? 'nome';
$direcaoAtual = isset($_GET['dir']) && strtolower($_GET['dir']) === 'desc' ? 'desc' : 'asc';

if (!in_array($ordemAtual, $colunasPermitidas)) {
    $ordemAtual = 'nome';
}

$order = "ORDER BY `{$ordemAtual}` {$direcaoAtual}";


function urlOrder($col, $title)
{
    global $ordemAtual, $direcaoAtual, $gets;

    $classeTh = '';
    $icone = '';

    // Se esta é a coluna que está sendo ordenada...
    if ($col === $ordemAtual) {
        // Inverte a direção para o próximo clique
        $proximaDirecao = $direcaoAtual === 'asc' ? 'desc' : 'asc';
        // Adiciona a classe CSS para mostrar o ícone correto
        $classeTh = 'sorted-' . $direcaoAtual;
        // Define o ícone de seta (usando Bootstrap Icons)
        $icone = $direcaoAtual === 'asc' ? '<i class="bi bi-sort-up"></i>' : '<i class="bi bi-sort-down"></i>';
    } else {
        // Se não for a coluna ativa, o primeiro clique sempre será ascendente
        $proximaDirecao = 'asc';
    }

    // Monta a URL para o link
    $url = "?order={$col}&dir={$proximaDirecao}" . ($gets ? '&' . $gets : '');

    // Imprime o HTML do cabeçalho
    echo "<th scope='col' class='text-center {$classeTh}'><a href='{$url}'>{$title} {$icone}</a></th>";
}

?>

<main>
    <section>
        <h1 class="text-center mt-4">Lista de Usuários</h1>

        <?= $mensagem ?>
        <a href="cadastrar_usuario.php">
            <button class="btn btn-success mt-4"> <i class="bi bi-person-plus-fill"></i> Novo Usuário</button>
        </a>
    </section>
    <section>
        <form action="" method="get">
            <div class="row my-4">
                <div class="col">
                    <label for="filtroNome" class="form-label">Buscar por Nome</label>
                    <input type="text" name="filtroNome" id="filtroNome" class="form-control" value="<?= $filtroNome ?>">
                </div>
                <div class="col">
                    <label for="filtroEmail" class="form-label">E-Mail</label>
                    <input type="text" name="filtroEmail" id="filtroEmail" class="form-control" value="<?= $filtroEmail ?>">
                </div>
                <div class="col d-flex align-items-end">
                    <button type="submit" class="btn btn-primary"> <i class="bi bi-funnel-fill"></i> Filtrar</button>
                </div>
            </div>
        </form>
    </section>
    <section>
        <div class='table-responsive'>
            <table id='tabela-usuarios' class='table mt-5 table-striped table-hover table-bordered vertical-align: middle'>
                <thead class='table-dark'>
                    <tr>
                        <?php urlOrder('id', 'UUID'); ?>
                        <?php urlOrder('nome', 'Nome'); ?>
                        <?php urlOrder('email', 'E-Mail'); ?>
                        <?php urlOrder('nasc', 'Data de Nascimento'); ?>
                        <th scope='col' class="text-center">Ações</th>
                    </tr>
                </thead>
                <tfoot class='text-center table-dark'>
                    <tr>
                        <th>UUID</th>
                        <th>Nome</th>
                        <th>E-Mail</th>
                        <th>Data de Nascimento</th>
                        <th>Ações</th>
                    </tr>
                </tfoot>
                <tbody class='table-group-divider'>
                    <?= $resultados ?>
                </tbody>
            </table>
        </div>
    </section>
    <section>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?= $paginacao ?>
            </ul>
        </nav>

    </section>
</main>