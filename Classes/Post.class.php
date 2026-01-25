<?php
class Post{
    protected $id;
    protected $titulo;
    protected $conteudo;
    protected $autor;
    protected $dataCriado;
    protected $dataModificado;
    protected $pdo;

    public function __construct($dbconnection) {
        $this->pdo = $dbconnection;
    }
    
    public function adicionarPost() {
    $titulo = $_POST["titulo"];
    $conteudo = $_POST["conteudo"];
    $autor = $_POST["autor"];
    
    if(empty($titulo)) {
        echo "Digite um titulo para o post!";
        exit;
    }elseif(empty($conteudo)) {
        echo "Digite o conteudo do post!";
        exit;
    }elseif(empty($autor)) {
        echo "É preciso de um autor para postar";
        exit;
    }elseif(strlen($titulo) < 5) {
        echo "O titulo precisa ter pelo menos 5 caracteres!";
        exit;
    }elseif(strlen($conteudo) < 50) {
        echo "O conteudo do post precisa ter pelo menos 50 caracteres!";
        exit;
    }

    $dataCriado = date("Y-m-d H:i:s");
    
    $sql = "INSERT INTO posts (autor, titulo, intro, conteudo, dataCriado) VALUES (:autor, :titulo, :intro, :conteudo, :dataCriado)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':autor', $autor);
    $stmt->bindParam(':titulo', $titulo);
    $intro = substr($conteudo, 0, 150) . '...'; //gerar uma intro com os primeiros 150 caracteres do conteudo
    $stmt->bindParam(':intro', $intro);
    $stmt->bindParam(':conteudo', $conteudo);
    $stmt->bindParam(':dataCriado', $dataCriado);
    $result = $stmt->execute();

    if(!$result) {
        $error = $stmt->errorInfo();
        echo 'Ocorreu algum erro:' . $error[2];
    }else{
        echo 'Sucesso! Post adicionado!';
    }
    }

    public function deletarPost() {
        $id = $_POST["id"];

        if (empty($id)) {
            echo 'Você precisa selecionar um post!';
            return;
        }

        //verifica se o post existe
        $sql = "SELECT id FROM posts WHERE id =:id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            echo 'Este post não existe!';
            return;
        }

        //deleta o post
        $sql = "DELETE FROM posts WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            echo 'Post deletado com sucesso!';
        }else {
            $error = $stmt->errorInfo();
            echo 'Ocorreu um erro ao deletar o post:' . $error[2];
        }
    }

    public function updatePost() {
        $id = $_POST["id"];

        if (empty($id)) {
            echo 'Você precisa selecionar um post para modificar!';
            return;
        }

        //verificar se o post existe
        $sql = "SELECT id FROM posts WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            echo 'Este post não existe!';
            return;
        }

        //define a data de modificação
        $dataModificado = date("Y-m-d H:i:s");

        //faz o update no post
        $conteudo = $_POST["conteudo"];
        $sql = "UPDATE posts SET titulo = ?, intro = ?, conteudo = ?, dataModificado = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam("?", $titulo);
        $stmt->bindParam("?", $intro);
        $stmt->bindParam("?", $conteudo);
        $stmt->bindParam("?", $dataModificado);
        
        if ($stmt->execute()) {
            echo 'Post atualizado com sucesso!';
        }else{
            $error = $stmt->errorInfo();
            echo 'Ocorreu algum erro ao atualizar o post error: ' . $error[2];
        }
    }

    public function mostrarTitulo() {
        //verifica se o post existe
        $sql = "SELECT id FROM post WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam("?", $id);
        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            echo 'Este post não existe';
            return;
        }

        //procura o titulo do post
        $sql = "SELECT titulo FROM post WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam("?", $id);
        $stmt->execute();
        $result = $stmt->fetch();

        echo "$result";
        return;
    }

    public function mostrarAutor() {
        //verifica se o post existe
        $sql = "SELECT id FROM post WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam("?", $id);
        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            echo 'Este post não existe';
            return;
        }

        //procura o autor do post
        $sql = "SELECT autor FROM post WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam("?", $id);
        $stmt->execute();
        $result = $stmt->fetch();

        echo "$result";
        return;
    }

    public function mostrarConteudo() {
        //verifica se o post existe
        $sql = "SELECT id FROM post WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam("?", $id);
        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            echo 'Este post não existe';
            return;
        }

        //procura o conteudo do post
        $sql = "SELECT conteudo FROM post WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam("?", $id);
        $stmt->execute();
        $result = $stmt->fetch();

        echo "$result";
        return;
    }

    public function mostrarDataCriado() {
        //verifica se o post existe
        $sql = "SELECT id FROM post WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam("?", $id);
        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            echo 'Este post não existe';
            return;
        }

        //procura a data que foi criado o post
        $sql = "SELECT dataCriado FROM post WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam("?", $id);
        $stmt->execute();
        $result = $stmt->fetch();

        echo "$result";
        return;
    }

    public function mostrarDataModificado() {
        //verifica se o post existe
        $sql = "SELECT id FROM post WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam("?", $id);
        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            echo 'Este post não existe';
            return;
        }

        /**
         * preciso fazer colocar para puxar a ultima da que foi modificado pois assim nao vai
         */
        //procura a data que o post foi modificado
        $sql = "SELECT dataModificado FROM post WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam("?", $id);
        $stmt->execute();
        $result = $stmt->fetch();

        echo "$result";
        return;
    }
    
    public function listarPosts() {
        $sql = "SELECT id, titulo, autor, intro, dataCriado FROM posts ORDER BY id DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $posts;
    }

}
?>