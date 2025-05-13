<?php
session_start();
if (!isset($_SESSION['usuario_logado'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Painel Inicial</title>
</head>
<body>
    <h1>Bem-vindo!</h1>
    <p><a href="listar_produtos.php">Listar Produtos</a></p>
    <p><a href="cadastrar_produto.php">Cadastrar Produto</a></p>
    <p><a href="remover_produto.php">Remover Produto</a></p>
</body>
</html>