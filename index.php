<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="icon" href="img/ghrlogo.ico" type="image/x-icon">
    <title>Entrar</title>
</head>

<body>
    <div class="bloco1">
        <div class="bloco esquerda">
            <img src="img/logoghr.png" alt="Logo" class="logo">
        </div>
        <div class="bloco direita">
            <h1>Data Entry</h1>
            <p>Atendimento/Requisições</p>
            <form>
                <input type="text" id="usuario" name="usuario" placeholder="Usuário" required>
                <input type="password" id="senha" name="senha" placeholder="Senha" required>
                <button type="button" onclick="window.location.href='inc/main.php'">Entrar</button>
            </form>
        </div>
    </div>
</body>

</html>