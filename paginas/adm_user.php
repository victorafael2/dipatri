<?php
// Faz a conexão com o banco de dados


// Verifica se a conexão foi bem sucedida
if (!$conn) {
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}

// Cria a query
$query = "SELECT * FROM adm where id = 1";

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

<?php
// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os valores do formulário
    $senhaAtual = $_POST['senhaAtual'];
    $novaSenha = $_POST['novaSenha'];
    $confirmarSenha = $_POST['confirmarSenha'];

    // Validação
    if ($senhaAtual === '') {
        $erro = 'Digite a senha atual.';
    } elseif ($novaSenha === '') {
        $erro = 'Digite a nova senha.';
    } elseif ($novaSenha !== $confirmarSenha) {
        $erro = 'A nova senha e a confirmação de senha não correspondem.';
    } else {
        // Configurações de conexão com o banco de dados


        // Verifica se houve erro na conexão
        if ($conexao->connect_error) {
            die('Erro na conexão com o banco de dados: ' . $conexao->connect_error);
        }

        // Consulta SQL para obter a senha atual do usuário
        $email = $_SESSION['email'];
        $sql = "SELECT senha FROM usuarios WHERE email = '$email'";
        $resultado = $conexao->query($sql);

        // Verifica se a consulta retornou algum resultado
        if ($resultado->num_rows === 1) {
            $registro = $resultado->fetch_assoc();
            $senhaArmazenada = $registro['senha'];

            // Verifica se a senha atual fornecida corresponde à senha armazenada no banco de dados
            if (md5($senhaAtual) === $senhaArmazenada) {
                // Atualize a senha no banco de dados
                $novaSenhaCriptografada = md5($novaSenha);
                $sqlAtualizacao = "UPDATE usuarios SET senha = '$novaSenhaCriptografada' WHERE email = '$email'";
                $conexao->query($sqlAtualizacao);

                // Exiba uma mensagem de sucesso ou redirecione para a página desejada
                $mensagem = 'Senha atualizada com sucesso!';
            } else {
                $erro = 'A senha atual está incorreta.';
            }
        } else {
            $erro = 'Usuário não encontrado.';
        }

        // Fecha a conexão com o banco de dados
        $conexao->close();
    }
}
?>






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
                    <form action="pages.php?pagina=adm_user.php" >
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome:</label>
                            <input type="text" id="nome" class="form-control" value="Nome do Usuário" >
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="text" id="email" class="form-control" value="<?php echo $email ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#trocarSenhaModal">Trocar Senha</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </main>










    <!-- Modal de Trocar Senha -->
    <div class="modal fade" id="trocarSenhaModal" tabindex="-1" aria-labelledby="trocarSenhaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="trocarSenhaModalLabel">Trocar Senha</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="senhaAtual" class="form-label">Senha Atual:</label>
                            <input type="password" id="senhaAtual" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="novaSenha" class="form-label">Nova Senha:</label>
                            <input type="password" id="novaSenha" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirmarSenha" class="form-label">Confirmar Nova Senha:</label>
                            <input type="password" id="confirmarSenha" class="form-control" required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/js/bootstrap.bundle.min.js"></script>





