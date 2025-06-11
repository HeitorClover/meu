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

        // 🚨 Verifica se a empresa existe
        if (!$this->model->empresaExiste($nome_dono, $email, $senha, $cnpj)) {
            die("Empresa não encontrada ou dados incorretos.");
        }

        // ✅ Se passar, cadastra o campeonato
        $this->model->Campar($nome, $nome_dono, $cnpj, $email, $senha, $nicho, $cep, $logradouro, $cidade, $bairro, $estado);

        header("Location: cadastros/camps.php?sucesso=1");
        exit;
    }
}

public function listar() {
    return $this->model->buscarEstudantes();
}

// nome , nome_dono, email, senha, nicho, cep, logradouro, cidade, bairro, estado

}
