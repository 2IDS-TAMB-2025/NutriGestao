<?php
require_once '../controller/conecta_banco.php';

class CardapioVisualizacaoModel {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

   /**
 * Retorna os cardápios de uma semana específica para geração de PDF
 */
public function getCardapiosPorSemana($unidade_escolar, $data_inicio_semana) {
    // Garante que a data está no formato correto
    $data_inicio_semana = date('Y-m-d', strtotime($data_inicio_semana));
    
    $sql = "
        SELECT c.*
        FROM CARDAPIO c
        WHERE c.unidade_escolar = ?
          AND c.SEMANA_REFERENCIA = ?
        ORDER BY FIELD(c.DIA_SEMANA, 'segunda','terca','quarta','quinta','sexta')
    ";

    $stmt = $this->conn->prepare($sql);
    if (!$stmt) {
        throw new Exception('Erro ao preparar statement: ' . $this->conn->error);
    }

    $stmt->bind_param('ss', $unidade_escolar, $data_inicio_semana);
    $stmt->execute();
    $result = $stmt->get_result();

    $cardapio = [];
    while ($row = $result->fetch_assoc()) {
        $cardapio[$row['DIA_SEMANA']] = $row;
    }

    $stmt->close();
    return $cardapio;
}

    /**
     * Retorna a última semana com cardápio cadastrado
     */
    public function getUltimaSemanaComCardapio($unidade_escolar) {
        $sql = "
            SELECT MAX(SEMANA_REFERENCIA) as ultima_semana
            FROM CARDAPIO
            WHERE unidade_escolar = ?
        ";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            throw new Exception('Erro ao preparar statement: ' . $this->conn->error);
        }

        $stmt->bind_param('s', $unidade_escolar);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        $stmt->close();
        return $row['ultima_semana'] ?? null;
    }
}