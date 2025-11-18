<?php
session_start();
require 'conecta_banco.php';

$conn = Database::getConnection();
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';
$confirma = $_POST['confirma'] ?? '';

if ($senha !== $confirma) {
    $_SESSION['msg'] = "As senhas não coincidem!";
    header("Location: ../view/recuperar_senha/nova_senha.php?email=$email");
    exit();
}

$hash = password_hash($senha, PASSWORD_DEFAULT);

$stmt = $conn->prepare("UPDATE ADMINISTRADOR SET SENHA=? WHERE EMAIL=?");
$stmt->bind_param("ss", $hash, $email);

if ($stmt->execute()) {
    $_SESSION['msg'] = "Senha atualizada com sucesso!";
    // Redireciona para o login
    header("Location: ../view/login.php");
} else {
    $_SESSION['msg'] = "Erro ao atualizar senha!";
    header("Location: ../view/recuperar_senha/nova_senha.php?email=$email");
}
