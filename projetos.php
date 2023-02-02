<?php

include 'conexao.php';
session_start();

function check_login() {
  if(!isset($_SESSION['administrador'])) {
    header('Location: acesso_colaboradores.php');
    exit;
  }
}

check_login();



// Verifique se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Obtenha os dados do formulário
  $item = $_POST['item'];
  $bu = $_POST['bu'];
  $tipo = $_POST['tipo'];
  $status = $_POST['status'];
  $cliente = $_POST['cliente'];
  $descricao = $_POST['descricao'];
  $engenheirochefe = $_POST['engenheirochefe'];
  $gerentedeprojeto = $_POST['gerentedeprojeto'];
  $cpm = $_POST['cpm'];
  $projeto = $_POST['projeto'];
  $os = $_POST['os'];
  $horasfabrica = $_POST['horasfabrica'];
  $horasteste = $_POST['horasteste'];
  $servicosemcampo = $_POST['servicosemcampo'];
  $servicosemgarantia = $_POST['servicosemgarantia'];
  $projetoeletrico = $_POST['projetoeletrico'];
  $projetomecanico = $_POST['projetomecanico'];

  // Crie a consulta SQL para inserir os dados na tabela "funcionarios"
  $query = "INSERT INTO projetos (item, bu, tipo, statusp, cliente, descricao, engenheirochefe, gerentedeprojeto, cpm, projeto, os, horasfabrica, horasteste, servicosemcampo, servicosemgarantia, projetoeletrico, projetomecanico) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

  // Prepare a consulta
  $stmt = mysqli_prepare($link, $query);

  // Ligue os parâmetros aos marcadores de posição
  mysqli_stmt_bind_param($stmt, 'isssssssssiiiiiii', $item, $bu, $tipo, $status, $cliente, $descricao, $engenheirochefe, $gerentedeprojeto, $cpm, $projeto, $os, $horasfabrica, $horasteste, $servicosemcampo, $servicosemgarantia, $projetoeletrico, $projetomecanico);


  // Execute a consulta
  mysqli_stmt_execute($stmt);

  // Redirecione o usuário para uma página de sucesso ou exiba uma mensagem de erro
  if (mysqli_stmt_affected_rows($stmt) > 0) {
    header('Location: sucesso_pro.php');
    exit;
  } else {
    $mensagem = "Erro ao cadastrar projetos: " . mysqli_error($link);
  }

  // Feche a consulta
  mysqli_stmt_close($stmt);

  // Feche a conexão
  mysqli_close($link);
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Cadastro de Projetos</title>
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>

<div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
<div class="w-full max-w-md space-y-8">

<div>
      <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
      <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Cadastre Seu imovel Abaixo</h2>
      <!--<p class="mt-2 text-center text-sm text-gray-600">
        Or 
        <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">start your 14-day free trial</a>
      </p>-->
    </div>

<form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="projetos.php" method="post">

<div class="mb-4">
  <label class="block text-gray-700 text-sm font-bold mb-2" for="item">Item:</label><br>
  <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" id="item" name="item" required><br>
</div>

<div class="mb-4">
  <label class="block text-gray-700 text-sm font-bold mb-2" for="bu">BU:</label><br>
  <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" id="bu" name="bu" required><br>
</div>

<!-- <div class="mb-4">
  <label class="block text-gray-700 text-sm font-bold mb-2" for="tipo">Tipo:</label><br>
  <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" id="tipo" name="tipo" required><br>
</div>-->
  
<div class="mb-4">
  <label class="block text-gray-700 text-sm font-bold mb-2" for="tipo">Tipo:</label><br>
  <select name="tipo" id="tipo" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    <option value="HH">HH</option><br>
    <option value="PF">PF</option>
  </select>
  </div>

  <div class="mb-4">
  <label class="block text-gray-700 text-sm font-bold mb-2" for="status">Status:</label><br>
  <select name="status" id="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    <option value="APROVADO">APROVADO</option><br>
    <option value="NÃO APROVADO">NÃO APROVADO</option>
  </select>
  </div>
  
<div class="mb-4">
  <label class="block text-gray-700 text-sm font-bold mb-2" for="cliente">Cliente:</label><br>
  <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" id="cliente" name="cliente" required><br>
</div>
  
<div class="mb-4">
  <label class="block text-gray-700 text-sm font-bold mb-2" for="descricao">Descricao:</label><br>
  <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" id="descricao" name="descricao" required><br>
</div>
  
<div class="mb-4">
  <label class="block text-gray-700 text-sm font-bold mb-2" for="engenheiro_chefe">Engenheiro Chefe:</label><br>
  <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" id="engenheirochefe" name="engenheirochefe" required><br>
</div>
  
<div class="mb-4">
  <label class="block text-gray-700 text-sm font-bold mb-2" for="gerentedeprojeto">Gerente de Projeto:</label><br>
  <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" id="gerentedeprojeto" name="gerentedeprojeto" required><br>
</div>

  <div class="mb-4">
  <label class="block text-gray-700 text-sm font-bold mb-2" for="cpm">Cpm:</label><br>
  <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" id="cpm" name="cpm" required><br>
</div>
  
<div class="mb-4">
  <label class="block text-gray-700 text-sm font-bold mb-2" for="projeto">Projeto:</label><br>
  <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" id="projeto" name="projeto" required><br>
</div>
  
<div class="mb-4">
  <label class="block text-gray-700 text-sm font-bold mb-2" for="os">Os:</label><br>
  <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" id="os" name="os" required><br>
</div>

<div class="mb-4">
  <label class="block text-gray-700 text-sm font-bold mb-2" for="horasfabrica">Horas na fábrica:</label><br>
  <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" step="0.01" id="horasfabrica" name="horasfabrica" required><br>
</div>

<div class="mb-4">
  <label class="block text-gray-700 text-sm font-bold mb-2" for="horasteste">Horas em teste:</label><br>
  <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" step="0.01" id="horasteste" name="horasteste" required><br>
</div>

<div class="mb-4">
  <label class="text-gray-700 text-sm font-bold mb-2" for="servicosemcampo">Serviços em campo:</label><br>
  <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" step="0.01" id="servicosemcampo" name="servicosemcampo" required><br>
</div>

<div class="mb-4">
  <label class="text-gray-700 text-sm font-bold mb-2" for="servicosemgarantia">Serviços em garantia:</label><br>
  <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" step="0.01" id="servicosemgarantia" name="servicosemgarantia" required><br>
</div>

<div claas="form-group">
  <label class="text-gray-700 text-sm font-bold mb-2" for="projetoeletrico">Projeto elétrico:</label><br>
  <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" step="0.01" id="projetoeletrico" name="projetoeletrico" required><br>
</div>
<br>
<div class="mb-4">
  <label class="text-gray-700 text-sm font-bold mb-2" for="projetomecanico">Projeto mecânico:</label><br>
  <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" step="0.01" id="projetomecanico" name="projetomecanico" required><br><br>
</div>

<div>
        <button type="submit" class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
          <span class="absolute inset-y-0 left-0 flex items-center pl-3">
            <!-- Heroicon name: mini/lock-closed -->
            <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" />
            </svg>
          </span>
          Enviar Projeto

          
        </button>
        <br>
        <div class="inline-block align-middle">
  <a href="cadastros_escolha.php" class="text-indigo-600 hover:text-indigo-500">Voltar ao Menu Principal</a>
  </label>
</div>

      </div>
</div>
</body>
</html>