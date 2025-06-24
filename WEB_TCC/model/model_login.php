<?php
include_once '../controller/conecta_banco.php'; // ajuste o caminho conforme sua estrutura

class Administrador {

    // Buscar administrador pelo CPF
    public function buscarPorCPF($cpf, $senha, $unidade_escolar) {
        $conn = Database::getConnection();

        // Primeiro, buscar o usuário pelo CPF e unidade escolar
        $stmt = $conn->prepare("SELECT * FROM ADMINISTRADOR WHERE CPF = ? AND UNIDADE_ESCOLAR = ?");
        $stmt->bind_param("ss", $cpf, $unidade_escolar);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $administrador = $resultado->fetch_assoc();
        $stmt->close();
        $conn->close();

        // Verificar se o usuário existe e se a senha está correta
        if ($administrador && password_verify($senha, $administrador['SENHA'])) {
            return $administrador;
        }

        // Se não encontrou ou a senha estiver incorreta
        return null;
    }

    // Inserir administrador (se já usar cadastro)
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
