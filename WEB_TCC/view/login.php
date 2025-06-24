<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon " type="imagem/x-con" href="./images/2.png">
    <title>Nutrigestão - Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="login.css">

</head>
<style>
    .botao{
        margin-left:35%
    }
</style>
<body>
    <div class="container">
        <div class="login">
            <h2>Bem Vindo!</h2>
            <p>Para se manter conectado conosco<br>por favor logue com suas informações pessoais</p>
            <a href="cadastro.html"><button>Cadastrar-se</button></a>
        </div>
        <div class="registro">
            <h1 class="titulo">NutriGestão</h1>
            <?php if (isset($_GET['erro'])): ?>
                <div style="color: #fd9c14; padding: 10px;">
                    Dados inválidos!
                </div>
            <?php endif; ?>
            <form method="POST" action="../controller/controller_login.php">
            <input type="text" name="cpf" id="cpf" placeholder="CPF">
            <input type="text" name="unidade_escolar" id="unidade_escolar" placeholder="Unidade Escolar">
            <input type="password" name="senha" id="senha" placeholder="Senha">
            <br/>
            <br/>
            <button style="margin-left:45%;">Entrar</button>
            <br>
            <br/>
            <a href="esquecisenha.php" class="botao">Esqueci a minha senha</a>
            </form>
        </div>
    </div>
</body>
</html>