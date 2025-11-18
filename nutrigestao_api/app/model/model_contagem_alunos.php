<?php
require_once '../config/conecta_banco.php';

class ContagemModel {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

        public function inserirContagem($quantidade_lanche_manha, $quantidade_bebida_manha, $quantidade_lanche_tarde, $quantidade_bebida_tarde, $turma, $data, $unidade_escolar) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("
            INSERT INTO CONTAGEM_ALUNOS (QUANTIDADE_LANCHE_MANHA, QUANTIDADE_BEBIDA_MANHA, QUANTIDADE_LANCHE_TARDE, QUANTIDADE_BEBIDA_TARDE, TURMA, DATA, UNIDADE_ESCOLAR) 
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        if (!$stmt) {
            die("Erro na query: " . $conn->error);
        }
        $stmt->bind_param("iiiissi", $quantidade_lanche_manha, $quantidade_bebida_manha, $quantidade_lanche_tarde, $quantidade_bebida_tarde, $turma, $data, $unidade_escolar);
        $stmt->execute();
        $stmt->close();
        return true;
    }
}
?>
