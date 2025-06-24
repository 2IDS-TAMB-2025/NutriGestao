<?php
require_once '../model/model_administrador.php';

if (isset($_POST["cpf"]) && isset($_POST["nome"]) && isset($_POST["email"]) && isset($_POST["unidade_escolar"]) && isset($_POST["senha"]) && isset($_POST["confirmar_senha"])) {
   
    if($_POST["senha"] == $_POST["confirmar_senha"]){
        $admin = new Administrador();
        $admin->inserirAdministrador(
            $_POST["cpf"],
            $_POST["nome"],
            $_POST["email"],
            $_POST["unidade_escolar"],
            $_POST["senha"]
        );
        header("Location: ../view/login.php");
    }else{
        header("Location: ../view/cadastro.html");
    }
    
} else {
    echo "Erro ao salvar!";
}
if(isset($_GET["cpf"])){
    $admin = new Administrador();
    $dados_usu = "";
}