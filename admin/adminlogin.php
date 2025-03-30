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
                if($pg == "login") {

                    $usuario = $_POST["usuario"];
                    $senha = $_POST["senha"];
                    
                    var_dump($usuario, $senha);
                    if (empty($usuario AND $senha) ) {
                        echo "Digite um usuario e senha";
                    }

                    $sql = "SELECT * FROM usuarios WHERE nome = :nome AND senha = :senha";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindvalue(":nome", $usuario);
                    $stmt->bindvalue(":senha", $senha);
                    $stmt->execute();

                    if($stmt->rowCount() >= 1) {
                        
                        $usuario = $stmt->fetch();
                        session_start();
                        $_SESSION["nome"] = $usuario["usuario"];
                        $_SESSION["id"] = $usuario["id"];
                        echo "ola Login realizado com sucesso";
                        echo "<a href=\"painel.php\">CLIQUE AQUI</a>";
                        exit;
                    }else{
                        echo "Usuario ou senha incorretos";
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