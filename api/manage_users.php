<?php
// Iniciar a sessão
session_start();

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
        $filterName = "%$filterName%";
        $stmt->bindParam(':filterName', $filterName, PDO::PARAM_STR);
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
}

?>

<!DOCTYPE html>
<html>
<head>
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


.btn-back{
  font-size: 13px;
  height: 25px;
  width: 55px;

  text-align: center; /* Centraliza o texto horizontalmente */
  display: flex;
  align-items: center; /* Centraliza verticalmente */
  justify-content: center; /* Centraliza verticalmente */
  background-color: #4CAF50;
  padding: 10px 15px;
  color: #f4f4f4;
  border: none;
  border-radius: 3px;
}

  </style>
<body>
<div class="container">
<center><a href="home.php"><button class="btn-back"><strong>Voltar</strong></button></a></center>
<hr class="soon2">
    <h1>Gerenciamento de Usuários</h1>
    <p style="font-size: 15px;">Esta é a página de gerenciamento de usuários, aqui você pode excluir, adicionar ou editar os usuários já existentes no Software.</p>
    <hr class="soon2">
    <!-- Campo de pesquisa por nome -->
    <div class="form-group">
        <input type="text" class="form-control" id="searchName" placeholder="Pesquisar usuários por nome">
    </div>

    <!-- Botão para adicionar usuário -->
    <a href="../cadastro.html" class="btn btn-success">Adicionar Usuário</a>

    <!-- Listagem de usuários -->
    <div id="userList">
        <?php listarUsuarios(); ?>
    </div>
</div>
<br>
<script>
    function confirmDelete(userId) {
        if (confirm("Tem certeza de que deseja excluir este usuário?")) {
            window.location.href = 'excluir_usuario.php?id=' + userId;
        }
    }

    // Lidar com a pesquisa à medida que as letras são digitadas
    $(document).ready(function () {
        $("#searchName").on("input", function () {
            var searchName = $("#searchName").val();
            atualizarListaUsuarios(searchName);
        });

        // Função para atualizar a lista de usuários com base no filtro de nome
        function atualizarListaUsuarios(filterName) {
            $.ajax({
                type: "POST", // Alterado para POST
                url: "search_users.php", // Crie um novo arquivo PHP para processar a pesquisa
                data: { filterName: filterName },
                success: function (data) {
                    $("#userList").html(data);
                }
            });
        }
    });
</script>
</body>
</html>
