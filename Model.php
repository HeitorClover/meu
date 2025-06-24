<?php
class Model {
    private $host = 'localhost';
    private $dbname = 'loginsporttown';
    private $usuario = 'root';
    private $senha = 'mysql2025';

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

    public function Campar($nome, $nome_dono, $cnpj, $email, $senha, $nicho, $cep, $logradouro, $cidade, $bairro, $estado, string $target_file) {
        try{
            require_once("upload.php");
        }catch (PDOException $e) {
            die("Erro ao fazer Upload: " . $e->getMessage());
        }

        try {
            // Criptografa a senha
            $hash = password_hash($senha, PASSWORD_DEFAULT);

            // SQL com 3 colunas e 3 placeholders nomeados
            $sql = "
                INSERT INTO camps (nome, nome_dono, cnpj, email, senha, nicho, cep, logradouro, cidade, bairro, estado, target_file)
                VALUES (:nome, :nome_dono, :cnpj, :email, :senha, :nicho, :cep, :logradouro, :cidade, :bairro, :estado, :arquivo)
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
            $stmt->bindParam(':arquivo', $target_file, PDO::PARAM_STR);

            

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

    public function buscarTodosCampeonatos() {
    try {
        $stmt = $this->pdo->prepare("SELECT nome, nome_dono, nicho, logradouro FROM camps");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        error_log("Erro ao buscar campeonatos: " . $e->getMessage());
        return [];
    }
}

public function buscarCampeonatosPorNome($nome, $nicho) {
    try {
        $sql = "SELECT nome, nome_dono, nicho, logradouro FROM camps WHERE 1=1";
        $params = [];
        
        if (!empty($nome)) {
            $sql .= " AND nome LIKE :nome";
            $params[':nome'] = '%'.$nome.'%';
        }
        
        // Modificação importante: só adiciona o filtro se nicho não estiver vazio
        if (!empty($nicho)) {
            $sql .= " AND nicho = :nicho";
            $params[':nicho'] = $nicho;
        }
        
        $stmt = $this->pdo->prepare($sql);
        
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        error_log("Erro ao buscar campeonatos: " . $e->getMessage());
        return [];
    }
}

public function getAllCamps() {
    $sql = "
        SELECT
            id,
            nome,
            nome_dono,
            email,
            cnpj,
            nicho,
            cep,
            logradouro,
            cidade,
            bairro,
            estado,
            criado_em,
            target_file      
        FROM camps
        ORDER BY criado_em DESC
    ";
    $stmt = $this->pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function deletarCampeonato($nome) {
    try {
        $stmt = $this->pdo->prepare("DELETE FROM camps WHERE nome = :nome");
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        return $stmt->execute();
    } catch (PDOException $e) {
        error_log("Erro ao excluir campeonato: " . $e->getMessage());
        return false;
    }
}


public function atualizarCampeonato($nome_original, $nome, $nome_dono, $cnpj, $email, $senha, $nicho, $cep, $logradouro, $cidade, $bairro, $estado) {
    try {
        $stmt = $this->pdo->prepare("
            UPDATE camps 
            SET nome = :nome, cnpj = :cnpj, nome_dono = :nome_dono, email = :email, 
            nicho = :nicho, cep = :cep, logradouro = :logradouro, 
            cidade = :cidade, bairro = :bairro, estado = :estado
            WHERE nome = :nome_original
        ");
        
       $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':cnpj', $cnpj, PDO::PARAM_STR);
        $stmt->bindParam(':nome_dono', $nome_dono, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':nicho', $nicho, PDO::PARAM_STR);
        $stmt->bindParam(':cep', $cep, PDO::PARAM_STR);
        $stmt->bindParam(':logradouro', $logradouro, PDO::PARAM_STR);
        $stmt->bindParam(':cidade', $cidade, PDO::PARAM_STR);
        $stmt->bindParam(':bairro', $bairro, PDO::PARAM_STR);
        $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);
        
        return $stmt->execute();
    } catch (PDOException $e) {
        error_log("Erro ao atualizar campeonato: " . $e->getMessage());
        return false;
    }
}
}?>
