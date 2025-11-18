<?php
require_once(__DIR__ . '/../controller/conecta_banco.php');

class ContagemModel {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    // Buscar últimos registros por turma da data atual e CPF
    public function buscarUltimosPorTurmasHoje($unidade_escolar = null) {
        return $this->buscarPorFiltro(null, date('Y-m-d'), $unidade_escolar);
    }

    // Buscar por filtro: turma (sala), data e unidade_escolar
    public function buscarPorFiltro($sala = null, $data = null, $unidade_escolar) {
        if (!$data) {
            $data = date('Y-m-d');
        }

        $params = [];
        $types = "";

        $where = " WHERE DATA = ? AND UNIDADE_ESCOLAR = ? ";
        $params[] = $data;
        $types .= "s";
        $params[] = $unidade_escolar;
        $types .= "s";

        if ($sala) {
            $where .= " AND TURMA = ? ";
            $params[] = $sala;
            $types .= "s";
        }

        $query = "
            SELECT c1.*
            FROM CONTAGEM_ALUNOS c1
            INNER JOIN (
                SELECT TURMA, MAX(ID) as max_id
                FROM CONTAGEM_ALUNOS
                $where
                GROUP BY TURMA
            ) c2 ON c1.TURMA = c2.TURMA AND c1.ID = c2.max_id
            ORDER BY c1.TURMA ASC
        ";

        $stmt = $this->conn->prepare($query);
        if ($stmt === false) {
            die("Erro na preparação da query: " . $this->conn->error);
        }

        $stmt->bind_param($types, ...$params);
        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
?>
