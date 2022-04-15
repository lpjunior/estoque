<?php 
    require_once('config/config.php');
    session_start();

    $service = new ProdutoService();

    $nome = filter_input(INPUT_POST, 'inputNome', FILTER_SANITIZE_SPECIAL_CHARS);
    $valorCompra = filter_input(INPUT_POST, 'inputvalorCompra', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $valorVenda = filter_input(INPUT_POST, 'inputvalorVenda', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $categoriaId = filter_input(INPUT_POST, 'inputCategoria', FILTER_SANITIZE_NUMBER_INT);
    $status = filter_input(INPUT_POST, 'inputStatus', FILTER_SANITIZE_NUMBER_INT);
    $descricao = filter_input(INPUT_POST, 'inputDescricao', FILTER_SANITIZE_SPECIAL_CHARS);
 
    $produto = new Produto();
    $produto->setNome($nome);
    $produto->setValorCompra($valorCompra);
    $produto->setValorVenda($valorVenda);
    $produto->setCategoriaId($categoriaId);
    $produto->setStatus($status);
    $produto->setDescricao($descricao);

    if($service->cadastrar($produto))
    {
        header('location: ./home');
        exit;
    } else {
        $_SESSION['error'] = 'Ocorreu uma falha ao cadastrar';
        header('location: ./produto');
        exit;
    }