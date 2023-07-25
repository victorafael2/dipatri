
  <!-- Inclua a folha de estilos do Leaflet -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>



<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Campestre</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active"></li>
                        </ol>
                        <div class="row">

                        </div>
                        <div class="row">

                        </div>
                        <div class="card mb-4">
                            <div class="card-header">

                         Campestre
                            </div>
                            <div class="card-body">

                              <!-- Contêiner para exibir o mapa -->
                              <div id="map" style="height: 500px;"></div>

  <!-- Inclua o script do Leaflet -->


                            </div>
                        </div>
                    </div>
                </main>

                <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>


                <script>
  // Função para carregar as coordenadas e exibir o mapa
  function initMap() {
    // Coordenadas iniciais do mapa - por exemplo, coordenadas do primeiro ponto da lista
    const initialCoords = [-5.3937189616, -42.7655610957];

    // Crie o mapa e defina a exibição inicial
    const map = L.map('map').setView(initialCoords, 10); // O "10" é o nível de zoom inicial

    // Adicione um provedor de mapa (OpenStreetMap)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    // Lista de coordenadas no formato [latitude, longitude, altura]
    const coordinatesList = [
      [-5.3937189616, -42.7655610957, 0],
      [-5.3963603702, -42.7629390427, 0],
      [-5.3968172543, -42.7626617163, 0],
      [-5.3989106771, -42.7620570800, 0],
      [-5.4090542192, -42.7621006093, 0],
      [-5.4168045934, -42.7621164611, 0],
      [-5.4170369477, -42.7672679984, 0],
      [-5.4176139041, -42.7786539924, 0],
      [-5.4186211678, -42.8039501131, 0],
      [-5.4342716217, -42.8194921521, 0],
      [-5.4354168525, -42.8208730550, 0],
      [-5.4365031769, -42.8227514107, 0],
      [-5.4375460381, -42.8236235890, 0],
      [-5.4386276376, -42.8248202408, 0],
      [-5.4265526331, -42.8274166583, 0],
      [-5.4224632813, -42.8284514860, 0],
      [-5.4207025570, -42.8288668349, 0],
      [-5.4207011324, -42.8259532404, 0],
      [-5.4176150098, -42.8249900804, 0],
      [-5.4131714357, -42.8260393612, 0],
      [-5.4101931192, -42.8215346674, 0],
      [-5.4024472296, -42.8187200616, 0],
      [-5.3978519950, -42.8071548381, 0],
      [-5.4008789107, -42.8036353938, 0],
      [-5.3975145314, -42.7968221605, 0],
      [-5.3963856920, -42.7965072399, 0],
      [-5.3981539666, -42.7926966092, 0],
      [-5.3971998717, -42.7924403726, 0],
      [-5.4018889312, -42.7803065773, 0],
      [-5.3996433889, -42.7781878803, 0]
    ];

    // Crie um array para armazenar as coordenadas processadas
    const latLngList = [];

    // Percorra a lista de coordenadas e crie objetos de LatLng
    coordinatesList.forEach((coord) => {
      latLngList.push(L.latLng(coord[0], coord[1]));
    });

    // Crie uma camada de polilinha (linha que conecta os pontos) usando as coordenadas processadas
    const polyline = L.polyline(latLngList).addTo(map);

    // Ajuste o zoom e o centro do mapa para abranger a polilinha
    map.fitBounds(polyline.getBounds());
  }

  // Chame a função de inicialização do mapa assim que a página for carregada
  document.addEventListener('DOMContentLoaded', initMap);
</script>

