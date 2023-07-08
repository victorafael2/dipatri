<?php
// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os dados do formulário
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validação dos dados (pode adicionar outras validações conforme necessário)
    if (empty($name) || empty($email) || empty($password)) {
        echo 'Por favor, preencha todos os campos.';
        exit();
    }

    // Criptografa a senha utilizando md5 (não é recomendado, apenas para fins de exemplo)
    $hashedPassword = md5($password);

    // TODO: Adicione a lógica de processamento do cadastro aqui
    // Por exemplo, você pode inserir os dados em um banco de dados MySQL

  include 'databaseconnect.php';

    // Verifica a conexão
    if (!$conn) {
        die('Erro ao conectar ao banco de dados: ' . mysqli_connect_error());
    }

    // Prepara a consulta SQL para inserir os dados
    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$name', '$email', '$hashedPassword')";

    if (mysqli_query($conn, $sql)) {
        // Cadastro realizado com sucesso
        header('Location: ../index.php');
        exit();
    } else {
        // Erro ao inserir no banco de dados
        echo 'Erro ao cadastrar: ' . mysqli_error($conn);
    }

    // Fecha a conexão com o banco de dados
    mysqli_close($conn);
}
?>
