<?php
include_once '../controller/conecta_banco.php';

class Desperdicio {

    public function inserirQuantidades($diaria, $semanal, $mensal, $cpf_usuario) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("
            INSERT INTO DESPERDICIO (DESPERDICIO_DIARIO, DESPERDICIO_SEMANAL, DESPERDICIO_MENSAL, CPF_USUARIO, DATA_REGISTRO) 
            VALUES (?, ?, ?, ?, NOW())
        ");
        if (!$stmt) {
            die("Erro na query: " . $conn->error);
        }
        $stmt->bind_param("iiis", $diaria, $semanal, $mensal, $cpf_usuario);
        $stmt->execute();
        $stmt->close();
        return true;
    }

    public function buscarUltimoDesperdicio($cpf_usuario) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("
            SELECT DESPERDICIO_DIARIO, DESPERDICIO_SEMANAL, DESPERDICIO_MENSAL 
            FROM DESPERDICIO 
            WHERE CPF_USUARIO = ? 
            ORDER BY ID DESC 
            LIMIT 1
        ");
        $stmt->bind_param("s", $cpf_usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $desperdicio = $resultado->fetch_assoc();
        $stmt->close();
        return $desperdicio;
    }

    public function dadosDesperdiciosDiario($cpf_usuario) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("
            SELECT SUM(DESPERDICIO_DIARIO) AS SOMA_DIARIA 
            FROM DESPERDICIO
            WHERE DATE(data_registro) = CURDATE()
              AND CPF_USUARIO = ?
        ");
        $stmt->bind_param("s", $cpf_usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $desperdicio = $resultado->fetch_assoc();
        $stmt->close();
        return $desperdicio ?: ['SOMA_DIARIA' => 0];
    }

    public function dadosDesperdiciosSemanais($cpf_usuario) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("
            SELECT SUM(DESPERDICIO_SEMANAL) AS SOMA_SEMANAL 
            FROM DESPERDICIO
            WHERE YEARWEEK(data_registro, 1) = YEARWEEK(CURDATE(), 1)
              AND CPF_USUARIO = ?
        ");
        $stmt->bind_param("s", $cpf_usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $desperdicio = $resultado->fetch_assoc();
        $stmt->close();
        return $desperdicio ?: ['SOMA_SEMANAL' => 0];
    }

    public function dadosDesperdiciosMensais($cpf_usuario) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("
            SELECT SUM(DESPERDICIO_MENSAL) AS SOMA_MENSAL 
            FROM DESPERDICIO
            WHERE YEAR(data_registro) = YEAR(CURDATE())
              AND MONTH(data_registro) = MONTH(CURDATE())
              AND CPF_USUARIO = ?
        ");
        $stmt->bind_param("s", $cpf_usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $desperdicio = $resultado->fetch_assoc();
        $stmt->close();
        return $desperdicio ?: ['SOMA_MENSAL' => 0];
    }
}
?>
