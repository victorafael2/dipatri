<!-- Inclua a folha de estilos do Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />




<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Mapas Gerais</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"></li>
            </ol>
            <div class="row">

            </div>
            <div class="row">

            </div>
            <div class="card mb-4">
                <div class="card-header">

                    Mapas gerais
                </div>
                <div class="card-body">

                    <!-- Contêiner para exibir o mapa -->
                    <div id="map" style="height: 500px;"></div>

                    <select id="municipSelect">
                        <option value="" selected>Selecionar Município</option>
                    </select>

                    <button id="resetZoomButton">Resetar Zoom</button>
                    <button id="resetAllButton">Resetar Tudo</button>
                    <p id="recordCount">Quantidade de Registros: 0</p>
                    <!-- Novo elemento para mostrar a quantidade de registros -->

                    <!-- Inclua o script do Leaflet -->

                    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
                    <script
                        src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.4.1/leaflet.markercluster.js">
                    </script>

                    <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const map = L.map('map').setView([-8.22534417, -42.53591972], 7);
                        const tileLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')
                            .addTo(map);

                        const selectElement = document.getElementById('municipSelect');
                        const recordCountElement = document.getElementById(
                        'recordCount'); // Elemento para exibir a quantidade de registros
                        let data;
                        let initialBounds;
                        let selectedPolygonLayer;

                        fetch('kml/dados.geojson')
                            .then(response => response.json())
                            .then(dataResponse => {
                                data = dataResponse;

                                data.forEach(polygon => {
                                    const municipName = polygon.properties.nm_municip;

                                    if (!selectElement.querySelector(`[value="${municipName}"]`)) {
                                        const option = document.createElement('option');
                                        option.value = municipName;
                                        option.text = municipName;
                                        selectElement.appendChild(option);
                                    }

                                    const borderColor = polygon.properties.borderColor || 'blue';
                                    const fillColor = polygon.properties.fillColor || 'green';
                                    const polygonStyle = {
                                        color: borderColor,
                                        fillColor: fillColor,
                                        fillOpacity: 0.4,
                                        weight: 2
                                    };

                                    const popupContent = `
              Município: ${polygon.properties.nm_municip}<br>
              Comunidade: ${polygon.properties.nm_comunid}<br>
              Tipo: ${polygon.properties.tipo}
            `;

                                    L.geoJSON(polygon, {
                                            style: polygonStyle
                                        })
                                        .bindPopup(popupContent)
                                        .addTo(map);
                                });

                                const bounds = L.geoJSON(data).getBounds();
                                map.fitBounds(bounds);

                                initialBounds = L.geoJSON(data).getBounds();
                                map.fitBounds(initialBounds);

                                updateRecordCount(); // Atualiza a contagem inicial de registros
                            });

                        selectElement.addEventListener('change', function() {
                            const selectedMunicip = selectElement.value;

                            if (selectedPolygonLayer) {
                                map.removeLayer(selectedPolygonLayer);
                            }

                            const selectedPolygon = data.find(polygon => polygon.properties
                                .nm_municip === selectedMunicip);

                            if (selectedPolygon) {
                                const borderColor = selectedPolygon.properties.borderColor || 'blue';
                                const fillColor = selectedPolygon.properties.fillColor || 'green';
                                const polygonStyle = {
                                    color: borderColor,
                                    fillColor: fillColor,
                                    fillOpacity: 0.4,
                                    weight: 2
                                };

                                const popupContent = `
            Município: ${selectedPolygon.properties.nm_municip}<br>
            Comunidade: ${selectedPolygon.properties.nm_comunid}
          `;

                                selectedPolygonLayer = L.geoJSON(selectedPolygon, {
                                        style: polygonStyle
                                    })
                                    .bindPopup(popupContent)
                                    .addTo(map);

                                const selectedPolygonBounds = selectedPolygonLayer.getBounds();
                                map.fitBounds(selectedPolygonBounds);
                            }

                            updateRecordCount
                        (); // Atualiza a contagem de registros após a seleção ser alterada
                        });

                        const resetZoomButton = document.getElementById('resetZoomButton');
                        resetZoomButton.addEventListener('click', function() {
                            map.fitBounds(initialBounds);
                        });

                        const resetAllButton = document.getElementById('resetAllButton');
                        resetAllButton.addEventListener('click', function() {
                            selectElement.value = '';
                            map.fitBounds(initialBounds);
                            if (selectedPolygonLayer) {
                                map.removeLayer(selectedPolygonLayer);
                            }
                            updateRecordCount(); // Atualiza a contagem de registros após o reset
                        });

                        function updateRecordCount() {
                            recordCountElement.textContent = `Quantidade de Registros: ${data.length}`;
                        }

                    });
                    </script>
                </div>
            </div>
        </div>
    </main>