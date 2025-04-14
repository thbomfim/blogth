<?php 
include("../config/config.php");
$pg = $_GET["pg"];
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

        <main>
            <?php 
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
            <?php
            }elseif ($pg == "novouserok") {
                $nome = $_POST["nome"];
                $senha = $_POST["senha"];
              
                if (empty($nome AND $senha)) {

                echo "Digite um usuario e senha";
                exit;
              }else{
                  echo var_dump($nome, $senha);

                  $stmt = "INSERT INTO usuarios(nome,senha) VALUES(:nome,:senha)";
                  $resul = $pdo->prepare($stmt);
                  $resul->bindParam(':nome',$nome);
                  $resul->bindParam(':senha',$senha);
                  $resul->execute();

                  if($resul->rowCount() >= 1) {
                      echo "Usuario cadastrado!";
                    }else {
                      echo "Ocorreu algum erro!";
                    }
                }
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
                            <textarea name="post" class="form-control" id="post" row="5" placeholder="Seu post aqui!"></textarea><br>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Enviar</button>
        <?php
          }elseif($pg == "newpostok") {
              
              $titulo = $_POST["titulo"];
              $post = $_POST["post"];
              
              if(empty($titulo AND $post)) {
                  echo "É preciso digitar o titulo e o post";
                  exit;
              }else{
                  $posPonto = strpos($post, '.');
                  
                  if ($posPonto !== false) {
                      $intro = substr($post, 0, $posPonto + 1);
                  }else{
                      $intro = substr($post, 0, 150);
                      $intro = substr($intro, 0, strrpos($intro, ''));
                  }
                  $stmt = "INSERT INTO posts(titulo,intro,texto,data) VALUES( :titulo, :intro, :post, NOW())";
                  $resul = $pdo->prepare($stmt);
                  $resul->bindParam(':titulo', $titulo);
                  $resul->bindParam(':intro', $intro);
                  $resul->bindParam(':post', $post);
                  
                  if($resul->execute()) { 
                      echo "Post Adicionado";
                  }else{
                      $erro = $resul->errorinfo();
                      echo "Ocorreu algum erro!" . $erro[2];
                  }
              }
          }
        ?>
        </main>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>