<?php 
    require_once('config/config.php');

    $service = new ProdutoService();

    $id = filter_input(INPUT_POST, 'inputId', FILTER_SANITIZE_NUMBER_INT);
    $categoriaId = filter_input(INPUT_POST, 'inputCategoria', FILTER_SANITIZE_NUMBER_INT);

    $produto = new Produto();
    $produto->setId($id);
    $produto->setCategoriaId($categoriaId);

    if ($service->atualizarCategoria($produto)) {
        $notificacao = new stdClass();
        $notificacao->status = "success";
        $notificacao->acao = "Atualizar";
        $notificacao->pagina = "Produto";
        $notificacao->msg = "Categoria do produto atualizado com sucesso";
        $_SESSION['status'] = serialize($notificacao);
    } else {
        $notificacao = new stdClass();
        $notificacao->status = "danger";
        $notificacao->acao = "Atualizar";
        $notificacao->pagina = "Produto";
        $notificacao->msg = "Falha ao atualizar a categoria do produto";
        $_SESSION['status'] = serialize($notificacao);
    }

    header("location: load.php/load-produto/{$produto->getId()}");
    exit;