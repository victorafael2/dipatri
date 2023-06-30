<?php
// Conexão com o banco de dados
$servername = "localhost";  // substitua pelo nome do seu servidor MySQL
$username = "root"; // substitua pelo nome de usuário do banco de dados
$password = "";   // substitua pela senha do banco de dados
$dbname = "aprendendo"; // substitua pelo nome do banco de dados

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Consulta SQL
$sql = "SELECT DISTINCT *, SUBSTRING(SUBSTRING(teste, 18), 1, CHAR_LENGTH(SUBSTRING(teste, 18)) - 3) as coordenadas, CONCAT(municipio, ' - ', localidade) as nome_completo FROM poligonos WHERE municipio in ('AGRICOLÂNDIA','ALTOS','AMARANTE','BARRAS','BARRO DURO','BATALHA','BOM JESUS','BOM PRINCÍPIO DO PIAUÍ','CANTO DO BURITI','CAXINGÓ','COLÔNIA DO GURGUÉIA','CANTO DO BURITI','CAXINGÓ','COLÔNIA DO GURGUÉIA','COLÔNIA DO PIAUÍ','CRISTINO CASTRO','CURRAIS','CURRALINHOS','DEMERVAL LOBÃO','ESPERANTINA','FLORESTA DO PIAUÍ','HUGO NAPOLEÃO','ITAUEIRA','JARDIM DO MULATO','JOÃO COSTA','JOAQUIM PIRES','JOCA MARQUES','JOSÉ DE FREITAS','LAGOA ALEGRE','LUZILÂNDIA','MADEIRO','MIGUEL ALVES','MONSENHOR GIL',
'MORRO DO CHAPÉU DO PIAUÍ','MURICI DOS PORTELAS','NAZÁRIA','NOSSA SENHORA DOS REMÉDIOS','NOVA SANTA RITA','OEIRAS','OLHO D\'ÁGUA DO PIAUÍ',
'PAES LANDIM','PAJEÚ DO PIAUÍ','PALMEIRAIS','PARNAGUÁ','PASSAGEM FRANCA DO PIAUÍ','PAVUSSU','PEDRO LAURENTINO',
'PIMENTEIRAS','PORTO','REDENÇÃO DO GURGUÉIA','RIACHO FRIO','SANTA FILOMENA',
'SANTA LUZ','SANTO INÁCIO DO PIAUÍ','SÃO FRANCISCO DO PIAUÍ','SÃO GONÇALO DO PIAUÍ','SÃO JOÃO DO PIAUÍ','SAO MIGUEL DO FIDALGO',
'SÃO MIGUEL DO FIDALGO','SAO MIGUEL DO TAPUIO','SÃO PEDRO DO PIAUÍ','SAO RAIMUNDO NONATO','SÃO RAIMUNDO NONATO','SEBASTIÃO LEAL',
'SIGEFREDO PACHECO','SIMPLÍCIO MENDES','TERESINA','UNIÃO','WALL FERRAZ'



















) ORDER BY municipio";

$result = $conn->query($sql);

$coordinatesArray = array();

if ($result->num_rows > 0) {
    // Extrai as coordenadas do resultado da consulta
    while ($row = $result->fetch_assoc()) {
        $name = mysqli_real_escape_string($conn, $row["nome_completo"]);
        $coordinates = $row["coordenadas"];
        $pointsArray[$name] = $coordinates;
    }
} else {
    echo "Nenhum resultado encontrado.";
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Mapa com Leaflet.js, Leaflet Tag Filter Button e Leaflet Sidebar</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-tag-filter-button/dist/leaflet-tag-filter-button.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-sidebar-v2/css/leaflet-sidebar.css" />
    <style>
        #map {
            height: 600px;
        }
    </style>
</head>
<body>
    <div id="map"></div>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-tag-filter-button/dist/leaflet-tag-filter-button.js"></script>
    <script src="https://unpkg.com/leaflet-sidebar-v2/js/leaflet-sidebar.js"></script>
    <script>
        // Cria o mapa e define a localização inicial
        var map = L.map('map').setView([-4.239, -42.568], 14);

        // Adiciona o tile layer (camada de visualização do mapa)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
            maxZoom: 18
        }).addTo(map);

        // Verifica se existem pontos para exibir
        <?php if (!empty($pointsArray)) { ?>
            // Cria um objeto para armazenar referências aos marcadores e polígonos
            var markersAndPolygons = {};

            // Cria uma lista ordenada para exibir os nomes dos pontos
            var pointList = document.createElement('ol');
            pointList.setAttribute('type', '1');

            // Cria a tabela para exibir os pontos e suas coordenadas
            var table = document.createElement('table');
            var tableHead = document.createElement('thead');
            var tableBody = document.createElement('tbody');

            // Cria a linha de cabeçalho da tabela
            var tableHeadRow = document.createElement('tr');
            var tableHeadName = document.createElement('th');
            tableHeadName.textContent = 'Nome';
            var tableHeadCoordinates = document.createElement('th');
            tableHeadCoordinates.textContent = 'Coordenadas';
            tableHeadRow.appendChild(tableHeadName);
            tableHeadRow.appendChild(tableHeadCoordinates);
            tableHead.appendChild(tableHeadRow);
            table.appendChild(tableHead);

            // Percorre os pontos do array
            <?php foreach ($pointsArray as $name => $coordinates) { ?>
                // Quebra as coordenadas em um array
                var coordinatesArray = <?php echo json_encode(explode(", ", $coordinates)); ?>;

                // Converte as coordenadas para o formato esperado pelo Leaflet.js
                var leafletCoordinates = coordinatesArray.map(function (coordinateString) {
                    var coordinateArray = coordinateString.split(" ");
                    var lat = parseFloat(coordinateArray[1]);
                    var lng = parseFloat(coordinateArray[0]);
                    return [lat, lng];
                });

                // Cria o polígono com as coordenadas
                var polygon = L.polygon(leafletCoordinates, { color: 'red' });

                // Centraliza o mapa no polígono
                map.fitBounds(polygon.getBounds());

                // Calcula o ponto médio do polígono
                var latSum = 0;
                var lngSum = 0;
                for (var i = 0; i < leafletCoordinates.length; i++) {
                    latSum += leafletCoordinates[i][0];
                    lngSum += leafletCoordinates[i][1];
                }
                var latAvg = latSum / leafletCoordinates.length;
                var lngAvg = lngSum / leafletCoordinates.length;

                // Cria o marcador para o ponto médio com rótulo personalizado
                var marker = L.marker([latAvg, lngAvg]).bindPopup('<?php echo $name; ?>');
                marker.addTo(map);

                // Armazena referências aos marcadores e polígonos
                markersAndPolygons['<?php echo $name; ?>'] = {
                    marker: marker,
                    polygon: polygon
                };

                // Adiciona o nome do ponto à lista
                var listItem = document.createElement('li');
                listItem.textContent = '<?php echo $name; ?>';
                listItem.addEventListener('click', function() {
                    // Obtém a referência ao marcador e polígono correspondente
                    var markerAndPolygon = markersAndPolygons['<?php echo $name; ?>'];

                    // Centraliza o mapa no marcador
                    map.setView(markerAndPolygon.marker.getLatLng());

                    // Abre o popup do marcador
                    markerAndPolygon.marker.openPopup();
                });

                pointList.appendChild(listItem);

                // Adiciona a linha na tabela com o nome e as coordenadas do ponto
                var tableBodyRow = document.createElement('tr');
                var tableBodyName = document.createElement('td');
                tableBodyName.textContent = '<?php echo $name; ?>';
                var tableBodyCoordinates = document.createElement('td');
                tableBodyCoordinates.textContent = latAvg.toFixed(6) + ', ' + lngAvg.toFixed(6);
                tableBodyRow.appendChild(tableBodyName);
                tableBodyRow.appendChild(tableBodyCoordinates);
                tableBody.appendChild(tableBodyRow);
            <?php } ?>

            // Adiciona a lista à página
            document.body.appendChild(pointList);

            // Adiciona a tabela à página
            table.appendChild(tableBody);
            document.body.appendChild(table);
        <?php } ?>
    </script>

    <div id="sidebar">
        <div id="sidebar-content"></div>
    </div>
</body>
</html>
