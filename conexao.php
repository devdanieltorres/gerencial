<?php
// CONCEXÃO COM BANCO DE DADOS
$host = "----------";
$usuario = "----------";
$senha = "";
$bd = "----------";
global $mysqli;

$mysqli = new mysqli($host, $usuario, $senha, $bd);

if($mysqli->connect_errno)
    echo "Falha na conexão: (".$mysqli->connect_errno.") ".$mysqli->connect_error;
?>