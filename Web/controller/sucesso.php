<?php
require_once './controller_login.php'; 
$unidade_escolar = $_GET['unidade_escolar'] ?? null;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Cadastro Realizado</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  <link rel="icon" href="../view/images/2.png" type="image/x-icon">
</head>
<style>
  #informacoes_salvas{ 
    color: #ff9800;
  }
  #logo_informacoes_salvas{
    width: 50%;
    margin-bottom: 0;
    margin-top: 0;
  }
</style>
<body class="bg-gray-100 flex items-center justify-center h-screen">
  
  <div class="bg-white p-8 rounded-lg shadow-lg max-w-md text-center">
    <img src="../view/images/8.png" alt="NutriGestão" id="logo_informacoes_salvas" class="mx-auto mb-4 w-28">
    <h1 id="informacoes_salvas"class="text-2xl font-bold text-green-600 mb-2">Informações Salvas com Sucesso!</h1>
    <p class="text-gray-700 mb-6">Os dados do aluno foram registrados corretamente no sistema.</p>
    <a href="../view/restricoes_dietas.php?unidade_escolar=<?= urlencode($unidade_escolar) ?>" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded">
      Voltar
    </a>
    <?print($unidade_escolar);
    exit;?>
  </div>
</body>
</html>
