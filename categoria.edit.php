<?php 
    require_once('config/config.php');
    session_start();

    $service = new CategoriaService();

    $id = filter_input(INPUT_POST, 'inputIdentificador', FILTER_SANITIZE_NUMBER_INT);
    $nome = filter_input(INPUT_POST, 'inputNome', FILTER_SANITIZE_SPECIAL_CHARS);

    $categoria = new Categoria();
    $categoria->setId($id);
    $categoria->setNome($nome);

    if($service->atualizar($categoria))
    {
        header('location: ./load.php/load-categorias');
        exit;
    } else {
        $_SESSION['error'] = 'Ocorreu uma falha ao cadastrar';
        header('location: ./categoria');
        exit;
    }