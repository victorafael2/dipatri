<?php
session_start(); // Inicia a sessão

include 'database/databaseconnect.php';

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    die('Erro na conexão com o banco de dados: ' . $conn->connect_error);
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os valores do formulário
    $email = $_POST['username'];
    $senha_login = md5($_POST['senha_login']); // Codifica a senha usando MD5

    // Consulta SQL para verificar as credenciais no banco de dados
    $sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha_login'";
    $resultado = $conn->query($sql);

    // Verifica se a consulta retornou algum resultado
    if ($resultado->num_rows === 1) {
        // Atribui o email à variável de sessão
        $_SESSION['email'] = $email;

        // Login bem-sucedido, redireciona para a página de sucesso
        header('Location: index.php');
        exit();
    } else {
        // Credenciais inválidas, exibe uma mensagem de erro
        $erro = 'Credenciais inválidas. Tente novamente.';
        echo $sql;
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
}
?>







<!DOCTYPE html>
<html>

<head>
    <link rel="apple-touch-icon" sizes="180x180"
        href="https://s2-g1.glbimg.com/MApfQR_5mIrwW6QgZvSS0L9Rwtk=/1200x/smart/filters:cover():strip_icc()/i.s3.glbimg.com/v1/AUTH_59edd422c0c84a879bd37670ae4f538a/internal_photos/bs/2023/Y/j/SPWn0AR4qG91WIj3Bp6g/marca-pi.jpg">
    <link rel="icon" type="image/png" sizes="32x32"
        href="https://s2-g1.glbimg.com/MApfQR_5mIrwW6QgZvSS0L9Rwtk=/1200x/smart/filters:cover():strip_icc()/i.s3.glbimg.com/v1/AUTH_59edd422c0c84a879bd37670ae4f538a/internal_photos/bs/2023/Y/j/SPWn0AR4qG91WIj3Bp6g/marca-pi.jpg">
    <link rel="icon" type="image/png" sizes="16x16"
        href="https://s2-g1.glbimg.com/MApfQR_5mIrwW6QgZvSS0L9Rwtk=/1200x/smart/filters:cover():strip_icc()/i.s3.glbimg.com/v1/AUTH_59edd422c0c84a879bd37670ae4f538a/internal_photos/bs/2023/Y/j/SPWn0AR4qG91WIj3Bp6g/marca-pi.jpg">
    <link rel="shortcut icon" type="image/x-icon"
        href="https://s2-g1.glbimg.com/MApfQR_5mIrwW6QgZvSS0L9Rwtk=/1200x/smart/filters:cover():strip_icc()/i.s3.glbimg.com/v1/AUTH_59edd422c0c84a879bd37670ae4f538a/internal_photos/bs/2023/Y/j/SPWn0AR4qG91WIj3Bp6g/marca-pi.jpg">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
    .login-page {
        position: relative;
        height: 100vh;
        background-repeat: no-repeat;
        /* Evita que a imagem de fundo se repita */
        background-size: cover;
        /* Redimensiona a imagem de fundo para cobrir toda a área */
    }

    .login-form {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    </style>
</head>

<body>
    <div class="login-page">
        <div class="container-fluid h-100">
            <div class="row h-100">
                <div class="col-md-6 offset-md-3">
                    <div class="login-form">
                        <h2 class="text-center">Login Dipatri</h2>
                        <?php if (isset($erro)): ?>
                        <div class="alert alert-danger"><?php echo $erro; ?></div>
                        <?php endif; ?>

                        <form action="login.php" method="POST">

                            <div class="form-group">
                                <label for="username">Email:</label>
                                <input type="email" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="senha_login">Senha:</label>
                                <input type="password" class="form-control" id="senha_login" name="senha_login" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Acessar</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    // Array com as URLs das imagens de fundo
    var backgroundImages = [
        "https://www.segueviagem.com.br/wp-content/uploads/2020/12/Ponte-Estaiada-Teresina-Piau%C3%AD-Assessoria-de-imprensa.jpeg",
        "https://st4.depositphotos.com/12417518/22770/i/600/depositphotos_227701132-stock-photo-piaui-state-of-brazil-flag.jpg",
        "https://www.campomaioremfoco.com.br/images/colunas2/6283/castelo_do_piaui.jpg",
        "https://deltarioparnaiba.com.br/wp-content/uploads/2021/07/serra-da-capivara.jpg",
        "https://deltarioparnaiba.com.br/wp-content/uploads/2016/08/6505bddcf5_media.jpg",
        "https://www.maladeaventuras.com/wp-content/uploads/2021/03/pedra-sal-piaui%CC%81.jpg",
        "https://barragrandepiaui.com.br/wp-content/uploads/2015/09/Barra-Grande.jpg",
        "https://turismo.pi.gov.br/wp-content/uploads/2020/02/rota-das-emoc%CC%A7o%CC%83es-730x424.jpg"

        // Adicione mais imagens aqui
    ];

    // Função para alterar aleatoriamente a imagem de fundo
    function changeBackground() {
        var randomNumber = Math.floor(Math.random() * backgroundImages.length);
        var imageUrl = backgroundImages[randomNumber];
        document.querySelector('.login-page').style.backgroundImage = "url('" + imageUrl + "')";
    }

    // Altera a imagem de fundo inicialmente e em intervalos de 5 segundos
    changeBackground();
    setInterval(changeBackground, 5000);
    </script>
</body>

</html>