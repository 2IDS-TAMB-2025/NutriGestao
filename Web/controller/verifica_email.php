<?php
session_start();
require_once "../model/ModelUsuario.php";



if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    if(!$email) {
        $_SESSION['msg'] = "Email inválido!";
        header("Location: ../view/esqueci_senha.php");
        exit();
    }

    $conn = Database::getConnection();
    $modelUsuario = new ModelUsuario($conn);

    $usuario = $modelUsuario->getUsuarioPorEmail($email);
    if(!$usuario) {
        $_SESSION['msg'] = "Email não cadastrado.";
        header("Location: ../view/esqueci_senha.php");
        exit();
    }

    // Gera código aleatório de 6 dígitos
    $codigo = rand(100000, 999999);

    // Salva o código no banco (ou em outro lugar, por exemplo, sessão)
    $modelUsuario->salvarCodigoVerificacao($email, $codigo);

    // Envia email
    $assunto = "Código de verificação";
    $mensagem = "Seu código para recuperação de senha é: $codigo";
    $headers = "From: seuemail@seudominio.com\r\n";
    $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

    if(mail($email, $assunto, $mensagem, $headers)) {
        $_SESSION['msg'] = "Código enviado para o email: $email";
        $_SESSION['email'] = $email; // pra usar na próxima página de verificação do código
        header("Location: ../view/verifica_codigo.php");
        exit();
    } else {
        $_SESSION['msg'] = "Erro ao enviar o email. Tente novamente.";
        header("Location: ../view/esquecisenha.php");
        exit();
    }
} else {
    header("Location: ../view/esquecisenha.php");
    exit();
}
?>