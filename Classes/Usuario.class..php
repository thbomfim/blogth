<?php 
include("../config/config.php");

class Usuario {
    protected $id;
    protected $nome;
    protected $senha;
    protected $pdo;

    public function __construct($dbconnection) {
        $this->pdo = $dbconnection;
    }

    public function registrarUsuario() {
        $nome = $_POST["nome"];
        $senha = $_POST["senha"];

        if(empty($nome) || empty($senha)) {
            echo "Nome e senha são obrigatórios!";
            return;
        }

        $hashedSenha = password_hash($senha, PASSWORD_BCRYPT);

        $sql = "INSERT INTO usuarios (nome, senha) VALUES (:nome, :senha)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':senha', $hashedSenha);
        $result = $stmt->execute();

        if(!$result) {
            $error = $stmt->errorInfo();
            echo 'Ocorreu algum erro:' . $error[2];
        } else {
            echo 'Sucesso! Usuário registrado!';
        }
    }

    public function autenticarUsuario($usuario, $senha) {

        if(empty($usuario) || empty($senha)) {
            echo "Usuario e senha são obrigatórios!";
            return;
        }

        $sql = "SELECT * FROM usuarios WHERE nome = :nome";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nome', $usuario);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if($usuario && password_verify($senha, $usuario['senha'])) {
            echo 'Sucesso! Usuário autenticado!';
            // Aqui você pode iniciar a sessão e armazenar os dados do usuário
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION["nome"] = $usuario["nome"];
            $_SESSION["id"] = $usuario["id"];
            echo "ola Login realizado com sucesso";
            echo "<a href=\"painel.php\">CLIQUE AQUI</a>";
            exit;
        } else {
            echo 'Nome ou senha incorretos!';
        }
    }

    public function deletarUsuario() {
        $id = $_POST["id"];

        if (empty($id)) {
            echo 'Você precisa selecionar um usuário!';
            return;
        }

        $sql = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $result = $stmt->execute();

        if(!$result) {
            $error = $stmt->errorInfo();
            echo 'Ocorreu algum erro:' . $error[2];
        } else {
            echo 'Sucesso! Usuário deletado!';
        }
    }

    public function updateUsuario() {
        $id = $_POST["id"];
        $nome = $_POST["nome"];
        $senha = $_POST["senha"];

        if (empty($id) || empty($nome) || empty($senha)) {
            echo 'ID, nome e senha são obrigatórios!';
            return;
        }

        $hashedSenha = password_hash($senha, PASSWORD_BCRYPT);

        $sql = "UPDATE usuarios SET nome = :nome, senha = :senha WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':senha', $hashedSenha);
        $stmt->bindParam(':id', $id);
        $result = $stmt->execute();

        if(!$result) {
            $error = $stmt->errorInfo();
            echo 'Ocorreu algum erro:' . $error[2];
        } else {
            echo 'Sucesso! Usuário atualizado!';
        }
    }

    public function listarUsuarios() {
        $sql = "SELECT id, nome FROM usuarios";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $usuarios;
    }

    public function nameUser() {
    $sql = "SELECT nome FROM usuarios WHERE id = :iduser";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":iduser", $_SESSION["id"]);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row["nome"];
}
}
?>