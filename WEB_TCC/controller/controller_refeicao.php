<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../model/model_refeicao.php';


$refeicao = new Refeicao();
$cpf_usuario = $_SESSION['cpf_usuario'];

if (isset($_POST['quantidade_diaria'])) {
    $diaria = intval($_POST['quantidade_diaria']);

    if ($diaria >= 0) {
        $inserido = $refeicao->inserirQuantidadeDiaria($diaria);

        if ($inserido) {
            header("Location: ../view/refeicao.php?sucesso=1&cpf=".$cpf_usuario);
            exit;
        } else {
            echo "Erro ao inserir os dados.";
        }
    } else {
        echo "Quantidade diária inválida.";
    }
}

// Sempre carregar os dados para o relatório
$dados_diario = $refeicao->dadosRefeicoesDiario();
$dados_semanais = $refeicao->dadosRefeicoesSemanais();
$dados_mensais = $refeicao->dadosRefeicoesMensais();
?>