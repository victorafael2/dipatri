<?php
// Inicia a sessão
session_start();

include 'database/databaseconnect.php';

// Verifica se a variável de sessão está definida (supondo que você defina uma variável chamada $_SESSION['logged_in'] ao fazer o login)
if (isset($_SESSION['email'])) {
    $linkText = 'Logout';
    $linkUrl = 'database/logout.php'; // Insira o URL do script de logout aqui
} else {
    $linkText = 'Cadastrar';
    $linkUrl = 'cadastro.php'; // Insira o URL da página de cadastro aqui
}

if (isset($_SESSION['email'])) {
    // Obtém o email da sessão
    $email = $_SESSION['email'];

    // Faça o que precisar com o email...
} else {
    // O email não está armazenado na sessão, pode ser necessário redirecionar para a página de login
    $email = 'Convidado';
}
?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="VictorRafaeL" content="" />
    <link rel="apple-touch-icon" sizes="180x180" href="https://s2-g1.glbimg.com/MApfQR_5mIrwW6QgZvSS0L9Rwtk=/1200x/smart/filters:cover():strip_icc()/i.s3.glbimg.com/v1/AUTH_59edd422c0c84a879bd37670ae4f538a/internal_photos/bs/2023/Y/j/SPWn0AR4qG91WIj3Bp6g/marca-pi.jpg">
    <link rel="icon" type="image/png" sizes="32x32" href="https://s2-g1.glbimg.com/MApfQR_5mIrwW6QgZvSS0L9Rwtk=/1200x/smart/filters:cover():strip_icc()/i.s3.glbimg.com/v1/AUTH_59edd422c0c84a879bd37670ae4f538a/internal_photos/bs/2023/Y/j/SPWn0AR4qG91WIj3Bp6g/marca-pi.jpg">
    <link rel="icon" type="image/png" sizes="16x16" href="https://s2-g1.glbimg.com/MApfQR_5mIrwW6QgZvSS0L9Rwtk=/1200x/smart/filters:cover():strip_icc()/i.s3.glbimg.com/v1/AUTH_59edd422c0c84a879bd37670ae4f538a/internal_photos/bs/2023/Y/j/SPWn0AR4qG91WIj3Bp6g/marca-pi.jpg">
    <link rel="shortcut icon" type="image/x-icon" href="https://s2-g1.glbimg.com/MApfQR_5mIrwW6QgZvSS0L9Rwtk=/1200x/smart/filters:cover():strip_icc()/i.s3.glbimg.com/v1/AUTH_59edd422c0c84a879bd37670ae4f538a/internal_photos/bs/2023/Y/j/SPWn0AR4qG91WIj3Bp6g/marca-pi.jpg">
    <title>Dashboard - Dipatri</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" /> -->
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">