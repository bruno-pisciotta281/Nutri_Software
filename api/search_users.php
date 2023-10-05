<?php
// Incluir o arquivo de configuração
require_once("config.php");

// Função para listar os usuários com base em um filtro de nome
function listarUsuarios($filterName = "") {
    global $pdo;

    $sql = "SELECT id, nome, email, role FROM usuarios";

    // Se um filtro de nome foi especificado, adicione uma cláusula WHERE à consulta
    if (!empty($filterName)) {
        $sql .= " WHERE nome LIKE :filterName";
    }

    $stmt = $pdo->prepare($sql);

    // Se um filtro de nome foi especificado, vincule o parâmetro
    if (!empty($filterName)) {
        $filterNameParam = "%$filterName%";
        $stmt->bindParam(':filterName', $filterNameParam, PDO::PARAM_STR);
    }

    $stmt->execute();

    if ($stmt) {
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($result) > 0) {
            echo '<table class="table">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>ID</th>';
            echo '<th>Nome</th>';
            echo '<th>Email</th>';
            echo '<th>Role</th>';
            echo '<th>Ações</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            foreach ($result as $row) {
                echo '<tr>';
                echo '<td data-label="ID">' . $row['id'] . '</td>';
                echo '<td data-label="Nome">' . $row['nome'] . '</td>';
                echo '<td data-label="Email">' . $row['email'] . '</td>';
                echo '<td data-label="Role">' . $row['role'] . '</td>';
                echo '<td>';
                echo '<a href="editar_usuario.php?id=' . $row['id'] . '" class="btn btn-primary">Editar</a>';
                echo '<button onclick="confirmDelete(' . $row['id'] . ')" class="btn btn-danger">Excluir</button>';
                echo '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        } else {
            echo "Nenhum usuário encontrado.";
        }
    } else {
        echo "Erro na consulta: " . $pdo->errorInfo()[2];
    }

    // Liberar o cursor associado ao PDOStatement
    $stmt->closeCursor();
}

// Obtenha o valor do filtro de nome
if (isset($_POST['filterName'])) {
    $filterName = $_POST['filterName'];
    listarUsuarios($filterName);
}
?>
