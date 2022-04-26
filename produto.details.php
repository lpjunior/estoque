<?php
require_once('config/config.php');

$produto = unserialize($_SESSION['produto']);
$categorias = unserialize($_SESSION['categorias']);

$title = 'Detalhes do produto';
include_once('header.php');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Produtos</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="home">Home</a></li>
            <li class="breadcrumb-item active">Produtos</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-6">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Produto</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <form id="produtoform" action="produto.edit" method="post">
              <div class="form-group">
                <label for="idProduto">ID do produto</label>
                <input type="number" id="idProduto" name="inputId" class="form-control" value="<?= $produto->getId() ?>" readonly>
              </div>
              <div class="form-group">
                <label for="idNome">Nome do produto</label>
                <input type="text" id="idNome" name="inputNome" class="form-control" value="<?= $produto->getNome() ?>">
              </div>
              <div class="form-group">
                <label for="idvalorCompra">Valor de Compra</label>
                <input type="number" step="any" id="idvalorCompra" name="inputvalorCompra" class="form-control" value="<?= $produto->getValorCompra() ?>">
              </div>
              <div class="form-group">
                <label for="valorVendaId">Valor de Venda</label>
                <input type="number" step="any" id="valorVendaId" name="inputvalorVenda" class="form-control" value="<?= $produto->getValorVenda() ?>">
              </div>
              <div class="form-group">
                <label for="statusId">Status do produto</label>
                <select id="statusId" name="inputStatus" class="form-control custom-select">
                  <option disabled>Selecione</option>
                  <option value="1" <?= ($produto->getStatus()) ? 'selected' : '' ?>>Ativo</option>
                  <option value="0" <?= (!$produto->getStatus()) ? 'selected' : '' ?>>Inativo</option>
                </select>
              </div>
              <div class="form-group">
                <label for="inputDescription">Descrição do produto</label>
                <textarea id="inputDescription" name="inputDescricao" class="form-control" rows="4"><?= $produto->getDescricao() ?></textarea>
              </div>
            </form>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>

      <div class="col-md-6">
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">Alterar categoria</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <form id="addCategoriaform" action="produto.categoria.edit" method="post">
            <input type="hidden" id="idProduto2" name="inputId" class="form-control" value="<?= $produto->getId() ?>">  
            <div class="form-group">
                <label for="statusId">Categoria do produto</label>
                <select id="statusId" name="inputCategoria" class="form-control custom-select">
                    <?php foreach ($categorias as $categoria): ?>
                      <option <?= ($produto->getCategoriaId() == $categoria->getId()) ? 'selected' : '' ?> value="<?= $categoria->getId() ?>"><?= $categoria->getNome() ?></option>
                    <?php endforeach; ?>
                </select>
              </div>
              <div class="row">
                <div class="col-12">
                  <button type="submit" form="addCategoriaform" class="btn btn-danger float-right">Modificar</button>
                </div>
              </div>
            </form>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <a href="produtos" class="btn btn-secondary mb-3" onclick="return confirm('Deseja descartar as alterações?')">Cancel</a>
        <button type="submit" form="produtoform" class="btn btn-success float-right">Salvar alterações</button>
      </div>
    </div>
  </section>
</div>

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