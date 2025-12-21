<?php 
class Usuario {
    protected $id;
    protected $nome;
    protected $senha;
    protected $pdo;

    public __construct($dbconnection) {
        $this->pdo = $dbconnection;
    }
}
?>