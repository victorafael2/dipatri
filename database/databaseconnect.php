<?php
    // Seleciona as configurações do banco de dados com base no ambiente

    if ($_SERVER['SERVER_NAME'] === 'localhost') {
        $servidor = "45.152.44.103";
        $usuario = "u358437276_victor";
        $senha = "Vr88094852";
        $dbname = "u358437276_dipatri_produc";
} else {

    // $servidor = "45.152.44.103";
    // $usuario = "u358437276_angelo";
    // $senha = "Angelo01";
    // $dbname = "u358437276_angelo";
    $servidor = "45.152.44.103";
        $usuario = "u358437276_victor";
        $senha = "Vr88094852";
        $dbname = "u358437276_dipatri_produc";

}



//Criar a conexao
// Define o fuso horário após a conexão

$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
mysqli_set_charset($conn,"utf8");
date_default_timezone_set('America/Fortaleza');
if(!$conn){
    die("Falha na conexao: " . mysqli_connect_error());
}else{
    //echo "Conexao realizada com sucesso";
    mysqli_query($conn, "SET time_zone = '+03:00'");
}  ;







?>