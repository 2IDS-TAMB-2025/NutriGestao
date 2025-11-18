<?php
require_once __DIR__ . '/../controller/controller_contagem_alunos.php';
require_once '../controller/controller_login.php'; 

$salaFiltro = isset($_GET['sala']) ? $_GET['sala'] : '';
$dataFiltro = isset($_GET['data']) ? $_GET['data'] : date('Y-m-d');

?>
<!DOCTYPE html>
<html class="wide wow-animation" lang="pt-BR">
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
    <link rel="stylesheet" href="css/contagem.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta http-equiv="refresh" content="60">
  </head>
  <body>
    <div class="preloader">
      <div class="preloader-body">
        <div class="cssload-container"><span></span><span></span><span></span><span></span></div>
      </div>
    </div>

    <div class="page">
      <header class="section page-header">
        <div class="rd-navbar-wrap rd-navbar-modern-wrap">
          <nav class="rd-navbar rd-navbar-modern">
            <div class="rd-navbar-brand"><img src="./images/8.png"/></div>
            <div class="rd-navbar-main-outer">
              <div class="rd-navbar-main">
                
                <div class="rd-navbar-main-element">
                  <div class="rd-navbar-nav-wrap">
                    <ul class="rd-navbar-nav">
                      <li class="rd-nav-item "><a class="rd-nav-link" href="Inicio.php?unidade_escolar=<?php echo $_GET["unidade_escolar"];?>"><b id="link">Início</b></a></li>
                      <li class="rd-nav-item "><a class="rd-nav-link" href="refeicao.php?unidade_escolar=<?php echo $_GET["unidade_escolar"];?>"><b id="link">Refeições</b></a></li>
                      <li class="rd-nav-item"><a class="rd-nav-link" href="desperdicio.php?unidade_escolar=<?php echo $_GET["unidade_escolar"];?>"><b id="link">Desperdícios</b></a></li>
                      <li class="rd-nav-item"><a class="rd-nav-link" href="contagem.php?unidade_escolar=<?php echo $_GET["unidade_escolar"];?>"><b id="link">Contagem</b></a></li>
                      <li class="rd-nav-item"><a class="rd-nav-link" href="tabela_restricoes.php?unidade_escolar=<?php echo $_GET["unidade_escolar"];?>"><b id="link">Restricões & Dietas</b></a></li>
                      <li class="rd-nav-item"><a class="rd-nav-link" href="cardapio.php?unidade_escolar=<?php echo $_GET["unidade_escolar"];?>"><b id="link">Cardápio</b></a></li>
                    </ul>
                    <!-- Perfil -->
                    <div class="profile-container">
                      <div class="profile-icon" id="profileIcon">
                        <b style="color: #f89200;"><?= strtoupper(substr($_SESSION['email'], 0, 2)) ?></b>
                      </div>
                      <div class="dropdown" id="dropdownMenu">
                        <p style="margin: 5px 0;font-size:15px"><strong>Email:</strong> <?= htmlspecialchars($_SESSION['email'] ?? '-') ?></p>
                        <p style="margin: 5px 0;font-size:15px"><strong>Unidade Escolar:</strong> <?= htmlspecialchars($_SESSION['unidade_escolar'] ?? '-') ?></p>
                        <hr><br/>
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

      <div class="conteudo" style=" margin: 0 160px;">
        
        <div class="card">
<h3 class="titulo" style="font-size: 50px;">Contagem de Lanches - Data: <?= date('d/m/Y', strtotime($dataFiltro)) ?></h3>

        <div class="filtro">
    <form method="GET" action="" id="filterForm">
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

        <!-- Campo hidden para preservar unidade_escolar -->
        <input type="hidden" name="unidade_escolar" 
               value="<?= isset($_GET['unidade_escolar']) ? htmlspecialchars($_GET['unidade_escolar']) : '' ?>">

        <button type="submit">Aplicar Filtro</button>

        <button type="button" 
            onclick="window.location.href='contagem.php?unidade_escolar=<?= isset($_GET['unidade_escolar']) ? urlencode($_GET['unidade_escolar']) : '' ?>'">
            Limpar Filtros
        </button>
    </form>
</div>

<script>
// Garantir que o unidade_escolar seja preservado mesmo se houver algum problema
document.getElementById('filterForm').addEventListener('submit', function(e) {
    const urlParams = new URLSearchParams(window.location.search);
    const unidadeEscolar = urlParams.get('unidade_escolar');
    
    if (unidadeEscolar && !this.querySelector('input[name="unidade_escolar"]').value) {
        this.querySelector('input[name="unidade_escolar"]').value = unidadeEscolar;
    }
});
</script>


          <p class="subtitulo"><b>Totais Gerais</b></p>
          <div class="totais-container">
            <div class="total-manha">
              <h4 class="total-titulo">Café da Manhã</h4>
              <p style="margin: 5px 0;"><strong>Total Lanches:</strong> <span id="totalLancheManha">0</span></p>
              <p style="margin: 5px 0;"><strong>Total Bebidas:</strong> <span id="totalBebidaManha">0</span></p>
            </div>
            <div class="total-tarde">
              <h4 class="total-titulo">Café da Tarde</h4>
              <p style="margin: 5px 0;"><strong>Total Lanches:</strong> <span id="totalLancheTarde">0</span></p>
              <p style="margin: 5px 0;"><strong>Total Bebidas:</strong> <span id="totalBebidaTarde">0</span></p>
            </div>
          </div>
          <h3 class="subtitulo">Contagem de Alimentos de Lanches da Tarde e Manhã</h3>
          <table id="wasteTable">
            <thead>
              <tr>
                <th>Tipo de Refeição</th>
                <th colspan="2">Café da Manhã</th>
                <th colspan="2">Café da Tarde</th>
                <th>Data</th>
              </tr>
              <tr id="sla">
                <th>Sala</th>
                <th>Lanche (QT)</th>
                <th>Bebida (QT)</th>
                <th>Lanche (QT)</th>
                <th>Bebida (QT)</th>
                <th>DD/MM/AAAA</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $turmasPermitidas = [
                  "2º Ano E.M A","2º Ano E.M B","3º Ano E.M A","3º Ano E.M B",
                  "6º Ano Ef2 A","6º Ano Ef2 B","7º Ano Ef2 A","7º Ano Ef2 B",
                  "8º Ano Ef2 A","8º Ano Ef2 B","9º Ano Ef2 A","9º Ano Ef2 B",
                  "1º Ano E.M A","1º Ano E.M B"
                ];

                // Arrays para separar salas com e sem registro
                $salasComRegistro = [];
                $salasSemRegistro = [];
                
                // Variáveis para calcular totais
                $totalLancheManha = 0;
                $totalBebidaManha = 0;
                $totalLancheTarde = 0;
                $totalBebidaTarde = 0;

                if (!empty($dadosTurmas)) :
                  foreach ($dadosTurmas as $linha):
                    if (in_array($linha['TURMA'], $turmasPermitidas)) {
                      $temDados = !empty($linha['QUANTIDADE_LANCHE_MANHA']) || !empty($linha['QUANTIDADE_BEBIDA_MANHA']) || 
                                 !empty($linha['QUANTIDADE_LANCHE_TARDE']) || !empty($linha['QUANTIDADE_BEBIDA_TARDE']);
                      
                      if ($temDados) {
                        $salasComRegistro[] = $linha;
                        
                        // Somar totais
                        $totalLancheManha += intval($linha['QUANTIDADE_LANCHE_MANHA'] ?? 0);
                        $totalBebidaManha += intval($linha['QUANTIDADE_BEBIDA_MANHA'] ?? 0);
                        $totalLancheTarde += intval($linha['QUANTIDADE_LANCHE_TARDE'] ?? 0);
                        $totalBebidaTarde += intval($linha['QUANTIDADE_BEBIDA_TARDE'] ?? 0);
                      } else {
                        $salasSemRegistro[] = $linha;
                      }
                    }
                  endforeach;
                endif;

                // Exibir salas COM registro
                if (!empty($salasComRegistro)) :
                  foreach ($salasComRegistro as $linha):
              ?>
                    <tr class="com-registro">
                      <td><?= htmlspecialchars($linha['TURMA']); ?></td>
                      <td><?= !empty($linha['QUANTIDADE_LANCHE_MANHA']) ? htmlspecialchars($linha['QUANTIDADE_LANCHE_MANHA']) : '<span style="color:red;">Sem registro</span>'; ?></td>
                      <td><?= !empty($linha['QUANTIDADE_BEBIDA_MANHA']) ? htmlspecialchars($linha['QUANTIDADE_BEBIDA_MANHA']) : '<span style="color:red;">Sem registro</span>'; ?></td>
                      <td><?= !empty($linha['QUANTIDADE_LANCHE_TARDE']) ? htmlspecialchars($linha['QUANTIDADE_LANCHE_TARDE']) : '<span style="color:red;">Sem registro</span>'; ?></td>
                      <td><?= !empty($linha['QUANTIDADE_BEBIDA_TARDE']) ? htmlspecialchars($linha['QUANTIDADE_BEBIDA_TARDE']) : '<span style="color:red;">Sem registro</span>'; ?></td>
                      <td><?= !empty($linha['DATA']) ? date('d/m/Y', strtotime($linha['DATA'])) : '<span style="color:red;">Sem registro</span>'; ?></td>
                    </tr>
              <?php
                  endforeach;
                endif;

                // Exibir salas SEM registro (se não houver filtro aplicado)
                if (empty($salaFiltro) && !empty($salasSemRegistro)) :
                  foreach ($salasSemRegistro as $linha):
              ?>
                    <tr class="sem-registro">
                      <td><?= htmlspecialchars($linha['TURMA']); ?></td>
                      <td colspan="5">Ainda não enviou contagem</td>
                    </tr>
              <?php
                  endforeach;
                endif;

                // Mensagem quando não há registros
                if (empty($salasComRegistro) && empty($salasSemRegistro)): 
              ?>
                  <tr><td colspan="6">Nenhuma contagem encontrada para as turmas listadas.</td></tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>

      <footer class="section footer-variant-2 footer-modern context-dark section-top-image section-top-image-dark">
        <div class="qnf"><a href="Inicio.php?unidade_escolar=<?php echo $_GET["unidade_escolar"];?>"><img src="./images/8.png" alt="" width="196" height="42"/></a></div>
        <div class="copy">
          <p class="direitos">&copy; 2025 <b>NutriGestão</b> - Todos os direitos reservados</p>
        </div>
        <br><br>
      </footer>
    </div>

    <div class="snackbars" id="form-output-global"></div>
    <script src="js/core.min.js"></script>
    <script src="js/script.js"></script>
    <script>
      // Atualizar totais na página
      document.getElementById('totalLancheManha').textContent = '<?= $totalLancheManha ?>';
      document.getElementById('totalBebidaManha').textContent = '<?= $totalBebidaManha ?>';
      document.getElementById('totalLancheTarde').textContent = '<?= $totalLancheTarde ?>';
      document.getElementById('totalBebidaTarde').textContent = '<?= $totalBebidaTarde ?>';

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
  </body>
</html>