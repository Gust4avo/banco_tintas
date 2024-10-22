<?php

include("conexao.php"); // Assegure-se de que este arquivo é incluído corretamente

if (isset($_POST['email']) && strlen($_POST['email']) > 0) {

    if (!isset($_SESSION)) {
        session_start();
    }

    $_SESSION['email'] = $conexao->real_escape_string($_POST['email']); // Use $conexao aqui
    $_SESSION['senha'] = md5(md5($_POST['senha']));

    $sql_code = "SELECT senha, codigo FROM usuario WHERE email ='$_SESSION[email]'";
    $sql_query = $conexao->query($sql_code) or die($conexao->error); // Use $conexao aqui

    $dado = $sql_query->fetch_assoc();
    $total = $sql_query->num_rows;

    // Inicialize $erro como um array vazio
    $erro = array(); 

    if ($total == 0) {
        $erro[] = "Esse email não pertence a nenhum usuário.";
    } else {
        if ($dado['senha'] == $_SESSION['senha']) {
            $_SESSION['usuario'] = $dado['codigo'];
            // Redireciona para a página de sucesso
            header("Location: sucesso.php"); // Redireciona aqui
            exit(); // Finaliza o script
        } else {
            $erro[] = "Senha incorreta.";
        }
    }
}

// Verifique se a variável $erro foi inicializada antes de contar
if (isset($erro) && count($erro) > 0) {
    foreach ($erro as $msg) {
        echo "<p>$msg</p>";
    }
}
?>

<html lang="pt-br">
<body>

<form action="" method="post">
    <p><input value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" name="email" placeholder="E-mail" type="text"></p>
    <p><input value="" name="senha" type="password"></p>
    <p><a href="">Esqueceu a senha?</a></p>
    <p><input type="submit" value="Entrar"></p>
</form>

</body>
</html>
