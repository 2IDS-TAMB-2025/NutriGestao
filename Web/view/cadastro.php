<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="cadastro.css">
    <link rel="icon" href="./images/2.png" type="image/x-icon">
    <style>
        #cadastro {
            margin-left: 37%;
        }
        .erro {
            color: red;
            font-weight: bold;
            margin-bottom: 10px;
            text-align: center;
        }
        .sucesso {
            color: green;
            font-weight: bold;
            margin-bottom: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login">
            <h2>Bem Vindo!</h2>
            <p>Para se manter conectado conosco<br>por favor logue com suas informações pessoais</p>
            <a href="login.php"><button>Login</button></a>
        </div>

        <div class="registro">
            <h2>Cadastro</h2>
            <br/>

            <?php if (isset($_GET['erro'])): ?>
                <div class="erro">
                    <?php
                        if ($_GET['erro'] === 'cpf') {
                            echo "O CPF já está sendo utilizado por outro usuário.";
                        } elseif ($_GET['erro'] === 'senhas') {
                            echo "As senhas não coincidem!";
                        } elseif ($_GET['erro'] === 'unidade_invalida') {
                            echo "A unidade escolar deve ser um número de 3 dígitos!";
                        } else {
                            echo "Ocorreu um erro ao cadastrar. Tente novamente.";
                        }
                    ?>
                </div>
            <?php elseif (isset($_GET['sucesso'])): ?>
                <div class="sucesso">
                    Cadastro realizado com sucesso!
                </div>
            <?php endif; ?>

            <form action="../controller/controller_administrador.php" method="POST" id="cadastroForm">
                <input type="text" name="nome" placeholder="Nome Completo"
                       value="<?= isset($_GET['nome']) ? htmlspecialchars($_GET['nome']) : '' ?>">

                <input type="text" name="cpf" placeholder="CPF"
                       value="<?= isset($_GET['cpf']) ? htmlspecialchars($_GET['cpf']) : '' ?>">

                <input type="email" name="email" placeholder="Email"
                       value="<?= isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '' ?>">

                <input type="text" name="unidade_escolar" id="unidade_escolar" placeholder="Unidade Escolar (3 dígitos)"
                       maxlength="3" pattern="[0-9]{3}" title="Digite exatamente 3 números"
                       value="<?= isset($_GET['unidade']) ? htmlspecialchars($_GET['unidade']) : '' ?>">

                <input type="password" name="senha" placeholder="Senha">
                <input type="password" name="confirmar_senha" placeholder="Confirmar Senha">
                <br/>
                <button type="submit" id="cadastro">Cadastrar-se</button>
            </form>
        </div>
    </div>

    <script>
        // Validação da unidade escolar no frontend
        document.getElementById('unidade_escolar').addEventListener('input', function(e) {
            // Remove qualquer caractere não numérico
            this.value = this.value.replace(/[^0-9]/g, '');
            
            // Limita a 3 dígitos
            if (this.value.length > 3) {
                this.value = this.value.slice(0, 3);
            }
        });

        document.getElementById('cadastroForm').addEventListener('submit', function(e) {
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