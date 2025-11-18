<?php
session_start();
require_once '../controller/controller_login.php'; 
require_once '../controller/controller_cardapio_visualizacao.php';

function dataDoDia($inicio, $diasAdicionar) {
    return date('d/m/Y', strtotime("$inicio +$diasAdicionar days"));
}

$diasSemana = ['segunda', 'terca', 'quarta', 'quinta', 'sexta'];
?>

<!DOCTYPE html>
<html class="wide wow-animation" lang="pt-br">
<head>
    <title>NutriGestão - Cardápio da Semana</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <link rel="icon" href="./images/2.png" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
        th { color: #fff; }
        td { color: #000; }
        .btn:hover { font-size: 20px; color: black; }
        .btn { color: #353535; font-size: 18px; cursor: pointer; text-decoration: none; }
        #btnGerarPDF, .visualizar {
            padding: 12px;
            background-color: #fd9c14;
            color: #fff;
            text-decoration: none;
            font-size: 14px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }
        .visualizar { margin-right: 3%; }
        .salvar:hover { background-color: #f89200; padding: 18px; }
        .botao1 { padding-top: 12px; display: flex; justify-content: right; }
        .botao { padding-top: 12px; }
        .no-class { 
            color: #f89200; 
            font-weight: bold; 
            font-size: 1.2em; 
            text-align: center; 
            padding: 30px; 
        }
        .montserrat { font-family: "Montserrat", sans-serif; }
        #link { font-family: "Montserrat", sans-serif; }
        .btn-navegacao {
            padding: 8px 12px;
            background-color: #6c757d;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        .btn-navegacao:hover { background-color: #5a6268; }
        table tbody tr:nth-child(even) { background-color: #ffffff; }
        table tbody tr:nth-child(odd) { background-color: #ffe4b7; }
        .semana-info { 
            background-color: #f8f9fa; 
            padding: 15px; 
            border-radius: 8px; 
            margin-bottom: 20px; 
        }
        .semana-navegacao { 
            display: flex; 
            gap: 10px; 
            align-items: center; 
            flex-wrap: wrap; 
        }
    </style>
</head>
<body>
   <div class="page"><a style="display: none;"section section-banner d-none d-xl-block href="https://www.templatemonster.com/intense-multipurpose-html-template.html" style="background-image: url(6.png); background-image: -webkit-image-set( url(6.png) 1x, url(6.png) 2x )"><img src="./images/7.png" srcset="7.png 1x, 7.png 2x" alt="" width="1600" height="310"></a>
      <!-- Page Header-->   
      <header class="section page-header">
        <!-- RD Navbar-->
        <div class="rd-navbar-wrap rd-navbar-modern-wrap">
          <nav class="rd-navbar rd-navbar-modern" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-fixed" data-xl-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static" data-xxl-layout="rd-navbar-static" data-xxl-device-layout="rd-navbar-static" data-lg-stick-up-offset="46px" data-xl-stick-up-offset="46px" data-xxl-stick-up-offset="70px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
            <div class="rd-navbar-brand">
              <a href="Inicio.php">
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
                      <li class="rd-nav-item "><a class="rd-nav-link" href="Inicio.php ?unidade_escolar=<?php echo $_GET["unidade_escolar"];?>"><b id="link">Início</b></a>
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

        <div class="botao1">
            <button class="visualizar"><a href="./cardapio.php?unidade_escolar=<?php echo $_GET["unidade_escolar"];?>" style="color: white;"><b>← Voltar</b></a></button>
        </div>

        <section class="section section-md text-center">
            <div class="container">
                <div class="card">
                    <h3 class="wow fadeIn">Cardápio da Semana</h3>
                    
                    <!-- Navegação da Semana -->
                    <div class="semana-info">
                      <form method="POST" action="">
                          <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                              <label for="inicio_semana" style="font-weight: bold;">Selecionar Semana:</label>
                              <input type="date" id="inicio_semana" name="inicio_semana" 
                                    value="<?= $inicio_semana ?>" 
                                    class="form-control" style="width: auto;"
                                    onchange="this.form.submit()">
                          </div>
                      </form>
                      
                      <small style="color: #666; margin-top: 10px; display: block;">
                          Semana de <strong><?= date('d/m/Y', strtotime($inicio_semana)) ?></strong> 
                          a <strong><?= date('d/m/Y', strtotime($inicio_semana . ' +4 days')) ?></strong>
                      </small>
                  </div>

                    <!-- Tabela do Cardápio -->
                    <?php if (!empty($cardapio_semana)) : ?>
                        <table class="table table-bordered" style="width:100%; border-collapse: collapse; text-align:center;">
                            <thead style="background-color:#fd9c14;">
                                <tr>
                                    <th>Dia</th>
                                    <th>Manhã</th>
                                    <th>Almoço</th>
                                    <th>Tarde</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($diasSemana as $index => $dia): 
                                    $registro = $cardapio_semana[$dia] ?? null;
                                    $dataDia = dataDoDia($inicio_semana, $index);
                                ?>
                                <tr>
                                    <td style="font-weight:bold;"><?= ucfirst($dia) ?> <br>
                                        <small><?= $dataDia ?></small>
                                    </td>
                                    <td>
                                        <?php if($registro && ($registro['BEBIDA_MANHA'] || $registro['LANCHE_MANHA'] || $registro['ACOMPANHAMENTO_MANHA'] || $registro['FRUTA_MANHA'])): ?>
                                            Bebida: <?= $registro['BEBIDA_MANHA'] ?><br>
                                            Lanche: <?= $registro['LANCHE_MANHA'] ?><br>
                                            Acomp.: <?= $registro['ACOMPANHAMENTO_MANHA'] ?><br>
                                            Fruta: <?= $registro['FRUTA_MANHA'] ?>
                                        <?php else: ?>
                                            Não haverá aula
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($registro && $registro['ALMOCO']): ?>
                                            <?= $registro['ALMOCO'] ?>
                                        <?php else: ?>
                                            Não haverá aula
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($registro && ($registro['BEBIDA_TARDE'] || $registro['LANCHE_TARDE'] || $registro['ACOMPANHAMENTO_TARDE'] || $registro['FRUTA_TARDE'])): ?>
                                            Bebida: <?= $registro['BEBIDA_TARDE'] ?><br>
                                            Lanche: <?= $registro['LANCHE_TARDE'] ?><br>
                                            Acomp.: <?= $registro['ACOMPANHAMENTO_TARDE'] ?><br>
                                            Fruta: <?= $registro['FRUTA_TARDE'] ?>
                                        <?php else: ?>
                                            Não haverá aula
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        
                        <br/>
                        <div class="botao">
                            <button class="salvar" id="btnGerarPDF">Gerar PDF</button>
                        </div>
                    <?php else: ?>
                        <p class="no-class">Nenhum cardápio encontrado para esta semana.</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <footer class="section footer-variant-2 footer-modern context-dark">
            <div class="footer-brand"><a href="Inicio.php"><img src="./images/8.png" alt="NutriGestão" width="196" height="42"/></a></div>
            <div class="copy">
                <p class="direitos">&copy; 2025 <b>NutriGestão</b> - Todos os direitos reservados</p>
            </div>
        </footer>

        <script src="js/core.min.js"></script>
        <script src="js/script.js"></script>
        <script>
            // Perfil Dropdown
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
                window.location.href = "login.php";
            }

            // Gerar PDF
            // Gerar PDF
document.getElementById('btnGerarPDF').addEventListener('click', function() {
    const inicioSemana = "<?= $inicio_semana ?>";
    const unidade_escolar = "<?= $unidade_escolarLogado ?>";
    
    console.log('Inicio semana:', inicioSemana);
    console.log('Unidade escolar:', unidade_escolar);
    
    if (!inicioSemana) {
        alert('Selecione a data de início da semana!');
        return;
    }
    
    const url = 'cardapio_pdf.php?inicio_semana=' + encodeURIComponent(inicioSemana) + 
              '&unidade_escolar=' + encodeURIComponent(unidade_escolar);
    
    console.log('URL do PDF:', url);
    
    // Teste: abra a URL em nova aba primeiro para ver se há erro
    window.open(url, '_blank');
});
        </script>
    </div>
</body>
</html>