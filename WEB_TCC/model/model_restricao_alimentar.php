<?php
require_once '../controller/conecta_banco.php';

class RestricaoModel {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    public function salvarRestricao($dados, $arquivo = null) {
        $nomeArquivo = null;
        if ($arquivo && $arquivo['error'] === UPLOAD_ERR_OK) {
            $nomeTmp = $arquivo['tmp_name'];
            $ext = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
            $nomeArquivo = uniqid('doc_') . '.' . $ext;
            $destino = __DIR__ . '/uploads/' . $nomeArquivo;

            if (!is_dir(__DIR__ . '/uploads')) {
                mkdir(__DIR__ . '/uploads', 0777, true);
            }

            move_uploaded_file($nomeTmp, $destino);
        }

        $sql = "INSERT INTO restricoes_alimentares
            (nome_aluno, telefone_responsavel, tipo_restricao, turma,
             nome_profissional, registro_profissional, anotacoes_sintomas, documento_medico, cpf_usuario)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param(
            "sssssssss",
            $dados['nome_aluno'],
            $dados['telefone_responsavel'],
            $dados['tipo_restricao'],
            $dados['turma'],
            $dados['nome_profissional'],
            $dados['registro_profissional'],
            $dados['anotacoes_sintomas'],
            $nomeArquivo,
            $dados['cpf_usuario']
        );

        if ($stmt->execute()) {
            return true;
        } else {
            error_log("Erro ao salvar restrição: " . $stmt->error);
            return false;
        }
    }
}
?>
