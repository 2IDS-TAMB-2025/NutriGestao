<?php
include_once '../controller/conecta_banco.php';

class Administrador {

    // busca com base no cpf select * from adminstrador where cpf = cpf

    
    public function inserirAdministrador($cpf, $nome, $email, $unidade_escolar, $senha){
        $senhaHash = password_hash($senha,PASSWORD_DEFAULT);
        $conn = Database::getConnection();
        $stmt = $conn->prepare("INSERT INTO ADMINISTRADOR (CPF, NOME, EMAIL, UNIDADE_ESCOLAR, SENHA) 
                                VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $cpf, $nome, $email, $unidade_escolar, $senhaHash);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }
}
?>