<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}// Garante que a sessão está ativa
require_once "../model/model_relatorio.php";

$relatorio = new Relatorio();

$dataFiltro = null;
if (isset($_GET['data']) && !empty($_GET['data'])) {
    $dataFiltro = $_GET['data'];
}

// Verifica se o usuário está logado e tem CPF
if (!isset($_SESSION['cpf_usuario'])) {
    die("Usuário não identificado. Faça o login novamente.");
}

$cpf_usuario = $_SESSION['cpf_usuario'];


// Passa o CPF para a model
$dados = $relatorio->getRelatorio($dataFiltro, $cpf_usuario);
?>
