<?php
include("conexao.php"); // Inclua seu arquivo de conexão

if (isset($_POST['submit'])) {
    // Obtenha os dados do formulário
    $nome = $conexao->real_escape_string($_POST['nome']);
    $endereco = $conexao->real_escape_string($_POST['endereco']);
    $idade = (int)$_POST['idade']; // Converter para inteiro
    $genero = (int)$_POST['genero']; // Converter para inteiro
    $senha = md5(md5($_POST['senha'])); 
    $email = $conexao->real_escape_string($_POST['email']);
    $nivelacesso = 1; 

    // Insira os dados no banco de dados
    $sql_code = "INSERT INTO usuario (nome, endereco, idade, genero, senha, email, nivelacesso) 
                 VALUES ('$nome', '$endereco', $idade, $genero, '$senha', '$email', $nivelacesso)";
    
    if ($conexao->query($sql_code)) {
        echo "Usuário cadastrado com sucesso!";
    } else {
        echo "Erro: " . $conexao->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
</head>
<body>

<h2>Cadastro de Usuário</h2>
<form action="" method="post">
    <p><input name="nome" placeholder="Nome" type="text" required></p>
    <p><input name="endereco" placeholder="Endereço" type="text" required></p>
    <p><input name="idade" placeholder="Idade" type="number" required></p>
    <p>
        <label>Gênero:</label>
        <select name="genero" required>
            <option value="0">Selecione</option>
            <option value="1">Masculino</option>
            <option value="2">Feminino</option>
            <option value="3">Outro</option>
        </select>
    </p>
    <p><input name="senha" placeholder="Senha" type="password" required></p>
    <p><input name="email" placeholder="E-mail" type="email" required></p>
    <p><input type="submit" name="submit" value="Cadastrar"></p>
</form>

</body>
</html>
