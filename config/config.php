<?php 
    session_start();

    if(
        !isset($_SESSION['usuario_details']) 
        && basename($_SERVER['PHP_SELF']) != 'recuperar_senha.php'
        && basename($_SERVER['PHP_SELF']) != 'user.register.php'
    ) {
        $_SESSION['error'] = 'Faça o login primeiro';
        header('location: /estoque/login');
        exit;
    }

    # https://www.php.net/manual/en/function.date-default-timezone-set
    # https://www.php.net/manual/pt_BR/function.spl-autoload-register.php

    date_default_timezone_set('America/Sao_Paulo');

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