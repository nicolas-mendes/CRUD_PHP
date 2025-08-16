<?php 
    require __DIR__.'/vendor/autoload.php';
    define('TITLE','Editar Usuário');
    use \App\entity\usuario;

    //VALIDAR ID DE CONSULTA
    if(!isset($_GET['id']))
    {
        header('location: index.php?status=error');
        exit;
    }

    //CRIAR CONSULTA NA DB
    $obUsuario = usuario::getUsuario($_GET['id']);
    
    //VALIDAÇÃO DO USUARIO
    if(!$obUsuario instanceof usuario)
    {
        header('location: index.php?status=error');
        exit;
    }

    //Validação dos dados do POST
    if(isset($_POST['nome'],$_POST['email'],$_POST['senha'],$_POST['nasc']))
    {
        $obUsuario->nome = $_POST['nome'];
        $obUsuario->email = $_POST['email'];
        $obUsuario->senha = $_POST['senha'];
        $obUsuario->nasc = $_POST['nasc'];
        $obUsuario->atualizar();

        header('location: index.php?status=success');
        exit;
    }

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/formulario.php';
    include __DIR__.'/includes/footer.php';
?>