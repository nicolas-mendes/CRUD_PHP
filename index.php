<?php 
    require __DIR__.'/vendor/autoload.php';

    use \App\entity\usuario;
    use \App\database\pagination;

    //FILTRO NOME
    $filtroNome = htmlspecialchars($_GET['filtroNome']??'',ENT_QUOTES);
    
    //FILTRO E-MAIL
    $filtroEmail = htmlspecialchars($_GET['filtroEmail']??'',ENT_QUOTES);

    //ORDER
    $col = $_GET['order'] ?? 'nome';
    $dir = $_GET['dir'] ?? ' ';

    // Concatena os valores diretamente na variável $order
    $order = " " . $col . " " . $dir;

//CONDIÇÕES SQL
$condicoes = 
    [
        strlen($filtroNome) ? 'nome LIKE "%'.str_replace(' ','%',$filtroNome).'%"' : null,
        strlen($filtroEmail) ? 'email LIKE "%'.str_replace(' ','%',$filtroEmail).'%"' : null
    ];

    //REMOVE POSIÇÕES VAZIAS
    $condicoes = array_filter($condicoes);

    //CLÁUSULA WHERE
    $where = implode(' AND ',$condicoes);

    //QUANTIDADE TOTAL DE USUÁRIOS
    $totalUsuarios = usuario::getTotalUsuarios($where);

    //PAGINAÇÃO
    $obPagination = new pagination($totalUsuarios,$_GET['pagina'] ?? 1);


    //OBTEM AS VAGAS
    $usuarios = usuario::getUsuarios($where,$order,$obPagination->getLimit());
 

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/listar_usuario.php';
    include __DIR__.'/includes/footer.php';
?>