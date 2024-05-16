<?php

$server = 'localhost';
$user = 'hangar';
$password = 'Resultados@2019';
$database = 'instituto-caranguejo';

$connect = new mysqli($server, $user, $password, $database);

if ($connect->connect_error) {
    die("Erro na conexão: " . $conexao->connect_error);
}

?>
