<?php
session_start();
if (!isset($_SESSION['usuario_logado'])) {
    header('Location: login.php');
    exit();
}

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'classes/DB.php';
    $db = new DB();

    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $descricao = $_POST['descricao'];
    $categoria = $_POST['categoria'];

    if ($db->cadastrarProduto($nome, $preco, $descricao, $categoria)) {
        $mensagem = 'Produto cadastrado com sucesso!';
    } else {
        $mensagem = 'Erro ao cadastrar o produto.';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cadastrar Produto</title>
</head>
<body>
    <h1>Cadastrar Novo Produto</h1>
    <?php if ($mensagem): ?>
        <p><?php echo $mensagem; ?></p>
    <?php endif; ?>
    <form method="POST">
        Nome: <input type="text" name="nome" required><br><br>
        Preço: <input type="number" step="0.01" name="preco" required><br><br>
        Descrição: <textarea name="descricao"></textarea><br><br>
        Categoria: <input type="text" name="categoria"><br><br>
        <button type="submit">Cadastrar</button>
    </form>
    <p><a href="home.php">Voltar</a></p>
</body>
</html>