<?php
require_once '../controller/controller_login.php'; 
?>
<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
  <head>
    <title>NutriGestão-Refeições</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <link rel="icon" href="./images/2.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
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
    select option:hover {
      background-color: #ff9800;
      color: white;
    }
    .montserrat{
      font-family: "Montserrat", sans-serif;
      font-optical-sizing: auto;
      font-weight: weight;
      font-style: normal;
    }
    #link{
      font-family: "Montserrat", sans-serif;
    }
    #form_rest{
      border: 2px solid #bababa !important;
    }
  </style>
  <body class="bg-gray-100 text-gray-800">
    <div class="preloader">
      <div class="preloader-body">
        <div class="cssload-container"><span></span><span></span><span></span><span></span>
        </div>
      </div>
    </div>
    <div class="page"><a style="display: none;"section section-banner d-none d-xl-block href="https://www.templatemonster.com/intense-multipurpose-html-template.html" style="background-image: url(6.png); background-image: -webkit-image-set( url(6.png) 1x, url(6.png) 2x )"><img src="7.png" srcset="7.png 1x, 7.png 2x" alt="" width="1600" height="310"></a>      <!-- Page Header-->   
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

  <main class="p-6 space-y-6">
        <form method="POST" action="../controller/controller_restricao_alimentar.php" enctype="multipart/form-data">
          <section class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold mb-4">Informações do Aluno</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium" for="nome_aluno">Nome do Aluno</label>
                <input
                  type="text"
                   id="form_rest"
                  name="nome_aluno"
                  class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                  placeholder="Ex: Lucas da Silva"
                  required
                />
              </div>
              <div>
                <label class="block text-sm font-medium" for="telefone_responsavel">Telefone do Responsável</label>
                <input
                  type="tel"
                   id="form_rest"
                  name="telefone_responsavel"
                  class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                  placeholder="(00) 91234-5678"
                  required
                />
              </div>
              <div>
                <label class="block text-sm font-medium" for="tipo_restricao">Tipo de Restrição</label>
                <input
                  type="text"
                  id="form_rest"
                  name="tipo_restricao"
                  class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                  placeholder="Ex: Intolerância à lactose"
                  required
                />
              </div>
              <div class="relative">
              <label class="block text-sm font-medium">Turma</label>
              <select  name="turma" id="form_rest" required
                class="mt-1 block w-full border border-gray-300 bg-white text-gray-700 py-2 px-3 pr-8 rounded-md appearance-none focus:outline-none focus:ring-2 focus:ring-orange-400">
                
                <option value="">Selecione uma turma</option>
                <option>6° EF2 A</option>
                <option>6° EF2 B</option>
                <option>7° EF2 A</option>
                <option>7° EF2 B</option>
                <option>8° EF2 A</option>
                <option>8° EF2 B</option>
                <option>9° EF2 A</option>
                <option>9° EF2 B</option>
                <option>1° EM A</option>
                <option>1° EM B</option>
                <option>2° EM A</option>
                <option>2° EM B</option>
                <option>3° EM A</option>
                <option>3° EM B</option>
              </select>

              <!-- Ícone da setinha -->
              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
              </div>
            </div>

            </div>
          </section>

          <section class="bg-white p-6 rounded-lg shadow mt-6">
            <h2 class="text-lg font-semibold mb-4">Atestado Médico</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium" for="nome_profissional">Nome do Profissional de Saúde</label>
                <input
                  type="text"
                   id="form_rest"
                  name="nome_profissional"
                  class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                  id="form_rest"
                  placeholder="Ex: Dr. Nome Sobrenome"
                  required
                />
              </div>
              <div>
                <label class="block text-sm font-medium" for="registro_profissional">CRM ou Registro Profissional</label>
                <input
                  type="text"
                   id="form_rest"
                  name="registro_profissional"
                  class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                  id="form_rest"
                  placeholder="Ex: CRM-SP 123456"
                  required
                />
              </div>
              <div class="md:col-span-2">
                <label class="block text-sm font-medium" for="anotacoes_sintomas">Anotações sobre Sintomas/Reações</label>
                <textarea
                   id="form_rest"
                  name="anotacoes_sintomas"
                  class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                  id="form_rest"
                  rows="3"
                  placeholder="Detalhes adicionais sobre o caso..."
                  required
                ></textarea>
              </div>
              <div class="md:col-span-2">
                <label class="block text-sm font-medium" for="documento_medico">Enviar Documento Médico</label>
                <input
                  type="file"
                   id="form_rest"
                  name="documento_medico"
                  id="form_rest"
                  class="mt-1 block w-full text-sm text-gray-500
                    file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0
                    file:text-sm file:font-semibold file:bg-red-600 file:text-white hover:file:bg-red-700"
                />
              </div>
            </div>
          </section>

          <div class="text-right mt-6">
            <button
              type="submit"
              style="background-color: #ff9800;"
              class="text-white font-semibold py-2 px-6 rounded-lg hover:brightness-90"
            >
              Salvar Informações
            </button>
          </div>
        </form>
      </main>




      <!--
<a class="section section-banner" href="https://www.templatemonster.com/intense-multipurpose-html-template.html" style="background-image: url(images/banner/background-03-1920x310.jpg); background-image: -webkit-image-set( url(images/banner/background-03-1920x310.jpg) 1x, url(images/banner/background-03-3840x620.jpg) 2x )"><img src="images/banner/foreground-03-1600x310.png" srcset="images/banner/foreground-03-1600x310.png 1x, images/banner/foreground-03-3200x620.png 2x" alt="" width="1600" height="310"></a>
      Page Footer-->
      <footer class="section footer-variant-2 footer-modern context-dark section-top-image section-top-image-dark">
        <div class="footer-brand"><a href="Inicio.php"><img src="./images/8.png" alt="" width="196" height="42"/></a></div>
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