<?php
    require_once "../model/model.php";

    if(isset($_POST["cpf"]) && isset($_POST["tipo"])&& isset($_POST["nome"])&& isset($_POST["email"])&& isset($_POST["unidade_escolar"])&& isset($_POST["Senha"])){
        $nome = $_POST["cpf"];
        $senha = $_POST["tipo"];
         $senha = $_POST["nome"];
          $senha = $_POST["email"];
           $senha = $_POST["unidade_escolar"];
            $senha = $_POST["senha"];
        
        $usuario = new Usuario($cpf,$tipo,$nome,$email,$unidade_escolar,$senha);
        $usuario->salvar();
        header("Location: ../view/view_relatorio_usuarios.php");
    }
    else {
        echo("erro");
    }
?>