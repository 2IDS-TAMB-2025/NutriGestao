<?php 
require_once '../controller/controller_desperdicio.php'; 
require_once '../controller/controller_relatorio.php'; 
?>
<!DOCTYPE html>
<html class="wide wow-animation" lang="pt-br">
<head>
  <title>NutriGestão-Desperdício</title>
  <meta name="format-detection" content="telephone=no">
  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta charset="utf-8">
  <meta http-equiv="refresh" content="60">

  <link rel="icon" href="./images/2.png" type="image/x-icon">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/fonts.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <style>
    table { width: 100%; border-collapse: collapse; margin: 20px 0; overflow: hidden; border-radius: 5px; }
    th, td { border: 1px solid #ddd; padding: 8px; text-align: center;}
    th { background-color: #ff9900c2; color: white; }
    label { font-weight: bold; margin-right: 10px; }
    input[type="text"], input[type="date"] { padding: 5px; border: 1px solid #ccc; border-radius: 4px; width: 200px; }
    tr:nth-child(even) { background-color: #f2f2f2; }
    tr:hover { background-color: #ddd; }
    button { display: block; padding: 10px 20px; font-size: 16px; color: white; border: none; border-radius: 5px; cursor: pointer; width: 15%; background-color: #ff9900c2; margin-left:2%; }
    button:hover { background-color: #ff9800; }
    tbody { color: #000; }
    .botao { width: 60%; display: flex; margin-left: 30%; margin-top: 5%; }
    .filtro { text-align: center; font-size: 20px; color: #000; }
    #filtro { width: 10%; background-color: #ff9900c2; }
    .montserrat { font-family: "Montserrat", sans-serif; font-optical-sizing: auto; font-weight: weight; font-style: normal; }
    #link { font-family: "Montserrat", sans-serif; }
    .dropdown.hidden { display: none; } 
    form { margin-bottom: 2%; display: flex; margin-top: 2%; margin-left: 24%; width: 100%; }
  </style>
</head>
<body>
  <div class="page">
    <header class="section page-header">
      <div class="rd-navbar-wrap rd-navbar-modern-wrap">
        <nav class="rd-navbar rd-navbar-modern">
          <div class="rd-navbar-brand"><img src="./images/8.png"/></div>
          <div class="rd-navbar-main-outer">
            <div class="rd-navbar-main">
              <div class="rd-navbar-panel">
                <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                <div class="rd-navbar-main-element">
                  <div class="rd-navbar-nav-wrap">
                    <ul class="rd-navbar-nav">
                      <li class="rd-nav-item"><a class="rd-nav-link" href="Inicio.php?unidade_escolar=<?php echo $_GET["unidade_escolar"];?>"><b id="link">Início</b></a></li>
                      <li class="rd-nav-item"><a class="rd-nav-link" href="refeicao.php?unidade_escolar=<?php echo $_GET["unidade_escolar"];?>"><b id="link">Refeições</b></a></li>
                      <li class="rd-nav-item"><a class="rd-nav-link" href="desperdicio.php?unidade_escolar=<?php echo $_GET["unidade_escolar"];?>"><b id="link">Desperdícios</b></a></li>
                      <li class="rd-nav-item"><a class="rd-nav-link" href="contagem.php?unidade_escolar=<?php echo $_GET["unidade_escolar"];?>"><b id="link">Contagem</b></a></li>
                      <li class="rd-nav-item"><a class="rd-nav-link" href="tabela_restricoes.php?unidade_escolar=<?php echo $_GET["unidade_escolar"];?>"><b id="link">Restricões & Dietas</b></a></li>
                      <li class="rd-nav-item"><a class="rd-nav-link" href="cardapio.php?unidade_escolar=<?php echo $_GET["unidade_escolar"];?>"><b id="link">Cardápio</b></a></li>
                    </ul>
                    <div class="profile-container" style="position: relative; margin-left: 20px;">
                      <div class="profile-icon" id="profileIcon" style="width: 40px; height: 40px; background-color: #ff990032; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer;">
                        <b style="color: #f89200;"><?= strtoupper(substr($_SESSION['email'], 0, 2)) ?></b>
                      </div>
                      <div class="dropdown hidden" id="dropdownMenu" style="position: absolute; top: 50px; right: 0; background-color: white; border: 1px solid #ddd; box-shadow: 0 2px 5px rgba(0,0,0,0.1); border-radius: 8px; padding: 10px; z-index: 1000; color:#757575; width:250px;">
                        <p style="margin: 5px 0; font-size:15px;"><strong>Email:</strong> <?= htmlspecialchars($_SESSION['email'] ?? '-') ?></p>
                        <p style="margin: 5px 0; font-size:15px;"><strong>Unidade Escolar:</strong> <?= htmlspecialchars($_SESSION['unidade_escolar'] ?? '-') ?></p>
                        <hr><br/>
                        <button onclick="logout()" style="background-color: #f89200; border: none; padding: 8px 12px; border-radius: 5px; color: white; cursor: pointer; width: 140px;font-size: 15px;margin-left: 20%;">Sair</button>
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
    <div class="card">
        <h3>Desperdício Alimentar:</h3>
        <p><strong>Diário:</strong> <?= number_format($dados_diario['SOMA_DIARIA'], 2) ?> Kg</p>
        <p><strong>Semanal:</strong> <?= number_format($dados_semanais['SOMA_SEMANAL'], 2) ?> Kg</p>
        <p><strong>Mensal:</strong> <?= number_format($dados_mensais['SOMA_MENSAL'], 2) ?> Kg</p>
    </div>

    <div class="card">
        <h3>Relatórios de Consumo e Desperdício de Alimentos</h3>
        <div class="filtro">
            <form method="GET">
                <label for="filterDate">Filtrar por Data:</label>
                <input type="date" id="filterDate" name="data" value="<?= htmlspecialchars($dataFiltro ?? '') ?>">
                <input type="hidden" name="unidade_escolar" value="<?= htmlspecialchars($_GET['unidade_escolar'] ?? '') ?>">
                <button type="submit">Aplicar Filtro</button>
                <button type="button" onclick="window.location='desperdicio.php?unidade_escolar=<?= urlencode($_GET['unidade_escolar']) ?>'">Limpar Filtro</button>
            </form>
        </div>
        <table>
    <thead>
        <tr>
            <th>Data</th>
            <th>Quantidade Servida (Kg)</th>
            <th>Total de Alunos</th>
            <th>Desperdício Total (Kg)</th>
            <th>Desperdício Médio por Aluno (Kg)</th>
            <th>Taxa de Desperdício</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($dados)) : ?>
            <?php foreach ($dados as $linha) : ?>
                <?php 
                $quantidade_servida = $linha['quantidade_diaria'] ?? 0;
                $total_alunos = $linha['total_alunos'] ?? 0;
                $desperdicio_total = $linha['desperdicio_diario'] ?? 0;
                $desperdicio_medio = $total_alunos > 0 ? $desperdicio_total / $total_alunos : 0;
                $taxa_desperdicio = $quantidade_servida > 0 ? ($desperdicio_total / $quantidade_servida) * 100 : 0;
                ?>
                <tr>
                    <td><?= date('d/m/Y', strtotime($linha['DATA_REGISTRO'])) ?></td>
                    <td><?= $quantidade_servida > 0 ? number_format($quantidade_servida, 2) . ' Kg' : '—' ?></td>
                    <td><?= $total_alunos > 0 ? number_format($total_alunos, 0) : '—' ?></td>
                    <td><?= $desperdicio_total > 0 ? number_format($desperdicio_total, 2) . ' Kg' : '—' ?></td>
                    <td><?= $total_alunos > 0 ? number_format($desperdicio_medio, 2) . ' Kg' : '—' ?></td>
                    <td><?= $quantidade_servida > 0 ? number_format($taxa_desperdicio, 2) . ' %' : '—' ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr><td colspan="6">Nenhum dado de desperdício encontrado.</td></tr>
        <?php endif; ?>
    </tbody>
</table>
    </div>
</div>

    <footer class="section footer-variant-2 footer-modern context-dark section-top-image section-top-image-dark">
      <div class="footer-brand"><a href="Inicio.php?unidade_escolar=<?php echo $_GET["unidade_escolar"];?>"><img src="./images/8.png" alt="" width="196" height="42"/></a></div>
      <div class="copy">
        <p class="direitos">&copy; 2025 <b>NutriGestão</b> - Todos os direitos reservados</p>
      </div>
      <br><br>
    </footer>
  </div>

  <script src="js/core.min.js"></script>
  <script src="js/script.js"></script>
  <script>
    const profileIcon = document.getElementById('profileIcon');
    const dropdownMenu = document.getElementById('dropdownMenu');

    profileIcon.addEventListener('click', (e) => {
      e.stopPropagation();
      dropdownMenu.classList.toggle('hidden');
    });

    window.addEventListener('click', (e) => {
      if (!profileIcon.contains(e.target) && !dropdownMenu.contains(e.target)) {
        dropdownMenu.classList.add('hidden');
      }
    });

    private function calibrarDesperdicio($valor) {
    return max(0, $valor - 0.45);
  }

    function logout() {
      window.location.href = "login.php";
    }
  </script>
</body>
</html>
