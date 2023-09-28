<?php
require_once("config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verifique se o email já está em uso
    $sql_check_email = "SELECT id FROM usuarios WHERE email = :email";
    $stmt_check_email = $pdo->prepare($sql_check_email);
    $stmt_check_email->bindParam(':email', $email);
    $stmt_check_email->execute();

    if ($stmt_check_email->rowCount() > 0) {
        // O email já está em uso
        header("Location: ../cadastro.html?erro=email"); // Redireciona com parâmetro de erro
        exit();
    }

    // Hash da senha
    $hashed_senha = password_hash($senha, PASSWORD_DEFAULT);

    // Inserir dados na tabela 'usuarios'
    $sql_insert = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
    $stmt_insert = $pdo->prepare($sql_insert);

    $stmt_insert->bindParam(':nome', $nome);
    $stmt_insert->bindParam(':email', $email);
    $stmt_insert->bindParam(':senha', $hashed_senha);

    if ($stmt_insert->execute()) {
        // Cadastro bem-sucedido
        session_start();
        $_SESSION['usuario_id'] = $pdo->lastInsertId(); // Obter o ID do novo usuário
        $_SESSION['usuario_nome'] = $nome;
        header("Location: ../login.html"); // Redireciona para a página de login após o cadastro
        exit();
    } else {
        // Cadastro falhou
        header("Location: ../cadastro.html?erro=1"); // Redireciona com parâmetro de erro
        exit();
    }
}
?>
