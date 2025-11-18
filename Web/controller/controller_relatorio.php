<?php 
if (session_status() === PHP_SESSION_NONE) session_start();
require_once "../model/model_relatorio.php";

$relatorio = new Relatorio();
$dataFiltro = $_GET['data'] ?? null;
$unidade_escolar = $_GET['unidade_escolar'] ?? $_SESSION['unidade_escolar'] ?? '';

// Relatório completo
$dados = $relatorio->getRelatorio($dataFiltro, $unidade_escolar);
?>