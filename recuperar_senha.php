<?php
    require_once('sendmail.php');
    require_once('config/config.php');

    $email = filter_input(INPUT_POST, 'inputContato', FILTER_SANITIZE_SPECIAL_CHARS);

    $service = new UsuarioService();

    $usuario = $service->LocalizarPorEmail($email);

    $senhaNova = uniqid('senac_');
    
    $usuario->setSenha("123123");

    // $usuario = $service->atualizarSenha($usuario);

    enviarEmail($usuario);

