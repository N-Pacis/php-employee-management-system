<?php

include 'conexao.php';
require_once 'vendor/autoload.php';
session_start();
function check_login()
{

    if (!isset($_SESSION['administrador'])) {
        header('Location: login.php');
        exit;
    }
}

Check_login();
?>

<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

<form method="post" action="" class="bg-white p-6 rounded-lg shadow-md">
    <label class="block font-medium mb-2 text-gray-700" for="colaborador">Selecione o colaborador:</label>
    <div class="relative rounded-md shadow-sm">
        <select name="colaborador" id="colaborador" class="form-input py-2 px-3 rounded-md leading-5 text-gray-900 bg-white border border-gray-300 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
            <?php
            // conecta ao banco de dados

            // cria a consulta SQL para buscar os colaboradores
            $query = "SELECT nome FROM colaboradores";
            $result = $link->query($query);
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row["nome"] . "'>" . $row["nome"] . "</option>";
            }
            ?>
        </select>
    </div>
    <div class="flex items-center justify-between mt-5">
        <button class="px-4 py-2 font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
            Consultar
        </button>
        <button class="px-4 py-2 font-medium text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none focus:shadow-outline-blue active:bg-gray-400" type="button" onclick="window.location.href = window.location.href; unset($_POST['colaborador'])">
            Limpar
        </button>
        <a href="logout.php" class="px-4 py-2 font-medium text-white bg-red-500 rounded-md hover:bg-red-600 focus:outline-none focus:shadow-outline-red active:bg-red-800">
            Logout
        </a>

    </div>
</form>




<?php
// verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['colaborador'])) {
    // conecta ao banco de dados


    // pega o valor do campo 'colaborador' do formulário
    $colaborador = $_POST['colaborador'];
    $_SESSION["colaborador"] = $colaborador;
    // cria a consulta SQL para buscar as horas trabalhadas do colaborador selecionado
    $query = "SELECT * FROM horas_trabalhadas WHERE nome_usuario = '$colaborador'";
    $result = $link->query($query);
}
// verifica se a consulta retornou algum resultado
if ($result->num_rows > 0) {
    // imprime as informações da tabela horas_trabalhadas para o colaborador selecionado
    echo "<div style='display: flex; justify-content: center; padding: 20px;'>";
    echo "<button class='px-4 py-2 font-medium text-white bg-green-500 rounded-md hover:bg-green-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800' id='download-btn'>
    Baixar Excel
</button>";

    echo "</div>";
    echo "<table class='table-auto w-full border-collapse'>";
    echo "<thead>";
    echo "<tr> <th class='text-left px-4 py-2 bg-gray-100 text-gray-600 font-medium'>Início</th> <th class='text-left px-4 py-2 bg-gray-100 text-gray-600 font-medium'>Almoço</th> <th class='text-left px-4 py-2 bg-gray-100 text-gray-600 font-medium'>Término</th> <th class='text-left px-4 py-2 bg-gray-100 text-gray-600 font-medium'>Projeto</th> <th class='text-left px-4 py-2 bg-gray-100 text-gray-600 font-medium'>Descrição</th> <th class='text-left px-4 py-2 bg-gray-100 text-gray-600 font-medium'>Horas</th> <th class='text-left px-4 py-2 bg-gray-100 text-gray-600 font-medium'>Minutos</th> <th class='text-left px-4 py-2 bg-gray-100 text-gray-600 font-medium'>Feriado</th> </tr>";
    echo "</thead>";
    echo "<tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td class='text-left px-4 py-2 border-b border-gray-300'>" . $row["inicio"] . "</td>";
        echo "<td class='text-left px-4 py-2 border-b border-gray-300'>" . $row["almoco"] . "</td>";
        echo "<td class='text-left px-4 py-2 border-b border-gray-300'>" . $row["termino"] . "</td>";
        echo "<td class='text-left px-4 py-2 border-b border-gray-300'>" . $row["projeto"] . "</td>";
        echo "<td class='text-left px-4 py-2 border-b border-gray-300'>" . $row["descricao"] . "</td>";
        echo "<td class='text-left px-4 py-2 border-b border-gray-300'>" . $row["horas"] . "</td>";
        echo "<td class='text-left px-4 py-2 border-b border-gray-300'>" . $row["minutos"] . "</td>";
        echo "<td class='text-left px-4 py-2 border-b border-gray-300'>" . $row["feriado"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Não foram encontradas horas trabalhadas para o colaborador selecionado.";
}

// fecha a conexão com o banco de dados
$link->close();
?>

<script>
    document.getElementById("download-btn").addEventListener("click", function() {
        window.location.href = "baixar-excel.php";
    });
</script>