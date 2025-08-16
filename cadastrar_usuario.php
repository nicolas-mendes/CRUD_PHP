<?php 
    require __DIR__.'/vendor/autoload.php';
    define('TITLE','Cadastrar Usuário');
    use \App\entity\usuario;

    $obUsuario = new usuario;
    
    //Validação dos dados do POST
    if(isset($_POST['nome'],$_POST['email'],$_POST['senha'],$_POST['nasc']))
    {
        
        $obUsuario->nome = $_POST['nome'];
        $obUsuario->email = $_POST['email'];
        $obUsuario->senha = $_POST['senha'];
        $obUsuario->nasc = $_POST['nasc'];
        $obUsuario->cadastrar();

        header('location: index.php?status=success');
        exit;
    }

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/formulario.php';
    include __DIR__.'/includes/footer.php';
?>