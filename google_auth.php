<?php
require_once 'vendor/autoload.php'; // Caminho para o arquivo de autoload gerado pelo Composer

// Configurações da autenticação
$client = new Google_Client();
$client->setClientId('937469059904-j4009pav3dl03q5cugi8f1sgm1h9m80q.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('https://dipatri.cloud/redirect');
$client->addScope('email'); // Escopo de acesso, você pode adicionar mais escopos conforme necessário

// Verifica se já há um token de acesso válido
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
    $client->setAccessToken($_SESSION['access_token']);
} else {
    // Não há token, então redireciona para a tela de autenticação do Google
    $authUrl = $client->createAuthUrl();
    header('Location: ' . $authUrl);
    exit();
}

// Verifica se o código de autorização foi retornado
if (isset($_GET['code'])) {
    // Troca o código de autorização por um token de acesso
    $accessToken = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($accessToken);

    // Salva o token de acesso na sessão para uso posterior
    $_SESSION['access_token'] = $accessToken;

    // Redireciona para a página principal da sua aplicação
    header('Location: index.php');
    exit();
}
