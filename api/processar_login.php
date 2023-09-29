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
        $userId = $row['id'];

        // Gerar um identificador único (por exemplo, um UUID)
        $identifier = uniqid();

        // Armazenar o identificador no banco de dados junto com o ID do usuário
        $sql = "UPDATE usuarios SET identifier = :identifier WHERE id = :userId";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':identifier', $identifier);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();

        // Definir um cookie com o identificador
        setcookie('user_identifier', $identifier, time() + 3600, '/'); // O cookie expira em 1 hora

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
