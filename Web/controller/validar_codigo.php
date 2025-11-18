<?php
session_start();
require 'conecta_banco.php';

$conn = Database::getConnection();
$email = $_POST['email'] ?? '';
$codigo = $_POST['codigo'] ?? '';

$stmt = $conn->prepare("SELECT * FROM RECUPERACAO_SENHA WHERE email=? AND codigo=? AND expira_em > NOW()");
$stmt->bind_param("ss", $email, $codigo);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    header("Location: ../view/recuperar_senha/nova_senha.php?email=$email");
} else {
    $_SESSION['msg'] = "Código inválido ou expirado!";
    header("Location: ../view/recuperar_senha/confirmar_codigo.php?email=$email");
}
