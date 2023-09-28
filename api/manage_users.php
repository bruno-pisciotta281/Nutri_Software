<?php
// Iniciar a sessão
session_start();

// Incluir o arquivo de configuração
require_once("config.php");

// Função para listar os usuários
function listarUsuarios() {
    global $pdo; // Alterado de $conn para $pdo (assumindo que seja o objeto PDO)

    $sql = "SELECT id, nome, email FROM usuarios";
    $stmt = $pdo->query($sql);

    if ($stmt) {
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($result) > 0) {
            echo '<table class="table">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>ID</th>';
            echo '<th>Nome</th>';
            echo '<th>Email</th>';
            echo '<th>Ações</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            foreach ($result as $row) {
                echo '<tr>';
                echo '<td data-label="ID">' . $row['id'] . '</td>';
                echo '<td data-label="Nome">' . $row['nome'] . '</td>';
                echo '<td data-label="Email">' . $row['email'] . '</td>';
                echo '<td>';
                echo '<a href="editar_usuario.php?id=' . $row['id'] . '" class="btn btn-primary">Editar</a>';
                echo '<a href="excluir_usuario.php?id=' . $row['id'] . '" class="btn btn-danger">Excluir</a>';
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
}

?>

<!DOCTYPE html>
<html>
<head>
    <!-- Inclua o jQuery para os alertas -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <title>Gerenciamento de Usuários</title>
</head>
<style>
    /* Estilos globais */
  body {
    font-family: 'Montserrat', sans-serif !important;
    background-color: #f4f4f4;
    color: #333;
    display: flex;
    max-height: 100vh;
    margin: 0;
    flex-direction: column;
  }

  .container {
    margin: auto;
    background-color: #fff;
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    max-width: 800px;
    margin-top: 1rem;
  }

   /* Botões dispostos lado a lado */
   .btn-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between; /* Espaço igual entre os botões */
    margin-top: 2rem;
  }

  .btn {
    flex-basis: calc(50% - 1rem); /* Largura de 50% com margem de 1rem entre os botões */
    background-color: #4CAF50;
    border: none;
    margin-left: 1rem;
    margin-bottom: 1rem; /* Espaço inferior entre os botões */
    justify-content: space-between;
    padding: 5px 10px;
    color: #f4f4f4;
  }

  /* Estilo condicional para o último botão 
  .btn:last-child {
    flex-basis: 100%; 
  }
*/
  .btn:hover {
    background-color: #45a049;
    color: #f4f4f4;
  }

  @media (max-width: 768px) {
    .container {
      width: 90%;
      padding: 0.8rem;
    }
  }

  h1, h2 {
    color: #444;
    margin: 0.5em 0;
    font-size: 1.5em;
  }

  p {
    font-size: 1.2em;
  }

  /* Estilização da navbar lateral */
  .sidebar {
    background-color: #333;
    width: 0; 
    padding-top: 20px;
    position: fixed; 
    height: 100%; 
    transition: 0.5s; 
    z-index: 1; 
    overflow-x: hidden; 
  }

  .sidebar a {
    padding: 15px;
    text-align: center;
    text-decoration: none;
    font-size: 18px;
    color: white;
    display: block;
  }

  .sidebar a:hover {
    background-color: #555;
  }

  /* Botão de toggle para abrir a barra lateral */
  .toggle-btn {
    position: absolute;
    top: 10px;
    left: 10px; 
    font-size: 30px;
    color: #555;
    cursor: pointer;
  }

  @media (max-width: 768px) {
    .toggle-btn {
      left: 25px;
      top: 18px; 
    }
  }

  .soon {
    color: #ffff;
    text-align: center;
  }

  .soon1 {
    background-color: #ffff;
    color: #ffff;
    text-align: center;
  }

  .soon2{
    background-color: #333;
  }

  .tnav {
    color: #ffff;
    text-align: center;
  }

  .footer{
    font-size: 15px;
  }

  .user-info {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px;
    background-color: #333;
}

.user-info p {
    color: white;
    margin: 0;
    font-size: 18px;
}

.user-info .toggle-btn {
    font-size: 30px;
    color: #555;
    cursor: pointer;
}

.logout-button {
  float: right;

}

/* Estilos para tornar a tabela responsiva */
@media (max-width: 768px) {
  table {
    width: 100%;
  }

  table thead {
    display: none; /* Ocultar o cabeçalho da tabela em telas menores */
  }

  table tbody td {
    display: block; /* Colocar cada célula em uma linha separada */
    text-align: left;
  }

  table tbody tr {
    margin-bottom: 10px; /* Espaço entre as linhas */
    border: 1px solid #ddd;
    padding: 8px;
  }

  /* Estilos adicionais para melhorar a legibilidade em telas menores */
  table tbody td:before {
    content: attr(data-label); /* Adicionar rótulos às células */
    font-weight: bold;
    display: inline-block;
    width: 100%;
  }
}


a{
    color: #f4f4f4;
}

  </style>
<body>
  <div class="container">
    <h1>Gerenciamento de Usuários</h1>
    
    <!-- Botão para adicionar usuário -->
    <a href="home.php"><button class="btn">Voltar</button></a>
    <a href="../cadastro.html" class="btn btn-success">Adicionar Usuário</a>

    <!-- Listagem de usuários -->
    <?php listarUsuarios(); ?>
  </div>
  <br>
  <script>
    function confirmDelete(userId) {
        if (confirm("Tem certeza de que deseja excluir este usuário?")) {
            window.location.href = 'excluir_usuario.php?id=' + userId;
        }
    }
  </script>
</body>
</html>
