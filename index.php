<?php
include("header.html");
include("config/config.php");
?>

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
                <div id="divPost">
                <a href="post.php?pg=post&id=<?=$info['id']?>" class="mb-4">
                    <h2><?= $info['titulo'] ?></h2>
                </a>
                    <?= $info['intro'] ?>
                <div style="margin: 10px 0" class="data"><?php echo" $info[autor] &nbsp; $info[dataCriado]"; ?></div></div>
                <?php
                    }
                ?>

                <!-- Paginação com reticências -->
                <nav aria-label="Navegação de página">
                    <ul style="margin: 20px 0" class="pagination justify-content-center">

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
<?php include("footer.html") ?>