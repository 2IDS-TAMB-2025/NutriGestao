<?php
include_once '../controller/conecta_banco.php';

class Desperdicio {

    // Soma do desperdício de todos os alunos de um único dia
    public function dadosDesperdiciosDiario($data = null) {
        $conn = Database::getConnection();
        $sql = "SELECT SUM(DESPERDICIO_ALUNO) AS SOMA_DIARIA 
                FROM DESPERDICIO_ALUNOS" . 
                ($data ? " WHERE DATE(DATA_REGISTRO) = ?" : "");
        $stmt = $conn->prepare($sql);
        if ($data) {
            $stmt->bind_param("s", $data);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc() ?: ['SOMA_DIARIA' => 0];
    }

    // Soma do desperdício semanal
    public function dadosDesperdiciosSemanais($inicio = null, $fim = null) {
        $conn = Database::getConnection();
        $sql = "SELECT SUM(DESPERDICIO_ALUNO) AS SOMA_SEMANAL 
                FROM DESPERDICIO_ALUNOS" . 
                ($inicio && $fim ? " WHERE DATE(DATA_REGISTRO) BETWEEN ? AND ?" : "");
        $stmt = $conn->prepare($sql);
        if ($inicio && $fim) {
            $stmt->bind_param("ss", $inicio, $fim);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc() ?: ['SOMA_SEMANAL' => 0];
    }

    // Soma do desperdício mensal
    public function dadosDesperdiciosMensais($mes = null, $ano = null) {
        $conn = Database::getConnection();
        $sql = "SELECT SUM(DESPERDICIO_ALUNO) AS SOMA_MENSAL 
                FROM DESPERDICIO_ALUNOS" . 
                ($mes && $ano ? " WHERE MONTH(DATA_REGISTRO) = ? AND YEAR(DATA_REGISTRO) = ?" : "");
        $stmt = $conn->prepare($sql);
        if ($mes && $ano) {
            $stmt->bind_param("ss", $mes, $ano);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc() ?: ['SOMA_MENSAL' => 0];
    }

    // Buscar dados para preencher a tabela (agrupado por data)
    public function buscarDadosParaTabela($dataFiltro = null) {
        $conn = Database::getConnection();
        
        $sql = "SELECT 
                    DATA_REGISTRO,
                    SUM(DESPERDICIO_ALUNO) as desperdicio_diario,
                    COUNT(RA) as total_alunos
                FROM DESPERDICIO_ALUNOS";
        
        if ($dataFiltro) {
            $sql .= " WHERE DATE(DATA_REGISTRO) = ?";
        }
        
        $sql .= " GROUP BY DATA_REGISTRO ORDER BY DATA_REGISTRO DESC";
        
        $stmt = $conn->prepare($sql);
        
        if ($dataFiltro) {
            $stmt->bind_param("s", $dataFiltro);
        }
        
        $stmt->execute();
        $result = $stmt->get_result();
        
        $dados = [];
        while ($linha = $result->fetch_assoc()) {
            $dados[] = $linha;
        }
        return $dados;
    }

    // Buscar todos os desperdícios (opcional para debug)
    public function buscarTodosDados() {
        $conn = Database::getConnection();
        $sql = "SELECT * FROM DESPERDICIO_ALUNOS ORDER BY DATA_REGISTRO DESC";
        $resultado = $conn->query($sql);
        $dados = [];
        while ($linha = $resultado->fetch_assoc()) {
            $dados[] = $linha;
        }
        return $dados;
    }
}
?>