<?php 

    # https://www.php.net/manual/en/function.date-default-timezone-set
    # https://www.php.net/manual/en/function.spl-autoload-register.php
    # https://www.php.net/manual/en/function.file-exists

    date_default_timezone_set('America/Sao_Paulo');

    spl_autoload_register(function ($file_name) {
        # inclui classes do diretório php
        $filename = "php" . DIRECTORY_SEPARATOR . "$file_name.php";
        if (file_exists($filename)) {
            require_once($filename);
        }

        # inclui classes do diretório php/model
        $filename = "php" . DIRECTORY_SEPARATOR . "model" . DIRECTORY_SEPARATOR . "$file_name.php";
        if (file_exists($filename)) {
            require_once($filename);
        }

        # inclui classes do diretório php/service
        $filename = "php" . DIRECTORY_SEPARATOR . "service" . DIRECTORY_SEPARATOR . "$file_name.php";
        if (file_exists($filename)) {
            require_once($filename);
        }
        
        # inclui classes do diretório php/service
        $filename = "php" . DIRECTORY_SEPARATOR . "repository" . DIRECTORY_SEPARATOR . "$file_name.php";
        if (file_exists($filename)) {
            require_once($filename);
        }
    });