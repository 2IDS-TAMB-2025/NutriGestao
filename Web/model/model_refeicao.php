<?php
include_once '../controller/conecta_banco.php';


class Refeicao {
    public function inserirQuantidadeDiaria($diaria) {
        $conn = Database::getConnection();
        $unidade_escolar = $_SESSION['unidade_escolar'] ?? null;

        if (!$unidade_escolar) {
            die("Erro: Usuário não identificado.");
        }

        $stmt = $conn->prepare("INSERT INTO REFEICAO (quantidade_diaria, data_registro, unidade_escolar) VALUES (?, NOW(), ?)");
        if (!$stmt) {
            die("Erro na query: " . $conn->error);
        }
        $stmt->bind_param("is", $diaria, $unidade_escolar);
        $stmt->execute();
        $stmt->close();
        return true;
    }

    public function dadosRefeicoesDiario() {
        $conn = Database::getConnection();
        $unidade_escolar = $_SESSION['unidade_escolar'] ?? null;

        $stmt = $conn->prepare("
            SELECT SUM(quantidade_diaria) AS SOMA_DIARIA 
            FROM REFEICAO 
            WHERE DATE(data_registro) = CURDATE() 
              AND unidade_escolar = ?
        ");
        $stmt->bind_param("s", $unidade_escolar);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $refeicao = $resultado->fetch_assoc();
        return $refeicao ?: ['SOMA_DIARIA' => 0];
    }

    public function dadosRefeicoesSemanais() {
        $conn = Database::getConnection();
        $unidade_escolar = $_SESSION['unidade_escolar'] ?? null;

        $stmt = $conn->prepare("
            SELECT SUM(quantidade_diaria) AS SOMA_SEMANAL 
            FROM REFEICAO 
            WHERE YEARWEEK(data_registro, 1) = YEARWEEK(CURDATE(), 1) 
              AND unidade_escolar = ?
        ");
        $stmt->bind_param("s", $unidade_escolar);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $refeicao = $resultado->fetch_assoc();
        return $refeicao ?: ['SOMA_SEMANAL' => 0];
    }

    public function dadosRefeicoesMensais() {
        $conn = Database::getConnection();
        $unidade_escolar = $_SESSION['unidade_escolar'] ?? null;

        $stmt = $conn->prepare("
            SELECT SUM(quantidade_diaria) AS SOMA_MENSAL 
            FROM REFEICAO 
            WHERE YEAR(data_registro) = YEAR(CURDATE()) 
              AND MONTH(data_registro) = MONTH(CURDATE()) 
              AND unidade_escolar = ?
        ");
        $stmt->bind_param("s", $unidade_escolar);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $refeicao = $resultado->fetch_assoc();
        return $refeicao ?: ['SOMA_MENSAL' => 0];
    }
}
?>
