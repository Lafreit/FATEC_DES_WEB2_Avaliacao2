<?php
session_start();
if (!isset($_SESSION['usuario_logado'])) {
    header('Location: login.php');
    exit();
}

require_once 'classes/DB.php';
$db = new DB();
$produtos = $db->listarProdutos();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Lista de Produtos</title>
</head>
<body>
    <h1>Lista de Produtos</h1>
    <?php if ($produtos): ?>
        <ul>
            <?php foreach ($produtos as $produto): ?>
                <li><?php echo $produto['nome']; ?> - R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Nenhum produto cadastrado.</p>
    <?php endif; ?>
    <p><a href="home.php">Voltar</a></p>
</body>
</html>