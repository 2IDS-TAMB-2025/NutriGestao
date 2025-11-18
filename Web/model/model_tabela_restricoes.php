<?php
require_once '../controller/conecta_banco.php';

class TabelaRestricoesModel {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    // Retorna todas as restrições da unidade escolar
    public function getAlunosRestricoes($unidade_escolar = null) {
        $sql = "SELECT 
                    id,
                    nome_aluno,
                    turma,
                    tipo_restricao,
                    telefone_responsavel,
                    nome_profissional,
                    registro_profissional,
                    anotacoes_sintomas,
                    documento_medico,
                    criado_em
                FROM restricoes_alimentares";

        if ($unidade_escolar) {
            $sql .= " WHERE unidade_escolar = ?";
        }

        $stmt = $this->conn->prepare($sql);

        if ($unidade_escolar) {
            $stmt->bind_param("s", $unidade_escolar);
        }

        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    // Busca uma restrição específica por ID
    public function getRestricaoPorId($id) {
        $sql = "SELECT * FROM restricoes_alimentares WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }

    // Atualiza uma restrição existente
    public function atualizarRestricao($id, $dados, $arquivo = null) {
        // Se há um novo arquivo, atualiza o nome do documento
        if ($arquivo && $arquivo['error'] === UPLOAD_ERR_OK) {
            $nomeTmp = $arquivo['tmp_name'];
            $ext = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
            $nomeArquivo = uniqid('doc_') . '.' . $ext;
            $destino = __DIR__ . '/uploads/' . $nomeArquivo;

            if (!is_dir(__DIR__ . '/uploads')) {
                mkdir(__DIR__ . '/uploads', 0777, true);
            }

            move_uploaded_file($nomeTmp, $destino);
            $dados['documento_medico'] = $nomeArquivo;
        } else {
            // Mantém o documento atual se não foi enviado novo arquivo
            $restricaoAtual = $this->getRestricaoPorId($id);
            $dados['documento_medico'] = $restricaoAtual['documento_medico'];
        }

        $sql = "UPDATE restricoes_alimentares SET 
                nome_aluno = ?,
                turma = ?,
                tipo_restricao = ?,
                telefone_responsavel = ?,
                nome_profissional = ?,
                registro_profissional = ?,
                anotacoes_sintomas = ?,
                documento_medico = ?
                WHERE id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param(
            "ssssssssi",
            $dados['nome_aluno'],
            $dados['turma'],
            $dados['tipo_restricao'],
            $dados['telefone_responsavel'],
            $dados['nome_profissional'],
            $dados['registro_profissional'],
            $dados['anotacoes_sintomas'],
            $dados['documento_medico'],
            $id
        );

        return $stmt->execute();
    }

    // Insere restrição
    public function salvarAluno(
        $nome,
        $turma,
        $tipo,
        $telefone,
        $profissional,
        $registro,
        $sintomas,
        $documento,
        $unidade_escolar
    ) {
        $stmt = $this->conn->prepare(
            "INSERT INTO restricoes_alimentares (
                nome_aluno, turma, tipo_restricao, telefone_responsavel,
                nome_profissional, registro_profissional, anotacoes_sintomas,
                documento_medico, unidade_escolar
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );

        $stmt->bind_param(
            "sssssssss",
            $nome,
            $turma,
            $tipo,
            $telefone,
            $profissional,
            $registro,
            $sintomas,
            $documento,
            $unidade_escolar
        );

        return $stmt->execute();
    }

    // Exclui por ID
    public function excluirAluno($id) {
        $stmt = $this->conn->prepare("DELETE FROM restricoes_alimentares WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>