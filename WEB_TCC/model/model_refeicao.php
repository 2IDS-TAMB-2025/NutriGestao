<?php
include_once '../controller/conecta_banco.php';


class Refeicao {
    public function inserirQuantidadeDiaria($diaria) {
        $conn = Database::getConnection();
        $cpf_usuario = $_SESSION['cpf_usuario'] ?? null;

        if (!$cpf_usuario) {
            die("Erro: Usuário não identificado.");
        }

        $stmt = $conn->prepare("INSERT INTO REFEICAO (quantidade_diaria, data_registro, cpf_usuario) VALUES (?, NOW(), ?)");
        if (!$stmt) {
            die("Erro na query: " . $conn->error);
        }
        $stmt->bind_param("is", $diaria, $cpf_usuario);
        $stmt->execute();
        $stmt->close();
        return true;
    }

    public function dadosRefeicoesDiario() {
        $conn = Database::getConnection();
        $cpf_usuario = $_SESSION['cpf_usuario'] ?? null;

        $stmt = $conn->prepare("
            SELECT SUM(quantidade_diaria) AS SOMA_DIARIA 
            FROM REFEICAO 
            WHERE DATE(data_registro) = CURDATE() 
              AND cpf_usuario = ?
        ");
        $stmt->bind_param("s", $cpf_usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $refeicao = $resultado->fetch_assoc();
        return $refeicao ?: ['SOMA_DIARIA' => 0];
    }

    public function dadosRefeicoesSemanais() {
        $conn = Database::getConnection();
        $cpf_usuario = $_SESSION['cpf_usuario'] ?? null;

        $stmt = $conn->prepare("
            SELECT SUM(quantidade_diaria) AS SOMA_SEMANAL 
            FROM REFEICAO 
            WHERE YEARWEEK(data_registro, 1) = YEARWEEK(CURDATE(), 1) 
              AND cpf_usuario = ?
        ");
        $stmt->bind_param("s", $cpf_usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $refeicao = $resultado->fetch_assoc();
        return $refeicao ?: ['SOMA_SEMANAL' => 0];
    }

    public function dadosRefeicoesMensais() {
        $conn = Database::getConnection();
        $cpf_usuario = $_SESSION['cpf_usuario'] ?? null;

        $stmt = $conn->prepare("
            SELECT SUM(quantidade_diaria) AS SOMA_MENSAL 
            FROM REFEICAO 
            WHERE YEAR(data_registro) = YEAR(CURDATE()) 
              AND MONTH(data_registro) = MONTH(CURDATE()) 
              AND cpf_usuario = ?
        ");
        $stmt->bind_param("s", $cpf_usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $refeicao = $resultado->fetch_assoc();
        return $refeicao ?: ['SOMA_MENSAL' => 0];
    }
}
?>
