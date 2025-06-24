<?php
require_once 'controllers/Controller.php';

$controller = new Controller();

$rota = $_GET['rota'] ?? 'listar'; // Se não tiver definida, define com a rota padrão

// Processa requisições POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($rota == 'cadastrar') {
        $controller->cadastrar();
    }elseif ($rota == 'empresa') {
        $controller->empresa();
    }elseif ($rota == 'camps') {
        $controller->camps();
    }
    exit;
}

// Processa requisições GET
switch($rota) {
    case 'buscar_ajax':
        try {
            $nomePesquisa = $_GET['nome'] ?? '';
            $nichoBuscar = $_GET['nicho'] ?? ''; // Adicione esta linha
            $campeonatos = $controller->buscarCampeonatosPorFiltros($nomePesquisa, $nichoBuscar); 

            if (!empty($campeonatos)): ?>
                <table border="1">
                    <tr>
                        <th>Nome do campeonato</th>
                        <th>Nome do dono</th>
                        <th>Modalidade</th>
                        <th>Endereço</th>
                    </tr>
                    <?php foreach ($campeonatos as $campeonato): ?>
                    <tr>
                        <td><?= htmlspecialchars($campeonato->nome) ?></td>
                        <td><?= htmlspecialchars($campeonato->nome_dono) ?></td>
                        <td><?= htmlspecialchars($campeonato->nicho) ?></td>
                        <td><?= htmlspecialchars($campeonato->logradouro) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p><?= $nomePesquisa ? 'Nenhum estudante encontrado.' : 'Nenhum estudante cadastrado.' ?></p>
            <?php endif;

        } catch(Exception $e) {
            http_response_code(500);
            echo "Erro no servidor: " . $e->getMessage();
        }
        exit;

    case 'cadastrar':
        require_once 'cadastros/cadastrar.php';
        break;
    case 'empresa':
        require_once 'cadastros/empresa.php';
        break;
    case 'camps':
        require_once 'cadastros/camps.php';
        break;
    case 'listar':
    require_once __DIR__ . '/Ações/saveCamp.php';
    break;
    case 'deletar':
        $controller->deletar();
    break;
    case 'confirmarDeletar':
        $controller->deletar();
    break; 
    case 'formAtualizar':
    require_once 'Ações/editCamp.php';
    break;
    
    case 'atualizar':
        $controller->atualizar();
    break;    
}

?>