<?php
// function limitarTexto($texto, $limite){
//     $texto = substr($texto, 0, strrpos(substr($texto, 0, $limite), ' ')) . '...';
//     return $texto;
// }

 
// String a ser limitada
$string = 'Como limitar caracteres sem cortar as palavras com PHP';

$texto = substr($string, 0, strrpos(substr($string, 0, 30), ' ')) . '...';

echo $texto;
 
// Mostrando a string limitada em 25 caracteres.
// print(limitarTexto($string, $limite = 30));