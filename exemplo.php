<?php
/**
 * exemplo.php - Gabarito da atividade: formulários GET e POST
 * -------------------------------------------------------------
 * Copie/adapte a lógica abaixo para o index.php.
 */

$mensagem     = '';
$tipoMensagem = '';

$metodo = $_SERVER['REQUEST_METHOD'];

$nomeRecebido = false;
$nome         = '';

if ($metodo === 'POST' && isset($_POST['nome'])) {
    $nomeRecebido = true;
    $nome         = $_POST['nome'];
} elseif ($metodo === 'GET' && isset($_GET['nome'])) {
    $nomeRecebido = true;
    $nome         = $_GET['nome'];
}

if ($nomeRecebido) {
    $nome = is_string($nome) ? trim($nome) : '';

    if ($nome === '') {
        $tipoMensagem = 'erro';
        $mensagem     = 'Informe seu nome para continuar.';
    } else {
        $tipoMensagem = 'sucesso';
        $mensagem     = "Recebemos o nome {$nome} pelo método {$metodo}.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Exemplo - Formulários GET e POST</title>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; margin: 40px; }
        form { margin-bottom: 24px; }
        label { display: block; margin-bottom: 6px; }
        input[type="text"] { padding: 6px; width: 260px; }
        button { padding: 6px 14px; margin-top: 8px; cursor: pointer; }
        .mensagem { padding: 10px 14px; border-radius: 4px; max-width: 420px; }
        .sucesso { background: #e6f4ea; border: 1px solid #34a853; color: #1e4620; }
        .erro    { background: #fce8e6; border: 1px solid #ea4335; color: #611a15; }
    </style>
</head>
<body>
    <h1>Exemplo funcionando - GET e POST</h1>

    <?php if ($mensagem !== ''): ?>
        <p class="mensagem <?= $tipoMensagem === 'erro' ? 'erro' : 'sucesso' ?>">
            <?= htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8') ?>
        </p>
    <?php endif; ?>

    <h2>Formulário 1 - Método GET</h2>
    <form method="GET" action="">
        <label for="nome-get">Nome:</label>
        <input type="text" id="nome-get" name="nome" placeholder="Digite seu nome">
        <button type="submit">Enviar via GET</button>
    </form>

    <hr>

    <h2>Formulário 2 - Método POST</h2>
    <form method="POST" action="">
        <label for="nome-post">Nome:</label>
        <input type="text" id="nome-post" name="nome" placeholder="Digite seu nome">
        <button type="submit">Enviar via POST</button>
    </form>
</body>
</html>
