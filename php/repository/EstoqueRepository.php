<?php
class EstoqueRepository
{
    private $conn;

    public function __construct() {}
    
    function fnAddCategoria(Categoria $categoria): bool
    {
        try {

            $this->openConnection();

            $query = "insert into categoria (nome) values (:pnome) on conflict do nothing";

            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":pnome", $categoria->getNome());

            if ($stmt->execute())
                return true;

            return false;
        } catch (PDOException $error) {
            echo "Erro ao inserir a categoria no banco. Erro: {$error->getMessage()}";
            return false;
        } finally {
            unset($this->conn);
            unset($stmt);
        }
    }
    
    function fnUpdateCategoria(Categoria $categoria): bool
    {
        try {

            $this->openConnection();

            $query = "update categoria set nome = :pnome where id = :pid";

            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":pid", $categoria->getId());
            $stmt->bindValue(":pnome", $categoria->getNome());

            if ($stmt->execute())
                return true;

            return false;
        } catch (PDOException $error) {
            echo "Erro ao atualizar a categoria no banco. Erro: {$error->getMessage()}";
            return false;
        } finally {
            unset($this->conn);
            unset($stmt);
        }
    }

    function fnAddProduto($produto): bool
    {
        try {

            $this->openConnection();

            $query = "insert into produto (nome, descricao, valor_compra, valor_venda, status, categoria_id) ";
            $query .= "values (:pnome, :pdescricao, :pvalorCompra, :pvalorVenda, :pstatus, :pcategoriaId)";
            $query .= " on conflict do nothing";

            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":pnome", $produto->getNome());
            $stmt->bindValue(":pdescricao", $produto->getDescricao());
            $stmt->bindValue(":pvalorCompra", $produto->getValorCompra());
            $stmt->bindValue(":pvalorVenda", $produto->getValorVenda());
            $stmt->bindValue(":pstatus", $produto->getStatus());
            $stmt->bindValue(":pcategoriaId", $produto->getCategoriaId());

            if ($stmt->execute())
                return true;

            return false;
        } catch (PDOException $error) {
            echo "Erro ao inserir o produto no banco. Erro: {$error->getMessage()}";
            return false;
        } finally {
            unset($this->conn);
            unset($stmt);
        }
    }
    
    function fnUpdateProduto($produto): bool
    {
        try {

            $this->openConnection();

            $query = "update produto set nome = :pnome, descricao = :pdescricao, valor_compra = :pvalorCompra, valor_venda = :pvalorVenda, status = :pstatus ";
            $query .= "where id = :pid";

            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":pnome", $produto->getNome());
            $stmt->bindValue(":pdescricao", $produto->getDescricao());
            $stmt->bindValue(":pvalorCompra", $produto->getValorCompra());
            $stmt->bindValue(":pvalorVenda", $produto->getValorVenda());
            $stmt->bindValue(":pstatus", $produto->getStatus());
            $stmt->bindValue(":pid", $produto->getId());

            if ($stmt->execute())
                return true;

            return false;
        } catch (PDOException $error) {
            echo "Erro ao inserir o produto no banco. Erro: {$error->getMessage()}";
            return false;
        } finally {
            unset($this->conn);
            unset($stmt);
        }
    }
    
    function fnUpdateCategoriaProduto($produto): bool
    {
        try {

            $this->openConnection();

            $query = "update produto set categoria_id = :pcategoriaId ";
            $query .= "where id = :pid";

            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":pcategoriaId", $produto->getCategoriaId());
            $stmt->bindValue(":pid", $produto->getId());

            if ($stmt->execute())
                return true;

            return false;
        } catch (PDOException $error) {
            echo "Erro ao inserir o produto no banco. Erro: {$error->getMessage()}";
            return false;
        } finally {
            unset($this->conn);
            unset($stmt);
        }
    }

    function fnAddEstoque($estoque): bool
    {
        try {

            $this->openConnection();

            $query = "insert into estoque (data_cadastro, qtd_min, qtd_max, qtd_atual, produto_id) ";
            $query .= "values (:pdataCadastro, :pqtdMin, :pqtdMax, :pqtdAtual, :pprodutoId)";
            $query .= " on conflict do nothing";

            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":pdataCadastro", $estoque->getDataCadastro());
            $stmt->bindValue(":pqtdMin", $estoque->getQtdMin());
            $stmt->bindValue(":pqtdMax", $estoque->getQtdMax());
            $stmt->bindValue(":pqtdAtual", $estoque->getQtdAtual());
            $stmt->bindValue(":pprodutoId", $estoque->getProdutoId());

            if ($stmt->execute())
                return true;

            return false;
        } catch (PDOException $error) {
            echo "Erro ao inserir o estoque no banco. Erro: {$error->getMessage()}";
            return false;
        } finally {
            unset($this->conn);
            unset($stmt);
        }
    }

    public function fnListCategorias($limit, $page = 1) {
        try {

            $this->openConnection();

            $query = "select id, nome, criado_em criadoem from categoria limit :plimit offset (:ppage * :plimit)";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':plimit', $limit);
            $stmt->bindValue(':ppage', ($page - 1));

            if($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Categoria');
                return  $stmt->fetchAll();
            }

            return false;
        } catch (PDOException $error) {
            echo "Erro ao listar as categorias no banco. Erro: {$error->getMessage()}";
            return false;
        } finally {
            unset($this->conn);
            unset($stmt);
        }
    }

    public function fnLocalizarCategoria($id) {
        try {

            $this->openConnection();

            $query = "select * from categoria where id = :pid";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':pid', $id);

            if ($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Categoria');
                return  $stmt->fetch();
            }

            return false;
        } catch (PDOException $error) {
            echo "Erro ao listar as categorias no banco. Erro: {$error->getMessage()}";
            return false;
        } finally {
            unset($this->conn);
            unset($stmt);
        }
    }
    
    public function fnListCategoriasIn($ids) {
        try {

            $this->openConnection();

            $inQuery = implode(',', array_fill(0, count($ids), '?'));
            $query = "select * from categoria where id in ({$inQuery})";
            
            $stmt = $this->conn->prepare($query);
            foreach ($ids as $k => $id)
                $stmt->bindValue(($k + 1), $id);

            if ($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Categoria');
                return  $stmt->fetchAll();
            }

            return false;
        } catch (PDOException $error) {
            echo "Erro ao listar as categorias no banco. Erro: {$error->getMessage()}";
            return false;
        } finally {
            unset($this->conn);
            unset($stmt);
        }
    }
    
    public function fnListProdutos($limit) {
        try {

            $this->openConnection();

            $query = "select id, nome, descricao, valor_compra valorCompra, valor_venda valorVenda, status, categoria_id categoriaId, criado_em criadoEm from produto order by criado_em desc limit :plimit";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':plimit', $limit);

            if ($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Produto');
                return  $stmt->fetchAll();
            }

            return false;
        } catch (PDOException $error) {
            echo "Erro ao listar os produtos no banco. Erro: {$error->getMessage()}";
            return false;
        } finally {
            unset($this->conn);
            unset($stmt);
        }
    }

    public function fnLocalizarProduto($id) {
        try {

            $this->openConnection();

            $query = "select id, nome, descricao, valor_compra valorCompra, valor_venda valorVenda, status, categoria_id categoriaId, criado_em criadoEm from produto where id = :pid";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':pid', $id);

            if ($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Produto');
                return  $stmt->fetch();
            }

            return false;
        } catch (PDOException $error) {
            echo "Erro ao listar os produtos no banco. Erro: {$error->getMessage()}";
            return false;
        } finally {
            unset($this->conn);
            unset($stmt);
        }
    }

    public function fnListEstoque($limit = 9999) {
        try {

            $this->openConnection();

            $query = "id, data_cadastro datacadastro, qtd_min qtdmin, qtd_max qtdmax, qtd_atual qtdatual, produto_id produtoid from estoque order by criado_em desc limit :plimit";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':plimit', $limit);

            if ($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Estoque');
                return  $stmt->fetch();
            }

            return false;
        } catch (PDOException $error) {
            echo "Erro ao listar os produtos do estoque no banco. Erro: {$error->getMessage()}";
            return false;
        } finally {
            unset($this->conn);
            unset($stmt);
        }
    }

    public function fnListCategoriasQuantidade($limit = 9999) {
        try {

            $this->openConnection();

            $query = "select categoria.nome categoria, count(categoria_id) quantidade from produto " .
            "join categoria on categoria.id = categoria_id group by (categoria.nome, categoria_id) " .
            "order by count(categoria_id) desc limit :plimit;";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':plimit', $limit);

            if ($stmt->execute())
                return $stmt->fetchAll(PDO::FETCH_OBJ);

            return false;
        } catch (PDOException $error) {
            echo "Erro ao listar as categorias com quantidade no banco. Erro: {$error->getMessage()}";
            return false;
        } finally {
            unset($this->conn);
            unset($stmt);
        }
    }

    private function openConnection() {
        $connection = new Connection();
        $this->conn = $connection->getConnection();
    }
}
