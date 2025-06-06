<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<style>
body {
    background-image: url(../Imagens/Tela.PNG);
    background-size: cover; /* ajusta a imagem para cobrir toda a tela */
    background-repeat: no-repeat; /* evita que a imagem se repita */
    font-family: Arial, sans-serif;
    background-color: #f0f2f5;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
  }

  .login-container {
    background-color: rgba(252, 0, 0, 0);
    padding: 90px;
    padding-bottom: 30%;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    width: 300px;
    font-style: italic;
  }

  .login-container h1 {
    color: #ffffff;
    text-align: center;
    margin-bottom: 10px;
    font-size: xx-large;
  }

  .login-container h4 {
    color: #ffffff;
    text-align: center;
    margin-bottom: 20px;

  }

  .login-container input[type="text"],
  .login-container input[type="password"] {
    width: 100%;
    padding: 20px;
    margin: 20px 0;
    background-color: #252424;
    color: rgb(255, 255, 255);
    border: 1px solid #000000;
    border-radius: 5px;
  }

  .login-container button {
    width: 100%;
    padding: 10px;
    background-color: #252424;
    color: rgb(255, 255, 255);
    border: none;
    border-radius: 6px;
    cursor: pointer;
    margin-top: 15px;
    margin-left: 20px;
    
  }

  .login-container button:hover {
    background-color: #2c1313;
  }
</style>

     <?php if(isset($_GET['sucesso'])): ?>
        <p style="color: green;">Estudante cadastrado com sucesso!</p>
    <?php endif; ?>

    <form action="router.php?rota=empresa" method="POST">

        <label>Nome:</label>
        <input type="text" name="nome" placeholder="Nome" maxlength="200" required>

        <label>CNPJ:</label>
        <input type="text" name="cnpj" placeholder="CNPJ" maxlength="200" required>

        <label>Email:</label>
        <input type="text" name="email" placeholder="Email" maxlength="500" required>

        <label>Senha</label>
        <input type="password" name="senha" placeholder="Senha" min="6" max="100" required>

        <br><br>
        <input type="submit" value="Cadastrar">
    </form>

    <button onclick="window.location.href='../index.php'">Voltar ao Menu</button>
    
</body>
</html>