<?php
// Conexão com o banco de dados


// Verificação de erros na conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Consulta ao banco de dados
$sql = "SELECT * FROM paineis";
$result = $conn->query($sql);
?>

<style>
.card {
  background-image: url('caminho/para/sua/imagem.jpg');
  background-size: cover;
  /* Outros estilos para o card */
  width: 300px;
  height: 200px;
}


</style>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Pagina Inicial</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Inicio</li>
            </ol>
            <div class="row border-bottom">
                <h4>Últimos Painéis</h4>
                <?php
                    // Iterar sobre os resultados da consulta e criar os cards
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $image = $row["imagem"]; // Coluna com o caminho da imagem no banco de dados
                            $title = $row["nome"]; // Coluna com o título no banco de dados
                            $link = $row["nome_arquivo"]; // Coluna com o título no banco de dados
                            $description = $row["descricao"]; // Coluna com a descrição no banco de dados
                            // $items = $row["items"]; // Coluna com os itens no banco de dados (separados por vírgula, por exemplo)
                            // $items_array = explode(',', $items); // Converte a string de itens em um array

                            // Início do card
                            echo '<div class="col-md-3">';
                            echo '<a class="nav-link" href="pages.php?pagina=' . $link . '">';
                            echo '<div class="card w-100 mb-2" style="background-image: url(' . $image . ');">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">' . $title . '</h5>';
                            echo '<p class="card-text">' . $description . '</p>';

                            // Iterar sobre os itens e exibi-los dentro do card


                            // Fim do card
                            echo '</div>';
                            echo '</div>';
                            echo '</a>';
                            echo '</div>';
                        }
                    } else {
                        echo "Nenhum resultado encontrado.";
                    }
                    $conn->close(); // Fechar conexão com o banco de dados
                    ?>
            </div>
            <div class="row border-bottom">

            teste
            </div>
        </div>
    </main>
