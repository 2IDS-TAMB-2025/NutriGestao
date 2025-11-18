<?php
require_once "../controller/conecta_banco.php";

class ModelUsuario {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Verifica se email existe e retorna os dados do usuário
    public function getUsuarioPorEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM ADMINISTRADOR WHERE EMAIL = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();
        if($resultado->num_rows > 0) {
            return $resultado->fetch_assoc();
        } else {
            return false;
        }
    }
}