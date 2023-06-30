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
$sql = "SELECT *, SUBSTRING(SUBSTRING(teste, 18), 1, CHAR_LENGTH(SUBSTRING(teste, 18)) - 3) as coordenadas FROM poligonos WHERE municipio in ('teresina','amarante','SÃO JOÃO DO PIAUÍ') "; // Substitua sua_tabela e id pelo nome correto

$result = $conn->query($sql);

$coordinatesArray = array();

if ($result->num_rows > 0) {
    // Extrai as coordenadas do resultado da consulta
    while ($row = $result->fetch_assoc()) {
        $name = $row["localidade"];
        $coordinates = $row["coordenadas"];
        $pointsArray[$name] = $coordinates;
    }
} else {
    echo "Nenhum resultado encontrado.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-*******" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <title>GitHub-like Theme</title>
    <style>
    /* Personalize o estilo do tema aqui */

    /* Exemplo de cores semelhantes ao GitHub */
    :root {
        --primary-color: #24292e;
        --secondary-color: #6a737d;
        --accent-color: #0366d6;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #f6f8fa;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .navbar {
        background-color: var(--primary-color);
    }

    .navbar-brand {
        color: #fff;
    }

    .nav-link {
        color: #fff;
    }

    .container {
        margin-top: 40px;
        flex: 1;
    }

    .footer {
        background-color: var(--primary-color);
        color: #fff;
        padding: 20px 0;
        flex-shrink: 0;
    }

    .footer p {
        margin-bottom: 0;
    }

    .footer .social-icons {
        font-size: 24px;
        margin-top: 10px;
    }

    .footer .social-icons a {
        color: #fff;
        margin-right: 10px;
    }


    #map {
            height: 600px;
            width: 100%;
        }
    </style>

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="#">GitHub</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Repositórios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Projetos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Pacotes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Marketplace</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="#">Perfil</a></li>
                                <li><a class="dropdown-item" href="#">Configurações</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Sair</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <body>
        <div class="container">
            <div id="map"></div>

            <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
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
            // Percorre os pontos do array
            <?php foreach ($pointsArray as $name => $coordinates) { ?>
            // Quebra as coordenadas em um array
            var coordinatesArray = <?php echo json_encode(explode(", ", $coordinates)); ?>;

            // Converte as coordenadas para o formato esperado pelo Leaflet.js
            var leafletCoordinates = coordinatesArray.map(function(coordinateString) {
                var coordinateArray = coordinateString.split(" ");
                var lat = parseFloat(coordinateArray[1]);
                var lng = parseFloat(coordinateArray[0]);
                return [lat, lng];
            });

            // Cria o polígono com as coordenadas
            var polygon = L.polygon(leafletCoordinates, {
                color: 'red'
            }).addTo(map);

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
            L.marker([latAvg, lngAvg]).addTo(map)
                .bindPopup('<?php echo $name; ?>');
            <?php } ?>
            <?php } ?>
            </script>
        </div>
    </body>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <p>&copy; 2023 GitHub-like Theme. Todos os direitos reservados.</p>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>