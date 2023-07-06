<?php
// Configuração do banco de dados
include '../../database/databaseconnect.php';

// Verifica se ocorreu algum erro na conexão
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Consulta na tabela "municipios"
$query = "SELECT id, municipio FROM municipios";
$result = $conn->query($query);

// Prepara os resultados como um array para o select2
$results = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $results[] = [
            'id' => $row['id'],
            'text' => $row['municipio']
        ];
    }
}

// Retorna os resultados como JSON
echo json_encode($results);

// Fecha a conexão com o banco de dados
$conn->close();
?>
