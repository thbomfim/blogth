<?php
function islogado() {
    
}
/////////////////////mostra o nome do usuario
function nameUser() 
{
    global $pdo;

    $sql = "SELECT nome FROM usuarios WHERE id = :iduser";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":iduser", $_SESSION["id"]);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row["nome"];
}

?>