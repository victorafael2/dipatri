<?php
// Configurações do banco de dados
include '../../database/databaseconnect.php';

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

$municipio = isset($_GET['municipio']) ? implode(',', $_GET['municipio']) : '';


$municipio = isset($_GET['propriedade']) ? implode(',', $_GET['propriedade']) : '';



// Consulta ao banco de dados
// Consulta ao banco de dados
// $sql = "SELECT * FROM matriculas where municipio in ('$municipio') and propriedade in ('$propriedade')";
$sql = "SELECT * FROM matriculas where municipio in  ('$municipio') limit 500";
$result = $conn->query($sql);

// echo $sql;

// Verifica se houve erro na consulta
if (!$result) {
    die("Erro na consulta: " . $conn->error);
}

// Cria um array para armazenar os resultados da consulta
$dados = array();

// Obtém os dados da consulta e adiciona ao array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $dados[] = $row;
    }
}

// Fecha a conexão com o banco de dados
$conn->close();

// Retorna os dados no formato JSON
header('Content-Type: application/json');
echo json_encode($dados);
?>
