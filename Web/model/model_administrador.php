<?php
include_once '../controller/conecta_banco.php';

class Administrador {

    public function inserirAdministrador($cpf, $nome, $email, $unidade_escolar, $senha){
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $conn = Database::getConnection();
        $stmt = $conn->prepare("INSERT INTO ADMINISTRADOR (CPF, NOME, EMAIL, UNIDADE_ESCOLAR, SENHA) 
                                VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssis", $cpf, $nome, $email, $unidade_escolar, $senhaHash);

        try {
            $stmt->execute();
            $stmt->close();
            $conn->close();
            return true;
        } catch (mysqli_sql_exception $e) {
            $stmt->close();
            $conn->close();

            if ($e->getCode() == 1062) { // erro de entrada duplicada
                return "cpf_existente";
            }
            throw $e; // outros erros continuam sendo lançados
        }
    }
}
?>
