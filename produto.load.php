<?php
    require_once('config/config.php');
    
    session_start();
    $categoriaService = new CategoriaService();
    $produtoService = new ProdutoService();

    if(isset($_GET['load-categoria'])) {
        $_SESSION['categorias'] = serialize($categoriaService->listar());

        header('location: produto');
        exit;
    }

    if(isset($_GET['load-produto'])) {
        $_SESSION['produtos'] = $produtoService->listar(3);
        header('location: home');
        exit;
    }