<?php
// Dados de conexão com o banco de dados
include '../database/databaseconnect.php';

// Ler o conteúdo do arquivo JSON
$jsonFile = 'Áreas de Quilombolas_PI.json';
$jsonData = file_get_contents($jsonFile);

// Decodificar o JSON
$data = json_decode($jsonData, true);

// Verificar se o JSON foi decodificado corretamente
if ($data !== null) {
    $features = $data['features'];

    foreach ($features as $feature) {
        $geometry = $feature['geometry'];
        $properties = $feature['properties'];

        // Dados para inserção no banco de dados
        $type = $geometry['type'];
        $coordinates = json_encode($geometry['coordinates']);
        $cd_quilomb = $properties['cd_quilomb'];
        $cd_sr = $properties['cd_sr'];
        $nr_process = $properties['nr_process'];
        $nm_comunid = $properties['nm_comunid'];
        $nm_municip = $properties['nm_municip'];
        $cd_uf = $properties['cd_uf'];
        $dt_publica = $properties['dt_publica'];
        $nr_familia = $properties['nr_familia'];
        $nr_area_ha = $properties['nr_area_ha'];
        $fase = $properties['fase'];
        $esfera = $properties['esfera'];

        // Inserir os dados na tabela
        $sql = "INSERT INTO quilombola_ (
            type, coordinates, cd_quilomb, cd_sr, nr_process, nm_comunid, nm_municip, cd_uf, dt_publica,
            nr_familia, nr_area_ha, fase, esfera
        ) VALUES (
            '$type', '$coordinates', '$cd_quilomb', '$cd_sr', '$nr_process', '$nm_comunid', '$nm_municip',
            '$cd_uf', '$dt_publica', '$nr_familia', '$nr_area_ha', '$fase', '$esfera'
        )";

        if ($conn->query($sql) === true) {
            echo "Dados inseridos com sucesso!<br>";
        } else {
            echo "Erro: " . $sql . "<br>" . $conn->error;
        }
    }
} else {
    echo "Erro ao decodificar o JSON.";
}

// Fechar a conexão
$conn->close();
?>
