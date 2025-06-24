<?php
require_once '../controller/controller_relatorio.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Editar Usuários</title>
    <meta charset="UTF-8">
</head>
<body>
    <h1>Edição de Usuários</h1>
    <br/>
    <form action="../controller/controller_relatorio.php" method="post">
        <table border="1">
            <tr>
                <th>CPF</th>
                <th>Tipo</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Unidade Escolar</th>
                <th>Senha</th>
                <th>Ação</th>
            </tr>
            <?php
            if (isset($usuarios) && count($usuarios)) {
                foreach ($usuarios as $usu) {
            ?>
            <tr>
                <td><input type="text" name="cpf" value="<?php echo $usu['cpf']; ?>" readonly></td>
                <td><input type="text" name="tipo" value="<?php echo $usu['tipo']; ?>"></td>
                <td><input type="text" name="nome" value="<?php echo $usu['nome']; ?>"></td>
                <td><input type="email" name="email" value="<?php echo $usu['email']; ?>"></td>
                <td><input type="text" name="unidade_escolar" value="<?php echo $usu['unidade_escolar']; ?>"></td>
                <td><input type="password" name="senha" value="<?php echo $usu['senha']; ?>"></td>
                <td><input type="submit" name="acao" value="Editar"></td>
            </tr>
            <?php
                }
            }
            ?>
        </table>
    </form>
</body>
</html>