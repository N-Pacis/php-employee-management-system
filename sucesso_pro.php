<?php

session_start();

function check_login() {
  if(!isset($_SESSION['administrador'])) {
    header('Location: acesso_colaboradores.php');
    exit;
  }
}

check_login();

?>


<!DOCTYPE html>
<html>
<head>
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <title>Cadastro Feito com sucesso</title>
</head>
<body class="bg-gray-200">
  <h1 class="text-2xl font-medium text-center text-green-500">Cadastro realizado com sucesso!</h1>
  <p class="text-lg text-center text-gray-700">Cadastro feito com sucesso, clique abaixo caso queira voltar ao formulário de cadastro</p>
  <p class="text-center mt-4">
    <a href="projetos.php" class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600">Voltar para o formulário de cadastro</a>
  </p>
</body>
</html>