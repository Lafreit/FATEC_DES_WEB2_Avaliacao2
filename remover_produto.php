<?php
session_start();
if (!isset($_SESSION['usuario_logado'])) {
    header('Location: login.php');
    exit();
}

require_once 'classes/DB.php';
$db = new DB();
$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_remover = $_POST['id_remover'];
    if (is_numeric($id_remover)) {
        if ($db->removerProduto($id_remover)) {
            $mensagem = 'Produto removido com sucesso!';
        } else {
            $mensagem = 'Erro ao remover o produto.';
        }
    } else {
        $mensagem = 'ID inválido.';
    }
}

// Obter a lista de produtos para o formulário de remoção
$produtos = $db->listarProdutos();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Remover Produto</title>
</head>
<body>
    <h1>Remover Produto</h1>
    <?php if ($mensagem): ?>
        <p><?php echo $mensagem; ?></p>
    <?php endif; ?>
    <form method="POST">
        <label for="id_remover">Selecione o produto a remover:</label>
        <select name="id_remover" id="id_remover" required>
            <option value="">Selecione...</option>
            <?php foreach ($produtos as $produto): ?>
                <option value="<?php echo $produto['id']; ?>"><?php echo $produto['nome']; ?> (ID: <?php echo $produto['id']; ?>)</option>
            <?php endforeach; ?>
        </select>
        <br><br>
        <button type="submit">Remover Produto</button>
    </form>
    <p><a href="home.php">Voltar</a></p>
</body>
</html>