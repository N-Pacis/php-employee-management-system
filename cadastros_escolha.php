<?php

session_start();

function check_login() {
  if(!isset($_SESSION['administrador'])) {
    header('Location: acesso_colaboradores.php');
    exit;
  }
}

check_login();



if (isset($_POST['opcao'])) {
  if ($_POST['opcao'] == 'colaboradores') {
    header("Location: cadastro_funcionarios.php");
    exit();
  }
}

if (isset($_POST['opcao'])) {
    if ($_POST['opcao'] == 'projetos') {
      header("Location: projetos.php");
      exit();
    }
  }



  if (isset($_POST['opcao'])) {
    if ($_POST['opcao'] == 'relatorio') {
      header("Location: relatorio.php");
      exit();
    }
  }

?>



<html>
<head>
<style>
.titles, form{
  text-align: center;
}
</style>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body>
  <div class="titles">
  <h1 class="display-5">Cadastro de Colaboradores</h1>
  <h2 class="display-9">Escolha Uma Opção:</h2>
  </div>

  <form method="post" action="cadastros_escolha.php">

    <div class="custom-control custom-radio">
      <input class="custom-control-input" type="radio" name="opcao" value="colaboradores" id="colaboradores">
      <label class="custom-control-label" for="colaboradores">Colaboradores</label><br><br>
    </div>

    <div class="custom-control custom-radio">
      <input class="custom-control-input" type="radio" name="opcao" value="projetos" id="projetos">
      <label class="custom-control-label" for="projetos">Projetos</label><br><br>
    </div>


    <div class="custom-control custom-radio">
    <input class="custom-control-input" type="radio" name="opcao" value="relatorio" id="relatorio">
    <label class="custom-control-label" for="relatorio">Relatorios</label><br><br>
    </div>

    <input class="btn btn-primary" type="submit" value="Enviar">
    <input class="btn btn-primary" type="submit" value="Logout" formaction="logout.php">
  </form>