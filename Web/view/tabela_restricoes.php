<?php 
require_once '../controller/controller_login.php'; 
require_once '../controller/controller_tabela_restricoes.php'; 
?>
<!DOCTYPE html>
<html class="wide wow-animation" lang="pt-br">
<head>
  <title>NutriGestão-Desperdício</title>
  <meta name="format-detection" content="telephone=no">
  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta charset="utf-8">
  <link rel="icon" href="./images/2.png" type="image/x-icon">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

  <style>
    table { width: 100%; border-collapse: collapse; margin: 20px 0; border-radius: 5px; overflow: hidden; }
    th, td { border: 1px solid #ddd; padding: 8px;}
    th { background-color: #ff9900c2; color: white; text-align: center;}
    label { font-weight: bold; margin-right: 10px; }
    input[type="text"] { padding: 5px; border: 1px solid #ccc; border-radius: 4px; width: 200px; }
    tr:nth-child(even) { background-color: #f2f2f2; }
    tr:hover { background-color: #ddd; }
    button { display: block; padding: 7px 15px; font-size: 12px; color: white; border: none; border-radius: 5px; cursor: pointer; background-color: #ff9900c2; margin-left:2%; }
    button:hover { background-color: #ff9800; }
    tbody { color: #000; }
    .botao { width: 60%; display: flex; margin-left: 30%; margin-top: 5%; }
    .montserrat { font-family: "Montserrat", sans-serif; }
    #link { font-family: "Montserrat", sans-serif; }
    .dropdown.hidden { display: none; }
    form { margin-bottom: 2%; display: flex; margin-top: 2%; margin-left: 24%; width: 100%; }
    #exluir { width: 100%; }
    
    /* NOVO CSS PARA OS BOTÕES LADO A LADO */
    .botoes-acao {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
    }
    
    .botoes-acao form {
        margin: 0 !important;
        display: inline-block;
    }
    
    .botoes-acao form button {
        margin: 0;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }
  </style>
</head>

<body>
  <div class="page">
    
    <!-- MENU -->
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
                      <li class="rd-nav-item"><a class="rd-nav-link" href="tabela_restricoes.php?unidade_escolar=<?php echo $_GET["unidade_escolar"];?>"><b id="link">Restrições & Dietas</b></a></li>
                      <li class="rd-nav-item"><a class="rd-nav-link" href="cardapio.php?unidade_escolar=<?php echo $_GET["unidade_escolar"];?>"><b id="link">Cardápio</b></a></li>
                    </ul>

                    <!-- ÍCONE PERFIL -->
                    <div class="profile-container" style="position: relative; margin-left: 20px;">
                      <div class="profile-icon" id="profileIcon" style="width: 40px; height: 40px; background-color: #ff990032; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer;">
                        <b style="color: #f89200;"><?= strtoupper(substr($_SESSION['email'], 0, 2)) ?></b>
                      </div>

                      <div class="dropdown hidden" id="dropdownMenu" 
                        style="position: absolute; top: 50px; right: 0; background-color: white; border: 1px solid #ddd; 
                        box-shadow: 0 2px 5px rgba(0,0,0,0.1); border-radius: 8px; padding: 10px; z-index: 1000; 
                        color:#757575; width:250px;">
                        
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
        <h3>Tabela de Alunos com Restrições Alimentares</h3>

        <table>
          <thead>
            <tr>
              <th>Nome do aluno</th>
              <th>Turma</th>
              <th>Tipo de restrição</th>
              <th>Telefone do Responsável</th>
              <th>Profissional da Saúde</th>
              <th>Anotações sobre sintomas</th>
              <th>Documento médico</th>
              <th>Configuração</th>
            </tr>
          </thead>

          <tbody>
            <?php if (!empty($dados)) : ?>
            <?php foreach ($dados as $linha) : ?>
              <tr>
                <td><?= htmlspecialchars($linha['nome_aluno']) ?></td>
                <td><?= htmlspecialchars($linha['turma']) ?></td>
                <td><?= htmlspecialchars($linha['tipo_restricao']) ?></td>
                <td><?= htmlspecialchars($linha['telefone_responsavel']) ?></td>
                <td><?= htmlspecialchars($linha['nome_profissional'] ?? '-') ?></td>
                <td><?= htmlspecialchars($linha['anotacoes_sintomas'] ?? '-') ?></td>

                <td>
                  <form method="GET" action="../model/uploads/<?= htmlspecialchars($linha['documento_medico']) ?>" style="margin:0;" target="_blank">
                      <?php if (!empty($linha['documento_medico'])): ?>
                          <button type="submit" style="background-color: #f89200; padding: 7px 15px; color:white; border:none; border-radius:5px; cursor:pointer;">
                              <b>Ver Documento</b>
                          </button>
                      <?php else: ?>
                          <button type="button" disabled style="background-color: #ccc; padding: 7px 15px; color:#666; border:none; border-radius:5px; cursor:pointer;">
                              Nenhum
                          </button>
                      <?php endif; ?>
                  </form>
                </td>
                <td>
                  <div class="botoes-acao">
                    <!-- Botão Excluir -->
                    <form method="GET" style="margin:0;">
                        <input type="hidden" name="excluir_id" value="<?= $linha['id'] ?>">
                        <button type="submit" style="background-color: transparent; border:none; cursor:pointer;">
                            <img src="./images/11.png" style="width:28px; height:28px; color: black;" alt="Excluir">
                        </button>
                    </form>
                    <!-- Botão Editar -->
                    <form method="POST" style="margin:0;">
                        <input type="hidden" name="editar_id" value="<?= $linha['id'] ?>">
                        <button type="submit" style="background-color: transparent; border:none; cursor:pointer;">
                            <img src="./images/12.png" style="width:28px; height:28px; color: black;" alt="Editar">
                        </button>
                    </form>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
            <?php else : ?>
              <tr><td colspan="9">Nenhum dado encontrado.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>

        <br/>

        <div class="text-right mt-6" style="display:flex; justify-content: flex-end;">
          <button style="background-color: #ff9800; color:white; text-decoration:none;" class="text-white font-semibold py-2 px-6 rounded-lg hover:brightness-90">
            <a href="restricoes_dietas.php?unidade_escolar=<?php echo $_GET["unidade_escolar"];?>" style="color: white;"><b>Registrar restrição</b></a>
          </button>
        </div>

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

    function logout() {
      window.location.href = "login.php";
    }
  </script>
</body>
</html>