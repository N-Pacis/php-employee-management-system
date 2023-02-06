<?php
require_once 'vendor/autoload.php';
session_start();
include 'conexao.php';

$colaborador = $_SESSION["colaborador"];
$query = "SELECT * FROM horas_trabalhadas WHERE nome_usuario = '$colaborador'";
$result_horas = $link->query($query);

$colaboradores = "SELECT * FROM colaboradores WHERE nome= '$colaborador'";
$result_colaboradores = $link->query($colaboradores);
$row_colaboradores = $result_colaboradores->fetch_assoc();

// Create a new PHPSpreadsheet object
$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();

// Set the active sheet
$sheet = $spreadsheet->getActiveSheet();

// Set the column headers
$sheet->setCellValue('A1', 'Data');
$sheet->setCellValue('B1', 'Início');
$sheet->setCellValue('C1', 'Almoço');
$sheet->setCellValue('D1', 'Fim Almoço');
$sheet->setCellValue('E1', 'Término');
$sheet->setCellValue('F1', 'Projeto');
$sheet->setCellValue('H1', 'Descrição');
$sheet->setCellValue('G1', 'Horas');
$sheet->setCellValue('I1', 'Minutos');
$sheet->setCellValue('J1', 'Feriado');
$sheet->setCellValue('J1', 'Custo Total');
$sheet->setCellValue('K1', 'Nome de Usuário');

// Populate the data
$row = 2;
while ($rowData = mysqli_fetch_assoc($result_horas)) {
  $sheet->setCellValue('A' . $row, date("d/m/Y H:i", strtotime($rowData['data'])));
  $sheet->setCellValue('B' . $row, date("d/m/Y H:i", strtotime($rowData['inicio'])));
  $sheet->setCellValue('C' . $row, date("d/m/Y H:i", strtotime($rowData['almoco'])));
  $sheet->setCellValue('D' . $row, date("d/m/Y H:i", strtotime($rowData['fim_almoco'])));
  $sheet->setCellValue('E' . $row, date("d/m/Y H:i", strtotime($rowData['termino'])));
  $sheet->setCellValue('F' . $row, $rowData['projeto']);
  $sheet->setCellValue('H' . $row, $rowData['descricao']);
  $sheet->setCellValue('G' . $row, $rowData['horas']);
  $sheet->setCellValue('I' . $row, $rowData['minutos']);
  $sheet->setCellValue('J' . $row, $rowData['feriado']);
  $sheet->setCellValue('J' . $row, $rowData['horas'] * $row_colaboradores['valor']);
  $sheet->setCellValue('K' . $row, $rowData['nome_usuario']);
  $row++;
}

// Set the response headers
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="horas_trabalhadas.xls"');
header('Cache-Control: max-age=0');

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
$writer->save('php://output');
exit;
