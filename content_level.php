<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                    <form id="meuFormulario">
                        <div class="form-row">
                            <div class="col-md-4">
                                <label for="municipio">Municipio</label>
                                <select class="form-control" id="municipio" name="municipio" multiple>
                                    <option value="">Selecione o município</option>
                                    <?php


                                        // Consulta SQL para obter os municípios do banco de dados
                                        $query = "SELECT distinct(municipio) as municipio FROM matriculas order by municipio asc";
                                        $resultado = mysqli_query($conn, $query);

                                        // Verifica se a consulta retornou resultados
                                        if (mysqli_num_rows($resultado) > 0) {
                                            // Itera pelos resultados e cria as opções do select
                                            while ($row = mysqli_fetch_assoc($resultado)) {
                                            $id = $row['municipio'];
                                            $nome = $row['municipio'];
                                            echo "<option value='$id'>$nome</option>";
                                            }
                                        } else {
                                            echo "<option value=''>Nenhum município encontrado</option>";
                                        }

                                        // Fecha a conexão com o banco de dados

                                        ?>
                                </select>

                            </div>
                            <div class="col-md-4">
                            <label for="municipio">Propriedade</label>
                                <select class="form-control" id="propriedade" name="propriedade" multiple>
                                    <option value="">Selecione o município primeiro</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="tipo">Opção 3:</label>
                                <select class="form-control" id="tipo" name="tipo">
                                    <option value="opcao1">Opção 1</option>
                                    <option value="opcao2">Opção 2</option>
                                    <option value="opcao3">Opção 3</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row mt-2">
                            <div class="col-md-4">
                                <label for="matricula">Texto:</label>
                                <input type="text" class="form-control" id="matricula" name="matricula">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Enviar</button>
                    </form>

                    <div id="resultado"></div>


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


<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    $('#municipio').select2();
});

$(document).ready(function() {
    $('#propriedade').select2();
});
</script>

<script>
$(document).ready(function() {
  $('#municipio').change(function() {
    var municipio = $(this).val();

    // Verifica se um município foi selecionado
    if (municipio !== '') {
      $.ajax({
        type: 'POST',
        url: 'consultas/get/get_municipios_propriedades.php',
        data: { municipio: municipio },
        success: function(response) {
          // Atualiza as opções do select de propriedades com base na resposta do servidor
          $('#propriedade').html(response);
        }
      });
    } else {
      // Limpa as opções do select de propriedades se nenhum município for selecionado
      $('#propriedade').html('<option value="">Selecione o município primeiro</option>');
    }
  });
});

</script>

<script>
$(document).ready(function() {
    $('#meuFormulario').submit(function(e) {
        e.preventDefault(); // Impede o envio tradicional do formulário

        // Obtém os dados do formulário
        var formData = new FormData();

        // Obtém os valores selecionados do campo múltiplo
        var municipiosSelecionados = $('#municipio').val();

        // Adiciona os valores selecionados ao objeto FormData como um array
        for (var i = 0; i < municipiosSelecionados.length; i++) {
            formData.append('municipio[]', municipiosSelecionados[i]);
        }

          // Obtém os valores selecionados do campo múltiplo
          var propriedadeSelecionados = $('#propriedade').val();

// Adiciona os valores selecionados ao objeto FormData como um array
for (var i = 0; i < propriedadeSelecionados.length; i++) {
    formData.append('propriedade[]', propriedadeSelecionados[i]);
}

        // Envia os dados via AJAX
        $.ajax({
            type: 'POST',
            url: 'consultas/get/get_matriculas_filterby.php',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#resultado').html(response);
            }
        });
    });
});

</script>