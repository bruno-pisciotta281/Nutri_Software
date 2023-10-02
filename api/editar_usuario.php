<?php
// Iniciar a sessão
session_start();

// Incluir o arquivo de configuração
require_once("config.php");

// Verificar se o ID do usuário a ser editado foi passado na URL
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Consultar o banco de dados para obter os detalhes do usuário com base no ID
    $sql = "SELECT id, nome, email, role FROM usuarios WHERE id = :userId";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Preencha o formulário de edição com os detalhes do usuário
        $userName = $user['nome'];
        $userEmail = $user['email'];
        $userRole = $user['role'];
    } else {
        echo "Usuário não encontrado.";
        exit();
    }
} else {
    echo "ID do usuário não especificado.";
    exit();
}
?>



<!DOCTYPE html>
<html>
<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <title>Editar Usuários</title>
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
     color: #f4f4f4;
     flex-basis: calc(50% - 1rem); /* Largura de 50% com margem de 1rem entre os botões */
     background-color: #4CAF50;
     border: none;
     margin-bottom: 1rem; /* Espaço inferior entre os botões */
   }
 
   .btn:hover {
     color: #f4f4f4;
     background-color: #45a049;
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

   .soon2{
    background-color: #333;
  }
 </style>
<body>
    <div class="container">
        <h1>Editar Usuário</h1>
        <p>Edite as informações do usuário baixo, como nome, email e nível. Depois clique em atualizar para alterar os dados do usuário</p>
        <hr class="soon2">
        <form action="atualizar_usuario.php" method="POST"> <!-- Crie uma página "atualizar_usuario.php" para processar a atualização -->
            <input type="hidden" name="userId" value="<?php echo $userId; ?>"> <!-- Inclua o ID do usuário no formulário oculto -->
            <label for="nome">Nome:</label><br>
            <input type="text" id="nome" name="nome" value="<?php echo $userName; ?>" required><br><br>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" value="<?php echo $userEmail; ?>" required><br><br>

            <label for="role">Selecione o Nível:</label><br>
            <select id="role" name="role" required>
                <option value="administrador" <?php if ($userRole === 'administrador') echo 'selected'; ?>>Administrador</option>
                <option value="usuario" <?php if ($userRole === 'usuario') echo 'selected'; ?>>Usuário Comum</option>
            </select><br><br>

            <input class="btn" type="submit" value="Atualizar">
        </form>
        <hr class="soon2">
        <a href="manage_users.php"><button class="btn">Cancelar</button></a>
    </div>
</body>
</html>
