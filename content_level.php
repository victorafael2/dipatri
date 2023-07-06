
<link href="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>




<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Matrículas</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Busca de Matrículas</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                <i class="fa-regular fa-rectangle-list"></i>
                Matrículas
                </div>
                <div class="card-body">
                    <form id="meuFormulario">
                        <div class="form-row">
                            <div class="col-md-12">
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
                            <!-- <div class="col-md-4">
                            <label for="municipio">Propriedade</label>
                                <select class="form-control" id="propriedade" name="propriedade" multiple>
                                    <option value="">Selecione o município primeiro</option>
                                </select>
                            </div> -->
                            <!-- <div class="col-md-4">
                                <label for="tipo">Opção 3:</label>
                                <select class="form-control" id="tipo" name="tipo">
                                    <option value="opcao1">Opção 1</option>
                                    <option value="opcao2">Opção 2</option>
                                    <option value="opcao3">Opção 3</option>
                                </select>
                            </div> -->
                        </div>
                        <!-- <div class="form-row mt-2">
                            <div class="col-md-4">
                                <label for="matricula">Texto:</label>
                                <input type="text" class="form-control" id="matricula" name="matricula">
                            </div>
                        </div> -->
                        <button type="submit" class="btn btn-primary btn-sm mt-2"> Consultar</button>
                    </form>

                    <div id="resultado"></div>


                </div>
            </div>
        </div>


</main>





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

        // Obtém o valor selecionado do campo de município
        var municipio = $('#municipio').val();

        // Verifica se um município foi selecionado
        if (municipio !== '') {
            // Envia os dados via AJAX
            $.ajax({
                type: 'POST',
                url: 'consultas/get/get_matriculas_filterby.php',
                data: { municipio: municipio },
                success: function(response) {
                    $('#resultado').html(response);
                }
            });
        } else {
            // Limpa o resultado se nenhum município for selecionado
            $('#resultado').html('');
        }
    });
});
</script>
<script src="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/tableExport.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/libs/jsPDF/jspdf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.22.1/dist/extensions/export/bootstrap-table-export.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-table/dist/locale/bootstrap-table-pt-BR.min.js"></script>
