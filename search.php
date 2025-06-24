<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/SporTTown/models/Model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/SporTTown/controllers/Controller.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/SporTTown/configs/protected.php';

$controller = new Controller();
$nomePesquisa = $_GET['nome'] ?? '';
$nichoSelecionado = $_GET['nicho'] ?? '';

// Busca usando ambos os filtros
$campeonatos = $controller->buscarCampeonatosPorFiltros($nomePesquisa, $nichoSelecionado);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../Imagens/favicon.png">
    <title>Sport Town</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="bg-dark text-white pb-5">

<div class="search-container">
    <form id="filtroForm" method="GET">
        <input type="text" id="searchInput" name="nome" placeholder="Digite para pesquisar..." 
               value="<?= htmlspecialchars($nomePesquisa) ?>" autocomplete="off">
        <label for="nicho" class="required"><i class="fas fa-running"></i> || Modalidade Esportiva</label>
        <select name="nicho" id="nicho" class="form-select w-auto d-inline">
        <option value="">Todos</option>
        <option value="Futebol" <?= (isset($_GET['nicho']) && $_GET['nicho'] === 'Futebol') ? 'selected' : '' ?>>Futebol</option>
        <option value="Futsal" <?= (isset($_GET['nicho']) && $_GET['nicho'] === 'Futsal') ? 'selected' : '' ?>>Futsal</option>
        <option value="Vôlei" <?= (isset($_GET['nicho']) && $_GET['nicho'] === 'Vôlei') ? 'selected' : '' ?>>Vôlei</option>
        <option value="Basquete" <?= (isset($_GET['nicho']) && $_GET['nicho'] === 'Basquete') ? 'selected' : '' ?>>Basquete</option>
        <option value="Tênis de mesa" <?= (isset($_GET['nicho']) && $_GET['nicho'] === 'Tênis de mesa') ? 'selected' : '' ?>>Tênis de mesa</option>
        <option value="Xadrez" <?= (isset($_GET['nicho']) && $_GET['nicho'] === 'Xadrez') ? 'selected' : '' ?>>Xadrez</option>
    </select>
    </form>
    <div id="error"></div>
</div>
    <div id="results">
        <?php if (!empty($campeonatos)): ?>
            <table>
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
    <p><?= $nomePesquisa ? 'Nenhum campeonato encontrado.' : 'Nenhum campeonato cadastrado.' ?></p>
<?php endif; ?>
    </div>

<script>

                document.getElementById('nicho').addEventListener('change', function() {
                    document.getElementById('filtroForm').submit();
                });

                document.addEventListener('DOMContentLoaded', function() {
                    const searchInput = document.getElementById('searchInput');
                    const resultsDiv = document.getElementById('results');
                    const errorDiv = document.getElementById('error');
                    
                    searchInput.addEventListener('input', function() {
                    const nicho = document.getElementById('nicho').value; // Obtenha o valor do nicho
                    const searchTerm = this.value.trim();       
                    fetch(`../router.php?rota=buscar_ajax&nome=${encodeURIComponent(searchTerm)}&nicho=${encodeURIComponent(nicho)}`)
                        .then(response => {
                        if (!response.ok) throw new Error('Erro na rede');
                        return response.text(); // Agora esperamos HTML puro
                    })
                    .then(html => {
                        resultsDiv.innerHTML = html;
                        errorDiv.style.display = 'none';
                    })
                    .catch(error => {
                        errorDiv.textContent = 'Erro ao buscar campeonato: ' + error.message;
                        errorDiv.style.display = 'block';
                        console.error('Erro:', error);
                    });
                    });
                });
</script>

    <!-- ----------------------------------------------------------------------------------------------------------- -->

<div class="barra">
    <nav class="bottom-nav d-flex justify-content-around py-2">
        <a href="painel.php" class="nav-link text-center">
            <div>
              <img src="../Imagens/home.png">
            </div>
            <small>Home</small>
        </a>
        <a href="search.php" class="nav-link text-center">
            <div>
                <img src="../Imagens/lupa.png" >
            </div>
            <small>Pesquisar</small>
        </a>
        <a href="config.php" class="nav-link text-center">
            <div>
              <img src="../Imagens/configuraçoes.png">
            </div>
            <small>Ajustes</small>
        </a>
    </nav>
</div>
<br>
<br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
