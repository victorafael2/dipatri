<?php
// Dados de conexão com o banco de dados
include '../database/databaseconnect.php';

// Ler o conteúdo do arquivo JSON
$jsonFile = 'Assentamento Brasil_PI.json';
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
        $cd_sipra = $properties['cd_sipra'];
        $uf = $properties['uf'];
        $nome_proje = $properties['nome_proje'];
        $municipio = $properties['municipio'];
        $area_hecta = $properties['area_hecta'];
        $capacidade = $properties['capacidade'];
        $num_famili = $properties['num_famili'];
        $fase = $properties['fase'];
        $data_de_cr = $properties['data_de_cr'];
        $forma_obte = $properties['forma_obte'];
        $data_obten = $properties['data_obten'];
        $area_calc = $properties['area_calc_'];
        $sr = $properties['sr'];
        $descricao = $properties['descricao_'];

        // Preparar a instrução SQL usando prepared statement
        $stmt = $conn->prepare("INSERT INTO assentamentos (
            type, coordinates, cd_sipra, uf, nome_proje, municipio, area_hecta, capacidade, num_famili, fase,
            data_de_cr, forma_obte, data_obten, area_calc, sr, descricao
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Associar parâmetros
        $stmt->bind_param(
            "ssssssssssssssss",
            $type, $coordinates, $cd_sipra, $uf, $nome_proje, $municipio, $area_hecta, $capacidade,
            $num_famili, $fase, $data_de_cr, $forma_obte, $data_obten, $area_calc, $sr, $descricao
        );

        if ($stmt->execute()) {
            echo "Dados inseridos com sucesso!<br>";
        } else {
            echo "Erro: " . $stmt->error;
        }

        // Fechar o statement
        $stmt->close();
    }
} else {
    echo "Erro ao decodificar o JSON.";
}

// Fechar a conexão
$conn->close();
?>
