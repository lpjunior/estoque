<?php
    require_once('config/config.php');

    $service = new UsuarioService();

    $id = filter_input(INPUT_POST, 'inputIdentificador', FILTER_SANITIZE_NUMBER_INT);
    $senha = filter_input(INPUT_POST, 'inputSenha', FILTER_SANITIZE_SPECIAL_CHARS);
    $senhaRepetida = filter_input(INPUT_POST, 'inputSenhaRepetida', FILTER_SANITIZE_SPECIAL_CHARS);

    if ($senha !== $senhaRepetida) {
        $notificacao = new stdClass();
        $notificacao->status = "danger";
        $notificacao->acao = "Atualizar";
        $notificacao->pagina = "Usuário";
        $notificacao->msg = "Senha não confere";
        $_SESSION['status'] = serialize($notificacao);

        header('location: /estoque/usuario.details');
        exit;
    }

    $usuario = new Usuario();
    $usuario->setId($id);
    $usuario->setSenha($senha);

    if ($service->atualizarSenha($usuario)) {
        $notificacao = new stdClass();
        $notificacao->status = "success";
        $notificacao->acao = "Atualizar";
        $notificacao->pagina = "Usuário";
        $notificacao->msg = "Senha atualizada com sucesso";
        $_SESSION['status'] = serialize($notificacao);
    } else {
        $notificacao = new stdClass();
        $notificacao->status = "danger";
        $notificacao->acao = "Atualizar";
        $notificacao->pagina = "Usuário";
        $notificacao->msg = "Falha ao atualizar a senha";
        $_SESSION['status'] = serialize($notificacao);
    }

    header('location: /estoque/usuario.details');
    exit;
