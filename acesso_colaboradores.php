<?php

session_start();
function check_login() {
  if(!isset($_SESSION['colaborador'])) {
    header('Location: cadastros_escolha.php');
    exit;
  }
}

if (isset($_SESSION['nome_usuario'])) {
  $username = $_SESSION['nome_usuario'];
} else {
  header('Location: login.php');
}

Check_login();
?>


<!DOCTYPE html>
<html>
<head>
  <title>Cadastro de Horas</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
  <?php echo"<h1 class=display-4>Bem-vindo $username</h1>";?>
  <p class="display-5">Você está autenticado e pode ver este conteúdo.</p>
  <button class="btn btn-primary mt-3" onclick="window.location.href ='horas.php';">Cadastrar Horas</button>
  <button class="btn btn-primary mt-3" onclick="window.location.href ='obra.php';">Relatório de Obras</button>
  <button class="btn btn-primary mt-3" onclick="window.location.href ='logout.php';">Logout</button>
</body>
</html>
