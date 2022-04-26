<?php
require_once('config/config.php');
$title = 'Detalhes de usuário';
include_once('header.php');
$usuario = unserialize($_SESSION['usuario']);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Usuário</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="home">Home</a></li>
            <li class="breadcrumb-item active">Usuário</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-body row">
        <div class="col-5 text-center d-flex align-items-center justify-content-center">
          <div class="">
            <h2>Senac<strong>|Stock</strong></h2>
            <p class="lead mb-5">Detalhes do usuário</p>
          </div>
        </div>
        <div class="col-7">
          <form action="usuario.edit" method="post">
            <div class="form-group">
              <label for="idIdentificador">Identificador</label>
              <input type="text" id="idIdentificador" name="inputIdentificador" class="form-control" value="<?= $usuario->getId() ?>" readonly />
            </div>
            <div class="form-group">
              <label for="idNome">Nome</label>
              <input type="text" id="idNome" name="inputNome" class="form-control" value="<?= $usuario->getNome() ?>" />
            </div>
            <div class="form-group">
              <label for="idEmail">Email</label>
              <input type="text" id="idEmail" name="inputEmail" class="form-control" value="<?= $usuario->getEmail() ?>" />
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-dark">Salvar</button>
            </div>
          </form>
        </div>
        <div>
          <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#passwordModal">
            Alterar senha
          </button>

          <div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="passwordModalLabel">Mudar senha</h5>
                  <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                  <form id="formSenha" action="user.senha.edit" method="post">
                    <input type="hidden" id="inputIdentificador" name="inputIdentificador" value="<?= $usuario->getId() ?>" />
                    <div class="form-group">
                      <label for="inputSenha">Senha</label>
                      <input type="password" id="inputSenha" name="inputSenha" class="form-control" />
                    </div>
                    <div class="form-group">
                      <label for="inputSenhaRetry">Repetir Senha</label>
                      <input type="password" id="inputSenhaRetry" name="inputSenhaRepetida" class="form-control" />
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" form="formSenha" id="btnAlteraSenha" class="btn btn-success">Save changes</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<footer class="main-footer">
  <div class="float-right d-none d-sm-block">
    <b>Version</b> 1.1.0
  </div>
  <strong>Copyright &copy; 2022 <a href="index">Senac</strong>|Stock</a> All rights reserved.
</footer>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="resources/js/adminlte.min.js"></script>
<?php include "./toast.php" ?>
</body>

</html>