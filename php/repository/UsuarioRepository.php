<?php
class UsuarioRepository
{
    private $conn;

    public function __construct() {}
    
    function fnAddUsuario(Usuario $usuario): bool
    {
        try {
            $this->openConnection();

            $query = "insert into usuario (nome, email, senha) values (:pnome, :pemail, :psenha) on conflict do nothing";

            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":pnome", $usuario->getNome());
            $stmt->bindValue(":pemail", $usuario->getEmail());
            $stmt->bindValue(":psenha", md5($usuario->getSenha()));

            if ($stmt->execute())
                return true;

            return false;
        } catch (PDOException $error) {
            echo "Erro ao inserir o usuário no banco. Erro: {$error->getMessage()}";
            return false;
        } finally {
            unset($this->conn);
            unset($stmt);
        }
    }
    
    function fnUpdateUsuario(Usuario $usuario): bool
    {
        try {
            $this->openConnection();

            $query = "update usuario set nome = :pnome, email = :pemail where id = :pid";

            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":pnome", $usuario->getNome());
            $stmt->bindValue(":pemail", $usuario->getEmail());
            $stmt->bindValue(":pid", $usuario->getId());

            if ($stmt->execute())
                return true;

            return false;
        } catch (PDOException $error) {
            echo "Erro ao inserir o usuário no banco. Erro: {$error->getMessage()}";
            return false;
        } finally {
            unset($this->conn);
            unset($stmt);
        }
    }
    
    function fnUpdateSenhaUsuario(Usuario $usuario): bool
    {
        try {
            $this->openConnection();

            $query = "update usuario set senha = :psenha where id = :pid";

            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":psenha", md5($usuario->getSenha()));
            $stmt->bindValue(":pid", $usuario->getId());

            if ($stmt->execute())
                return true;

            return false;
        } catch (PDOException $error) {
            echo "Erro ao inserir o usuário no banco. Erro: {$error->getMessage()}";
            return false;
        } finally {
            unset($this->conn);
            unset($stmt);
        }
    }

    function fnLoginUsuario(Usuario $usuario)
    {
        try {
            $this->openConnection();

            $query = "select id, nome, email from usuario where email = :pemail and senha = :psenha";

            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":pemail", $usuario->getEmail());
            $stmt->bindValue(":psenha", md5($usuario->getSenha()));

            if ($stmt->execute())
                $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Usuario');
                if($usuario = $stmt->fetch())
                    return $usuario;

            return null;
        } catch (PDOException $error) {
            echo "Erro ao efetuar o login do usuário. Erro: {$error->getMessage()}";
            return null;
        } finally {
            unset($this->conn);
            unset($stmt);
        }
    }

    public function fnLisUsuarios($limit = 9999) {
        try {
            $this->openConnection();

            $query = "select id, nome, email from usuario limit :plimit";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':plimit', $limit);

            if($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Usuario');
                return  $stmt->fetchAll();
            }

            return false;
        } catch (PDOException $error) {
            echo "Erro ao listar os usuários do banco. Erro: {$error->getMessage()}";
            return false;
        } finally {
            unset($this->conn);
            unset($stmt);
        }
    }
    
    public function fnLocalizarUsuario($id) {
        try {
            $this->openConnection();

            $query = "select id, nome, email from usuario where id = :pid";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':pid', $id);

            if($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Usuario');
                return  $stmt->fetch();
            }

            return false;
        } catch (PDOException $error) {
            echo "Erro ao localizar o usuário do banco. Erro: {$error->getMessage()}";
            return false;
        } finally {
            unset($this->conn);
            unset($stmt);
        }
    }
    
    public function fnLocalizarUsuarioPorEmail($email) {
        try {
            $this->openConnection();

            $query = "select id, nome, email from usuario where email = :pemail";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':pemail', $email);

            if($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Usuario');
                return  $stmt->fetch();
            }

            return false;
        } catch (PDOException $error) {
            echo "Erro ao localizar o usuário do banco. Erro: {$error->getMessage()}";
            return false;
        } finally {
            unset($this->conn);
            unset($stmt);
        }
    }

    function fnSaveToken(AuthToken $token): bool
    {
        try {
            $this->openConnection();

            $query = "insert into auth_token (usuario_id, token, encryption_key) values (:pUsuarioId, :pToken, :pEncryptionKey) on conflict(usuario_id) do update set token = excluded.token, encryption_key = excluded.encryption_key";

            $connection = new Connection();
            $this->conn = $connection->getConnection();

            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":pUsuarioId", $token->getUsuarioId());
            $stmt->bindValue(":pToken", $token->getToken());
            $stmt->bindValue(":pEncryptionKey", $token->getEncryptionKey());

            if ($stmt->execute())
                return true;

            return false;
        } catch (PDOException $error) {
            echo "Erro ao inserir a token no banco. Erro: {$error->getMessage()}";
            return false;
        } finally {
            unset($this->conn);
            unset($stmt);
        }
    } 

    public function fnLocalizarTokenUsuario($token) {
        try {

            $this->openConnection();

            $query = "select id, usuario_id usuarioId, token, ultimo_acesso ultimoAcesso, atualizado_em atualizadoEm, criado_em criadoEm from auth_token where token = :pToken";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':pToken', $token);

            if($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'AuthToken');
                return  $stmt->fetch();
            }

            return false;
        } catch (PDOException $error) {
            echo "Erro ao localizar a token do usuário do banco. Erro: {$error->getMessage()}";
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
