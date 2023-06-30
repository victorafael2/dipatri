<?php
$pagina = $_GET['pagina'];
$caminho = 'paginas/';
$link = $caminho . $pagina;
?>

<?php include 'header.php' ?>
<?php include 'nav.php' ?>
<?php include 'sidebar.php' ?>

<?php include $link ?>

<?php include 'footer.php' ?>
