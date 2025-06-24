<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../model/model_cardapio.php';

if (!isset($_SESSION['cpf_usuario'])) {
    die("Usuário não identificado. Faça o login novamente.");
}

$cpf_usuario = $_SESSION['cpf_usuario'];


$model = new CardapioModel();

$dias_semana = ["segunda", "terça", "quarta", "quinta", "sexta"];
$semana_referencia = $_POST['inicio_semana'] ?? date('Y-m-d');

foreach ($dias_semana as $dia) {
    $tem_aula = isset($_POST["{$dia}_tem_aula"]);

    if ($tem_aula) {
        $data = $_POST["{$dia}_data_manha"] ?? '';
        $bebida_manha = $_POST["{$dia}_bebida_manha"] ?? '';
        $lanche_manha = $_POST["{$dia}_lanche_manha"] ?? '';
        $acompanhamento_manha = $_POST["{$dia}_acompanhamento_manha"] ?? '';
        $fruta_manha = $_POST["{$dia}_fruta_manha"] ?? '';

        $almoco = $_POST["{$dia}_almoco"] ?? '';

        $bebida_tarde = $_POST["{$dia}_bebida_tarde"] ?? '';
        $lanche_tarde = $_POST["{$dia}_lanche_tarde"] ?? '';
        $acompanhamento_tarde = $_POST["{$dia}_acompanhamento_tarde"] ?? '';
        $fruta_tarde = $_POST["{$dia}_fruta_tarde"] ?? '';
    } else {
        $data = $_POST["{$dia}_data_manha"] ?? $semana_referencia;

        $bebida_manha = '';
        $lanche_manha = '';
        $acompanhamento_manha = '';
        $fruta_manha = '';

        $almoco = '';

        $bebida_tarde = '';
        $lanche_tarde = '';
        $acompanhamento_tarde = '';
        $fruta_tarde = '';
    }

    $dados = [
        'data' => $data,
        'dia_semana' => ucfirst($dia),
        'semana_referencia' => $semana_referencia,
        'bebida_manha' => $bebida_manha,
        'lanche_manha' => $lanche_manha,
        'acompanhamento_manha' => $acompanhamento_manha,
        'fruta_manha' => $fruta_manha,
        'almoco' => $almoco,
        'bebida_tarde' => $bebida_tarde,
        'lanche_tarde' => $lanche_tarde,
        'acompanhamento_tarde' => $acompanhamento_tarde,
        'fruta_tarde' => $fruta_tarde,
        'cpf_usuario' => $cpf_usuario,  // Adiciona o CPF do usuário aqui
    ];

    $model->salvarOuAtualizarCardapio($dados);
}
header("Location: ../view/cardapio.php?sucesso=1&cpf=".$cpf_usuario);
exit;
