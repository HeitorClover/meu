<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include('models/Model.php');
$model = new Model();
$pdo = $model->getConnect();

$erro = false;

if (isset($_POST['email'], $_POST['senha'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Primeiro tenta como usuario
    $stmt = $pdo->prepare("SELECT * FROM usuario WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch(PDO::FETCH_OBJ);

    if ($usuario && password_verify($senha, $usuario->senha)) {
        // Limpa sessão anterior da empresa
        unset($_SESSION['empresa_id'], $_SESSION['empresa_nome'], $_SESSION['empresa_email']);

        $_SESSION['usuario_id'] = $usuario->id;
        $_SESSION['usuario_nome'] = $usuario->nome;
        $_SESSION['usuario_email'] = $usuario->email;
        $_SESSION['tipo'] = 'usuario';
        header("Location: painel.php");
        exit;
    }

    // Se não for usuário, tenta como empresa
    $stmt = $pdo->prepare("SELECT * FROM empresa WHERE email = ?");
    $stmt->execute([$email]);
    $empresa = $stmt->fetch(PDO::FETCH_OBJ);

    if ($empresa && password_verify($senha, $empresa->senha)) {
        // Limpa sessão anterior do usuário
        unset($_SESSION['usuario_id'], $_SESSION['usuario_nome'], $_SESSION['usuario_email']);

        $_SESSION['empresa_id'] = $empresa->id;
        $_SESSION['empresa_nome'] = $empresa->nome;
        $_SESSION['empresa_email'] = $empresa->email;
        $_SESSION['tipo'] = 'empresa';
        header("Location: painel.php");
        exit;
    }

    // Nenhum encontrado
    $erro = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_login.css">
    <title> Login </title>
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <h4>Conecte-se para continuar</h4>
        <form action="" method="POST">
            <input type="text" name="email" placeholder="Email:" required>
            <input type="password" name="senha" placeholder="Senha:" required>
            <button type="submit">Entrar</button>
        </form>
        <a href="cadastros/cadastrar.php">Fazer Cadastro</a>
        <a href="cadastros/empresa.php">Cadastro como Empresa</a>
        <a href="recuperar.php">Esqueceu a senha?</a>
        <br>
        <?php if (!empty($erro)): ?>
            <p style="color: red; text-align:center;">Credenciais incorretas.</p>
            <?php endif; ?>
      </div>
      <script src="script_login.js"></script>
</body>
</html>