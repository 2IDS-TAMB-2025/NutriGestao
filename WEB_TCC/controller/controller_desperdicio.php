<?php
require_once '../model/model_desperdicio.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$cpf_usuario = $_SESSION['cpf_usuario'] ?? null;


if (!$cpf_usuario) {
    die("Erro: usuário não identificado.");
}

$desperdicio = new Desperdicio();

if (
    isset($_POST['DESPERDICIO_DIARIO']) || 
    isset($_POST['DESPERDICIO_SEMANAL']) || 
    isset($_POST['DESPERDICIO_MENSAL'])
) {
    $diaria = intval($_POST['DESPERDICIO_DIARIO']);
    $semanal = intval($_POST['DESPERDICIO_SEMANAL']);
    $mensal = intval($_POST['DESPERDICIO_MENSAL']);

    $inserido = $desperdicio->inserirQuantidades($diaria, $semanal, $mensal, $cpf_usuario);

    if ($inserido) {
        header("Location: ../view/desperdicio.php?cpf=12345678923");
        exit;
    } else {
        echo "Erro ao inserir os dados.";
    }
}

// Sempre carregar os dados do usuário logado
$dados_diario = $desperdicio->dadosDesperdiciosDiario($cpf_usuario);
$dados_semanais = $desperdicio->dadosDesperdiciosSemanais($cpf_usuario);
$dados_mensais = $desperdicio->dadosDesperdiciosMensais($cpf_usuario);
?>
