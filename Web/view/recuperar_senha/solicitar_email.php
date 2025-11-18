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
  <title>Recuperar Senha</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <style>
    h2{color: #f49200}
    body {font-family: Poppins, sans-serif; background:#f5f5f5; display:flex; justify-content:center; align-items:center; height:100vh; margin:0;}
    .box {background:#fff; padding:20px; border-radius:10px; box-shadow:0 0 10px rgba(0,0,0,0.1); max-width:400px; width:100%;}
    h2 {margin-bottom:10px;}
    #email{width: 95%;}
    input,button {width:100%; padding:10px; margin:10px 0; border:1px solid #ccc; border-radius:5px;}
    button {background:#f49200; color:white; border:none; cursor:pointer;}
    button:hover {background:#ffb444;}
    .msg {color:red; text-align:center;}
  </style>
</head>
<body>
  <div class="box">
    <h2>Recuperar Senha</h2>
    <p>Digite seu email cadastrado para receber um código de recuperação.</p>
    <?php if($msg): ?><p class="msg"><?= htmlspecialchars($msg) ?></p><?php endif; ?>
    <form action="../../controller/enviar_codigo.php" method="POST">
      <input type="email" name="email" id="email" placeholder="Digite seu email" required>
      <button type="submit">Enviar Email</button>
    </form>
  </div>
</body>
</html>
