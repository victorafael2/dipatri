<?php
// Configurações de conexão com o banco de dados
include 'database/databaseconnect.php';

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    die('Erro na conexão com o banco de dados: ' . $conn->connect_error);
}

// Verifica se a variável de sessão está configurada
if (isset($_SESSION['email'])) {
    // Obtém o email do usuário logado
    $email = $_SESSION['email'];

    // Consulta SQL para buscar o nome relacionado ao email
    $sql = "SELECT nome FROM usuarios WHERE email = '$email'";
    $resultado = $conn->query($sql);

    // Verifica se a consulta retornou algum resultado
    if ($resultado && $resultado->num_rows === 1) {
        $registro = $resultado->fetch_assoc();
        $nome = $registro['nome'];

        // Exibe o nome na página
        $logado = 'Logado como: ' . $nome;
    } else {
        $logado = 'Usuário não encontrado.';
    }
} else {
    $logado = 'Usuário não está logado.';
}


// Fecha a conexão com o banco de dados
// $conn->close();
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

              </div>
          </div>
          <div class="sb-sidenav-footer">
          <p ><small>
            <?php echo $logado ?>
            </small>
          </p>
            <?php if (isset($_SESSION['email'])) { ?>
    <div class="btn-group btn-group-sm">
        <a href="<?php echo $linkUrl; ?>" class="btn btn-outline-primary"><i class="fa-solid fa-arrow-right-from-bracket"></i> <?php echo $linkText; ?></a>
    </div>
<?php } else { ?>
    <div class="btn-group btn-group-sm">
        <a href="<?php echo $linkUrl; ?>" class="btn btn-outline-success "><i class="fa-solid fa-user-plus"></i> <?php echo $linkText; ?></a>
        <a href="login.php" class="btn btn-success"><i class="fa-solid fa-arrow-right-to-bracket"></i> Login</a>
    </div>
<?php } ?>

</div>

      </nav>
  </div>