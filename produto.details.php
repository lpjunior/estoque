<?php 
  require_once('config/config.php'); 
  $produtoService = new ProdutoService(); 
  $produto = $produtoService->localizar($_GET['id']);
  
  $categoriaService = new CategoriaService(); 
  $categorias = $categoriaService->LocalizarPorIds(array($produto->getCategoriaId()));
  
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
              <form id="produtoform" action="" method="post">
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
                  <input type="number" step="any" id="valorVendaId" name="inputvalorVenda"  class="form-control" value="<?= $produto->getValorVenda() ?>">
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
          
          <div class="card card-info">
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Adicionar categoria</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <form id="addCategoriaform" action="" method="post">
                  <div class="form-group">
                    <label for="statusId">Status do produto</label>
                    <select id="statusId" name="inputStatus" class="form-control custom-select">
                      <option disabled>Selecione</option>
                      <option selected>Informática</option>
                      <option>Vestuário</option>
                    </select>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <button type="submit" form="addCategoriaform" class="btn btn-info float-right disabled">Adicionar</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <div class="card-header">
              <h3 class="card-title">Categoria(s)</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($categorias as $categoria): ?>
                  <tr>
                    <td><?= $categoria->getId() ?></td>
                    <td><?= $categoria->getNome() ?></td>
                    <td class="text-right py-0 align-middle">
                      <div class="btn-group btn-group-sm">
                        <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                        <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                      </div>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <a href="produtos" class="btn btn-secondary mb-3" onclick="return confirm('Deseja descartar as alterações?')">Cancel</a>
          <button type="submit" class="btn btn-success float-right">Salvar alterações</button>
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
</body>
</html>
