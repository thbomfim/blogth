<?php
include("config/config.php");
$pg = $_GET['pg'] ?? '';
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

          echo "<h1>$post[titulo]</h1>";
          echo "<small class='data'>$post[data]</small>";
          echo "<p>$post[texto]</p>";
        } else {
          echo "<p>Bem-vindo ao Blog do TH! Selecione um post para começar.</p>";
        }
        ?>
            </div>
        </main>

        <footer class="text-center">
            <div class="container">
                <p class="mb-0">© 2025 Blog do TH - Todos os direitos reservados.</p>
            </div>
        </footer>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>