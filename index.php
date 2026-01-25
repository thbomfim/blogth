<?php
include("config/config.php");
?>
<!doctype html>
<html lang="pt-br" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog do th</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="estilo/style.css">
</head>

<body>
    <div class="pagina">
        <header class="text-center">
            <div class="container-md meu-container">
                <h1 id="logo">Blog do TH</h1>
                <nav class="menu">
                    <a>Home</a>
                    <a>Sobre min</a>
                    <a>Socias</a>
                </nav>
            </div>
        </header>

        <main>
            <div class="container-md text-center meu-container">
                <?php
                    $limite = 10;
                    $pagina = isset($_GET['pagina']) && (int)$_GET['pagina'] >= 0 ? (int)$_GET['pagina'] : 0;
                    $offset = $pagina * $limite;
                    
                    $totalQuery = $pdo->query('SELECT COUNT(*) FROM posts');
                    $totalPosts = $totalQuery->fetchColumn();
                    $totalPaginas = ceil($totalPosts / $limite);
            
                    // Buscar posts
                    $postagem = $pdo->query("SELECT * FROM posts ORDER BY id DESC LIMIT $limite OFFSET $offset");
                    
                    // Mostrar os posts
                    while($info = $postagem->fetch()){
                ?>
                <a href="post.php?pg=post&id=<?=$info['id']?>" class="mb-4">
                    <h2><?= $info['titulo'] ?></h2>
                    <?= $info['intro'] ?>
                </a>
                <div class="data"><?php echo" $info[autor] &nbsp; $info[dataCriado]"; ?></div></br>
                <?php
                    }
                ?>

                <!-- Paginação com reticências -->
                <nav aria-label="Navegação de página">
                    <ul class="pagination justify-content-center">

                        <!-- Anterior -->
                        <li class="page-item <?= ($pagina <= 0) ? 'disabled' : '' ?>">
                            <a class="page-link" href="?pagina=<?= $pagina - 1 ?>">Anterior</a>
                        </li>

                        <?php
                $mostrarPaginas = 2; // Quantas páginas antes/depois da atual mostrar
            
                for ($i = 0; $i < $totalPaginas; $i++) {
                    // Sempre mostrar as primeiras, últimas e as próximas da atual
                    if (
                        $i == 0 || $i == $totalPaginas - 1 ||
                        ($i >= $pagina - $mostrarPaginas && $i <= $pagina + $mostrarPaginas)
                    ) {
                        // Mostrar número da página
                        $isActive = ($i == $pagina) ? 'active' : '';
                        echo '<li class="page-item '.$isActive.'"><a class="page-link" href="?pagina='.$i.'">'.($i+1).'</a></li>';
                    } elseif (
                        // Mostrar "..." apenas se a página anterior não foi exibida
                        $i == 1 && $pagina > $mostrarPaginas + 1 ||
                        $i == $totalPaginas - 2 && $pagina < $totalPaginas - $mostrarPaginas - 2 ||
                        ($i == $pagina - $mostrarPaginas - 1) ||
                        ($i == $pagina + $mostrarPaginas + 1)
                    ) {
                        echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                    }
                }
                ?>

                        <!-- Próxima -->
                        <li class="page-item <?= ($pagina + 1 >= $totalPaginas) ? 'disabled' : '' ?>">
                            <a class="page-link" href="?pagina=<?= $pagina + 1 ?>">Próxima</a>
                        </li>

                    </ul>
                </nav>
            </div>
        </main>

        <footer>
            <div class="container-md meu-container">
                <p class="mb-0 text-center">© 2025 Blog do TH - Todos os direitos reservados.</p>
            </div>
        </footer>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>