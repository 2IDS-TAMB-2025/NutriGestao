<?php
include_once '../controller/conecta_banco.php';

class Relatorio {
    public function getRelatorio($dataFiltro = null, $unidade_escolar = null) {
        $conn = Database::getConnection();

        $sql = "
            SELECT 
                DATA_REGISTRO,
                SUM(total_alunos) as total_alunos,
                SUM(desperdicio_total) as desperdicio_diario,
                SUM(quantidade_total) as quantidade_diaria
            FROM (
                -- Dados de desperdício
                SELECT 
                    DATE(DATA_REGISTRO) as DATA_REGISTRO,
                    COUNT(RA) as total_alunos,
                    SUM(DESPERDICIO_ALUNO) as desperdicio_total,
                    0 as quantidade_total
                FROM DESPERDICIO_ALUNOS
                " . ($dataFiltro ? " WHERE DATE(DATA_REGISTRO) = ?" : "") . "
                GROUP BY DATE(DATA_REGISTRO)
                
                UNION ALL
                
                -- Dados de refeição
                SELECT 
                    DATE(DATA_REGISTRO) as DATA_REGISTRO,
                    0 as total_alunos,
                    0 as desperdicio_total,
                    SUM(quantidade_diaria) as quantidade_total
                FROM REFEICAO
                WHERE UNIDADE_ESCOLAR = ?
                " . ($dataFiltro ? " AND DATE(DATA_REGISTRO) = ?" : "") . "
                GROUP BY DATE(DATA_REGISTRO)
            ) AS combinado
            GROUP BY DATA_REGISTRO
            ORDER BY DATA_REGISTRO DESC
        ";

        $stmt = $conn->prepare($sql);
        
        if ($dataFiltro) {
            $stmt->bind_param("sss", $dataFiltro, $unidade_escolar, $dataFiltro);
        } else {
            $stmt->bind_param("s", $unidade_escolar);
        }

        
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        $dados = [];
        while ($linha = $resultado->fetch_assoc()) {
            $dados[] = $linha;
        }
        return $dados;
    }
}
?>