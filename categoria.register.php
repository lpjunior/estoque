<?php 
    require_once('config/config.php');
    session_start();

    $service = new CategoriaService();

    $nome = filter_input(INPUT_POST, 'inputNome', FILTER_SANITIZE_SPECIAL_CHARS);

    $categoria = new Categoria();
    $categoria->setNome($nome);

    if($service->cadastrar($categoria))
    {
        header('location: ./home');
        exit;
    } else {
        $_SESSION['error'] = 'Ocorreu uma falha ao cadastrar';
        header('location: ./categoria');
        exit;
    }