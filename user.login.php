<?php 
    spl_autoload_register(function($file_name){
        
        $files = array(
            # incluir as classes do diretório php/model
            "php" . DIRECTORY_SEPARATOR . "model" . DIRECTORY_SEPARATOR . "{$file_name}.php",
            # incluir as classes do diretório php/repository
            "php" . DIRECTORY_SEPARATOR . "repository" . DIRECTORY_SEPARATOR . "{$file_name}.php",
            # incluir as classes do diretório php/service
            "php" . DIRECTORY_SEPARATOR . "service" . DIRECTORY_SEPARATOR . "{$file_name}.php",
        );

        foreach ($files as $fileName) {
            if(file_exists($fileName)) {
                require_once($fileName);
            }
        }
    });
    
    session_start();

    $service = new UsuarioService();

    $email = filter_input(INPUT_POST, 'inputEmail', FILTER_SANITIZE_SPECIAL_CHARS);
    $senha = filter_input(INPUT_POST, 'inputSenha', FILTER_SANITIZE_SPECIAL_CHARS);

    $usuario = new Usuario();
    $usuario->setEmail($email);
    $usuario->setSenha($senha);

    if($user = $service->login($usuario))
    {
        $_SESSION['usuario'] = $user->getNome();
        header('location: ./home.php');
        exit;
    } else {
        $_SESSION['error'] = 'Verifique login/senha';
        header('location: ./login.php');
        exit;
    }

    
