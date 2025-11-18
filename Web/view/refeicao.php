<?php
require_once '../controller/controller_login.php'; 
require_once('./../controller/controller_refeicao.php');
?>
<!DOCTYPE html>
<html class="wide wow-animation" lang="pt-br">
  <head>
    <title>NutriGestão-Refeições</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <link rel="icon" href="./images/2.png" type="image/x-icon">
    <!-- Stylesheets-->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!--[if lt IE 10]>
    <div style="background: #212121; padding: 10px 0; box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3); clear: both; text-align:center; position: relative; z-index:1;"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img src="images/ie8-panel/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
    <script src="js/html5shiv.min.js"></script>
    <![endif]-->
  </head>
  <style>
  .montserrat{
      font-family: "Montserrat", sans-serif;
      font-optical-sizing: auto;
      font-weight: weight;
      font-style: normal;
    }
    #link{
  font-family: "Montserrat", sans-serif;
}
  .explanation-card {
    background-color: #f8f9fa;
    border-left: 4px solid #f89200;
    padding: 15px;
    margin-top: 15px;
    border-radius: 4px;
    font-size: 14px;
    color: #555;
}
.explanation-card h4 {
    margin-top: 0;
    color: #f89200;
    font-size: 16px;
}
.explanation-card ul {
    margin-bottom: 0;
    padding-left: 20px;
}
    </style>
  <body>
    <div class="preloader">
      <div class="preloader-body">
        <div class="cssload-container"><span></span><span></span><span></span><span></span>
        </div>
      </div>
    </div>
    <div class="page"><a style="display: none;"section section-banner d-none d-xl-block href="https://www.templatemonster.com/intense-multipurpose-html-template.html" style="background-image: url(../images/6.png); background-image: -webkit-image-set( url(6.png) 1x, url(6.png) 2x )"><img src="7.png" srcset="7.png 1x, 7.png 2x" alt="" width="1600" height="310"></a>      <!-- Page Header-->   
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
                      <li class="rd-nav-item"><a class="rd-nav-link" href="Inicio.php?unidade_escolar=<?php echo $_GET["unidade_escolar"];?>"><b id="link">Início</b></a>
                      </li>
                      <li class="rd-nav-item "><a class="rd-nav-link" href="refeicao.php?unidade_escolar=<?php echo $_GET["unidade_escolar"];?>"><b id="link">Refeições</b></a>
                      </li>
                      <li class="rd-nav-item"><a class="rd-nav-link" href="desperdicio.php?unidade_escolar=<?php echo $_GET["unidade_escolar"];?>"><b id="link">Desperdícios</b></a>
                      </li>
                      <li class="rd-nav-item"><a class="rd-nav-link" href="contagem.php?unidade_escolar=<?php echo $_GET["unidade_escolar"];?>"><b id="link">Contagem</b></a>
                      </li>
                      <li class="rd-nav-item"><a class="rd-nav-link" href="tabela_restricoes.php?unidade_escolar=<?php echo $_GET["unidade_escolar"];?>"><b id="link">Restricões & Dietas</b></a>
                      </li>
                      <li class="rd-nav-item"><a class="rd-nav-link" href="cardapio.php?unidade_escolar=<?php echo $_GET["unidade_escolar"];?>"><b id="link">Cardápio</b></a>
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

            </div>
          </nav>
        </div>
      </header>

    
          <div class="container">
              <!-- Formulário de Contagem de Refeições -->
              <div class="card">
        <h3>Registre Refeições Distribuídas</h3>
        <div class="input-container">
            <form method="POST" action="../controller/controller_refeicao.php" id="refeicaoForm" onsubmit="return validarFormulario()">
                <input type="number" name="quantidade_diaria" id="quantidade_diaria" placeholder="Registre em KG" min="1" 
                      value="<?= isset($dados['quantidade_diaria']) ? $dados['quantidade_diaria'] : '' ?>" required>
                <button type="submit">Registrar Informações</button>
            </form>
            <div class="explanation-card">
                <h4>Como usar este registro:</h4>
                <ul>
                    <li>Este campo serve para registrar a quantidade em <strong>quilogramas (KG)</strong> de refeições servidas</li>
                    <li>Adicione os valores diariamente para acompanhar o consumo</li>
                    <li>Você pode consultar as somas diária, semanal e mensal abaixo</li>
                    <li>O sistema irá acumular automaticamente os valores para os relatórios</li>
                </ul>
            </div>
        </div>
    </div>


<script>
function validarFormulario() {
    const quantidade = document.getElementById('quantidade_diaria').value;
    
    if (quantidade === '' || quantidade === '0' || parseInt(quantidade) <= 0) {
        alert('Por favor, insira uma quantidade válida maior que 0');
        document.getElementById('quantidade_diaria').focus();
        return false;
    }
    
    return true;
}

// Validação em tempo real
document.getElementById('quantidade_diaria').addEventListener('input', function() {
    if (this.value === '0') {
        this.value = '';
    }
});
</script>
    
        <!-- Relatórios de Refeições -->
        <div class="card">
            <h3>Refeições Distribuídas:</h3>
            <div class="value" id="daily-meals"><?php echo $dados_diario["SOMA_DIARIA"]; ?> Kg Refeições / Dia</div>
            <div class="indicator">
                <p><strong>Semanal:</strong> <span id="weekly-meals"><?php echo $dados_semanais["SOMA_SEMANAL"]; ?> Kg Refeições</span></p>
                <p><strong>Mensal:</strong> <span id="monthly-meals"><?php echo $dados_mensais["SOMA_MENSAL"]; ?> Kg Refeições</span></p>
            <!-- Card Explicativo -->
            
        </div>
    </div>
</div>
<br/>    
<br/>    
    


      <!--
<a class="section section-banner" href="https://www.templatemonster.com/intense-multipurpose-html-template.html" style="background-image: url(images/banner/background-03-1920x310.jpg); background-image: -webkit-image-set( url(images/banner/background-03-1920x310.jpg) 1x, url(images/banner/background-03-3840x620.jpg) 2x )"><img src="images/banner/foreground-03-1600x310.png" srcset="images/banner/foreground-03-1600x310.png 1x, images/banner/foreground-03-3200x620.png 2x" alt="" width="1600" height="310"></a>
      Page Footer-->
      <footer class="section footer-variant-2 footer-modern context-dark section-top-image section-top-image-dark">
        <div class="footer-brand"><a href="Inicio.php?unidade_escolar=<?php echo $_GET["unidade_escolar"];?>"><img src="./images/8.png" alt="" width="196" height="42"/></a></div>
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