<?php
require_once '../controller/controller_login.php'; 

// RECEBE a data inicial da semana (segunda-feira) do POST ou define uma default para teste
$inicio_semana = $_POST['inicio_semana'] ?? date('Y-m-d'); // ou qualquer default que faça sentido

// Função para calcular a data do dia da semana somando dias ao início
function dataDoDia($inicio, $diasAdicionar) {
    return date('d/m/Y', strtotime("$inicio +$diasAdicionar days"));
}

function dataParaMySQL($inicio, $diasAdicionar) {
    return date('Y-m-d', strtotime("$inicio +$diasAdicionar days"));
}
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
      th {
        color: #fff;
      }
      td {
        color: #000;
      }
      .btn:hover {
        font-size: 20px;
        color: black;
      }
      .btn {
        color: #353535;
        font-size: 18px;
        cursor: pointer;
        text-decoration: none;
      }
      .salvar {
        padding: 16px;
        background-color: #fd9c14;
        color: #fff;
        text-decoration: none;
        font-size: 16px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
      }
      .visualizar{
        padding: 12px;
        background-color: #fd9c14;
        color: #fff;
        text-decoration: none;
        font-size: 14px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        margin-right:3%;
      }
      .salvar:hover {
        background-color: #f89200;
        padding: 18px;
      }
      .botao1 {
        padding-top: 12px;
        display:flex;
        justify-content:right;
      }
      .botao {
        padding-top: 12px;
      }
      .no-class {
        color: #f89200;
        font-weight: bold;
        font-size: 1.2em;
        text-align: center;
        padding: 30px;
      }
      #havera {
        color: gray;
        margin-right: 90%;
        margin-bottom: 2%;
      }
      #checkbox{
        color: gray;
        margin-right:90%;
        margin-bottom:2%;
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
      #btnDefinirSemana{
        padding: 8px;
        background-color: #fd9c14;
        color: #fff;
        text-decoration: none;
        font-size: 14px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
      }
      .label{
        color: black;
        font-size: 20px;
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
        <button class="visualizar"><a href="./cardapio_visualizacao.php?unidade_escolar=<?php echo $_GET["unidade_escolar"];?>" style="color: white;"><b>Visualizar cardápio</b></a></button>
    </div>
      <section class="section section-md text-center">
  <div class="container">
    
    <h3 class="wow fadeIn">Definir cardápio da semana</h3>

    <form method="POST" action="../controller/controller_cardapio.php">
      <label class="label">Início da Semana:</label>
      <input type="date" id="inicio_semana" name="inicio_semana" value="<?= htmlspecialchars($inicio_semana) ?>" required>
    <button type="button" id="btnDefinirSemana" style="margin-left:10px;">Definir início da semana</button>
      <br><br>

      <div class="accordion" id="menuAccordion">
    <?php
    $dias_semana = ["segunda", "terça", "quarta", "quinta", "sexta"];
    foreach ($dias_semana as $index => $dia):
        $data_dia = dataDoDia($inicio_semana, $index);
        $data_mysql = dataParaMySQL($inicio_semana, $index);
    ?>
    <div class="card">
        <div class="card-header" style="background:#f5f5f5;">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse<?= $index ?>" aria-expanded="false" aria-controls="collapse<?= $index ?>">
                    <span class="dia-semana"><?= ucfirst($dia) ?></span> - <span class="data-dia" id="data_<?= $dia ?>"><?= $data_dia ?></span>
                </button>
            </h5>
        </div>
        <div id="collapse<?= $index ?>" class="collapse" data-parent="#menuAccordion">
            <div class="card-body">
                <!-- Input hidden com a data no formato MySQL -->
                <!-- <input type="date" name="<?= $dia ?>_data" value="<?= $data_mysql ?>"> -->
                
                <!-- Checkbox "Haverá aula?" -->
                <label id="checkbox">
                    <input type="checkbox" class="checkbox" name="<?= $dia ?>_tem_aula" id="<?= $dia ?>_checkbox" checked onchange="toggleCampos('<?= $dia ?>')">
                    Haverá aula?
                </label>
                <div id="<?= $dia ?>_campos">
                <table class="table table-bordered">
                  <thead style="background-color:#f89200;color:white;">
                    <tr><th>Período</th><th>Refeição</th></tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td rowspan="5"><b>Manhã</b></td>
                      <td id="data_dia">Data do dia: <input readonly type="date" name="<?= $dia ?>_data" id="<?= $dia ?>_input_data" value="<?= $data_dia ?>" required></td>
                    </tr>
                    <tr><td>Bebida: <input type="text" name="<?= $dia ?>_bebida_manha" required></td></tr>
                    <tr><td>Lanche: <input type="text" name="<?= $dia ?>_lanche_manha" required></td></tr>
                    <tr><td>Acompanhamento: <input type="text" name="<?= $dia ?>_acompanhamento_manha" style="margin-right: 8%;"></td></tr>
                    <tr><td>Fruta: <input type="text" name="<?= $dia ?>_fruta_manha" style="margin-left:1%;" required></td></tr>

                    <tr>
                      <td><b>Almoço</b></td>
                      <td>Cardápio: <textarea name="<?= $dia ?>_almoco" style="margin-right: 3%;"></textarea></td>
                    </tr>

                    <tr><td rowspan="5"><b>Tarde</b></td></tr>
                    <tr><td>Bebida: <input type="text" name="<?= $dia ?>_bebida_tarde" required></td></tr>
                    <tr><td>Lanche: <input type="text" name="<?= $dia ?>_lanche_tarde" required></td></tr>
                    <tr><td>Acompanhamento: <input type="text" name="<?= $dia ?>_acompanhamento_tarde" style="margin-right: 8%;"></td></tr>
                    <tr><td>Fruta: <input type="text" name="<?= $dia ?>_fruta_tarde" required style="margin-left: 1%;"></td></tr>
                  </tbody>
                </table>
              </div>

              <div class="no-class" id="<?= $dia ?>_no_class" style="display: none;">Não haverá aula neste dia.</div>

            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

      <div class="botao">
        <button class="salvar" type="submit"><b>Salvar e Enviar</b></button>
      </div>
    </form>
    <br/>
    <?php if (isset($_GET['sucesso'])): ?>
  <div style="background: #fd9c14; color: white; padding: 10px; margin-bottom: 15px; border: 1px solid #fd9c14; border-radius: 5px;">
    Dados salvos com sucesso!
  </div>
<?php endif; ?>
  </div>
</section>

      <footer class="section footer-variant-2 footer-modern context-dark">
        <div class="footer-brand"><a href="Inicio.php?unidade_escolar=<?php echo $_GET["unidade_escolar"];?>"><img src="./images/8.png" alt="NutriGestão" width="196" height="42"/></a></div>
        <div class="copy">
          <p class="direitos">&copy; 2025 <b>NutriGestão</b> - Todos os direitos reservados</p>
        </div>
        <br><br>
      </footer>

      <script src="js/core.min.js"></script>
      <script src="js/script.js"></script>
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
          window.location.href = "login.php";
        }
      </script>
    </div>
    <script>
        // Função para ativar/desativar campos conforme checkbox
        function toggleCampos(dia) {
          const checkbox = document.getElementById(dia + "_checkbox");
          const campos = document.getElementById(dia + "_campos");
          const noClass = document.getElementById(dia + "_no_class");

          if (checkbox.checked) {
            campos.style.display = "block";
            noClass.style.display = "none";

            campos.querySelectorAll("input, textarea").forEach(el => {
              el.disabled = false;
              if (el.hasAttribute("data-required")) {
                el.setAttribute("required", "required");
              }
            });

          } else {
            campos.style.display = "none";
            noClass.style.display = "block";

            campos.querySelectorAll("input, textarea").forEach(el => {
              el.removeAttribute("required");
            });
          }
        }

        // Atualiza datas dos cards e inputs ao clicar no botão "Definir início da semana"
        // Atualiza datas dos cards e inputs ao clicar no botão "Definir início da semana"
// Atualiza datas dos cards e inputs ao clicar no botão "Definir início da semana"
        document.getElementById('btnDefinirSemana').addEventListener('click', function() {
  const dataInicio = document.getElementById('inicio_semana').value;
  if (!dataInicio) {
    alert('Selecione uma data válida');
    return;
  }

  const dias = ["segunda", "terça", "quarta", "quinta", "sexta"];
  const parts = dataInicio.split('-');
  const dataInicioObj = new Date(parts[0], parts[1] - 1, parts[2]);

  dias.forEach((dia, i) => {
    const novaData = new Date(dataInicioObj);
    novaData.setDate(dataInicioObj.getDate() + i);

    const ano = novaData.getFullYear();
    const mes = String(novaData.getMonth() + 1).padStart(2, '0');
    const diaMes = String(novaData.getDate()).padStart(2, '0');
    
    // Formato para input date (aaaa-mm-dd)
    const dataFormatadaInput = `${ano}-${mes}-${diaMes}`;
    
    // Formato para exibição (dd/mm/aaaa) - igual ao PHP
    const dataFormatadaExibicao = `${diaMes}/${mes}/${ano}`;

    // Atualiza a data no cabeçalho (formato dd/mm/aaaa)
    const spanData = document.getElementById('data_' + dia);
    if (spanData) spanData.textContent = dataFormatadaExibicao;

    // Atualiza o input date dentro do card (formato aaaa-mm-dd)
    const inputData = document.getElementById(dia + '_input_data');
    if (inputData) inputData.value = dataFormatadaInput;
  });
});
      </script>
  </body>
</html>
