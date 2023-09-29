<?php
require_once("config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT id, nome, senha FROM usuarios WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row && password_verify($senha, $row['senha'])) {
        // Login bem-sucedido
        session_start();
        $_SESSION['usuario_id'] = $row['id'];
        $_SESSION['usuario_nome'] = $row['nome'];

        // Adicione este código JavaScript para definir o nome de usuário no Local Storage
        echo '<script>';
        echo 'var nomeUsuario = "' . $row['nome'] . '";';
        echo 'localStorage.setItem("nomeUsuario", nomeUsuario);';
        echo '</script>';

        header("Location: home.php");
        exit();
    } else {
        // Login falhou
        echo '<script>alert("Email ou senha incorretos.");</script>';
        echo '<script>window.location.href="../login.html";</script>';
        exit();
    }
}
?>
