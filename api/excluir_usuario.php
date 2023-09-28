<?php
// Incluir o arquivo de configuração
require_once("config.php");

// Verificar se o ID do usuário a ser excluído foi fornecido na URL
if (isset($_GET['id'])) {
    $idUsuario = $_GET['id'];

    // Verificar se o ID é um número inteiro válido
    if (filter_var($idUsuario, FILTER_VALIDATE_INT)) {
        // Consultar o banco de dados para verificar se o usuário existe
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $idUsuario, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // O usuário existe, então podemos prosseguir com a exclusão
            $sqlExcluir = "DELETE FROM usuarios WHERE id = :id";
            $stmtExcluir = $pdo->prepare($sqlExcluir);
            $stmtExcluir->bindParam(':id', $idUsuario, PDO::PARAM_INT);
            
            if ($stmtExcluir->execute()) {
                // Exclusão bem-sucedida, redirecionar de volta à página de gerenciamento de usuários
                header("Location: manage_users.php");
                exit();
            } else {
                // Erro ao excluir o usuário
                echo "Erro ao excluir o usuário.";
            }
        } else {
            echo "Tem certeza de que deseja excluir este usuário?";
            echo '<a href="excluir_usuario.php?id=' . $id . '&confirm=true">Sim</a> | <a href="manage_users.php">Não</a>';
        }
    } else {
        // ID do usuário não é um número válido
        echo "ID de usuário inválido.";
    }
} else {
    // ID do usuário não foi fornecido na URL
    echo "ID de usuário não especificado.";
}
?>
