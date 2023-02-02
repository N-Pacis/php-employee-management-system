<?php

include 'conexao.php';
session_start();
if (isset($_SESSION['nome_usuario'])) {
    $username = $_SESSION['nome_usuario'];
  } else {
    header('Location: login.php');
  }
function check_login() {

  if(!isset($_SESSION['colaborador'])) {
    header('Location: cadastros_escolha.php');
    exit;
  }
}

Check_login();



// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Armazena os dados do formulário em variáveis
    $cliente = $link->real_escape_string($_POST['cliente']);
    $local = $link->real_escape_string($_POST['local']);
    $resneopro = $link->real_escape_string($_POST['resneopro']);
    $colaboradores = $link->real_escape_string($_POST['colaboradores']);
    $obra = $link->real_escape_string($_POST['obra']);
    $data = $link->real_escape_string($_POST['data']);
    $respcliente = $link->real_escape_string($_POST['respcliente']);
    $atividades = $link->real_escape_string($_POST['atividades']);
    //aqui deve ser um tratamento para as fotos
    $fotos = $_FILES['fotos'];


    //verifica se não tem problema com a foto 
    $diretorio = "foto_obra/";
    if (isset($fotos)) {
        $file_type = pathinfo($fotos["name"], PATHINFO_EXTENSION);
        $novo_nome = uniqid().".".$file_type;
        $novo_nome = $diretorio . $novo_nome;
        $diretorio = "foto_obra/";
        move_uploaded_file($fotos['tmp_name'], $novo_nome);
    }

    // Cria a consulta SQL para inserir os dados no banco de dados
    $query = "INSERT INTO relatorio (cliente, local, resneopro, colaboradores, obra, data, respcliente, atividades, fotos, usuario) VALUES ('$cliente', '$local', '$resneopro', '$colaboradores', '$obra', '$data', '$respcliente', '$atividades', '$novo_nome', '$username')";

    // Executa a consulta SQL
    $result = $link->query($query);
    $cliente = $_POST['cliente'];
    $local = $_POST['local'];
    $resneopro = $_POST['resneopro'];
    $colaboradores = $_POST['colaboradores'];
    $obra = $_POST['obra'];
    $data = $_POST['data'];
    $respcliente = $_POST['respcliente'];
    if(empty($cliente)){
        echo "Nome do cliente é obrigatório";
    }
    elseif(empty($local)){
        echo "Local é obrigatório";
    }
    elseif(empty($resneopro)){
        echo "Res.Neopro é obrigatório";
    }
    elseif(empty($colaboradores)){
        echo "Colaboradores é obrigatório";
    }
    elseif(empty($obra)){
        echo "Obra é obrigatório";
    }
    elseif(empty($data)){
        echo "Data é obrigatório";
    }
    elseif(empty($respcliente)){
        echo "Res.Cliente é obrigatório";
    }


    //require "vendor/autoload.php";

    //if ($result) {
        // Create a new PHPMailer instance
    //    $mail = new PHPMailer;
    //    $mail->IsSMTP();
      //  $mail->SMTPAuth = true;
       // $mail->SMTPSecure = 'tls';
        ///$mail->Host = 'smtp.gmail.com';
        //$mail->Port = 587;
        //$mail->Username = 'jucio.marketing@gmail.com';
        //$mail->Password = 'juciodevl';
        //$mail->setFrom('jucio@neopro.com.br', 'Jucio Gabriel');
        //$mail->addAddress('jucio.marketing@gmail.com', 'teste 1');
        //$mail->addAddress('johnsilvamkt92@gmail.com', 'teste 2');
        //$mail->Subject = 'Novo relatório de obra';
        //$mail->Body = 'Um novo relatório de obra foi enviado. Verifique a área administrativa para mais detalhes.';
        //$mail->send();
        //echo "Relatório de obra enviado com sucesso! Um email foi enviado para o administrador.";
    //}
    //else {
      //  echo "Erro ao enviar relatório de obra. Verifique suas informações e tente novamente.";
}

    
    
    
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <title>Relatório de Obra</title>
</head>
<body>
<div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
  <div class="w-full max-w-md space-y-8">

  <div>
      <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
      <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Cadastre Seu Relatorio Abaixo</h2>
      <!--<p class="mt-2 text-center text-sm text-gray-600">
        Or 
        <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">start your 14-day free trial</a>
      </p>-->
    </div>

        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="post" action="obra.php" enctype="multipart/form-data">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="cliente">
                    Cliente:
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="cliente" name="cliente" type="text" placeholder="Ex: João Silva">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="local">
                    Local:
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="local" name="local" type="text" placeholder="Ex: Rua dos Bobos, nº 0">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="resneopro">
                    Res.Neopro:
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="resneopro" name="resneopro" type="text" placeholder="Ex:123456">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="colaboradores">
                    Colaboradores:
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="colaboradores" name="colaboradores" type="text" placeholder="Ex: João, Maria, José">
</div>
<div class="mb-4">
<label class="block text-gray-700 text-sm font-bold mb-2" for="obra">
Obra:
</label>
<input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="obra" name="obra" type="text" placeholder="Ex: Casa Verde">
</div>
<div class="mb-4">
<label class="block text-gray-700 text-sm font-bold mb-2" for="data">
Data:
</label>
<input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="data" name="data" type="date">
</div>
<div class="mb-4">
<label class="block text-gray-700 text-sm font-bold mb-2" for="respcliente">
Resp.Cliente:
</label>
<input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="respcliente" name="respcliente" type="text" placeholder="Ex: João Silva">
</div>
<div class="mb-4">
<label class="block text-gray-700 text-sm font-bold mb-2" for="atividades">
Atividades Realizadas:
</label>
<textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="atividades" name="atividades" rows="5" placeholder="Ex: Construção da base, Instalação do telhado"></textarea>
</div>
<div class="mb-4">
<label class="block text-gray-700 text-sm font-bold mb-2" for="fotos">
Upload de Fotos:
</label>
<input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="fotos" name="fotos" type="file" multiple>
</div>

<div>
        <button type="submit" class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
          <span class="absolute inset-y-0 left-0 flex items-center pl-3">
            <!-- Heroicon name: mini/lock-closed -->
            <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" />
            </svg>
          </span>
          Enviar Relatório

          
        </button>
        <br>
        <div class="inline-block align-middle">
        <a href="acesso_colaboradores.php" class="text-indigo-600 hover:text-indigo-500">Voltar ao Menu Principal</a>
</div>

      </div>




</div>
</form>
</div>
</body>
</html>

