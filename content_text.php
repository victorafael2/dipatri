<?php
// Captura os dados do formulário
if (empty($_POST['municipio'])) {
    $municipio = "ACAUÃ";
} else {
    $municipio = $_POST['municipio'];
}

if (empty($_POST['propriedade'])) {
    $propriedade = "SITIO SESMARIA CAMPOS";
} else {
    $propriedade = $_POST['propriedade'];
}



?>
                <link href="https://unpkg.com/bootstrap-table@1.22.0/dist/bootstrap-table.min.css" rel="stylesheet">
<link href="https://unpkg.com/bootstrap-table@1.22.0/dist/extensions/reorder-rows/bootstrap-table-reorder-rows.css"
    rel="stylesheet">
<link href="https://unpkg.com/bootstrap-table@1.22.0/dist/extensions/group-by-v2/bootstrap-table-group-by.css"
    rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script
    src="https://unpkg.com/bootstrap-table@1.22.0/dist/extensions/filter-control/bootstrap-table-filter-control.min.js">
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Matriculas</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Matriculas</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Matriculas
                </div>
                <div class="card-body">





<table id="tabela" data-toggle="table" data-filter-control="true" data-show-search-clear-button="true"
    data-url="consultas/get/get_matriculas.php" data-pagination="true" class="table table-sm table-borderless ">
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






                </div>
            </div>
        </div>

</div>
</main>
</div>



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






