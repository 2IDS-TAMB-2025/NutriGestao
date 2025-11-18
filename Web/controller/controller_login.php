<?php
require_once '../model/model_login.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(isset($_POST['cpf']) && isset($_POST['senha']) && isset($_POST['unidade_escolar'])) {
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];
    $unidade_escolar = $_POST['unidade_escolar'];

    // Converte para integer
    $unidade_escolar_int = intval($unidade_escolar);

    $admin = new Administrador();
    $dadosAdmin = $admin->buscarPorCPF($cpf, $senha, $unidade_escolar_int);

    if($dadosAdmin != null) {
        $_SESSION['unidade_escolar'] = $dadosAdmin['UNIDADE_ESCOLAR'];
        $_SESSION['email'] = $dadosAdmin['EMAIL'];
        $_SESSION['cpf_usuario'] = $dadosAdmin['CPF'];
        // Login válido: redirecione para a página principal
        header("Location: ../view/Inicio.php?unidade_escolar=".$dadosAdmin['UNIDADE_ESCOLAR']);
        exit;
    } else {
        // Login inválido: redirecione para login com erro
        header("Location: ../view/login.php?erro=1");
        exit;
    }
} 
?>