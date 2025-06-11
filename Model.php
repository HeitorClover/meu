<?php
class Model {
    private $host = 'localhost';
    private $dbname = 'loginsporttown';
    private $usuario = 'root';
    private $senha = 'mysql2024';

    protected $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->usuario, $this->senha);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro na conexão: " . $e->getMessage());
        }
    }
    
    public function getConnect() {
        return $this->pdo;
    }

    
    public function hashPassword($senha) {
        return password_hash($senha, PASSWORD_DEFAULT);
    }

    public function verifyPassword($senhaDigitada, $hashArmazenado) {
        return password_verify($senhaDigitada, $hashArmazenado); // Retorne DIRETAMENTE
    }
    
    public function salvar($nome, $email, $senha) {
        try {
            // Criptografa a senha
            $hash = password_hash($senha, PASSWORD_DEFAULT);

            // SQL com 3 colunas e 3 placeholders nomeados
            $sql = "
                INSERT INTO usuario (nome, email, senha)
                VALUES (:nome, :email, :senha)
            ";
            $stmt = $this->pdo->prepare($sql);

            // Bind correto de cada placeholder
            $stmt->bindParam(':nome',  $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $hash);

            $stmt->execute();
        } catch (PDOException $e) {
            die("Erro ao salvar: " . $e->getMessage());
        }
    }

    public function Empresar($nome, $cnpj, $email, $senha) {
        try {
            // Criptografa a senha
            $hash = password_hash($senha, PASSWORD_DEFAULT);

            // SQL com 3 colunas e 3 placeholders nomeados
            $sql = "
                INSERT INTO empresa (nome, cnpj, email, senha)
                VALUES (:nome, :cnpj, :email, :senha)
            ";
            $stmt = $this->pdo->prepare($sql);

            // Bind correto de cada placeholder
            $stmt->bindParam(':nome',  $nome);
            $stmt->bindParam(':cnpj',  $cnpj);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $hash);

            $stmt->execute();
        } catch (PDOException $e) {
            die("Erro ao salvar: " . $e->getMessage());
        }
    }

    public function Campar($nome, $nome_dono, $cnpj, $email, $senha, $nicho, $cep, $logradouro, $cidade, $bairro, $estado) {
        try {
            // Criptografa a senha
            $hash = password_hash($senha, PASSWORD_DEFAULT);

            // SQL com 3 colunas e 3 placeholders nomeados
            $sql = "
                INSERT INTO camps (nome, nome_dono, cnpj, email, senha, nicho, cep, logradouro, cidade, bairro, estado)
                VALUES (:nome, :nome_dono, :cnpj, :email, :senha, :nicho, :cep, :logradouro, :cidade, :bairro, :estado)
            ";


            $stmt = $this->pdo->prepare($sql);

            // Bind correto de cada placeholder
            $stmt->bindParam(':nome',       $nome);
            $stmt->bindParam(':cnpj',       $cnpj);
            $stmt->bindParam(':nome_dono',  $nome_dono);
            $stmt->bindParam(':email',      $email);
            $stmt->bindParam(':senha',      $hash);
            $stmt->bindParam(':nicho',      $nicho);
            $stmt->bindParam(':cep',        $cep);
            $stmt->bindParam(':logradouro', $logradouro);
            $stmt->bindParam(':cidade',     $cidade);
            $stmt->bindParam(':bairro',     $bairro);
            $stmt->bindParam(':estado',     $estado);

            

            $stmt->execute();
        } catch (PDOException $e) {
            die("Erro ao salvar: " . $e->getMessage());
        }
    }

    public function empresaExiste($nome, $email, $senhaDigitada, $cnpj) {
        $stmt = $this->pdo->prepare("SELECT senha FROM empresa WHERE nome = ? AND email = ? AND cnpj = ?");
        $stmt->execute([$nome, $email, $cnpj]);
        $empresa = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($empresa && password_verify($senhaDigitada, $empresa['senha'])) {
            return true;
        }

        return false;
    }




}?>
