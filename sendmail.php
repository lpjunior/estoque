<?php

    use PHPMailer\PHPMailer\PHPMailer;
    require 'vendor/autoload.php';
    define('GUSER', '');
    define('GPWD', '');

    function enviarEmail(Usuario $usuario)
    {
        $mail = new PHPMailer;

        # configuração para envio
        $mail->isSMTP();
        $mail->SMTPDebug = 0; # 0 - não debugar, 1 - cliente mensagens, 2 - cliente e server mensagens
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->SMTPAuth = true;
        $mail->Username = GUSER;
        $mail->Password = GPWD;
        $mail->setFrom(GUSER, 'Senac|Stock');
        $mail->addAddress($usuario->getEmail());
        $mail->Subject = 'Recuperar senha';
        $mail->msgHTML(montaMsg($usuario->getSenha()));
        $mail->AltBody = "Sua nova senha é: {$usuario->getSenha()}";

        # configuração de log
        date_default_timezone_set('America/Sao_Paulo');
        $date = date('Y-m-d H:i');

        #envio do email
        if(!$mail->send())
        {
            $log = fopen("email_log.txt", "a");
            fwrite($log, "{$mail->ErrorInfo}\r\n{$usuario->getEmail()}\r\n{$date}\r\n\r\n");
            fclose($log);
            redirectLogin('danger', 'Ocorreu uma falha ao enviar a senha para o email');
        } else {
            $log = fopen("email_log.txt", "a");
            fwrite($log, "Email enviado: {$usuario->getEmail()} - {$date}\r\n\r\n");
            fclose($log);
            redirectLogin('success', 'Foi gerado uma nova senha. Verifique seu email');
        }
    }

    function montaMsg(string $senha)
    {
        return "<!DOCTYPE html>"
        . "<html lang=\"pt-br\">"
        . " <head>"
            . "<meta charset=\"UTF-8\">"
            . "<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">"
            . "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">"
            . "<title>Recuperação de senha</title>"
        . "</head>"
        . "<body>"
            . "<h1>Recuperação senha <strong>Senac</strong>|Stock</h1>"
            . "<div align=\"center\">"
                . "<h3>Sua nova senha é: {$senha}</h3>"
           . "</div>"
        . "</body>"
        . "</html>";
    }

    function redirectLogin($status, $msg)
    {
        session_start();

        $notificacao = new stdClass();
        $notificacao->status = $status;
        $notificacao->msg = $msg;
        $_SESSION['status_login'] = serialize($notificacao);
        header('location: /estoque/login');
        exit;
    }
