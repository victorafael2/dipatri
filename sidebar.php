  <?php
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
    header('Location: index_2.php');
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
    $userEmail = $userInfo->getEmail();

    // Exiba as informações do usuário
    echo 'Usuário autenticado:';
    echo 'ID do usuário: ' . $userId . '<br>';
    echo 'Email do usuário: ' . $userEmail . '<br>';
    echo '<a href="?logout">Logout</a>';
} else {
    // O usuário não está autenticado, exiba o link de login do Google
    $authUrl = $client->createAuthUrl();
    echo '<a href="' . $authUrl . '">Login com o Google</a>';
}



  ?>



  <div id="layoutSidenav_nav">
      <nav class="sb-sidenav accordion sb-sidenav-light " id="sidenavAccordion">
          <div class="sb-sidenav-menu">
              <div class="nav">
                  <!-- <div class="sb-sidenav-menu-heading">Core</div> -->
                  <a class="nav-link" href="matriculas.php">
                      <div class="sb-nav-link-icon"><i class="fa-regular fa-rectangle-list"></i></i></div>
                      Matrículas
                  </a>

                  <!-- <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                      data-bs-parent="#sidenavAccordion">
                      <nav class="sb-sidenav-menu-nested nav">
                          <a class="nav-link" href="layout-static.html">Static Navigation</a>
                          <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                      </nav>
                  </div> -->
                  <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages"
                      aria-expanded="false" aria-controls="collapsePages">
                      <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                      Painéis BI
                      <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                  </a>
                  <div class="collapse" id="collapsePages" aria-labelledby="headingOne"
                      data-bs-parent="#sidenavAccordion">
                      <nav class="sb-sidenav-menu-nested nav">
                          <a class="nav-link" href="pages.php?pagina=projeto_bm.php">Pilares I e II</a>
                          <a class="nav-link" href="pages.php?pagina=projeto_pilares.php">Pilares II</a>
                          <a class="nav-link" href="pages.php?pagina=projeto_dpct.php">DPCT</a>
                      </nav>
                  </div>
                  <!-- <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                      data-bs-parent="#sidenavAccordion">
                      <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                          <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                              data-bs-target="#pagesCollapseAuth" aria-expanded="false"
                              aria-controls="pagesCollapseAuth">
                              Authentication
                              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                          </a>
                          <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne"
                              data-bs-parent="#sidenavAccordionPages">
                              <nav class="sb-sidenav-menu-nested nav">
                                  <a class="nav-link" href="login.html">Login</a>
                                  <a class="nav-link" href="register.html">Register</a>
                                  <a class="nav-link" href="password.html">Forgot Password</a>
                              </nav>
                          </div>
                          <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                              data-bs-target="#pagesCollapseError" aria-expanded="false"
                              aria-controls="pagesCollapseError">
                              Error
                              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                          </a>
                          <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne"
                              data-bs-parent="#sidenavAccordionPages">
                              <nav class="sb-sidenav-menu-nested nav">
                                  <a class="nav-link" href="401.html">401 Page</a>
                                  <a class="nav-link" href="404.html">404 Page</a>
                                  <a class="nav-link" href="500.html">500 Page</a>
                              </nav>
                          </div>
                      </nav>
                  </div> -->
                  <!-- <div class="sb-sidenav-menu-heading">Addons</div>
                  <a class="nav-link" href="charts.html">
                      <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                      Charts
                  </a>
                  <a class="nav-link" href="tables.html">
                      <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                      Tables
                  </a> -->
              </div>
          </div>
          <div class="sb-sidenav-footer">
              <!-- <div class="small"><a href="index_2.php">Logar</a></div> -->

              <div class="small"><a href="index_2.php"><?php $userEmail ?></a></div>





          </div>
      </nav>
  </div>