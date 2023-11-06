<?php
// Faz a conexão com o banco de dados


// Verifica se a conexão foi bem sucedida
if (!$conn) {
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}

// Cria a query
$query = "SELECT * FROM paineis where id = 7";

// Executa a query
$result = mysqli_query($conn, $query);

// Verifica se a query foi executada com sucesso
if ($result) {
    // Processa os resultados
    while ($row = mysqli_fetch_assoc($result)) {
        // Acessa os valores das colunas
        $nome = $row['nome'];
        $link = $row['link'];
        $descricao = $row['descricao'];

        // Faça o que precisa ser feito com os valores das colunas
        // ...
    }

    // Libera a memória ocupada pelos resultados
    mysqli_free_result($result);
} else {
    // Trata o erro, se a query não for executada corretamente
    echo "Erro na execução da query: " . mysqli_error($conn);
}

// Fecha a conexão com o banco de dados

?>


<style>
    .full-iframe {
        width: 100%;
        height: 100vh; /* 100% da altura da janela visível */
        border: none; /* Remove a borda padrão do iframe */
    }
</style>


<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"><?php echo $nome ?></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active"><?php echo $descricao ?></li>
                        </ol>
                        <div class="row">

                        </div>
                        <div class="row">

                        </div>
                        <div class="card mb-4">
                            <div class="card-header">

                            <?php echo $nome ?>
                            </div>
                            <div class="card-body">

                            <!-- <iframe title="<?php echo $nome ?>" width="100%" height="200" src="<?php echo $link ?>&filterPaneEnabled=false&navContentPaneEnabled=false" frameborder="0" allowFullScreen="false"></iframe> -->

                            <iframe src="http://localhost/dipatri/kml/mapa_gerais/index.html" frameborder="0" class="full-iframe"></iframe>

                            </div>
                        </div>
                    </div>
                </main>

