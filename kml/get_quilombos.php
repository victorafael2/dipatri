<?php
// Configuração da conexão com o banco de dados
include '../database/databaseconnect.php';

// Verifica se a conexão foi estabelecida com sucesso
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Consulta SQL para buscar os dados dos polígonos
$sql = "SELECT * FROM coordenada
        WHERE tipo = 'Imoveis Certificados' ";

$result = $conn->query($sql);

// Array para armazenar os dados formatados como GeoJSON
$geojson_data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $coordinates = json_decode($row["geojson"]);

        if ($row["TYPE"] === "MultiPolygon") {
            $feature = [
                "type" => "MultiPolygon",
                "coordinates" => $coordinates,
                "properties" => [
                    "nm_comunid" => $row["nome_comunidade"],
                    "nm_municip" => $row["nome_municipio"],
                    "borderColor" => $row["borderColor"],
                    "fillColor" => $row["fillColor"],
                    "tipo" => $row["tipo"],
                ]
            ];
        } else {
            $feature = [
                "type" => "Polygon",
                "coordinates" => $coordinates,
                "properties" => [
                    "nm_comunid" => $row["nome_comunidade"],
                    "nm_municip" => $row["nome_municipio"],
                    "borderColor" => $row["borderColor"],
                    "fillColor" => $row["fillColor"],
                    "tipo" => $row["tipo"],
                ]
            ];
        }

        $geojson_data[] = $feature;
    }
}

// Libera o resultado da consulta
$result->free_result();

// Fecha a conexão com o banco de dados
$conn->close();

// Defina o cabeçalho para download do arquivo JSON
header('Content-Disposition: attachment; filename="dados.geojson"');
header('Content-Type: application/json');

// Saída dos dados como JSON
echo json_encode($geojson_data, JSON_PRETTY_PRINT); // Use JSON_PRETTY_PRINT para formatar legivelmente
?>
