<?php
// Dados de conexão com o banco de dados
include '../database/databaseconnect.php';

// Ler o conteúdo do arquivo JSON
$jsonFile = 'Imóvel certificado SNCI Brasil_PI.json';
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
        $num_proces = $properties['num_proces'];
        $sr = $properties['sr'];
        $num_certif = $properties['num_certif'];
        $data_certi = $properties['data_certi'];
        $qtd_area_p = $properties['qtd_area_p'];
        $cod_profis = $properties['cod_profis'];
        $cod_imovel = $properties['cod_imovel'];
        $nome_imove = $properties['nome_imove'];
        $uf_municip = $properties['uf_municip'];

        // Inserir os dados na tabela
        $sql = "INSERT INTO imoveis_certificados_ (type, coordinates, num_proces, sr, num_certif, data_certi, qtd_area_p, cod_profis, cod_imovel, nome_imove, uf_municip)
                VALUES ('$type', '$coordinates', '$num_proces', '$sr', '$num_certif', '$data_certi', '$qtd_area_p', '$cod_profis', '$cod_imovel', '$nome_imove', '$uf_municip')";

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
