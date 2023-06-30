<?php
$servername = "localhost";  // substitua pelo nome do seu servidor MySQL
$username = "root"; // substitua pelo nome de usuário do banco de dados
$password = "";   // substitua pela senha do banco de dados
$dbname = "aprendendo"; // substitua pelo nome do banco de dados

// Cria a conexão
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verifica se a conexão foi estabelecida com sucesso
if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}
$sql = "SELECT *, SUBSTRING(SUBSTRING(teste, 17), 1, CHAR_LENGTH(SUBSTRING(teste, 17)) - 2) as poligonos FROM poligonos WHERE municipio = 'altos'"; // substitua "tabela" pelo nome da tabela que deseja consultar

$result = mysqli_query($conn, $sql);

if ($result) {
    // A consulta foi executada com sucesso, você pode iterar sobre os resultados
    while ($row = mysqli_fetch_assoc($result)) {
        // Use os dados retornados conforme necessário
        echo "ID: " . $row['id'] . ", Municipio: " . $row['municipio'] . ", Coordenadas: " . $row['poligonos'] . "</br>";
    }
} else {
    echo "Erro na consulta: " . mysqli_error($conn);
}
mysqli_close($conn);



?>


    <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Mapa com Leaflet.js</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        #map {
            height: 400px;
        }
    </style>
</head>
<body>
    <div id="map"></div>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        // Cria o mapa e define a localização inicial
        var map = L.map('map').setView([-3.7474, -38.5192], 12);

        // Adiciona o tile layer (camada de visualização do mapa)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
            maxZoom: 18
        }).addTo(map);

        // Define as coordenadas dos vértices do primeiro polígono
        var polygon1Coordinates = [
            [-3.7474, -38.5192], // Vértice 1
            [-3.7319, -38.5267], // Vértice 2
            [-3.7543, -38.5383]  // Vértice 3
        ];

        // Cria o primeiro polígono usando as coordenadas dos vértices
        var polygon1 = L.polygon(polygon1Coordinates, { color: 'red' }).addTo(map);

        // Define as coordenadas dos vértices do segundo polígono
        var polygon2Coordinates = [
            [-3.7411, -38.5047], // Vértice 1
            [-3.7319, -38.5104], // Vértice 2
            [-3.7543, -38.5208]  // Vértice 3
        ];

        // Cria o segundo polígono usando as coordenadas dos vértices
        var polygon2 = L.polygon(polygon2Coordinates, { color: 'blue' }).addTo(map);

        // Adiciona uma pop-up ao primeiro polígono
        polygon1.bindPopup("<b>Polígono 1</b><br>Coordenadas: " + polygon1Coordinates);

        // Adiciona uma pop-up ao segundo polígono
        polygon2.bindPopup("<b>Polígono 2</b><br>Coordenadas: " + polygon2Coordinates);
    </script>
</body>
</html>
