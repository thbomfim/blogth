<?php
include("header.html");
include("config/config.php");

    if ($pg == "post") {
        $id = $_GET['id'];

        $sql = "SELECT * FROM posts WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $post = $stmt->fetch();
?>
        <br><h1><?php echo $post['titulo']; ?></h1>
        <br><h3><?php echo $post['intro']; ?></h3>
        <br><blockquote class="author"><?php echo $post['autor']; ?> <?php echo $post['dataCriado']; ?></blockquote>
        </div>
        <div class="container-md meu-container">
        <p class="capitalize"><?php echo $post['conteudo']; ?></p>
        <?php } else { ?>
        <p>Este post não existe.</p>
    <?php } ?>
    <button type="submit" class="btn btn-primary" onclick="window.history.back()">Voltar</button>
<?php
include("footer.html");
?>