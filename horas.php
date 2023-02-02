<?php

include 'conexao.php';

// Verifica se o ID do usuário está armazenado na sessão

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
// verifica se a sessão do usuário está iniciada

  // imprime o nome do usuário na tabela
  



check_login();



// verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // conecta ao banco de dados
  

  // obtém os valores dos campos do formulário
  // converte o horário de início para o formato "YYYY-MM-DD hh:mm:ss"
  $data = date("Y-m-d", strtotime($_POST["data"]));
  $inicio = date("Y-m-d H:i:s", strtotime($_POST["inicio"]));
  $almoco = date("Y-m-d H:i:s", strtotime($_POST["almoco"]));
  $fim_almoco = date("Y-m-d H:i:s", strtotime($_POST["fim_almoco"]));
  $termino = date("Y-m-d H:i:s", strtotime($_POST["termino"]));
  $projeto = $link->real_escape_string($_POST["projeto"]);
  $descricao = $link->real_escape_string($_POST["descricao"]);
  $feriado = $link->real_escape_string($_POST["feriado"]);

  // calcula a diferença entre o horário de início e o horário de término
  $diff = strtotime($termino) - strtotime($inicio);

// calcula o total de horas trabalhadas (arredondando para baixo)
  $horas = floor($diff / 3600)-1;
  $horas = (string) $horas;

// calcula o total de minutos trabalhados
  $minutos = floor(($diff % 3600) / 60);
  $minutos = (string) $minutos;



  $query = "INSERT INTO horas_trabalhadas (data,inicio, almoco,fim_almoco, termino, projeto, horas, descricao, minutos, feriado, nome_usuario) VALUES (?, ?, ?,?, ?, ?,?, ?, ?, ?, ?)";
  $stmt = $link->prepare($query);
  $stmt->bind_param("sssssssssss",$data, $inicio, $almoco,$fim_almoco, $termino, $projeto,$horas, $descricao, $minutos, $feriado, $username);
  $stmt->execute();


  // verifica se a consulta foi bem-sucedida
  if ($stmt->affected_rows > 0) {
    // exibe uma mensagem de sucesso
    echo "Horas trabalhadas cadastradas com sucesso!";
  } else {
    // exibe uma mensagem de erro
    echo "Ocorreu um erro ao cadastrar as horas trabalhadas.";
  }
}

function buscar_projetos_do_banco_de_dados($link) {
  // implementação para buscar projetos do banco de dados

  $sql = "SELECT * FROM projetos";
  $result = $link->query($sql);

  
  $projetos = array();
  while ($row = mysqli_fetch_assoc($result)) {
    array_push($projetos, $row);
  }
    
  return $projetos;
}

?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.108.0">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <title>Cadastro de Horas</title>
  </head>
  <body>

  <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
  <div class="w-full max-w-md space-y-8">
  <div>
      <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
      <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Cadastre Suas Horas</h2>
      <!--<p class="mt-2 text-center text-sm text-gray-600">
        Or 
        <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">start your 14-day free trial</a>
      </p>-->
    </div>

<form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="horas.php" method="post">
<div class="mb-4">
  <label class="block text-gray-700 text-sm font-bold mb-2" for="inicio">Data:</label><br>
  <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="data" name="data" type="date">
</div>


<div class="mb-4">
  <label class="block text-gray-700 text-sm font-bold mb-2" for="inicio">Horário de início:</label><br>
  <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="datetime-local" id="inicio" name="inicio" required><br><br>
</div>

<div class="mb-4">
  <label class="block text-gray-700 text-sm font-bold mb-2" for="almoco">Horário do almoço:</label><br>
  <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="datetime-local" id="almoco" name="almoco" required><br><br>
</div>

<div class="mb-4">
  <label class="block text-gray-700 text-sm font-bold mb-2" for="almoco">Horário Fim do almoço:</label><br>
  <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="datetime-local" id="almoco" name="fim_almoco" required><br><br>
</div>

<div class="mb-4">
  <label class="block text-gray-700 text-sm font-bold mb-2" for="termino">Horário de término:</label><br>
  <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"type="datetime-local" id="termino" name="termino" required><br><br>
</div>

<div class="mb-4 relative">
  <label class="block text-gray-700 text-sm font-bold mb-2" for="projeto">Projeto:</label><br>
  <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293l-3.394 3.394a1 1 0 0 1-1.414 0l-6-6a1 1 0 0 1 0-1.414l6-6a1 1 0 0 1 1.414 1.414L5.293 9H17a1 1 0 0 1 0 2H9.293z"/></svg>
  </div>
  <select name="projeto" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    <option value="">-- Selecione o projeto ---</option>
    <?php
      $projetos = buscar_projetos_do_banco_de_dados($link);
      foreach ($projetos as $projeto) {
        echo "<option value='" . $projeto['projeto'] . "'>" . $projeto['cliente'] . "</option>";
      }
    ?>
  </select>
</div>
<div class="mb-4">
  <label class="block text-gray-700 text-sm font-bold mb-2" for="descricao">Descrição:</label><br>
  <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="descricao" name="descricao"  rows="3" required></textarea><br>
  <br>
</div>

<div class="mb-4">
  <label class="block text-gray-700 text-sm font-bold mb-2">Feriado:</label>
  <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="feriado" required>
    <option value="nao">Não</option>
    <option value="sim">Sim</option>
  </select><br><br>
</div>

<div>
        <button type="submit" class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
          <span class="absolute inset-y-0 left-0 flex items-center pl-3">
            <!-- Heroicon name: mini/lock-closed -->
            <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" />
            </svg>
          </span>
          Enviar Horas

          
        </button>
        <br>
        <div class="inline-block align-middle">
        <a href="acesso_colaboradores.php" class="text-indigo-600 hover:text-indigo-500">Voltar ao Menu Anterior</a>
  </label>
</div>

      </div>


  </div>
  </body>
</html>









































