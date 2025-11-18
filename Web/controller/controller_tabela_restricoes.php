<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../model/model_tabela_restricoes.php';
$model = new TabelaRestricoesModel();
$unidade_escolar = $_SESSION['unidade_escolar'] ?? null;

// Excluir registro
if (!empty($_GET['excluir_id'])) {
    $id = intval($_GET['excluir_id']);
    $model->excluirAluno($id);
    header("Location: tabela_restricoes.php?unidade_escolar=".$unidade_escolar);
    exit;
}

// Redirecionar para página de edição
if (!empty($_POST['editar_id'])) {
    $id = intval($_POST['editar_id']);
    header("Location: editar_restricao.php?unidade_escolar=".$unidade_escolar."&id=".$id);
    exit;
}

// Salvar novo registro
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['nome_aluno'])) {
    $model->salvarAluno(
        $_POST['nome_aluno'],
        $_POST['turma'],
        $_POST['tipo_restricao'],
        $_POST['telefone_responsavel'],
        $_POST['nome_profissional'],
        $_POST['registro_profissional'],
        $_POST['anotacoes_sintomas'],
        $_POST['documento_medico'],
        $unidade_escolar
    );

    header("Location: tabela_restricoes.php?unidade_escolar=".$unidade_escolar);
    exit;
}

// Busca todos os registros
$dados = $model->getAlunosRestricoes($unidade_escolar);
?>