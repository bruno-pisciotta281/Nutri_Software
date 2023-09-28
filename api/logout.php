<?php
// Iniciar a sessão
session_start();

// Encerrar a sessão
session_destroy();

// Redirecionar para a página de login (ou outra página)
header("Location: ../login.html"); // Substitua "login.php" pela página desejada
exit();
?>
