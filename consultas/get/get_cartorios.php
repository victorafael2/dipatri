<?php
$municipios = $_POST['municipio']; // Obtém os valores selecionados do campo múltiplo

$queryParams = [];
foreach ($municipios as $municipio) {
    $municipio = urlencode($municipio);
    $queryParams[] = 'municipio[]=' . $municipio;
}

$queryString = implode('&', $queryParams); // Concatena os parâmetros da string de consulta usando '&'

// $url_link = 'consultas/get/get_cartorios_total.php?' . $queryString; // Concatena a string de consulta com a URL base

$url_base = 'consultas/get/get_cartorios_total.php';
if ($queryString != 'municipio[]=all') {
    $url_link = $url_base . '?' . $queryString; // Concatena a string de consulta com a URL base
} else {
    $url_link = $url_base;
}

// echo $url_link; // Exibe a URL completa com a string de consulta
?>

<style>
    .custom-table {
        font-size: 12px; /* Defina o tamanho de fonte desejado */
    }
</style>


<table id="table" data-toggle="table" data-show-export="true" data-show-button-icons="true" data-show-button-text="true" data-pagination="true" data-click-to-select="true"  data-locale="pt-BR"
   data-show-toggle="false" data-show-columns="false" data-export-data-type="all" data-export-file-name="Matriculas" data-url="<?php echo $url_link ?>"
   class="table table-sm table-borderless fs--3 table-striped rounded custom-table">
    <thead>
        <tr>
            <th data-field="id">ID</th>
            <th data-field="municipio" data-filter-control="select">Municipio</th>
            <th data-field="Codigo_CNS" data-filter-control="select">Codigo_CNS</th>
            <th data-field="Denominacao_Serventia" data-filter-control="select">Denominacao_Serventia</th>
            <th data-field="Municipios_Circunscritos" data-filter-control="input">Municipios_Circunscritos</th>
            <th data-field="Responsavel" data-filter-control="input">Responsavel</th>
            <th data-field="Endereco" data-filter-control="input">Endereco</th>
            <th data-field="Telefone" data-filter-control="input">Telefone</th>
            <th data-field="Email" data-filter-control="input">Email</th>
            <th data-field="Whatsapp" data-filter-control="input">Whatsapp</th>
        </tr>
    </thead>
</table>



<script src="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/tableExport.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/libs/jsPDF/jspdf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.22.1/dist/extensions/export/bootstrap-table-export.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-table/dist/locale/bootstrap-table-pt-BR.min.js"></script>


<!-- <script>
$(document).ready(function() {
  $('#table').bootstrapTable({
    exportOptions: {
      fileName: 'Matriculas',
      ignoreColumn: [0] // Ignora a coluna de índice
    },
    toolbar: '#toolbar',
    showExport: true,
    exportTypes: ['excel']
  });
});
</script> -->


