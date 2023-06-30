<?php
// Realize a conexão com o banco de dados (substitua as informações de conexão pelo seu próprio host, usuário, senha e nome do banco de dados)
include '../../database/databaseconnect.php';

// Verifique se a conexão foi estabelecida com sucesso
if (!$conn) {
  die('Erro na conexão com o banco de dados: ' . mysqli_connect_error());
}

$municipiosSelecionados = $_POST['municipio'];

// Verifica se foram selecionados municípios
if (!empty($municipiosSelecionados)) {
    // Constrói a string com os municípios selecionados para utilizá-la na cláusula WHERE
    $municipiosString = "'" . implode("', '", $municipiosSelecionados) . "'";

    // Consulta SQL para obter as propriedades relacionadas aos municípios selecionados
    $query = "SELECT DISTINCT propriedade FROM matriculas WHERE municipio IN ($municipiosString) ORDER BY propriedade ASC";
} else {
    // Consulta SQL para obter todas as propriedades quando nenhum município for selecionado
    $query = "SELECT DISTINCT propriedade FROM matriculas ORDER BY propriedade ASC";
}


// Execute a consulta
$resultado = mysqli_query($conn, $query);

// Crie as opções de propriedades
$options = '';
if (mysqli_num_rows($resultado) > 0) {
  while ($row = mysqli_fetch_assoc($resultado)) {
    $propriedade = $row['propriedade'];
    $options .= "<option value='$propriedade'>$propriedade</option>";
  }
} else {
  $options = "<option value=''>Nenhuma propriedade encontrada</option>";
}

// Retorne as opções de propriedades em formato HTML
echo $options;

// Feche a conexão com o banco de dados
mysqli_close($conn);
