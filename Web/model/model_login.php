<?php
include_once '../controller/conecta_banco.php'; 

class Administrador {


    public function buscarPorCPF($cpf, $senha, $unidade_escolar) {
        $conn = Database::getConnection();


        $stmt = $conn->prepare("SELECT * FROM ADMINISTRADOR WHERE CPF = ? AND UNIDADE_ESCOLAR = ?");
        $stmt->bind_param("ss", $cpf, $unidade_escolar);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $administrador = $resultado->fetch_assoc();
        $stmt->close();
        $conn->close();


        if ($administrador && password_verify($senha, $administrador['SENHA'])) {
            return $administrador;
        }

        return null;
    }

    public function inserirAdministrador($cpf, $tipo, $nome, $email, $unidade_escolar, $senha){
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $conn = Database::getConnection();
        $stmt = $conn->prepare("INSERT INTO ADMINISTRADOR (CPF, TIPO, NOME, EMAIL, UNIDADE_ESCOLAR, SENHA) 
                                VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $cpf, $tipo, $nome, $email, $unidade_escolar, $senhaHash);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        return true;
    }
}
?>
