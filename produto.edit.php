<?php 
    require_once('config/config.php');

    $service = new ProdutoService();

    $id = filter_input(INPUT_POST, 'inputId', FILTER_SANITIZE_NUMBER_INT);
    $nome = filter_input(INPUT_POST, 'inputNome', FILTER_SANITIZE_SPECIAL_CHARS);
    $valorCompra = filter_input(INPUT_POST, 'inputvalorCompra', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $valorVenda = filter_input(INPUT_POST, 'inputvalorVenda', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $categoriaId = filter_input(INPUT_POST, 'inputCategoria', FILTER_SANITIZE_NUMBER_INT);
    $status = filter_input(INPUT_POST, 'inputStatus', FILTER_SANITIZE_NUMBER_INT);
    $descricao = filter_input(INPUT_POST, 'inputDescricao', FILTER_SANITIZE_SPECIAL_CHARS);

    $produto = new Produto();

    $produto->setId($id);
    $produto->setNome($nome);
    $produto->setValorCompra($valorCompra);
    $produto->setValorVenda($valorVenda);
    $produto->setStatus($status);
    $produto->setDescricao($descricao);

    if ($service->atualizar($produto)) {
        $notificacao = new stdClass();
        $notificacao->status = "success";
        $notificacao->acao = "Atualizar";
        $notificacao->pagina = "Produto";
        $notificacao->msg = "Produto atualizado com sucesso";
        $_SESSION['status'] = serialize($notificacao);
    } else {
        $notificacao = new stdClass();
        $notificacao->status = "danger";
        $notificacao->acao = "Atualizar";
        $notificacao->pagina = "Produto";
        $notificacao->msg = "Falha ao atualizar o produto";
        $_SESSION['status'] = serialize($notificacao);
    }

    header("location: load.php/load-produto/{$produto->getId()}");
    exit;