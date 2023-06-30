
<?php

$municipios = $_POST['municipio']; // Obtém os valores selecionados do campo múltiplo
$municipiostring = http_build_query(['municipio' => $municipios]);







if (empty($_POST['propriedade'])) {
    $propriedade = "SITIO SESMARIA CAMPOS";
} else {
    $propriedade = $_POST['propriedade'];
}
// $tipo = $_POST['tipo'];
// $matricula = $_POST['matricula'];
$propriedadestring = http_build_query(['propriedades' => $propriedade]);

$url = 'consultas/get/get_matriculas.php?' . $municipiostring .'&&'. $propriedadestring;
echo $url;
?>







<table id="tabela" data-toggle="table" data-filter-control="true" data-show-search-clear-button="true"
    data-url="<?php echo $response ?>&&propriedade=<?php echo $propriedade ?>" data-pagination="true" class="table table-sm table-borderless ">
    <thead>
        <tr>
            <th data-field="id">ID</th>
            <th data-field="municipio" data-filter-control="select">Municipio</th>
            <th data-field="propriedade" data-filter-control="select">Propriedade</th>
            <th data-field="tipo" data-filter-control="select">Tipo</th>
            <th data-field="matricula" data-filter-control="input">Matricula</th>
        </tr>
    </thead>
</table>




<script src="https://unpkg.com/bootstrap-table@1.22.0/dist/bootstrap-table.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table-draggable/1.0.0/bootstrap-table-draggable.min.js">
</script>
<script src="https://cdn.jsdelivr.net/npm/tablednd@1.0.5/dist/jquery.tablednd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.16.0/locale/bootstrap-table-pt-BR.min.js">
</script>
<script src="https://unpkg.com/bootstrap-table@1.22.0/dist/extensions/multiple-sort/bootstrap-table-multiple-sort.js">
</script>
<script
    src="https://unpkg.com/bootstrap-table@1.22.0/dist/extensions/filter-control/bootstrap-table-filter-control.min.js">
</script>
<script src="https://unpkg.com/bootstrap-table@1.22.0/dist/extensions/group-by-v2/bootstrap-table-group-by.min.js">
</script>

<script src="https://cdn.jsdelivr.net/npm/tablednd@1.0.5/dist/jquery.tablednd.min.js"></script>

<script src="https://unpkg.com/bootstrap-table@1.22.0/dist/extensions/reorder-rows/bootstrap-table-reorder-rows.min.js">
</script>