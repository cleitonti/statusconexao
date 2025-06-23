<?php //Esse é basicamente um script com a função que fará o teste de conexão
function verificarPorta($ip, $porta, $timeout = 5) {
    $conexao = @fsockopen($ip, $porta, $errno, $errstr, $timeout);
    if ($conexao) {
        fclose($conexao);
        return true;
    } else {
        return false;
    }
}

$ip = $_POST['ip'] ?? ''; //Variável que recebe o IP
$porta = $_POST['porta'] ?? ''; //Variável que recebe a porta
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Resultado da Conectividade</title>
    <link rel="stylesheet" href="style.css">
</head>
<body> <!-- Preciso desse form para enviar o retorno em tela de forma amigável -->
    <div class="card">
        <h2>Resultado</h2>
        <div class="result">
            <?php
            if ($ip && $porta) {
                $portas = explode(',', $porta);
                foreach ($portas as $p) {
                    $p = trim($p);
                    if (is_numeric($p)) {
                        $status = verificarPorta($ip, $p) ? '✅ Aberta' : '❌ Fechada ou inacessível';
                        echo "<p><strong>Porta $p:</strong> $status</p>";
                    } else {
                        echo "<p><strong>Porta inválida:</strong> $p</p>";
                    }
                }
            } else {
                echo "<p>IP ou porta não informados corretamente.</p>";
            }
            ?>
        </div>
        <a class="back-button" href="index.html">← Voltar</a>
    </div>
</body>
</html>

