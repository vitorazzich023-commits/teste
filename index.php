<?php
/**
 * index.php - Atividade: formulários GET e POST
 * -------------------------------------------------------------
 * Requisitos atendidos:
 *  - Dois formulários na mesma página (GET e POST).
 *  - Método identificado com $_SERVER['REQUEST_METHOD'].
 *  - Dados lidos de $_GET ou $_POST, conforme o método.
 *  - Verificação de envio + validação do nome (trim).
 *  - Mensagem de erro para campo vazio ou só com espaços.
 *  - Mensagem de sucesso com o nome e o método utilizados.
 *
 * Observações de implementação:
 *  - Abrir a página já é uma requisição GET, porém SEM o campo "nome".
 *    Por isso, só validamos quando a chave "nome" realmente existe.
 *  - O atributo HTML "required" foi omitido de propósito: a validação
 *    exigida é a do servidor (é ela que gera a mensagem de erro).
 */

$mensagem     = ''; // texto exibido ao usuário
$tipoMensagem = ''; // 'erro' ou 'sucesso' (apenas para estilizar)

// 1. Identifica o método HTTP da requisição ('GET' ou 'POST').
$metodo = $_SERVER['REQUEST_METHOD'];

// 2. Verifica se o campo "nome" foi enviado e lê o valor pelo array
//    correspondente ao método. Valores não-string (ex.: nome[]=x)
//    são descartados para evitar erro em trim().
$nomeRecebido = false;
$nome         = '';

if ($metodo === 'POST' && isset($_POST['nome'])) {
    $nomeRecebido = true;
    $nome         = $_POST['nome'];
} elseif ($metodo === 'GET' && isset($_GET['nome'])) {
    $nomeRecebido = true;
    $nome         = $_GET['nome'];
}

// 3. Valida apenas quando houve envio do formulário.
if ($nomeRecebido) {
    $nome = is_string($nome) ? trim($nome) : '';

    // 4. Nome vazio ou contendo apenas espaços -> erro.
    if ($nome === '') {
        $tipoMensagem = 'erro';
        $mensagem     = 'Informe seu nome para continuar.';
    } else {
        // 5. Nome válido -> sucesso com nome e método.
        $tipoMensagem = 'sucesso';
        $mensagem     = "Recebemos o nome {$nome} pelo método {$metodo}.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Formulários GET e POST</title>
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
    <h1>Formulários GET e POST</h1>

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
