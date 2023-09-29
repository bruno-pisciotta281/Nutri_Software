<?php
// Iniciar a sessão
session_start();

// Incluir o arquivo de configuração
require_once("config.php");

// Verificar se o formulário de atualização foi enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obter os dados do formulário
    $userId = $_POST['userId'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    // Atualizar os detalhes do usuário no banco de dados
    $sql = "UPDATE usuarios SET nome = :nome, email = :email, role = :role WHERE id = :userId";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':userId', $userId);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':role', $role);

    if ($stmt->execute()) {
        // Atualização bem-sucedida, redirecione de volta à página de gerenciamento de usuários
        header("Location: manage_users.php");
        exit(); // Certifique-se de sair para evitar execução adicional
    } else {
        echo "Erro ao atualizar o usuário.";
    }
}
?>
