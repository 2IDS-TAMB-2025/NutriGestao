<?php
require_once(__DIR__ . '/../controller/conecta_banco.php');

class ContagemModel {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    // Buscar últimos registros por turma da data atual e CPF
    public function buscarUltimosPorTurmasHoje($cpf_usuario = null) {
        return $this->buscarPorFiltro(null, date('Y-m-d'), $cpf_usuario);
    }

    // Buscar por filtro: turma (sala), data e cpf_usuario
    public function buscarPorFiltro($sala = null, $data = null, $cpf_usuario) {
        if (!$data) {
            $data = date('Y-m-d');
        }

        $params = [];
        $types = "";

        $where = " WHERE DATA = ? AND cpf_usuario = ? ";
        $params[] = $data;
        $types .= "s";
        $params[] = $cpf_usuario;
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
