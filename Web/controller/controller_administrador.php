<?php
require_once '../model/model_administrador.php';

if (isset($_POST["cpf"], $_POST["nome"], $_POST["email"], $_POST["unidade_escolar"], $_POST["senha"], $_POST["confirmar_senha"])) {
    
    $cpf = trim($_POST["cpf"]);
    $nome = trim($_POST["nome"]);
    $email = trim($_POST["email"]);
    $unidade = trim($_POST["unidade_escolar"]);
    $senha = $_POST["senha"];
    $confirmar = $_POST["confirmar_senha"];

    // Validação da unidade escolar (deve ser número de 3 dígitos)
    if (!preg_match('/^\d{3}$/', $unidade)) {
        $nome = urlencode($nome);
        $cpf = urlencode($cpf);
        $email = urlencode($email);
        $unidade = urlencode($unidade);
        header("Location: ../view/cadastro.php?erro=unidade_invalida&nome=$nome&cpf=$cpf&email=$email&unidade=$unidade");
        exit;
    }

    // Converte para integer
    $unidade_int = intval($unidade);

    // Verifica se as senhas coincidem
    if ($senha === $confirmar) {
        $admin = new Administrador();
        $result = $admin->inserirAdministrador($cpf, $nome, $email, $unidade_int, $senha);

        if ($result === true) {
            header("Location: ../view/login.php?sucesso=1");
            exit;
        } elseif ($result === "cpf_existente") {
            // CPF já cadastrado
            $nome = urlencode($nome);
            $cpf = urlencode($cpf);
            $email = urlencode($email);
            $unidade = urlencode($unidade);
            header("Location: ../view/cadastro.php?erro=cpf&nome=$nome&cpf=$cpf&email=$email&unidade=$unidade");
            exit;
        } else {
            header("Location: ../view/cadastro.php?erro=desconhecido");
            exit;
        }
    } else {
        // Caso as senhas não coincidam, envia os dados preenchidos de volta
        $nome = urlencode($nome);
        $cpf = urlencode($cpf);
        $email = urlencode($email);
        $unidade = urlencode($unidade);
        header("Location: ../view/cadastro.php?erro=senhas&nome=$nome&cpf=$cpf&email=$email&unidade=$unidade");
        exit;
    }
    
} else {
    echo "Erro ao salvar!";
}
?>