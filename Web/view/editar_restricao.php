<?php
require_once '../controller/controller_login.php'; 
require_once '../controller/controller_editar_restricao.php';
?>
<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
  <head>
    <title>NutriGestão - Editar Restrição</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <link rel="icon" href="./images/2.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
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
  </head>
  <body class="bg-gray-100 text-gray-800">
    <div class="preloader">
      <div class="preloader-body">
        <div class="cssload-container"><span></span><span></span><span></span><span></span>
        </div>
      </div>
    </div>
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
                        <li class="rd-nav-item "><a class="rd-nav-link" href="Inicio.php?unidade_escolar=<?php echo $_GET["unidade_escolar"];?>"><b id="link">Início</b></a></li>
                        <li class="rd-nav-item "><a class="rd-nav-link" href="refeicao.php?unidade_escolar=<?php echo $_GET["unidade_escolar"];?>"><b id="link">Refeições</b></a></li>
                        <li class="rd-nav-item"><a class="rd-nav-link" href="desperdicio.php?unidade_escolar=<?php echo $_GET["unidade_escolar"];?>"><b id="link">Desperdícios</b></a></li>
                        <li class="rd-nav-item"><a class="rd-nav-link" href="contagem.php?unidade_escolar=<?php echo $_GET["unidade_escolar"];?>"><b id="link">Contagem</b></a></li>
                        <li class="rd-nav-item"><a class="rd-nav-link" href="tabela_restricoes.php?unidade_escolar=<?php echo $_GET["unidade_escolar"];?>"><b id="link">Restrições & Dietas</b></a></li>
                        <li class="rd-nav-item"><a class="rd-nav-link" href="cardapio.php?unidade_escolar=<?php echo $_GET["unidade_escolar"];?>"><b id="link">Cardápio</b></a></li>
                      </ul>
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

      <main class="p-6 space-y-6">
        <!-- CORREÇÃO AQUI: action vazio para submeter para a mesma página -->
        <form method="POST" action="" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?= $dados_atuais['id'] ?>">
          
          <section class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold mb-4">Editar Informações do Aluno</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium" for="nome_aluno">Nome do Aluno</label>
                <input
                  type="text"
                  id="form_rest"
                  name="nome_aluno"
                  class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                  placeholder="Nome completo"
                  value="<?= htmlspecialchars($dados_atuais['nome_aluno']) ?>"
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
                  value="<?= htmlspecialchars($dados_atuais['telefone_responsavel']) ?>"
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
                  value="<?= htmlspecialchars($dados_atuais['tipo_restricao']) ?>"
                  required
                />
              </div>
              <div class="relative">
                <label class="block text-sm font-medium">Turma</label>
                <select name="turma" id="form_rest" required
                  class="mt-1 block w-full border border-gray-300 bg-white text-gray-700 py-2 px-3 pr-8 rounded-md appearance-none focus:outline-none focus:ring-2 focus:ring-orange-400">
                  <option value="">Selecione uma turma</option>
                  <?php
                  $turmas = ["6° EF2 A","6° EF2 B","7° EF2 A","7° EF2 B","8° EF2 A","8° EF2 B","9° EF2 A","9° EF2 B","1° EM A","1° EM B","2° EM A","2° EM B","3° EM A","3° EM B"];
                  foreach ($turmas as $turma) {
                      $selected = ($dados_atuais['turma'] == $turma) ? 'selected' : '';
                      echo "<option value='$turma' $selected>$turma</option>";
                  }
                  ?>
                </select>
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
                  placeholder="Ex: Dr. Nome Sobrenome"
                  value="<?= htmlspecialchars($dados_atuais['nome_profissional']) ?>"
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
                  placeholder="Ex: CRM-SP 123456"
                  value="<?= htmlspecialchars($dados_atuais['registro_profissional']) ?>"
                  required
                />
              </div>
              <div class="md:col-span-2">
                <label class="block text-sm font-medium" for="anotacoes_sintomas">Anotações sobre Sintomas/Reações</label>
                <textarea
                  id="form_rest"
                  name="anotacoes_sintomas"
                  class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                  rows="3"
                  placeholder="Detalhes adicionais sobre o caso..."
                  required
                ><?= htmlspecialchars($dados_atuais['anotacoes_sintomas']) ?></textarea>
              </div>
              <div class="md:col-span-2">
                <label class="block text-sm font-medium" for="documento_medico">Alterar Documento Médico (opcional)</label>
                <input
                  type="file"
                  id="form_rest"
                  name="documento_medico"
                  class="mt-1 block w-full text-sm text-gray-500
                    file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0
                    file:text-sm file:font-semibold file:bg-red-600 file:text-white hover:file:bg-red-700"
                />
                <?php if (!empty($dados_atuais['documento_medico'])): ?>
                  <p class="text-sm text-gray-600 mt-2">
                    Documento atual: 
                    <a href="../model/uploads/<?= htmlspecialchars($dados_atuais['documento_medico']) ?>" 
                       target="_blank" class="text-blue-600 hover:underline">
                      Ver documento atual
                    </a>
                  </p>
                <?php else: ?>
                  <p class="text-sm text-gray-600 mt-2">Nenhum documento cadastrado</p>
                <?php endif; ?>
              </div>
            </div>
          </section>

          <div class="text-right mt-6" style="display:flex; justify-content: flex-end;">
            <button
              type="submit"
              style="background-color: #ff9800;"
              class="text-white font-semibold py-2 px-6 rounded-lg hover:brightness-90"
            >
              Atualizar Informações
            </button>
            <div
              style="background-color: #ff9800; color:white; width:20%; margin-left:1%; text-decoration:none;"
              class="text-white font-semibold py-2 px-6 rounded-lg hover:brightness-90 text-center"
            >
              <a href="./tabela_restricoes.php?unidade_escolar=<?php echo $_GET["unidade_escolar"];?>" style="color: white;">Cancelar</a>
            </div>
          </div>
        </form>
      </main>

      <footer class="section footer-variant-2 footer-modern context-dark section-top-image section-top-image-dark">
        <div class="footer-brand"><a href="Inicio.php?unidade_escolar=<?php echo $_GET["unidade_escolar"];?>"><img src="./images/8.png" alt="" width="196" height="42"/></a></div>
        <div class="copy">
          <p class="direitos">&copy; 2025 <b>NutriGestão</b> - Todos os direitos reservados</p>
        </div>
        <br><br>
      </footer>
    </div>
    <div class="snackbars" id="form-output-global"></div>
    <script src="js/core.min.js"></script>
    <script src="js/script.js"></script>
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
      window.location.href = "login.php";
    }
  </script>
</html>