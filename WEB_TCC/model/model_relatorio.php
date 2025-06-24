<?php
include_once '../controller/conecta_banco.php';

class Relatorio {
    public function getRelatorio($dataFiltro = null, $cpf) {
        $conn = Database::getConnection();

        // Monta SQL dinamicamente
        $sql = "
            SELECT data_registro, 
                   SUM(quantidade_diaria) AS quantidade_diaria, 
                   SUM(desperdicio_diario) AS desperdicio_diario
            FROM (
                SELECT DATE(DATA_REGISTRO) AS data_registro, 
                       QUANTIDADE_DIARIA AS quantidade_diaria, 
                       0 AS desperdicio_diario
                FROM REFEICAO
                WHERE CPF_USUARIO = ? " . ($dataFiltro ? "AND DATE(DATA_REGISTRO) = ?" : "") . "

                UNION ALL

                SELECT DATE(DATA_REGISTRO) AS data_registro, 
                       0 AS quantidade_diaria, 
                       DESPERDICIO_DIARIO AS desperdicio_diario
                FROM DESPERDICIO
                WHERE CPF_USUARIO = ? " . ($dataFiltro ? "AND DATE(DATA_REGISTRO) = ?" : "") . "
            ) AS combinado
            GROUP BY data_registro
            ORDER BY data_registro DESC
        ";

        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("Erro na preparação da query: " . $conn->error);
        }

        if ($dataFiltro) {
            // Bind CPF, Data, CPF, Data
            $stmt->bind_param("ssss", $cpf, $dataFiltro, $cpf, $dataFiltro);
        } else {
            // Bind CPF, CPF
            $stmt->bind_param("ss", $cpf, $cpf);
        }

        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }
}
?>
