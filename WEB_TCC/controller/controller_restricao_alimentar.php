<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../model/model_restricao_alimentar.php';

if (!isset($_SESSION['cpf_usuario'])) {
    die("Usuário não identificado. Faça o login novamente.");
}

$cpf_usuario = $_SESSION['cpf_usuario'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

    // Adiciona o cpf do usuário logado no array de dados
    $dados['cpf_usuario'] = $cpf_usuario;

    $turmas_validas = [
        "6° EF2 A","6° EF2 B","7° EF2 A","7° EF2 B",
        "8° EF2 A","8° EF2 B","9° EF2 A","9° EF2 B",
        "1° EM A","1° EM B","2° EM A","2° EM B","3° EM A","3° EM B"
    ];

    if (!in_array($dados['turma'], $turmas_validas)) {
        die("Erro: Turma inválida.");
    }

    $model = new RestricaoModel();

    $arquivo = $_FILES['documento_medico'] ?? null;

    $salvou = $model->salvarRestricao($dados, $arquivo);

    if ($salvou) {
        header("Location: sucesso.html");
        exit;
    } else {
        echo "Erro ao salvar os dados. Tente novamente.";
    }
} else {
    echo "Método inválido.";
}
?>
