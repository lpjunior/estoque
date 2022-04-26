<?php
    require_once('config/config.php');

    $categoriaService = new CategoriaService();
    $produtoService = new ProdutoService();
    $usuarioService = new usuarioService();

    $pathUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $urlSegments = explode('/', substr($pathUri, 1));

    if($urlSegments[count($urlSegments) - 1] == 'load-categorias') {
        $_SESSION['categorias'] = serialize($categoriaService->listar(10));

        header('location: /estoque/categorias');
        exit;
    }
    
    if($urlSegments[count($urlSegments) - 1] == 'load-produtos') {
        $_SESSION['produtos'] = serialize($produtoService->listar(10));

        header('location: /estoque/produtos');
        exit;
    }
    
    if($urlSegments[count($urlSegments) - 1] == 'load-usuarios') {
        $_SESSION['usuarios'] = serialize($usuarioService->listar(10));

        header('location: /estoque/usuarios');
        exit;
    }

    if($urlSegments[count($urlSegments) - 2] == 'load-categoria') {
        $id = $urlSegments[count($urlSegments) - 1];
        $_SESSION['categoria'] = serialize($categoriaService->LocalizarPorId($id));

        header('location: /estoque/categoria.details');
        exit;
    }

    if($urlSegments[count($urlSegments) - 2] == 'load-usuario') {
        $id = $urlSegments[count($urlSegments) - 1];
        $_SESSION['usuario'] = serialize($usuarioService->LocalizarPorId($id));

        header('location: /estoque/usuario.details');
        exit;
    }
    
    if($urlSegments[count($urlSegments) - 2] == 'load-produto') {
        $id = $urlSegments[count($urlSegments) - 1];

        $_SESSION['produto'] = serialize($produtoService->localizar($id));
        $_SESSION['categorias'] = serialize($categoriaService->listar());

        header('location: /estoque/produto.details');
        exit;
    }

    if($urlSegments[count($urlSegments) - 1] == 'load-home') {
        $_SESSION['produtos'] = serialize($produtoService->listar(3));
        $_SESSION['categorias'] = serialize($categoriaService->listarComQuantidade(3));
        
        header('location: /estoque/home');
        exit;
    }

