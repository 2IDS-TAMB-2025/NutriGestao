<?php
require_once '../controller/controller_login.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>
<!DOCTYPE html>
<html class="wide wow-animation" lang="pt-br">
  <head>
    <title>NutriGestão - Ínicio</title>
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
    <link rel="stylesheet" href="./css/style.css">
    <!--[if lt IE 10]>
    <div style="background: #212121; padding: 10px 0; box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3); clear: both; text-align:center; position: relative; z-index:1;"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img src="images/ie8-panel/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
    <script src="js/html5shiv.min.js"></script>
    <![endif]-->
</head>
  <body>
    <div class="preloader">
      <div class="preloader-body">
        <div class="cssload-container">
        </div>
      </div>
    </div>
    <div class="page"><a style="display: none;"section section-banner d-none d-xl-block href="https://www.templatemonster.com/intense-multipurpose-html-template.html" style="background-image: url(6.png); background-image: -webkit-image-set( url(6.png) 1x, url(6.png) 2x )"><img src="./images/7.png" srcset="7.png 1x, 7.png 2x" alt="" width="1600" height="310"></a>
      <!-- Page Header-->  
      <header class="section page-header">
        <!-- RD Navbar-->
        <div class="rd-navbar-wrap rd-navbar-modern-wrap">
          <nav class="rd-navbar rd-navbar-modern" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-fixed" data-xl-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static" data-xxl-layout="rd-navbar-static" data-xxl-device-layout="rd-navbar-static" data-lg-stick-up-offset="46px" data-xl-stick-up-offset="46px" data-xxl-stick-up-offset="70px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
            <div class="rd-navbar-brand">
              <a href="inicio.php">
                  <img src="./images/8.png" alt="Logo">
              </a>
          </div>
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
                      <li class="rd-nav-item "><a class="rd-nav-link" href="Inicio.php?unidade_escolar=<?php echo $_GET["unidade_escolar"];?>"><b id="link">Início</b></a>
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
                    </ul>                </ul>
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
      <!-- Swiper-->
      <section class="section swiper-container swiper-slider swiper-slider-modern" data-loop="true" data-autoplay="5000" data-simulate-touch="true" data-nav="true" data-slide-effect="fade">
        <div class="swiper-wrapper text-left">
          <div class="swiper-slide context-dark" data-slide-bg="./images/6.png">
            <div class="swiper-slide-caption">
              <div class="container">
                <div class="row justify-content-center justify-content-xxl-start">
                  <div class="col-md-10 col-xxl-6">
                    <div class="slider-modern-box">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide" data-slide-bg="./images/7.png">
            <div class="swiper-slide-caption">
              <div class="container">
                <div class="row justify-content-center justify-content-xxl-start">
                  <div class="col-md-10 col-xxl-6">
                    <div class="slider-modern-box">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide" data-slide-bg="./images/10.png">
            <div class="swiper-slide-caption">
              <div class="container">
                <div class="row justify-content-center justify-content-xxl-start">
                  <div class="col-md-10 col-xxl-6">
                    <div class="slider-modern-box">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Swiper Navigation-->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
        <!-- Swiper Pagination-->
        <div class="swiper-pagination swiper-pagination-style-2"></div>
      </section>
      <div class="apresentacao" style="margin-top:0;">
        <div class="sobre">
        <h2 class="title"><b>Um pouco sobre a criação do projeto:</b></h2>
        </div>
        <br><br><br>
        <p class="paragrafo">Seja bem-vindo ao <b>NutriGestão</b>, um projeto inovador desenvolvido por estudantes do <b>3º ano do Ensino Médio do SESI Joelmir Beting - CE-370</b>, em parceria com o curso de <b>Tecnologia da Informação do SENAI</b>. O <b>NutriGestão</b> foi criado com o propósito de otimizar o gerenciamento do consumo de alimentos nas instituições de ensino, promovendo um equilíbrio entre oferta e demanda. A iniciativa busca reduzir o desperdício de alimentos e garantir que todos os alunos tenham acesso adequado às refeições, contribuindo para uma alimentação mais sustentável e eficiente. Por meio de soluções tecnológicas práticas e intuitivas, o <b>NutriGestão</b> se destaca como uma ferramenta essencial para escolas preocupadas com o bem-estar de seus estudantes.</p>
        <button id="ler-conteudo-btn" aria-label="Ler Conteúdo">Ler Páragrafo</button>
    </div>
    <script>
        document.getElementById('ler-conteudo-btn').addEventListener('click', function() {
            const texto = document.querySelector('.paragrafo').innerText;
            const falante = new SpeechSynthesisUtterance(texto);
            falante.lang = 'pt-BR';
            falante.volume = 1;
            falante.rate = 1;
            falante.pitch = 1;
            speechSynthesis.speak(falante);
        });
    </script>
   
                          </div>
                        </div>
                      </div>
                    </article>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <br>
        <br>
        <br>
        <div class="divisao"><p>.</p></div>
      <!-- Team of professionals-->
      <section class="section section-md bg-default">
        <div class="container">
            <div class="oh">
                <h2 class="wow slideInUp" data-wow-delay="0s"><b>Desenvolvedores:</b></h2>
            </div>
            <br>
            <div class="row2 row-30 justify-content-center">
                <div class="col-md-6 col-lg-3 col-xl-3 wow fadeInRight" data-wow-delay="0s">
                    <!-- Team Classic-->
                    <article class="team-classic">
                        <a class="team-classic-figure" href="https://www.instagram.com/xandy_velucci/" target="_blank"><img src="./images/alexandre.png" alt="" width="370" height="406"/></a>
                        <div class="team-classic-caption">
                            <h5 class="team-classic-name"><a href="https://www.instagram.com/xandy_velucci/" target="_blank">Alexandre Eduardo da Silva Velucci</a></h5>
                            <p class="team-classic-status">Full Stack e <b>P.O</b></p>
                        </div>
                    </article>
                </div>
                <div class="col-md-6 col-lg-3 col-xl-3 wow fadeInRight" data-wow-delay=".1s">
                    <!-- Team Classic-->
                    <article class="team-classic">
                        <a class="team-classic-figure" href="https://www.instagram.com/amandajvi/" target="_blank"><img src="./images/amanda.png" alt="" width="370" height="406"/></a>
                        <div class="team-classic-caption">
                            <h5 class="team-classic-name"><a href="https://www.instagram.com/amandajvi/" target="_blank">Amanda Vieira da Costa</a></h5>
                            <p class="team-classic-status">Front-End</p>
                        </div>
                    </article>
                </div>
                <div class="col-md-6 col-lg-3 col-xl-3 wow fadeInRight" data-wow-delay=".2s">
                    <!-- Team Classic-->
                    <article class="team-classic">
                        <a class="team-classic-figure" href="https://www.instagram.com/giorgettigabriel/" target="_blank"><img src="./images/gabrielF.png" alt="" width="370" height="406"/></a>
                        <div class="team-classic-caption">
                            <h5 class="team-classic-name"><a href="https://www.instagram.com/giorgettigabriel/" target="_blank">Gabriel Giorgetti Faria</a></h5>
                            <p class="team-classic-status">Banco de Dados</p>
                        </div>
                    </article>
                </div>
                <div class="col-md-6 col-lg-3 col-xl-3 wow fadeInRight" data-wow-delay=".3s">
                    <!-- Team Classic-->
                    <article class="team-classic">
                        <a class="team-classic-figure" href="https://www.instagram.com/gaabriel_moroni/" target="_blank"><img src="./images/moroni.png" alt="" width="370" height="406"/></a>
                        <div class="team-classic-caption">
                            <h5 class="team-classic-name"><a href="https://www.instagram.com/gaabriel_moroni/" target="_blank">Gabriel Viana Moroni</a></h5>
                            <p class="team-classic-status">Back-End</p>
                        </div>
                    </article>
                </div>
   
                <!-- Linha inferior (segunda linha) -->
                <div class="col-md-6 col-lg-3 col-xl-3 wow fadeInRight" data-wow-delay=".1s">
                    <!-- Team Classic-->
                    <article class="team-classic">
                        <a class="team-classic-figure" href="https://www.instagram.com/juliapuelcherribeiro/" target="_blank"><img src="./images/julia.png" alt="" width="370" height="406"/></a>
                        <div class="team-classic-caption">
                            <h5 class="team-classic-name"><a href="https://www.instagram.com/juliapuelcherribeiro/" target="_blank">Júlia Puelcher Ribeiro</a></h5>
                            <p class="team-classic-status">Full Stack</p>
                        </div>
                    </article>
                </div>
                <div class="col-md-6 col-lg-3 col-xl-3 wow fadeInRight" data-wow-delay=".1s">
                    <!-- Team Classic-->
                    <article class="team-classic">
                        <a class="team-classic-figure" href="https://www.instagram.com/liebert_henrique/" target="_blank"><img src="./images/liebert.png" alt="" width="370" height="406"/></a>
                        <div class="team-classic-caption">
                            <h5 class="team-classic-name"><a href="https://www.instagram.com/liebert_henrique/" target="_blank">Liebert Henrique Simões de Oliveira</a></h5>
                            <p class="team-classic-status">Front-End</p>
                        </div>
                    </article>
                </div>
                <div class="col-md-6 col-lg-3 col-xl-3 wow fadeInRight" data-wow-delay=".1s">
                    <!-- Team Classic-->
                    <article class="team-classic">
                        <a class="team-classic-figure" href="https://www.instagram.com/thalita_perle/" target="_blank"><img src="./images/thalita.png" alt="" width="370" height="406"/></a>
                        <div class="team-classic-caption">
                            <h5 class="team-classic-name"><a href="https://www.instagram.com/thalita_perle/" target="_blank">Thalita Bichoff Perle</a></h5>
                            <p class="team-classic-status">Back-End e <b>Scrum Master</b></p>
                        </div>
                    </article>
                </div>
                <div class="col-md-6 col-lg-3 col-xl-3 wow fadeInRight" data-wow-delay=".1s">
                    <!-- Team Classic-->
                    <article class="team-classic">
                        <a class="team-classic-figure" href="https://www.instagram.com/yasminbrandalia/" target="_blank"><img src="./images/yasmin.png" alt="" width="370" height="406"/></a>
                        <div class="team-classic-caption">
                            <h5 class="team-classic-name"><a href="https://www.instagram.com/yasminbrandalia/" target="_blank">Yasmin Caroline Brandalia</a></h5>
                            <p class="team-classic-status">Banco de Dados</p>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
     
      <!-- Page Footer-->
      <footer class="section footer-variant-2 footer-modern context-dark section-top-image section-top-image-dark">
  <div class="footer-brand">
    <a href="Inicio.php?unidade_escolar=<?php echo $_GET['unidade_escolar']; ?>">
      <img src="./images/8.png" alt="" width="196" height="42" />
    </a>
  </div>

  <div class="footer-variant-2-content">
    <div class="container">
      <div class="col-sm-6 col-lg-4 col-xl-3">
        <div class="oh-desktop">
          <div class="wow slideInRight" data-wow-delay="0s">
            <div class="heading-6 subtitle"><b>Contatos</b></div>
          </div>

          <!-- contatos em linha -->
          <ul class="rd-navbar-modern-contacts contatos-inline">
            <li>
              <div class="unit unit-spacing-sm">
                <div class="unit-left"><span class="icon fa fa-instagram"></span></div>
                <div class="unit-body">
                  <a class="link-phone" href="https://www.instagram.com/nutrigestaosenai_/" target="_blank"><b>@nutrigestaosenai_</b></a>
                </div>
              </div>
            </li>
            <li>
              <div class="unit unit-spacing-sm">
                <div class="unit-left"><span class="icon fa fa-envelope"></span></div>
                <div class="unit-body">
                  <a class="link-email" href="https://mail.google.com/mail/u/0/?tab=rm&ogbl#inbox?compose=new" target="_blank"><b>nutrigestaosenai@gmail.com</b></a>
                </div>
              </div>
            </li>
            <li>
              <div class="unit unit-spacing-sm">
                <div class="unit-left"><span class="icon fa fa-location-arrow"></span></div>
                <div class="unit-body">
                  <a class="link-location" href="https://maps.app.goo.gl/fSgXXD9pTsuMovgT7" target="_blank"><b>Rua Bela Vista, 100, Centro, Tambaú SP</b></a>
                </div>
              </div>
            </li>
          </ul>

          <br>
          <div class="copy">
            <p class="direitos">&copy; 2025 <b>NutriGestão</b> - Todos os direitos reservados</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>

  </body>
   <!-- Javascript-->
    <script src="js/core.min.js"></script>
    <script src="js/script.js"></script>
    <!-- coded by Ragnar-->
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
  <style></style>
</html>