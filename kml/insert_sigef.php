<?php
// Dados de conexão com o banco de dados
include '../database/databaseconnect.php';

// Ler o conteúdo do arquivo JSON
$jsonFile = 'Sigef Brasil_PI.json';
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
        $parcela_co = $properties['parcela_co'];
        $rt = $properties['rt'];
        $art = $properties['art'];
        $situacao_i = $properties['situacao_i'];
        $codigo_imo = $properties['codigo_imo'];
        $data_submi = $properties['data_submi'];
        $data_aprov = $properties['data_aprov'];
        $status = $properties['status'];
        $nome_area = $properties['nome_area'];
        $registro_m = $properties['registro_m'];
        $registro_d = $properties['registro_d'];
        $municipio_ = $properties['municipio_'];
        $uf_id = $properties['uf_id'];

        // Preparar a instrução SQL usando prepared statement
        $stmt = $conn->prepare("INSERT INTO sigef (
            type, coordinates, parcela_co, rt, art, situacao_i, codigo_imo, data_submi, data_aprov, status,
            nome_area, registro_m, registro_d, municipio_, uf_id
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Associar parâmetros
        $stmt->bind_param(
            "sssssssssssssss",
            $type, $coordinates, $parcela_co, $rt, $art, $situacao_i, $codigo_imo, $data_submi, $data_aprov,
            $status, $nome_area, $registro_m, $registro_d, $municipio_, $uf_id
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
