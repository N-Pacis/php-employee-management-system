<?php


include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Obtenha os dados do formulário
  $nome = $_POST['nome'];
  $funcao = $_POST['funcao'];
  $valor = $_POST['valor'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $perfil = $_POST['perfil'];
  
  // Verifica se o username está definido e não está vazio
  if (!empty($username)) {
    // Crie a consulta SQL para inserir os dados na tabela "funcionarios"
    $query1 = "INSERT INTO colaboradores (nome, funcao, valor) VALUES (?, ?, ?)";
    $query2 = "INSERT INTO usuarios (username, password, administrador) VALUES (?, ?, ?)";

    // Prepare a consulta
    $stmt1 = mysqli_prepare($link, $query1);
    mysqli_stmt_bind_param($stmt1, "ssd", $nome, $funcao, $valor);
    mysqli_stmt_execute($stmt1);

    $stmt2 = mysqli_prepare($link, $query2);
    mysqli_stmt_bind_param($stmt2, "sss", $username, $password, $perfil);
    mysqli_stmt_execute($stmt2);
  } else {
    echo "Username não foi definido";
  }
  header("Location: sucesso_colab.php");
  exit;
}



?>


<!doctype html>
<html lang="en">
  <head>
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    
<meta charset="utf-8"/>
<title>Cadastro de funcionarios</title>

</head>

<body>
<div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
<div class="w-full max-w-md space-y-8">


<div>
<img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
      <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Cadastre Seu Colaborador Abaixo</h2>
      <!--<p class="mt-2 text-center text-sm text-gray-600">
        Or 
        <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">start your 14-day free trial</a>
      </p>-->
</div>

<script>
  function preencherUsuario() {
    var nome = document.getElementById("nome").value;
    document.getElementById("username").value = nome;
  }
</script>
<form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="cadastro_funcionarios.php">

  <div class="mb-4">
  <label class="block text-gray-700 text-sm font-bold mb-2" for="nome">Nome:</label><br>
  <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" oninput="preencherUsuario()" type="text" name="nome" id="nome" required><br><br>
  </div>

  <div class="mb-4">
  <label class="block text-gray-700 text-sm font-bold mb-2" for="funcao">Função:</label><br>
  <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="funcao" id="funcao" required><br><br>
  </div>

  <div class="mb-4">
  <label class="block text-gray-700 text-sm font-bold mb-2" for="custo">Custo por Hora:</label><br>
  <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" name="valor" id="valor" step="0.01" pattern="^\$\d{1,3}(,\d{3})*(\.\d{2})?$" required><br><br>
  </div>

  
  <div class="mb-4">
    <label class="block text-gray-700 font-medium mb-2" for="username">
      Nome de usuário:
    </label>
    <input 
      class="bg-white focus:outline-none focus:shadow-outline-blue focus:border-blue-300 rounded-lg py-2 px-4 block w-full appearance-none leading-normal" 
      type="text" 
      id="username" 
      name="username"
    >
  </div>
  <div class="mb-4">
    <label class="block text-gray-700 font-medium mb-2" for="password">
      Senha:
    </label>
    <input 
      class="bg-white focus:outline-none focus:shadow-outline-blue focus:border-blue-300 rounded-lg py-2 px-4 block w-full appearance-none leading-normal" 
      type="password" 
      id="password" 
      name="password"
    >
  </div>
  <div class="mb-4">
    <label class="block text-gray-700 font-medium mb-2" for="perfil">
      Tipo de perfil:
    </label>
    <select 
      class="bg-white focus:outline-none focus:shadow-outline-blue focus:border-blue-300 rounded-lg py-2 px-4 block w-full appearance-none leading-normal" 
      id="perfil" 
      name="perfil"
    >
      <option value="1">Administrador</option>
      <option value="0">Colaborador</option>
    </select>
  </div>

  <br><br>

        <button type="submit" class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
          <span class="absolute inset-y-0 left-0 flex items-center pl-3">
            <!-- Heroicon name: mini/lock-closed -->
            <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" />
            </svg>
          </span>
          Enviar Cadastro
        </button>
        <br>
        <button class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" onclick="window.location.href ='cadastros_escolha.php';">
        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
            <!-- Heroicon name: mini/lock-closed -->
            <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" />
            </svg>
          </span>
          Voltar ao Menu Principal
        </button>
</form>
</div>
</div>
</html>




