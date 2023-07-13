
<link href="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.css" rel="stylesheet">
    <!-- <link href="https://unpkg.com/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Cartórios</h1>

            <div class="d-flex justify-content-between align-items-center">
                <ol class="breadcrumb mb-4" style="flex-grow: 1;">
                    <li class="breadcrumb-item active">Cartórios</li>
                </ol>
                <button type="button" class="btn btn-outline-success btn-sm mt-2" data-toggle="modal"
                    data-target="#myModal">
                    <i class="fa-solid fa-plus"></i> Cadastrar Cartório
                </button>
            </div>

            <div class="row">
                <div class="col">
                <div class="card mb-4">
                <div class="card-header">
                    <i class="fa-regular fa-rectangle-list"></i>
                  Lista de Cartórios
                </div>
                <div class="card-body">
                    <form id="meuFormulario">
                        <div class="form-row">
                            <div class="col-md-12">
                                <label for="municipio_busca">Municipio</label>
                                <select class="form-control" id="municipio_busca" name="municipio_busca" multiple>
                                    <option value="all">Selecione todos os registros</option>
                                    <?php


                                        // Consulta SQL para obter os municípios do banco de dados
                                        $query = "SELECT distinct(municipio) as municipio FROM cartorios order by municipio asc";
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

                        </div>

                        <button type="submit" class="btn btn-primary btn-sm mt-2"> Consultar</button>
                    </form>

                    <div id="resultado"></div>


                </div>
            </div>
                </div>
            </div>
        </div>
    </main>






    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />

    <!-- Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<!-- Scripts JavaScript -->
<script src="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/tableExport.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/libs/jsPDF/jspdf.min.js"></script>
<script
    src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js">
</script>
<script src="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.22.1/dist/extensions/export/bootstrap-table-export.min.js">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-table/dist/locale/bootstrap-table-pt-BR.min.js"></script>




<script>
  $(document).ready(function() {
    $('#municipio_busca').select2();
  });
</script>


<script>
    $(document).ready(function() {
        $('#meuFormulario').submit(function(e) {
            e.preventDefault(); // Impede o envio tradicional do formulário

            // Obtém o valor selecionado do campo de município
            var municipio = $('#municipio_busca').val();

            // Verifica se um município foi selecionado
            if (municipio !== '') {
                // Envia os dados via AJAX
                $.ajax({
                    type: 'POST',
                    url: 'consultas/get/get_cartorios.php',
                    data: {
                        municipio: municipio
                    },
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




<!-- Modal com o formulário -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
    <div class="modal-content">
      <!-- Cabeçalho do modal -->
      <div class="modal-header">
        <h4 class="modal-title">Formulário de Cartórios</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Corpo do modal com o formulário -->
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="municipio">Município:</label>
            <input type="text" class="form-control" id="municipio">
          </div>
          <div class="form-group">
            <label for="codigo">Código (CNS):</label>
            <input type="text" class="form-control" id="codigo">
          </div>
          <div class="form-group">
            <label for="denominacao">Denominação da Serventia:</label>
            <input type="text" class="form-control" id="denominacao">
          </div>
          <div class="form-group">
            <label for="circunscritos">Municípios Circunscritos:</label>
            <input type="text" class="form-control" id="circunscritos">
          </div>
          <div class="form-group">
            <label for="responsavel">Responsável:</label>
            <input type="text" class="form-control" id="responsavel">
          </div>
          <div class="form-group">
            <label for="endereco">Endereço:</label>
            <input type="text" class="form-control" id="endereco">
          </div>
          <div class="form-group">
            <label for="telefone">Telefone:</label>
            <input type="text" class="form-control" id="telefone">
          </div>
          <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="email" class="form-control" id="email">
          </div>
          <div class="form-group">
            <label for="whatsapp">Whatsapp:</label>
            <input type="text" class="form-control" id="whatsapp">
          </div>
          <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
      </div>
    </div>
  </div>
</div>