<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once(__DIR__ . '/../model/model_contagem_alunos.php');

$model = new ContagemModel();

$salaFiltro = isset($_GET['sala']) && $_GET['sala'] !== '' ? $_GET['sala'] : null;
$dataFiltro = isset($_GET['data']) && $_GET['data'] !== '' ? $_GET['data'] : date('Y-m-d');

// esta fazendo a linha abaixo, para nao deixar realizar o filtro se não estiver logado
if (!isset($_SESSION['unidade_escolar'])) {
    die("Usuário não identificado. Faça o login novamente."); // trocar para o redicionamento para a tela de login
}

$unidade_escolar = $_SESSION['unidade_escolar'];



$dadosTurmas = $model->buscarPorFiltro($salaFiltro, $dataFiltro, $unidade_escolar);
?>
