<?php
require_once "../controller/controller_relatorio.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Usuários</title>
</head>
<body>
    <h1>Relatório de Usuários</h1>

    <form action="" method="post">
        <input type="text" id="pesquisaNome" name="pesquisaNome" placeholder="Nome...">
        <input type="submit" value="Pesquisar">
    </form>

    <br/>
    <table border="1">
        <tr>
            <th>CPF</th>
            <th>Tipo</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Unidade Escolar</th>
            <th>Senha</th>
            <th>Editar</th>
            <th>Excluir</th>
        </tr>

        <?php
        if (isset($usuarios) && count($usuarios) > 0) {
            foreach ($usuarios as $usuario) {
                ?>
                <tr>
                    <td><?php echo $usuario["cpf"]; ?></td>
                    <td><?php echo $usuario["tipo"]; ?></td>
                    <td><?php echo $usuario["nome"]; ?></td>
                    <td><?php echo $usuario["email"]; ?></td>
                    <td><?php echo $usuario["unidade_escolar"]; ?></td>
                    <td><?php echo $usuario["senha"]; ?></td>
                    <td><a href="view_editar_usuario.php?cpf=<?php echo $usuario["cpf"]; ?>">Editar</a></td>
                    <td><a href="../controller/controller_excluir.php?cpf=<?php echo $usuario["cpf"]; ?>" onclick="return confirm('Tem certeza que deseja excluir este usuário?');">Excluir</a></td>
                </tr>
                <?php
            }
        } else {
            echo "<tr><td colspan='8'>Nenhum usuário encontrado.</td></tr>";
        }
        ?>
    </table>

    <br/>
    <a href="index.html"><button>Cadastrar Usuário</button></a>
</body>
</html>