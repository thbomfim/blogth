<?php
include("header.html");
include("config/config.php");
include("Classes/Post.class.php");


    if ($pg == "post") {
        $post = new Post($pdo);
        ?>
        
        <br><h1><?= $post->mostrarTitulo(); ?></h1><br>
        <blockquote class="author"><?= $post->mostrarAutor(); ?> <?= $post->mostrarDataCriado() ?></blockquote><br>
        <h3><?= $post->mostrarIntro(); ?></h3><br>
    </div>
        <div class="container-md meu-container">
        <!-- tenho que fazer um tratamento no objeto mostrarConteudo para mostrar somente a proxima palvra depois da intro -->
        <p class="capitalize"><?= $post->mostrarConteudo() ?></p>
        <?php } else { ?>
        <p>Este post não existe.</p>

        <?php
    }

?>
    <center><button type="submit" class="btn btn-primary" onclick="window.history.back()">Voltar</button></center>
<?php
include("footer.html");
?>