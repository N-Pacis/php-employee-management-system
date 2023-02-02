<?php
// Dados de conexão com o banco de dados
$host = 'localhost';
$user = 'root';
$pass = 'pacis123';
$database = 'leandrox_neopro';

// Criando a conexão com o banco de dados
$link = mysqli_connect($host, $user, $pass, $database);

// Verificando se a conexão foi estabelecida com sucesso
if (!$link) {
    die('Não foi possível conectar ao banco de dados: ' . mysqli_connect_error());
}

?>