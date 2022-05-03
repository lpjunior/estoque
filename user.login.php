<?php

spl_autoload_register(function ($file_name) {

    $files = array(
        # incluir as classes do diretório php/model
        "php" . DIRECTORY_SEPARATOR . "model" . DIRECTORY_SEPARATOR . "{$file_name}.php",
        # incluir as classes do diretório php/repository
        "php" . DIRECTORY_SEPARATOR . "repository" . DIRECTORY_SEPARATOR . "{$file_name}.php",
        # incluir as classes do diretório php/service
        "php" . DIRECTORY_SEPARATOR . "service" . DIRECTORY_SEPARATOR . "{$file_name}.php",
        # incluir as classes do diretório util/
        "util" . DIRECTORY_SEPARATOR . "{$file_name}.php",
    );

    foreach ($files as $fileName) {
        if (file_exists($fileName)) {
            require_once($fileName);
        }
    }
});

session_start();

$service = new UsuarioService();

$email = filter_input(INPUT_POST, 'inputEmail', FILTER_SANITIZE_SPECIAL_CHARS);
$senha = filter_input(INPUT_POST, 'inputSenha', FILTER_SANITIZE_SPECIAL_CHARS);
$remember = filter_input(INPUT_POST, 'remember');

$usuario = new Usuario();
$usuario->setEmail($email);
$usuario->setSenha($senha);

if ($user = $service->login($usuario)) {

    $_SESSION['usuario_details'] = $user->getNome();
    
    if (isset($remember)) {

        # cria as intancias de Crypt e AuthToken
        $crypt = new Crypt;

        # gera uma token nova a cada chamada usando sha1
        $token = sha1(uniqid(mt_rand() + time(), true));

        # gera o tempo de expiração do token (1 mês)
        $expire = (time() + (30 * 24 * 3600));
        
        $encryp_obj =  $crypt->encrypt(json_encode(serialize($usuario)));

        $auth = array(
            'data' => $encryp_obj['encryption'], 
            'key' => $encryp_obj['encryption_key'], 
            'token' => $token
        );

        setcookie('auth', json_encode($auth), $expire, '/', 'localhost', isset($_SERVER['HTTPS']), true);
    }

    redirectPage('./load.php/load-home');
} else {

    $notificacao = new stdClass();
    $notificacao->status = "danger";
    $notificacao->msg = 'Verifique login/senha';
    $_SESSION['status_login'] = serialize($notificacao);

    redirectPage('/estoque/login');
}

function redirectPage($path)
{
    header("location: {$path}");
    exit;
}