<?php
include 'database/databaseconnect.php';

// Lê o arquivo GeoJSON
$geojson = file_get_contents('kml/quilombolas.json');

// Conexão com o banco de dados


if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

$data = json_decode($geojson, true);

// Loop através dos recursos (polígonos) no GeoJSON e inserir no MySQL
foreach ($data['features'] as $feature) {
    $geometry = json_encode($feature['geometry']);
    $sql = "INSERT INTO tabela_geometrias (geometria) VALUES (ST_GeomFromGeoJSON('$geometry'))";

    if ($conn->query($sql) === TRUE) {
        echo "Geometria inserida com sucesso: " . $conn->insert_id . "\n";
    } else {
        echo "Erro na inserção: " . $conn->error . "\n";
    }
}

// Fechar a conexão com o banco de dados
$conn->close();
?>



<html>


<body>

<p>Teste</p>

</body>


</html>


