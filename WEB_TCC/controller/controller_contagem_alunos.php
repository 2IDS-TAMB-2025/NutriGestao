<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once(__DIR__ . '/../model/model_contagem_alunos.php');

$model = new ContagemModel();

$salaFiltro = isset($_GET['sala']) && $_GET['sala'] !== '' ? $_GET['sala'] : null;
$dataFiltro = isset($_GET['data']) && $_GET['data'] !== '' ? $_GET['data'] : date('Y-m-d');

if (!isset($_SESSION['cpf_usuario'])) {
    die("Usuário não identificado. Faça o login novamente.");
}

$cpf_usuario = $_SESSION['cpf_usuario'];


$dadosTurmas = $model->buscarPorFiltro($salaFiltro, $dataFiltro, $cpf_usuario);
?>
