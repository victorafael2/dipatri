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
$sql = "SELECT DISTINCT *, SUBSTRING(SUBSTRING(teste, 18), 1, CHAR_LENGTH(SUBSTRING(teste, 18)) - 3) as coordenadas, CONCAT(municipio, ' - ', localidade) as nome_completo FROM poligonos WHERE municipio in ('teresina','amarante','SÃO RAIMUNDO NONATO','SÃO JOÃO DO PIAUÍ','SÃO MIGUEL DO FIDALGO') ORDER BY municipio";



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

        // Cria um objeto de tags para os pontos
        var tags = {};

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
            var polygon = L.polygon(leafletCoordinates, { color: 'red' }).addTo(map);

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

            // Adiciona a tag ao objeto de tags
            tags['<?php echo $name; ?>'] = marker;
        <?php } ?>

        // Cria o controle de filtros
        var tagFilterControl = L.control.tagFilterButton({
            tags: tags,
            filterOnEveryClick: true,
            filterTextAll: 'Todos',
            filterTextSelected: 'Selecionado',
            filterTextNone: 'Nenhum',
            position: 'topright'
        }).addTo(map);

        // Cria a barra lateral para exibir as informações dos pontos filtrados
        var sidebar = L.control.sidebar({
            autopan: true,
            closeButton: true,
            container: 'sidebar',
            position: 'left'
        }).addTo(map);

        // Atualiza a barra lateral quando um filtro é aplicado
        tagFilterControl.on('filter', function (e) {
            var filteredTags = e.filteredTags;
            var content = '';

            // Percorre os pontos filtrados
            for (var tagName in filteredTags) {
                var marker = filteredTags[tagName];
                content += '<h3>' + tagName + '</h3>';
                content += '<p>' + marker.getPopup().getContent() + '</p>';
            }

            // Atualiza o conteúdo da barra lateral
            document.getElementById('sidebar-content').innerHTML = content;
            sidebar.open('info');
        });

        // Cria uma lista ordenada para exibir os nomes dos pontos
        var pointList = document.createElement('ol');
        pointList.setAttribute('type', '1');

        // Percorre os pontos do array
        <?php foreach ($pointsArray as $name => $coordinates) { ?>
            // Cria um elemento <li> para cada item da lista
            var listItem = document.createElement('li');
            listItem.textContent = '<?php echo $name; ?>';

            // Adiciona o evento de clique para mostrar o ponto no mapa
            listItem.addEventListener('click', function () {
                var marker = tags[this.textContent];
                if (marker) {
                    map.setView(marker.getLatLng(), 14);
                    marker.openPopup();
                }
            });

            // Adiciona o item da lista à lista ordenada
            pointList.appendChild(listItem);
        <?php } ?>

        // Adiciona a lista à página
        document.body.appendChild(pointList);
    </script>


    <div id="sidebar">
        <div id="sidebar-content"></div>
    </div>

    <script>
        // Cria uma lista ordenada para exibir os nomes dos pontos
    var pointList = document.createElement('ol');
    pointList.setAttribute('type', '1');

        // Percorre os pontos do array
        <?php foreach ($pointsArray as $name => $coordinates) { ?>
            // Adiciona o nome do ponto à lista
            var listItem = document.createElement('li');
            listItem.textContent = '<?php echo $name; ?>';
            pointList.appendChild(listItem);
        <?php } ?>

        // Adiciona a lista à página
        document.body.appendChild(pointList);
    </script>
</body>
</html>
