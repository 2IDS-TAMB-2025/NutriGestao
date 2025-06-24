<?php
session_start();
$msg = $_SESSION['msg'] ?? '';
unset($_SESSION['msg']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueci senha</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
    <div class="container">
        <div class="login">
            <h2>Esqueceu sua senha?</h2>
            <p>Informe o e-mail associado à sua conta para alterar sua senha.</p>
        </div>
        <div class="registro">
            <h2>Recupere sua conta:</h2>
              <?php if($msg): ?>
                    <p><?= htmlspecialchars($msg) ?></p>
            <?php endif; ?>
            <form action="../controller/verifica_email.php" method="POST">
                <input type="email" name="email" placeholder="Email" required>
                <br/>
                <button type="submit">Enviar código</button>
            </form>
            <br/><br/>
        </div>
    </div>
</body>
</html>