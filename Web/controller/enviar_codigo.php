<?php
session_start();
require 'conecta_banco.php';

$conn = Database::getConnection();
$email = $_POST['email'] ?? '';

if (!$email) {
    $_SESSION['msg'] = "Email inválido!";
    header("Location: ../view/recuperar_senha/solicitar_email.php");
    exit();
}

// Verifica se email existe
$stmt = $conn->prepare("SELECT CPF FROM ADMINISTRADOR WHERE EMAIL = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $_SESSION['msg'] = "Email não encontrado!";
    header("Location: ../view/recuperar_senha/solicitar_email.php");
    exit();
}

// Gera código
$codigo = rand(100000, 999999);

// Tabela RECUPERACAO_SENHA
$conn->query("CREATE TABLE IF NOT EXISTS RECUPERACAO_SENHA (
    email VARCHAR(150) NOT NULL,
    codigo VARCHAR(6) NOT NULL,
    expira_em DATETIME NOT NULL
)");

$expira = date("Y-m-d H:i:s", time() + 600); // 15 minutos = 900 segundos
$conn->query("DELETE FROM RECUPERACAO_SENHA WHERE email='$email'");
$stmt = $conn->prepare("INSERT INTO RECUPERACAO_SENHA (email, codigo, expira_em) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $email, $codigo, $expira);
$stmt->execute();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Enviando código...</title>
  <script src="https://cdn.jsdelivr.net/npm/emailjs-com@3/dist/email.min.js"></script>
  <script>
    (function(){ emailjs.init("SfCN5nmruXCBrwSmz"); })();

    window.onload = function() {
      emailjs.send("service_nutrigestao", "template_nutrigestao", {
        email: "<?php echo $email; ?>",
        codigo: "<?php echo $codigo; ?>"
      }).then(function() {
        window.location.href = "../view/recuperar_senha/confirmar_codigo.php?email=<?php echo $email; ?>";
      }, function(err) {
        alert("Erro ao enviar email. Tente novamente.");
        window.location.href = "../view/recuperar_senha/solicitar_email.php";
      });
    }
  </script>
  <style>
    body{
      background-color: #f5f5f5;
    }
    p{
      margin-left:45%;
      margin-top:25%;
    }
  </style>
</head>
<body>
  <p id="enviando">Enviando código para seu email...</p>
</body>
</html>
