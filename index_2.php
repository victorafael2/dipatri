<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Inclua o autoload do Composer
require_once 'vendor/autoload.php';

// Configure as credenciais do Google
$clientId = '937469059904-j4009pav3dl03q5cugi8f1sgm1h9m80q.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'https://dipatri.cloud/index.php';

// Crie uma instância do cliente Google_Client
$client = new Google_Client();
$client->setClientId($clientId);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope('email');
$client->addScope('profile');

// Verifique se a ação de logout foi solicitada
if (isset($_GET['logout'])) {
    // Revoke the token de acesso
    $client->revokeToken($_SESSION['access_token']);
    // Limpe a sessão
    session_destroy();
    // Redirecione para a página de login
    header('Location: index.php');
    exit();
}

// Verifique se o usuário já está autenticado
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
    // Configurar o token de acesso no cliente
    $client->setAccessToken($_SESSION['access_token']);

    // Verifique se o token de acesso expirou
    if ($client->isAccessTokenExpired()) {
        // Renove o token de acesso usando o token de atualização (refresh token)
        $refreshToken = $_SESSION['refresh_token'];
        $client->fetchAccessTokenWithRefreshToken($refreshToken);
        // Atualize o token de acesso na sessão
        $_SESSION['access_token'] = $client->getAccessToken();
    }

    // Crie um serviço Google API para obter informações do usuário
    $oauth = new \Google_Service_Oauth2($client);
    $userInfo = $oauth->userinfo->get();
    $userId = $userInfo->getId();
    $userName = $userInfo->getName();
    $userEmail = $userInfo->getEmail();

    // Exiba as informações do usuário
    echo 'Usuário autenticado:<br>';
    echo 'ID do usuário: ' . $userId . '<br>';
    echo 'Nome do usuário: ' . $userName . '<br>';
    echo 'Email do usuário: ' . $userEmail . '<br>';
    echo '<a href="?logout">Logout</a>';
} else {
    // O usuário não está autenticado
    $authUrl = $client->createAuthUrl();
    echo '<a href="' . $authUrl . '">Login com o Google deu erro camarada</a>';
}
