<?php
    require_once('config/config.php');

    $categoriaService = new CategoriaService();

    # cadastrar categoria
    $categoria = new Categoria();
    $categoria->setNome("Informática");
    $categoriaService->cadastrar($categoria);
    
    $produtoService = new ProdutoService();
    
    # cadastrar produto
    $produto = new Produto();
    $produto->setNome('Mouse Logitech G600');
    $produto->setDescricao('Mouse Gamer');
    $produto->setValorCompra(110.00);
    $produto->setdValorVenda(538.00);
    $produto->setStatus(true);
    $produto->setCategoriaId(1);

    $produtoService->cadastrar($produto);

    # cadastrar estoque
    $estoqueService = new EstoqueService();
    $estoque = new Estoque();
    $estoque->setDataCadastro(date('Y-m-d H:i:s'));
    $estoque->setQtdMin(5);
    $estoque->setQtdMax(99);
    $estoque->setQtdAtual(35);
    $estoque->setProdutoId(1);

    $estoqueService->cadastrar($estoque);