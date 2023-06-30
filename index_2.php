<?php
require_once 'google_auth.php';

$service = new Google_Service_Oauth2($client);
$user = $service->userinfo->get();

echo 'Bem-vindo, ' . $user->name . '! Seu email é ' . $user->email;
