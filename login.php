<?php
session_start();
$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    if ($usuario === 'admin' && $senha === 'admin') {
        $_SESSION['usuario_logado'] = true;
        header('Location: home.php');
        exit();
    } else {
        $erro = 'Usuário ou senha incorretos.';
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <?php if ($erro): ?>
        <p style="color: red;"><?php echo $erro; ?></p>
    <?php endif; ?>
    <form method="POST">
        <input type="text" name="usuario" placeholder="Usuário" required><br><br>
        <input type="password" name="senha" placeholder="Senha" required><br><br>
        <button type="submit">Entrar</button>
    </form>
    <p><a href="login.php?logout=true">Logout</a></p>
</body>
</html>