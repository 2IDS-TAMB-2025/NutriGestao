<?php
require_once '../config/conecta_banco.php';

class Cardapio {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    /**
     * Retorna os 5 registros (segunda a sexta) da ÚLTIMA semana cadastrada
     * para o cpf informado, ordenados por dia da semana.
     */
    public function getUltimosCardapios($unidade_escolar=370) {
        // Converte para integer se necessário
        $unidade_escolar = intval($unidade_escolar);
        
        // Seleciona a última SEMANA_REFERENCIA do usuário
        $sql = "
            SELECT c.*
            FROM CARDAPIO c
            WHERE c.unidade_escolar = ?
              AND c.SEMANA_REFERENCIA = (
                    SELECT MAX(SEMANA_REFERENCIA)
                    FROM CARDAPIO
                    WHERE unidade_escolar = ?
              )
            ORDER BY FIELD(c.DIA_SEMANA, 'segunda','terca','quarta','quinta','sexta')
        ";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            throw new Exception('Erro ao preparar statement: ' . $this->conn->error);
        }

        // Mudei para 'ii' (dois integers)
        $stmt->bind_param('ii', $unidade_escolar, $unidade_escolar);
        $stmt->execute();
        $result = $stmt->get_result();

        $cardapio = [];
        while ($row = $result->fetch_assoc()) {
            // O array final fica indexado pelo dia exatamente como sua view espera
            // (dias em minúsculas: 'segunda','terca','quarta','quinta','sexta')
            $cardapio[$row['DIA_SEMANA']] = $row;
        }

        $stmt->close();
        return $cardapio;
    }
}
?>