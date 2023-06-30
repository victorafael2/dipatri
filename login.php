<?php
session_start();
require_once 'google-api-php-client-main/';

// Verifica se o usuário já está logado, redireciona para a página protegida
if (isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit();
}

// Verifica se o formulário de login foi enviado
if (isset($_POST['login'])) {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Conexão com o banco de dados
    $conexao = new mysqli('localhost', 'usuario', 'senha', 'nome_do_banco');

    // Verifica se a conexão foi estabelecida com sucesso
    if ($conexao->connect_error) {
        die('Erro na conexão com o banco de dados: ' . $conexao->connect_error);
    }

    // Consulta para verificar as credenciais
    $query = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND senha = '$senha'";
    $result = $conexao->query($query);

    // Verifica se a consulta retornou algum resultado
    if ($result->num_rows == 1) {
        // Credenciais válidas, define a variável de sessão para o usuário logado
        $_SESSION['usuario'] = $usuario;

        // Redireciona para a página inicial após o login
        header('Location: index.php');
        exit();
    } else {
        // Exibe uma mensagem de erro para o usuário
        $mensagemErro = "Nome de usuário ou senha inválidos.";
    }

    // Fecha a conexão com o banco de dados
    $conexao->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dipatri</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
    body {
        margin: 0;
        padding: 0;
        overflow: hidden;
    }


    #background {
  position: relative;
  background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
}

.fade-background {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: black;
  opacity: 0.5;
}

    </style>
</head>

<body>
    <div id="background">
    <div class="fade-background"></div>

        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container" style="opacity: 1;">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5" >
                                    <div class="card-header">
                                        <h3 class="text-center font-weight-light my-4">Login</h3>
                                    </div>
                                    <div class="card-body">
                                        <form>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" type="email"
                                                    placeholder="name@example.com" />
                                                <label for="inputEmail">Email</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" type="password"
                                                    placeholder="Senha" />
                                                <label for="inputPassword">Senha</label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" id="inputRememberPassword"
                                                    type="checkbox" value="" />
                                                <label class="form-check-label" for="inputRememberPassword">Lembrar
                                                    senha</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="password.html">Esqueci a Senha?</a>
                                                <a class="btn btn-primary" href="index.html">Login</a>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="register.html">Fazer cadastro</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script src="js/backgroud.js"></script>
</body>

</html>