
<?php 
session_start();
include("../config/config.php");
?>
<!doctype html>
<html lang="pt-br" data-bs-theme="dark">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog do th</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../estilo/style.css">
  </head>
  <body>
    <div class="container-sm text-center">

        <header>
        <h1 id="logo">Blog do TH</h1>
        <nav class="menu">
            <a>Home</a> 
            <a>Sobre min</a> 
            <a>Socias</a>
        </nav>
        </header>

    <main>
        <?php
          if(!isset($_SESSION["id"])) {
            echo "Você não esta logado!";
            echo "<a href=\"index.php\">Entre novamente aqui!</a>";
            exit;
          }
        ?>
        <a href="admincp.php?pg=novouser">Cadastrar novo Usuario</a><br>
        <a href="admincp.php?pg=newpost">Novo Post</a>
    </main>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>