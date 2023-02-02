<?php

include 'conexao.php';

session_start();
// Verifica se o formulário foi enviado
if (isset($_POST['submit'])) {
  // Recebe os dados do formulário
  $username = $_POST['username'];
  $password = $_POST['password'];
  
  // Conecta ao banco de dados
  //$db = new mysqli("localhost", "root", "", "neopro");
// armazena os dados do usuário na sessão

  // Verifica se os dados de login são válidos
  $query = "SELECT * FROM usuarios WHERE username='$username' AND password='$password'";
  $result = $link->query($query);
  $username = $_POST['username']; // ou como você está pegando o nome de usuário no seu código.
  $_SESSION['nome_usuario'] = $username;

  
  if ($result->num_rows > 0) {
    // Os dados de login são válidos, verifique se o usuário é um administrador
    $query = "SELECT * FROM usuarios WHERE username='$username' AND administrador=1";
    $result = $link->query($query);
    
    if ($result->num_rows > 0) {
      // O usuário é um administrador, redirecione para a página de administrador
      // armazena os dados do usuário na sessão
      $_SESSION['administrador'] = true;
    // redireciona o usuário para a página restrita
      header("Location: cadastros_escolha.php");
      exit;
    } else {
      // armazena os dados do usuário na sessão
      // O usuário não é um administrador, redirecione para a página de usuário comum
      $_SESSION['colaborador'] = true;
      $_SESSION['employee_id'] = $row['id'];
      header("Location: acesso_colaboradores.php");
      exit;
    }
  } else {
    // Os dados de login são inválidos, exiba uma mensagem de erro
    echo "Nome de usuário ou senha inválidos.";
  }
}

?>

<!-- Exibe o formulário de login -->

<!doctype html>
<html lang="en">
<head>
<style>

body {
  background-color: #ccc;
}

.container{
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100vh;
}

form {
  width: 400px;
  background-color: white;
  padding: 30px;
  border-radius: 5px;
}



</style>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
<div class="container">
  <img src="imagens/logo.jpeg" alt="Logo">
  <form method="post" action="login.php">
    <label for="username">Nome de usuário:</label><br>
    <input type="text" class="form-control" name="username" id="username"><br>

    <label for="password">Senha:</label><br>
    <input type="password" class="form-control" name="password" id="password"><br><br>

    <input class="btn btn-primary" type="submit" name="submit" value="Entrar">
  </form> 
</div>
</body>
</html>