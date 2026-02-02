<?php 
include("../config/config.php");
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
        </header>

        <main>
            <h2>Login</h2>

            <form action="adminlogin.php?pg=login" method="post">

                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <label for="exampleInputEmail1" class="form-label">Usuario:</label>
                        <input type="text" name="usuario" class="form-control" id="usuario">
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <label for="exampleInputPassword1" class="form-label">Senha:</label>
                        <input type="password" name="senha" class="form-control" id="senha">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
    </div>
    </main>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>