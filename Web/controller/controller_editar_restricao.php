<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../model/model_tabela_restricoes.php';

if (!isset($_SESSION['unidade_escolar'])) {
    die("Usuário não identificado. Faça o login novamente.");
}

$unidade_escolar = $_SESSION['unidade_escolar'];
$model = new TabelaRestricoesModel();

// Buscar dados atuais se estiver editando
$dados_atuais = [];
if (!empty($_GET['id'])) {
    $id = intval($_GET['id']);
    $dados_atuais = $model->getRestricaoPorId($id);
    
    if (!$dados_atuais) {
        die("Registro não encontrado.");
    }
}

// Processar atualização
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['id'])) {
    $id = intval($_POST['id']);
    
    $dados = [];
    $campos = [
        'nome_aluno', 'telefone_responsavel', 'tipo_restricao', 'turma',
        'nome_profissional', 'registro_profissional', 'anotacoes_sintomas'
    ];

    foreach ($campos as $campo) {
        if (empty($_POST[$campo])) {
            die("Erro: O campo $campo é obrigatório.");
        }
        $dados[$campo] = trim($_POST[$campo]);
    }

    $turmas_validas = [
        "6° EF2 A","6° EF2 B","7° EF2 A","7° EF2 B",
        "8° EF2 A","8° EF2 B","9° EF2 A","9° EF2 B",
        "1° EM A","1° EM B","2° EM A","2° EM B","3° EM A","3° EM B"
    ];

    if (!in_array($dados['turma'], $turmas_validas)) {
        die("Erro: Turma inválida.");
    }

    $arquivo = $_FILES['documento_medico'] ?? null;

    $atualizou = $model->atualizarRestricao($id, $dados, $arquivo);

    if ($atualizou) {
        header("Location: tabela_restricoes.php?unidade_escolar=".$unidade_escolar);
        exit;
    } else {
        echo "Erro ao atualizar os dados. Tente novamente.";
    }
}
?>