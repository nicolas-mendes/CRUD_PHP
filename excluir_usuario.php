<?php 
    require __DIR__.'/vendor/autoload.php';
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
    if(isset($_POST['excluir']))
    {
        $obUsuario->excluir();

        header('location: index.php?status=success');
        exit;
    }

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/confirmar_exclusao.php';
    include __DIR__.'/includes/footer.php';
?>