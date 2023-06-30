<?php
include '../../database/databaseconnect.php';

// Verifique se a conexão foi estabelecida com sucesso
if (!$conn) {
    die('Erro na conexão com o banco de dados: ' . mysqli_connect_error());
}

// Receba o termo de pesquisa enviado via AJAX
$termo = $_GET['term'];

// Consulta SQL para obter as opções de propriedade do banco de dados com base no termo de pesquisa
$query = "SELECT distinct(propriedade) as id, propriedade as text FROM matriculas WHERE propriedade LIKE '%" . mysqli_real_escape_string($conn, $termo) . "%' ORDER BY propriedade ASC";

// Execute a consulta
$resultado = mysqli_query($conn, $query);

// Crie um array para armazenar os resultados
$resultados = array();

// Verifique se a consulta retornou resultados
if (mysqli_num_rows($resultado) > 0) {
    while ($row = mysqli_fetch_assoc($resultado)) {
        $resultados[] = $row;
    }
}

// Retorne os resultados em formato JSON
echo json_encode($resultados);

// Feche a conexão com o banco de dados
mysqli_close($conn);
?>
