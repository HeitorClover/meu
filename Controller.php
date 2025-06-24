<?php

require_once __DIR__ . '/../models/Model.php'; // Caminho absoluto, evita erros com níveis de diretórios

class Controller {
private $model;

public function __construct(){
    $this->model = new Model(); 
}

public function cadastrar() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];

        $this->model->salvar($nome, $email, $senha);

        header("Location: cadastros/cadastrar.php?sucesso=1");
        exit();

    }
}

public function empresa() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST["nome"];
        $cnpj = $_POST["cnpj"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];

        $this->model->Empresar($nome, $cnpj, $email, $senha);

        header("Location: cadastros/empresa.php?sucesso=1");
        exit;
    }
}

public function camps() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        session_start(); // Inicia a sessão
        
        // Recupera dados da empresa logada da sessão
        $empresa_nome_sessao = $_SESSION['empresa_nome'] ?? '';
        $empresa_email_sessao = $_SESSION['empresa_email'] ?? '';
        $empresa_cnpj_sessao = $_SESSION['empresa_cnpj'] ?? '';

        // Dados do formulário
        $nome = $_POST["nome"];
        $cnpj = $_POST["cnpj"];
        $nome_dono = $_POST["nome_dono"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        $nicho = $_POST["nicho"];
        $logradouro = $_POST["logradouro"];
        $cidade = $_POST["cidade"];
        $cep = $_POST["cep"];
        $estado = $_POST["estado"];
        $bairro = $_POST["bairro"];
        $target_file = $_FILES['arquivo'];

        // Verifica se os dados do formulário batem com a sessão
        if ($nome_dono !== $empresa_nome_sessao || 
            $email !== $empresa_email_sessao || 
            $cnpj !== $empresa_cnpj_sessao) {
            die("Dados da empresa não coincidem com o usuário logado.");
        }

        if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] === UPLOAD_ERR_OK) {
            require_once __DIR__ . '/../models/upload.php';
            $caminhoSeguro = fazerUpload($_FILES['arquivo']);
        } else {
            die("Erro no envio do arquivo.");
        }

        if (!$this->model->empresaExiste($nome_dono, $email, $senha, $cnpj)) {
            die("Empresa não encontrada ou dados incorretos.");
        }

        // Cadastra o campeonato
        $this->model->Campar(
            $nome,
            $nome_dono,
            $cnpj,
            $email,
            $senha,
            $nicho,
            $cep,
            $logradouro,
            $cidade,
            $bairro,
            $estado,
            $caminhoSeguro
        );

       
        // CRIAÇÃO DO ARQUIVO DO CAMPEONATO

        $diretorio = "C:/Apache24/htdocs/SporTTown/Corpos/";
        $nomeSanitizado = preg_replace('/[^a-zA-Z0-9_-]/', '_', $nome);
        $arquivo = $diretorio . $nomeSanitizado . ".php";

        $conteudo = <<<PHP
        <?php
        // Aqui deve aparacer: Página do campeonato: $nome
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        include('../models/Model.php');
        \$model = new Model();
        \$pdo = \$model->getConnect();

        // Recupera dados da sessão
        \$nome = \$_SESSION['empresa_nome'] ?? '';
        \$email = \$_SESSION['empresa_email'] ?? '';
        \$cnpj = \$_SESSION['empresa_cnpj'] ?? '';

        require_once('../configs/protected.php');
        ?>

        <!DOCTYPE html>
        <html lang="pt-BR">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="icon" type="image/png" href="../Imagens/favicon.png">
            <title>$nome</title>
            <link rel="stylesheet" href="../css/style.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        </head>
        <body>
            <div class="profile-section">
                <div class="profile-text">
                    <strong><?= htmlspecialchars(\$nome) ?></strong><br>
                    <small><?= htmlspecialchars(\$email) ?></small><br>   
                    <?php if (isset(\$_SESSION['empresa_cnpj'])): ?>
                        <small>CNPJ: <?= htmlspecialchars(\$cnpj) ?></small><br>
                    <?php endif; ?>
                    <a href="../login/logout.php" class="sair"> <small>Sair</small> </a>
                </div>
            </div>
        </body>
        </html>
        PHP;

        if (!file_exists($arquivo)) {
            if (file_put_contents($arquivo, $conteudo) !== false) {
                // Apenas para debug: você pode remover esse echo depois
                echo "Arquivo criado: " . $arquivo;
            } else {
                die("Erro ao criar o arquivo.");
            }
        }

        

        header("Location: cadastros/camps.php?sucesso=1");
        exit;
    }
}

public function painel() {
    // inicia sessão e verifica login, se necessário…
    session_start();
    // busca todos os camps
    $camps = $this->model->getAllCamps();

    // aqui você pode passar $camps para a view,
    // em puro PHP seria algo como:
    include __DIR__ . '/../views/painel.php';
}


public function listar() {
    return $this->model->buscarTodosCampeonatos();
}

public function buscarCampeonatosPorFiltros($nome, $nicho) {
    // Se nicho estiver vazio, passe uma string vazia para o model
    return $this->model->buscarCampeonatosPorNome($nome, $nicho ?? '');
}


public function buscarPorNome($nome) {
    // Adicione o parâmetro $nicho com valor padrão vazio
    return $this->model->buscarCampeonatosPorNome($nome, '');
}

 public function deletar() {
     if (isset($_GET['nome'])) {
         $nome = $_GET['nome'];
         if ($this->model->deletarCampeonato($nome)) {
            header("Location: /SporTTown/router.php?rota=listar&sucesso=1");
            if ($this->model->deletarCampeonato($nome)) {
            // --- começa deleção do arquivo em Corpos ---
           // 1) sanitiza o nome exatamente como você fez na criação:
            $nomeSanitizado = preg_replace('/[^a-zA-Z0-9_-]/', '_', $nome);
            // 2) monta o caminho absoluto para a pasta Corpos
         $arquivoCorpo = __DIR__ . '/../Corpos/' . $nomeSanitizado . '.php';
            // 3) se existir, apaga o arquivo
            if (file_exists($arquivoCorpo)) {
                unlink($arquivoCorpo);
           }
          // --- fim deleção do arquivo em Corpos ---
            header("Location: /SporTTown/router.php?rota=listar&sucesso=1");
         } else {
             header("Location: /SporTTown/router.php?rota=listar&erro=1");
         }}}}
  

public function atualizar() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        session_start();
        
        $nome = $_POST["nome"];
        $cnpj = $_POST["cnpj"];
        $nome_dono = $_POST["nome_dono"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        $nicho = $_POST["nicho"];
        $cep = $_POST["cep"];
        $logradouro = $_POST["logradouro"];
        $cidade = $_POST["cidade"];
        $bairro = $_POST["bairro"];
        $estado = $_POST["estado"];
        
        if ($this->model->atualizarCampeonato($nome_original, $nome, $nome_dono, $cnpj, $email, $senha, $nicho, $cep, $logradouro, $cidade, $bairro, $estado)) {
            header("Location: /SporTTown/router.php?rota=listar&sucesso=1");
        } else {
            header("Location: /SporTTown/router.php?rota=listar&erro=1");
        }
        exit;
    }
}

}
