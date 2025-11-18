<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="imagem/x-con" href="./images/2.png">
    <title>Nutrigestão - Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="login.css">
    <style>
        .botao {
            display: inline-block;
            margin-left: 35%;
            text-decoration: none;
            color: #f49200;
            font-weight: 600;
        }
        .botao:hover {
            color: #ffb444;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login">
            <h2>Bem Vindo!</h2>
            <p>Para se manter conectado conosco<br>por favor logue com suas informações pessoais</p>
            <a href="cadastro.php"><button>Cadastrar-se</button></a>
        </div>
        <div class="registro">
            <h1 class="titulo">NutriGestão</h1>

            <?php if (isset($_GET['erro'])): ?>
                <div style="color: #fd9c14; padding: 10px; text-align:center;">
                    Dados inválidos!
                </div>
            <?php endif; ?>

            <form method="POST" action="../controller/controller_login.php" id="loginForm">
                <input type="text" name="cpf" id="cpf" placeholder="CPF" required>
                <input type="text" name="unidade_escolar" id="unidade_escolar" placeholder="Unidade Escolar (3 dígitos)" 
                       maxlength="3" pattern="[0-9]{3}" title="Digite exatamente 3 números" required>
                <input type="password" name="senha" id="senha" placeholder="Senha" required>
                
                <button type="submit" style="margin-left:45%;">Entrar</button>
                <br><br>
                
                <a href="recuperar_senha/solicitar_email.php" class="botao">Esqueci a minha senha</a>
            </form>
        </div>
    </div>

    <script>
        // Validação da unidade escolar no login
        document.getElementById('unidade_escolar').addEventListener('input', function(e) {
            // Remove qualquer caractere não numérico
            this.value = this.value.replace(/[^0-9]/g, '');
            
            // Limita a 3 dígitos
            if (this.value.length > 3) {
                this.value = this.value.slice(0, 3);
            }
        });

        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const unidade = document.getElementById('unidade_escolar').value;
            
            // Valida se tem exatamente 3 dígitos
            if (unidade.length !== 3 || !/^\d{3}$/.test(unidade)) {
                e.preventDefault();
                alert('A unidade escolar deve ser um número de exatamente 3 dígitos!');
                document.getElementById('unidade_escolar').focus();
                return false;
            }
            
            return true;
        });
    </script>
</body>
</html>