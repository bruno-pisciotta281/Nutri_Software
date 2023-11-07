<?php
// Iniciar a sessão
session_start();
?>
<!DOCTYPE html>
<html>
<head>
   <!--Arquivos CSS e JavaScript do Bootstrap -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="shortcut icon" href="../media/logo2.jpeg">
  <title>Tela Inicial - Software de Nutrição</title>
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
    margin-bottom: 1rem; /* Espaço inferior entre os botões */
  }

  /* Estilo condicional para o último botão 
  .btn:last-child {
    flex-basis: 100%; 
  }
*/
  .btn:hover {
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
    font-size: 1.1em;
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

.btn-danger{
  font-size: 13px;
  height: 25px;
  width: 40px;
  float: right;
  text-align: center; /* Centraliza o texto horizontalmente */
  display: flex;
  align-items: center; /* Centraliza verticalmente */
  justify-content: center; /* Centraliza verticalmente */
}

/*Estilização da barra de rolagem horizontal */
::-webkit-scrollbar {
  width: 12px; /* Largura da barra de rolagem */
  height: 12px; /* Altura da barra de rolagem */
}

::-webkit-scrollbar-thumb {
  background-color: #45a049; /* Cor do polegar da barra de rolagem */
  border-radius: 6px; /* Arredondamento do polegar */
}

::-webkit-scrollbar-thumb:hover {
  background-color: #4CAF60; /* Cor do polegar da barra de rolagem ao passar o mouse */
}

::-webkit-scrollbar-track {
  background-color: #f1f1f1; /* Cor da faixa de rolagem */
}

/* Estilização da barra de rolagem vertical (caso necessário) */
/* Você pode ajustar as cores e outros estilos conforme desejado */
::-webkit-scrollbar-vertical {
  width: 12px; /* Largura da barra de rolagem vertical */
  height: 12px; /* Altura da barra de rolagem vertical */
}

::-webkit-scrollbar-thumb:vertical {
  background-color: #45a049; /* Cor do polegar da barra de rolagem vertical */
  border-radius: 6px; /* Arredondamento do polegar vertical */
}

::-webkit-scrollbar-thumb:vertical:hover {
  background-color: #4CAF60 ; /* Cor do polegar da barra de rolagem vertical ao passar o mouse */
}

::-webkit-scrollbar-track:vertical {
  background-color: #f1f1f1; /* Cor da faixa de rolagem vertical */
} 

/* Estilização da barra de rolagem vertical para dispositivos móveis */
/* Você pode ajustar as cores e outros estilos conforme desejado */
@media only screen and (max-width: 768px) {
  ::-webkit-scrollbar {
    width: 12px; /* Largura da barra de rolagem vertical */
  }

  ::-webkit-scrollbar-thumb:vertical {
    background-color: #45a049; /* Cor do polegar da barra de rolagem vertical */
    border-radius: 6px; /* Arredondamento do polegar vertical */
  }

  ::-webkit-scrollbar-thumb:vertical:hover {
    background-color: #4CAF60; /* Cor do polegar da barra de rolagem vertical ao passar o mouse */
  }

  ::-webkit-scrollbar-track:vertical {
    background-color: #f1f1f1; /* Cor da faixa de rolagem vertical */
  }
}

</style>
<body>
  <div class="sidebar" id="mySidebar">
    <a href="javascript:void(0)" class="close-btn" onclick="closeNav()">&#10006;</a>
    <hr class="soon1">
    <a href="index.php">Home</a>
    <hr class="soon1">
    <h2 class="tnav">Calculadoras:</h2>
    <a href="../imc.html">Índice de Massa Corporal</a>
    <a href="../peso_Ideal.html">Peso Ideal</a>
    <a href="../get_gestantes.html">Gasto Energético Total para Gestantes</a>
    <a href="../get_lactantes.html">Gasto Energético Total para Lactantes</a>
    <a href="../get_lactentes.html">Gasto Energético Total para Lactentes</a>
    <a href="../get_3a13anos.html">Gasto Energético Total de 03 a 13 anos</a>
    <a href="../get_adultos.html">Gasto Energético Total para Adultos</a>
    <hr class="soon1">
    <a href="conteudo.html"><strong>Página de Conteúdos</strong></a>
    <hr class="soon1">
    <p class="soon">Em breve mais funcionalidades!</p>
  </div>
</div>
<!-- Conteúdo Principal -->
<div class="container">
<div class="toggle-btn" onclick="toggleNav()">&#9776;</div>
<button class="btn btn-danger logout-button" onclick="logout()"><strong>SAIR</strong></button>
<?php
require_once("config.php");

// Verificar se o cookie de identificador está presente
if (isset($_COOKIE['user_identifier'])) {
    $identifier = $_COOKIE['user_identifier'];

    // Consultar o banco de dados para obter o nome do usuário com base no identificador
    $sql = "SELECT nome FROM usuarios WHERE identifier = :identifier";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':identifier', $identifier);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $userName = $row['nome'];
        echo "<p>Olá, <strong class='user-name'>$userName</strong></p>";
    } else {
        echo "Faça o Login Novamente!";
    }
} else {
    echo "Faça o Login Novamente!";
}
?>

  <hr class="soon2">
  <h1>Bem-vindo(a) ao Software de Nutrição <strong>NutriD&B</strong></h1>
  <img style="height: 200px" src="../media/hello.svg" alt="">
  <br><br>
  <p style="text-align:center;">O software NutriD&B te auxilia a calcular as necessidades energéticas de acordo com a <strong>idade</strong>, <strong>sexo</strong> e <strong>estado fisiológico</strong> na área de Nutrição. <br> <br> As fórmulas utilizadas para os cálculos tem como base a <strong>DRI 2023</strong>.</p>
  <hr class="soon2">
  <h2>Como Usar:</h2>
  <p>Siga estes passos simples para começar:</p>
  <ol>
    <li>Escolha uma calculadora abaixo.</li>
    <li>Na Calculadora preencha os campos com as informações solicitadas.</li>
    <li>Clique no botão "Calcular" para obter seus resultados.</li>
    <li>Depois em "Solução" para verificar como o calculo foi realizado!</li>
  </ol>
  <hr class="soon2">
  <h1>Calculadoras:</h1>
  <div class="btn-container">
    <a href="../imc.html" class="btn btn-primary">IMC</a> -
    <a href="../peso_Ideal.html" class="btn btn-primary">Peso Ideal</a> 
    <a href="../get_gestantes.html" class="btn btn-primary">GET para Gestantes</a> -
    <a href="../get_lactantes.html" class="btn btn-primary">GET para Lactantes</a> 
    <a href="../get_lactentes.html" class="btn btn-primary">GET para Lactentes</a> - 
    <a href="../get_3a13anos.html" class="btn btn-primary">GET de 3 a 13 anos</a>
  </div>
  <center>
    <a href="../get_adultos.html" class="btn btn-primary">GET para Adultos</a>
    <p style="font-size: 15px;">Em breve mais funcionalidades!</p>
    <hr class="soon2">
  </center>

<!--Sessão de Conteúdos-->
<h1>Conteúdos:</h1>
<p>Acesse também os nossos conteúdos! Aqui você pode encontrar os melhores temas relacionados a área de Nutrição sobre os mais diversos assuntos!</p>
<a href="../conteudo.html" class="btn btn-primary">Acesso aos Conteúdos</a>
  <?php
    // Verificar se o cookie de identificador está presente
if (isset($_COOKIE['user_identifier'])) {
  $identifier = $_COOKIE['user_identifier'];

  // Consultar o banco de dados para obter o nome do usuário com base no identificador
  $sql = "SELECT nome, role FROM usuarios WHERE identifier = :identifier";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':identifier', $identifier);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($row) {
      $userName = $row['nome'];
      $userRole = $row['role'];

      // Verificar se o usuário é um administrador
      if ($userRole === 'administrador') {
          // Se o usuário for administrador, exiba o botão para acessar a página de gerenciamento
          echo '<hr class="soon2">';
          echo '<p>Conteúdo para admins</p>';
          echo '<hr class="soon2">';
          echo '<h1>Gestão:</h1>';
          echo '<p>Para você administrador, gerencie aqui os usuários da plataforma!</p>';
          echo '<a href="manage_users.php" class="btn btn-primary">Gerenciar Usuários</a>';
          echo '<hr class="soon2">';
      }
  } else {
    echo '<br>';
      echo ".";
  }
} else {
  echo '<br>';
  echo ".";
}
?>
  <hr class="soon2">
  <h1 class="footer">Em desenvolvimento por: <br> Bruno Pisciotta e Duda Dias ♡</h1>
</div>
</div>
<br>
<script>

// Script para a funcionalida da sidebar
  let sidebarOpen = false;

  function toggleNav() {
    const sidebar = document.getElementById("mySidebar");
    const content = document.querySelector(".container");
    const toggleBtn = document.querySelector(".toggle-btn");

    if (!sidebarOpen) {
      sidebar.style.width = "250px";
      content.style.marginLeft = "250px";
      toggleBtn.style.display = "none";
      sidebarOpen = true;
    } else {
      sidebar.style.width = "0";
      content.style.marginLeft = "auto"; 
      toggleBtn.style.display = "block";
      sidebarOpen = false;
    }
  }

  function closeNav() {
    const sidebar = document.getElementById("mySidebar");
    const content = document.querySelector(".container");
    const toggleBtn = document.querySelector(".toggle-btn");

    sidebar.style.width = "0";
    content.style.marginLeft = "auto"; 
    toggleBtn.style.display = "block";
    sidebarOpen = false;
  }

  function logout() {
    // Realizar uma solicitação ao arquivo PHP de logout
    fetch("logout.php", {
        method: "POST", // ou "GET" dependendo da configuração do seu servidor
    })
    .then(response => {
        if (response.redirected) {
            // Se a resposta redirecionar, siga o redirecionamento
            window.location.href = response.url;
        }
    })
    .catch(error => {
        console.error("Erro ao fazer logout: " + error);
    });
}
</script>
</body>
</html>
