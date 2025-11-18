<?php
class Adm{
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    //Criar um novo usuário
    public function create($cpf,$tipo,$nome,$email,$unidade_escolar,$senha){
        $stmt = $this->db->prepare('INSERT INTO ADMINISTRADOR (CPF,TIPO,NOME,EMAIL,UNIDADE_ESCOLAR,SENHA)
                                    VALUES (:CPF, :TIPO, :NOME, :EMAIL, :UNIDADE_ESCOLAR, :SENHA)');
        $stmt->bindValue(':CPF',$cpf,SQLITE3_TEXT);
        $stmt->bindValue(':TIPO',$tipo,SQLITE3_TEXT);
        $stmt->bindValue(':NOME',$nome,SQLITE3_TEXT);
        $stmt->bindValue(':EMAIL',$email,SQLITE3_TEXT);
        $stmt->bindValue(':UNIDADE_ESCOLAR',$unidade_escolar,SQLITE3_INTEGER); // MUDADO PARA INTEGER
        $stmt->bindValue(':SENHA',$senha,SQLITE3_TEXT);
        return $stmt->execute();                            
    }
    
    //Obter todos os usuários
    public function getAdms(){
        $result = $this->db->query('SELECT * FROM ADMINISTRADOR');

        $administrador = [];
        while($row = $result->fetchArray(SQLITE3_ASSOC)){
            $administrador[] = $row;
        }
        return $administrador; // CORRIGIDO: era $contagem, mudei para $administrador
    }

    //Obter usuário pelo ID
    public function getAdmCpf($cpf){
        $stmt = $this->db->prepare("SELECT * FROM ADMINISTRADOR
                                    WHERE CPF = :CPF");
        $stmt->bindValue(':CPF',$cpf,SQLITE3_TEXT); // MUDADO PARA TEXT (CPF é string)
        $result = $stmt->execute();
        return $result->fetchArray(SQLITE3_ASSOC);                            
    }

    //Atualiza um usuário pelo ID 
    public function updateAdm($cpf, $tipo, $nome, $email, $unidade_escolar, $senha){ // CORRIGIDO: adicionei parâmetros
        $stmt = $this->db->prepare("UPDATE ADMINISTRADOR
                                    SET    TIPO = :TIPO,
                                           NOME = :NOME,
                                           EMAIL = :EMAIL,
                                           UNIDADE_ESCOLAR = :UNIDADE_ESCOLAR,
                                           SENHA = :SENHA
                                    WHERE  CPF = :CPF"); // CORRIGIDO: estava 'cpf' minúsculo
        $stmt->bindValue(':CPF',$cpf,SQLITE3_TEXT);
        $stmt->bindValue(':TIPO',$tipo,SQLITE3_TEXT);
        $stmt->bindValue(':NOME',$nome,SQLITE3_TEXT);
        $stmt->bindValue(':EMAIL',$email,SQLITE3_TEXT);
        $stmt->bindValue(':UNIDADE_ESCOLAR',$unidade_escolar,SQLITE3_INTEGER); // MUDADO PARA INTEGER
        $stmt->bindValue(':SENHA',$senha,SQLITE3_TEXT);
        return $stmt->execute();                            
    }

    //Exclui um usuário pelo ID
    public function deleteAdm($cpf){
        $stmt = $this->db->prepare('DELETE FROM ADMINISTRADOR
                                    WHERE CPF = :CPF');
        $stmt->bindValue(':CPF',$cpf,SQLITE3_TEXT); // MUDADO PARA TEXT
        return $stmt->execute();                            
    }
}
?>