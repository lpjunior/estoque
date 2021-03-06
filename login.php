<?php
  session_start();
  require_once('./util/Crypt.php');
  require_once('./php/model/Usuario.php');

  if (isset($_SESSION['usuario_details'])) {
    header('location: ./load.php/load-home');
    exit;
  }

  if(isset($_COOKIE['auth']) && !empty($_COOKIE['auth'])) {
    $crypt = new Crypt;
    $ecrypted = json_decode($_COOKIE['auth']);
    
    $user = unserialize(json_decode($crypt->decrypt($ecrypted->data, $ecrypted->key)));
  }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Senac|Stock - Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css" integrity="sha512-8vq2g5nHE062j3xor4XxPeZiPjmRDh6wlufQlfC6pdQ/9urJkU07NM0tEREeymP++NczacJ/Q59ul+/K2eYvcg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Theme style -->
  <link rel="stylesheet" href="resources/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <b>Senac</b>|Stock
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Informe suas credenciais para acessar</p>
        <?php if(isset($_SESSION['status_login'])) :
          $notificacao = unserialize($_SESSION['status_login']);
        ?>
        <p class="login-box-msg text-<?= $notificacao->status ?>"><?= $notificacao->msg ?></p>
        <?php 
          endif;
          unset($_SESSION['status_login']);
        ?>
        <form action="user.login" method="post">
          <div class="input-group mb-3">
            <input type="email" class="form-control" name="inputEmail" placeholder="Email" value="<?= isset($user) ? $user->getEmail() : '' ?>">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="inputSenha" placeholder="Password" value="<?= isset($user) ? $user->getSenha() : '' ?>">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember" name="remember" <?= isset($user) ? 'checked' : '' ?>>
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-dark btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <div class="text-center mb-3">
          <p>- OR -</p>
          <a href="forgot-password" class="btn btn-block btn-outline-danger">
            Esqueci minha senha
          </a>
          <a href="register" class="btn btn-block btn-outline-success">
            Registrar um novo usu??rio
          </a>
        </div>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- Bootstrap 4 -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <!-- AdminLTE App -->
  <script src="resources/js/adminlte.min.js"></script>
</body>

</html>