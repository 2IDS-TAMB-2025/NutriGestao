<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../model/model_cardapio.php';

$unidade_escolar = $_SESSION['unidade_escolar'];

$model = new CardapioModel();

$dias_semana = ["segunda", "terça", "quarta", "quinta", "sexta"];
$semana_referencia = $_POST['inicio_semana'] ?? date('Y-m-d');

foreach ($dias_semana as $dia) {
    $tem_aula = isset($_POST["{$dia}_tem_aula"]);
    
    // Pega a data do input hidden (já está no formato MySQL)
    $data = $_POST["{$dia}_data"] ?? '';

    if ($tem_aula) {
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
        // Se não há aula, limpa os campos
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

    // Verifica se a data não está vazia antes de salvar
    if (!empty($data)) {
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
            'unidade_escolar' => $unidade_escolar,
        ];

        $model->salvarOuAtualizarCardapio($dados);
    }
}

header("Location: ../view/cardapio.php?sucesso=1&unidade_escolar=" . urlencode($unidade_escolar));
exit;
?>