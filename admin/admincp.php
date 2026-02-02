<?php 
session_start();
include("../config/config.php");
include("../config/function.php");
include("../Classes/Usuario.class..php");
include("../Classes/Post.class.php");
?>
<!doctype html>
<html lang="pt-br" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog do th</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../estilo/style.css">
</head>

<body>
    <div class="container text-center">

        <header>
            <h1 id="logo">Blog do TH</h1>
            <nav class="menu">
                <a>Home</a>
                <a>Sobre min</a>
                <a>Socias</a>
            </nav>
        </header>

            <?php
            if(!isset($_SESSION["id"])) {
              echo "Você não esta logado!";
              echo "<a href=\"index.php\">Entre novamente aqui!</a>";
              exit;
            } 
            if ($pg == "novouser") {
                
            ?>
                <br>
                <form action="?pg=novouserok" method="post">
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <label class="form-label">Nome:</label>
                            <input type="text" name="nome" class="form-control" id="nome" /><br>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <label class="form-label">Senha:</label>
                            <input type="password" name="senha" class="form-control" id="senha" /><br>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                    <button type="submit" class="btn btn-primary" onclick="window.history.back()">Voltar</button>
            <?php
            }elseif ($pg == "novouserok") {

                $Usuario = new Usuario($pdo);
                $Usuario->registrarUsuario();
                ?>
                <button type="submit" class="btn btn-primary" onclick="window.history.back()">Voltar</button>
                <?php
            }elseif($pg == "newpost") {
            ?>
                <h2>Adicionar um novo Post</h2><br>
                <form action="?pg=newpostok" method="post">
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <label class="form-label">Titulo:</label>
                            <input type="text" name="titulo" class="form-control" id="titulo" /><br>
                        </div>
                    </div>
                    
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <label class="form-label">post:</label>
                            <textarea name="conteudo" class="form-control" id="post" row="5" placeholder="Seu post aqui!"></textarea><br>
                        </div>
                        <?php
                            $Usuario = new Usuario($pdo);
                        ?>
                        <input type="hidden" name="autor" value="<?= $Usuario->nameUser() ?>">
                        </div>
                    
                    <button type="submit" class="btn btn-primary">Enviar</button>
                    <button type="submit" class="btn btn-primary" onclick="window.history.back()">Voltar</button>
        <?php
          }elseif($pg == "newpostok") {

            $Post = new Post($pdo);
            $Post->adicionarPost();
            ?>
            <button type="submit" class="btn btn-primary" onclick="window.history.back()">Voltar</button>
            <?php
          }
        ?>
        </main>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>