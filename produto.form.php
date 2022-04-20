<?php 
  require_once('config/config.php');
  $categoriaService = new CategoriaService(); 

  $title = 'Cadastro do produto';
  include_once('header.php')
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Categoria</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home">Home</a></li>
              <li class="breadcrumb-item active">Categoria</li>
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
              <p class="lead mb-5">Cadastre um produto</p>
            </div>
          </div>
          <div class="col-7">
          <form id="produtoform" action="produto.register" method="post">
                <div class="form-group">
                  <label for="idNome">Nome do produto</label>
                  <input type="text" id="idNome" name="inputNome" class="form-control" value="">
                </div>
                <div class="form-group">
                  <label for="idvalorCompra">Valor de Compra</label>
                  <input type="number" step="any" id="idvalorCompra" name="inputvalorCompra" class="form-control" value="">
                </div>
                <div class="form-group">
                  <label for="valorVendaId">Valor de Venda</label>
                  <input type="number" step="any" id="valorVendaId" name="inputvalorVenda"  class="form-control" value="">
                </div>
                <div class="form-group">
                  <label for="CategoriaId">Categoria</label>
                  <select id="CategoriaId" name="inputCategoria" class="form-control custom-select">
                    <option selected disabled>Selecione</option>
                  <?php foreach($categoriaService->listar() as $categoria): ?>
                   
                    <option value="<?= $categoria->getId()?>"><?= $categoria->getNome()?></option>
                  <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="statusId">Status do produto</label>
                  <select id="statusId" name="inputStatus" class="form-control custom-select">
                    <option disabled>Selecione</option>
                    <option value="1" selected>Ativo</option>
                    <option value="0">Inativo</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="inputDescription">Descrição do produto</label>
                  <textarea id="inputDescription" name="inputDescricao" class="form-control" rows="4"></textarea>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-dark">Cadastrar</button>
                </div>
              </form>
          </div>
        </div>
      </div>
      <?php //unset($_SESSION['categorias']) ?>
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
</body>
</html>
