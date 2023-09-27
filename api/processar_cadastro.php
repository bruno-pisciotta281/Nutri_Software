<?php

require_once("config.php");

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password;sslmode=require");
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}

// Coletar dados do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Hash da senha

// Inserir dados na tabela 'usuarios'
$sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
$stmt = $pdo->prepare($sql);

$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':senha', $senha);

if ($stmt->execute()) {
    echo "Usuário cadastrado com sucesso!";
    // Redirecionar para a página de login
    header("Location: login.html");
} else {
    echo "Erro ao cadastrar o usuário.";
}
?>
