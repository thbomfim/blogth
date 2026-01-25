<?php
include("config/config.php");
?>
<!doctype html>
<html lang="pt-br" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog do TH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilo/style.css">

</head>

<body>
    <div class="pagina">

        <header class="text-center">
            <div class="container-md meu-container">
                <h1 id="logo">Blog do TH</h1>
                <nav class="menu">
                    <a href="?pg=home">Home</a>
                    <a href="?pg=sobre">Sobre mim</a>
                    <a href="?pg=sociais">Sociais</a>
                </nav>
            </div>
        </header>

        <main>
            <div class="container-md text-center meu-container">
                <?php
        if ($pg == "post") {
          $id = $_GET['id'];

          $sql = "SELECT * FROM posts WHERE id = :id";
          $stmt = $pdo->prepare($sql);
          $stmt->bindParam(':id', $id);
          $stmt->execute();
          $post = $stmt->fetch();

          echo "<br><h1>$post[titulo]</h1>";
          echo "<br><h3>$post[intro]</h3>";
          echo "<br><blockquote class=\"author\">$post[autor] $post[dataCriado]</blockquote>";
        echo" </div>";
        echo "<div class=\"container-md meu-container\">";
          echo "<p class=\"capitalize\">$post[conteudo]</p>";
        } else {
          echo "<p>Bem-vindo ao Blog do TH! Selecione um post para começar.</p>";
        }
        ?>
        <button type="submit" class="btn btn-primary" onclick="window.history.back()">Voltar</button>
        </div>
        </main>

        <footer>
            <div class="container-md meu-container">
                <div class="mb-0 text-center">&copy 2025 Blog do TH - Todos os direitos reservados.</div>
            </div>
        </footer>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>