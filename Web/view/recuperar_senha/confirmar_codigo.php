<?php
$email = $_GET['email'] ?? '';
if (!$email) {
    header("Location: solicitar_email.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Confirmar Código</title>
  <style>
    body {font-family: Poppins, sans-serif; background:#f5f5f5; display:flex; justify-content:center; align-items:center; height:100vh; margin:0;}
    .box {background:#fff; padding:20px; border-radius:10px; box-shadow:0 0 10px rgba(0,0,0,0.1); max-width:400px; width:100%;}
    input,button {width:100%; padding:10px; margin:10px 0; border:1px solid #ccc; border-radius:5px;}
    #codigo{width: 95%;}
    h2{color: #f49200;}
    button {background:#f49200; color:white; border:none; cursor:pointer;}
    button:hover {background:#ffb444;}
  </style>
</head>
<body>
  <div class="box">
    <h2>Digite o código</h2>
    <form action="../../controller/validar_codigo.php" method="POST">
      <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">
      <input type="text" name="codigo" id="codigo" maxlength="6" placeholder="Código" required>
      <button type="submit">Validar</button>
    </form>
  </div>
</body>
</html>
