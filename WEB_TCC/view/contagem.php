<?php
require_once __DIR__ . '/../controller/controller_contagem_alunos.php';
require_once '../controller/controller_login.php'; 

$salaFiltro = isset($_GET['sala']) ? $_GET['sala'] : '';
$dataFiltro = isset($_GET['data']) ? $_GET['data'] : date('Y-m-d');
?>
<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
  <head>
    <title>NutriGestão-Contagem</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <link rel="icon" href="./images/2.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!-- Stylesheets-->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <!--[if lt IE 10]>
    <div style="background: #212121; padding: 10px 0; box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3); clear: both; text-align:center; position: relative; z-index:1;">
      <a href="http://windows.microsoft.com/en-US/internet-explorer/">
        <img src="images/ie8-panel/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today.">
      </a>
    </div>
    <script src="js/html5shiv.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="preloader">
      <div class="preloader-body">
        <div class="cssload-container"><span></span><span></span><span></span><span></span></div>
      </div>
    </div>

    <div class="page">
      <a style="display: none;" section section-banner d-none d-xl-block href="https://www.templatemonster.com/intense-multipurpose-html-template.html" style="background-image: url(6.png); background-image: -webkit-image-set( url(6.png) 1x, url(6.png) 2x )">
        <img src="7.png" srcset="7.png 1x, 7.png 2x" alt="" width="1600" height="310">
      </a>
      <!-- Page Header-->   
      <header class="section page-header">
        <!-- RD Navbar-->
        <div class="rd-navbar-wrap rd-navbar-modern-wrap">
          <nav class="rd-navbar rd-navbar-modern" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-fixed" data-xl-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static" data-xxl-layout="rd-navbar-static" data-xxl-device-layout="rd-navbar-static" data-lg-stick-up-offset="46px" data-xl-stick-up-offset="46px" data-xxl-stick-up-offset="70px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
            <div class="rd-navbar-brand"><img src="./images/8.png"/></div>
            <div class="rd-navbar-main-outer">
              <div class="rd-navbar-main">
                <!-- RD Navbar Panel-->
                <div class="rd-navbar-panel">
                  <!-- RD Navbar Toggle-->
                  <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                  <!-- RD Navbar Brand
                  <div class="rd-navbar-brand"><img src="4.png" alt="" width="400" height="50"/></div>
                </div>-->
                <div class="rd-navbar-main-element">
                  <div class="rd-navbar-nav-wrap">
                    <ul class="rd-navbar-nav">
                      <li class="rd-nav-item "><a class="rd-nav-link" href="Inicio.php?cpf=<?php echo $_GET["cpf"];?>"><b id="link">Início</b></a>
                      </li>
                      <li class="rd-nav-item "><a class="rd-nav-link" href="refeicao.php?cpf=<?php echo $_GET["cpf"];?>"><b id="link">Refeições</b></a>
                      </li>
                      <li class="rd-nav-item"><a class="rd-nav-link" href="desperdicio.php?cpf=<?php echo $_GET["cpf"];?>"><b id="link">Desperdícios</b></a>
                      </li>
                      <li class="rd-nav-item"><a class="rd-nav-link" href="contagem.php?cpf=<?php echo $_GET["cpf"];?>"><b id="link">Contagem</b></a>
                      </li>
                      <li class="rd-nav-item"><a class="rd-nav-link" href="restricoes_dietas.php?cpf=<?php echo $_GET["cpf"];?>"><b id="link">Restricões & Dietas</b></a>
                      </li>
                      <li class="rd-nav-item"><a class="rd-nav-link" href="cardapio.php?cpf=<?php echo $_GET["cpf"];?>"><b id="link">Cardápio</b></a>
                      </li>
                    </ul>
                    <!-- Ícone de Perfil com Dropdown -->
                    <div class="profile-container" style="position: relative; margin-left: 20px;">
                      <div class="profile-icon" id="profileIcon" style="width: 40px; height: 40px; background-color: #ff990032; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer;">
                        <b style="color: #f89200;"><?= strtoupper(substr($_SESSION['email'], 0, 2)) ?></b>
                      </div>
                      <div class="dropdown" id="dropdownMenu" style="display: none; position: absolute; top: 50px; right: 0; background-color: white; border: 1px solid #ddd; box-shadow: 0 2px 5px rgba(0,0,0,0.1); border-radius: 8px; padding: 10px; z-index: 1000;color:#757575;width:250px;aling-itens:left;">
                        <p style="margin: 5px 0;font-size:15px"><strong>Email:</strong> <?= htmlspecialchars($_SESSION['email'] ?? '-') ?></p>
                        <p style="margin: 5px 0;font-size:15px"><strong>Unidade Escolar:</strong> <?= htmlspecialchars($_SESSION['unidade_escolar'] ?? '-') ?></p>
                        <hr>
                        <br/>
                      <button onclick="logout()" style="background-color: #f89200; border: none; padding: 8px 12px; border-radius: 5px; color: white; cursor: pointer;width:130px">Sair</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </nav>
        </div>
      </header>

      <style>
        .conteudo {
            font-family: Arial;
            margin: 30px;
            padding-top: 22px;
        }
        .titulo {
            text-align: center;
            font-size: 50px;
            padding-bottom: 10px;
        }
        .subtitulo {
            font-size: 15px;
            text-align: center;
            padding-top: 1%;
            color: black;
        }
        label {
            font-weight: bold;
            margin-right: 10px;
        }
        input[type="text"], input[type="date"], select {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 200px;
            color: #000;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            overflow: hidden;
            border-radius: 5px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            cursor: pointer;
        }
        th {
            background-color: #ff9800;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        .data {
          padding: 10px auto;
          color: #333;
          font-size: 20px;
        }
        #dateInput {
          margin: 10px;
        }
        tbody {
          color: #000;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 10%;
            background-color: #ff9900c2;
        }
        .card {
          margin-left: 6%;
          margin-right: 6%;
          background-color: white;
        }
        .montserrat {
          font-family: "Montserrat", sans-serif;
          font-optical-sizing: auto;
          font-weight: weight;
          font-style: normal;
        }
        #link {
          font-family: "Montserrat", sans-serif;
        }
        .montserrat{
            font-family: "Montserrat", sans-serif;
            font-optical-sizing: auto;
            font-weight: weight;
            font-style: normal;
          }
      </style>

      <div class="conteudo">
        <h3 class="titulo">Contagem de Lanches - Data: <?= date('d/m/Y', strtotime($dataFiltro)) ?></h3>

        <div class="filtro">
          <form method="GET" action="">
            <label for="salaFiltro">Filtrar por Sala:</label>
            <select name="sala" id="salaFiltro">
              <option value="" <?= $salaFiltro === '' ? 'selected' : '' ?>>Todas</option>
              <option value="2º Ano E.M A" <?= $salaFiltro === '2º Ano E.M A' ? 'selected' : '' ?>>2º Ano E.M A</option>
              <option value="2º Ano E.M B" <?= $salaFiltro === '2º Ano E.M B' ? 'selected' : '' ?>>2º Ano E.M B</option>
              <option value="3º Ano E.M A" <?= $salaFiltro === '3º Ano E.M A' ? 'selected' : '' ?>>3º Ano E.M A</option>
              <option value="3º Ano E.M B" <?= $salaFiltro === '3º Ano E.M B' ? 'selected' : '' ?>>3º Ano E.M B</option>
              <option value="6º Ano Ef2 A" <?= $salaFiltro === '6º Ano Ef2 A' ? 'selected' : '' ?>>6º Ano Ef2 A</option>
              <option value="6º Ano Ef2 B" <?= $salaFiltro === '6º Ano Ef2 B' ? 'selected' : '' ?>>6º Ano Ef2 B</option>
              <option value="7º Ano Ef2 A" <?= $salaFiltro === '7º Ano Ef2 A' ? 'selected' : '' ?>>7º Ano Ef2 A</option>
              <option value="7º Ano Ef2 B" <?= $salaFiltro === '7º Ano Ef2 B' ? 'selected' : '' ?>>7º Ano Ef2 B</option>
              <option value="8º Ano Ef2 A" <?= $salaFiltro === '8º Ano Ef2 A' ? 'selected' : '' ?>>8º Ano Ef2 A</option>
              <option value="8º Ano Ef2 B" <?= $salaFiltro === '8º Ano Ef2 B' ? 'selected' : '' ?>>8º Ano Ef2 B</option>
              <option value="9º Ano Ef2 A" <?= $salaFiltro === '9º Ano Ef2 A' ? 'selected' : '' ?>>9º Ano Ef2 A</option>
              <option value="9º Ano Ef2 B" <?= $salaFiltro === '9º Ano Ef2 B' ? 'selected' : '' ?>>9º Ano Ef2 B</option>
              <option value="1º Ano E.M A" <?= $salaFiltro === '1º Ano E.M A' ? 'selected' : '' ?>>1º Ano E.M A</option>
              <option value="1º Ano E.M B" <?= $salaFiltro === '1º Ano E.M B' ? 'selected' : '' ?>>1º Ano E.M B</option>
            </select>
            <input type="text" hidden name="cpf" value="<?= htmlspecialchars($cpf_usuario ?? '') ?>">
            <button type="submit" style="margin-left: 10px; background-color: #ff9800; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer;">
              Aplicar Filtro
            </button>
            <button type="button" onclick="window.location.href='contagem.php?cpf=<?= urlencode($_GET['cpf']) ?>'" style="margin-left: 10px; background-color: #ff9800; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer;">
              Limpar Filtros
            </button>
          </form>
        </div>
        <br/><br/>
        <div class="card">
          <br/>
          <p class="subtitulo"><b>Contagem de Alimentos de Lanches da Tarde e Manhã</b></p>
          <table id="wasteTable">
            <thead>
              <tr>
                <th>Tipo de Refeição</th>
                <th colspan="2">Café da Manhã</th>
                <th colspan="2">Café da Tarde</th>
                <th>Data</th>
              </tr>
              <tr>
                <th>Sala</th>
                <th>Lanche (QT)</th>
                <th>Bebida (QT)</th>
                <th>Lanche (QT)</th>
                <th>Bebida (QT)</th>
                <th>DD/MM/AAAA</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($dadosTurmas as $linha): ?>
                <tr>
                  <td><?= htmlspecialchars($linha['TURMA']); ?></td>
                  <td><?= htmlspecialchars($linha['QUANTIDADE_LANCHE_MANHA']); ?></td>
                  <td><?= htmlspecialchars($linha['QUANTIDADE_BEBIDA_MANHA']); ?></td>
                  <td><?= htmlspecialchars($linha['QUANTIDADE_LANCHE_TARDE']); ?></td>
                  <td><?= htmlspecialchars($linha['QUANTIDADE_BEBIDA_TARDE']); ?></td>
                  <td><?= date('d/m/Y', strtotime($linha['DATA'])); ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

        <script>
          // Adiciona um evento de clique para cada célula da tabela
          document.querySelectorAll('td').forEach(cell => {
              cell.addEventListener('click', function() {
                  // Se a célula não estiver em modo de edição, ative o modo de edição
                  if (!this.isContentEditable) {
                      this.contentEditable = true;
                      this.focus();
                  }
              });

              // Adiciona um evento para sair do modo de edição ao pressionar Enter
              cell.addEventListener('keypress', function(event) {
                  if (event.key === 'Enter') {
                      this.contentEditable = false; // Desativa o modo de edição
                      event.preventDefault(); // Evita a quebra de linha
                  }
              });
          });
        </script>
      </div>

      <footer class="section footer-variant-2 footer-modern context-dark section-top-image section-top-image-dark">
        <div class="qnf"><a href="Inicio.php"><img src="./images/8.png" alt="" width="196" height="42"/></a></div>
        <div class="copy">
          <p class="direitos">&copy; 2025 <b>NutriGestão</b> - Todos os direitos reservados</p>
        </div>
        <br><br>
      </footer>

      <div class="snackbars" id="form-output-global"></div>
      <!-- Javascript-->
      <script src="js/core.min.js"></script>
      <script src="js/script.js"></script>
      <!-- coded by Ragnar-->

    </body>

    <script>
      const profileIcon = document.getElementById('profileIcon');
      const dropdownMenu = document.getElementById('dropdownMenu');
    
      profileIcon.addEventListener('click', () => {
        dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
      });
    
      window.addEventListener('click', function(e) {
        if (!profileIcon.contains(e.target) && !dropdownMenu.contains(e.target)) {
          dropdownMenu.style.display = 'none';
        }
      });
    
      function logout() {
        // Redireciona para a página de login
        window.location.href = "login.php";
      }
    </script>
</html>
