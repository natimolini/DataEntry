<?php

include('../dbconnection/connection.php');
include('../databasePaciente/selecionarPaciente.php');
include('../databasePaciente/atualizarPaciente.php');
include('../databasePaciente/inserirPaciente.php');

date_default_timezone_set('America/Sao_Paulo');

$dadosPaciente = null;
if (isset($_GET['cpf']) && !empty($_GET['cpf'])) {
    $dadosPaciente = buscarDadosPacientePorCPF($_GET['cpf'], $conn);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'updatePatient') {
        if (isset($_POST['codigoPaciente']) && !empty($_POST['codigoPaciente'])) {
            $resultado = atualizarPaciente($_POST, $conn);
            if ($resultado) {
                echo "<p>Paciente atualizado com sucesso.</p>";
            }
        } else {
            $resultadoInsercao = inserirPaciente($_POST, $conn);
            if ($resultadoInsercao) {
                echo "<p>Paciente inserido com sucesso.</p>";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/ghrlogo.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/main.css">
    <title>Requisições</title>
</head>

<body>
<?php include('header.php');?>
    <div class="paciente">
        <h2 class="title" id="togglePaciente">Paciente</h2>
        <div class="conteudo" id="conteudoPaciente">
            <div class="localizarPaciente bloco-pequeno">
                <p class="titulo-loc">Localizar</p>
                <form class="search-container" action="main.php" method="get">
                    <input id="searchBar" class="input-padraoB" name="cpf" placeholder="Digite o CPF do paciente">
                    <button class="search-button" type="submit">OK</button>
                </form>

                <table class="tabela-padrao">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Idade</th>
                            <th>Data de Nascimento</th>
                            <th>Nome da Filiação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($dadosPaciente): ?>
                            <tr>
                                <td><?= htmlspecialchars($dadosPaciente['NM_PESSOA_FISICA'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($dadosPaciente['IDADE'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars(isset($dadosPaciente['DT_NASCIMENTO']) ? date('d/m/Y', strtotime($dadosPaciente['DT_NASCIMENTO'])) : 'N/A') ?></td>
                                <td><?= htmlspecialchars($dadosPaciente['NM_CONTATO'] ?? 'N/A') ?></td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td colspan="4">Nenhum paciente encontrado</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="infoPaciente bloco-pequeno">
                <p class="titulo-info">Informações</p>
                <form id="infoPacienteForm" class="info-container" action="main.php" method="post">
                    <input type="hidden" name="action" value="updatePatient">
                    <input type="hidden" name="codigoPaciente" value="<?= htmlspecialchars($dadosPaciente['CD_PESSOA_FISICA'] ?? '') ?>">

                    <label for="nomePaciente" class="tituloInfo">Nome:</label>
                    <input type="text" id="nomePaciente" name="nomePaciente" class="input-info"
                        value="<?= htmlspecialchars($dadosPaciente['NM_PESSOA_FISICA'] ?? '') ?>" required><br>

                    <label for="cpfpaciente" class="tituloInfo">CPF:</label>
                    <input type="text" id="cpfPaciente" name="cpfpaciente" class="input-info"
                        value="<?= htmlspecialchars($dadosPaciente['NR_CPF'] ?? '') ?>"
                        <?= $dadosPaciente ? 'readonly' : '' ?> required><br>

                    <label for="nomeMaePaciente1" class="tituloInfo">Filiação 1:</label>
                    <input type="text" id="nomeMaePaciente1" name="nomeMaePaciente1" class="input-info"
                        value="<?= htmlspecialchars($dadosPaciente['NM_CONTATO1'] ?? '') ?>" required><br>

                    <label for="nomeMaePaciente2" class="tituloInfo">Filiação 2:</label>
                    <input type="text" id="nomeMaePaciente2" name="nomeMaePaciente2" class="input-info"
                        value="<?= htmlspecialchars($dadosPaciente['NM_CONTATO2'] ?? '') ?>"><br>

                    <label for="sexo" class="tituloInfo">Sexo:</label>
                    <select id="sexo" name="sexo" class="input-info" required>
                        <option value="M" <?= ($dadosPaciente['SEXO'] ?? '') === 'Masculino' ? 'selected' : '' ?>>Masculino</option>
                        <option value="F" <?= ($dadosPaciente['SEXO'] ?? '') === 'Feminino' ? 'selected' : '' ?>>Feminino</option>
                        <option value="O" <?= ($dadosPaciente['SEXO'] ?? '') === 'Outro' ? 'selected' : '' ?>>Outro</option>
                    </select><br>

                    <label for="nascPaciente" class="tituloInfo nascimento">Data de Nascimento:</label>
                    <input type="text" id="nascPaciente" name="nascPaciente" class="input-info"
                        value="<?= isset($dadosPaciente['DT_NASCIMENTO']) ? date('d/m/Y', strtotime($dadosPaciente['DT_NASCIMENTO'])) : '' ?>" required><br>

                    <label for="estadoCivil" class="tituloInfo">Estado Civil:</label>
                    <select id="estadoCivil" name="estadoCivil" class="input-info" required>
                        <option value="1" <?= ($dadosPaciente['IE_ESTADO_CIVIL'] ?? '') === '1' ? 'selected' : '' ?>>Solteiro</option>
                        <option value="2" <?= ($dadosPaciente['IE_ESTADO_CIVIL'] ?? '') === '2' ? 'selected' : '' ?>>Casado</option>
                        <option value="3" <?= ($dadosPaciente['IE_ESTADO_CIVIL'] ?? '') === '3' ? 'selected' : '' ?>>Divorciado</option>
                        <option value="4" <?= ($dadosPaciente['IE_ESTADO_CIVIL'] ?? '') === '4' ? 'selected' : '' ?>>Desquitado</option>
                        <option value="5" <?= ($dadosPaciente['IE_ESTADO_CIVIL'] ?? '') === '5' ? 'selected' : '' ?>>Viúvo</option>
                        <option value="6" <?= ($dadosPaciente['IE_ESTADO_CIVIL'] ?? '') === '6' ? 'selected' : '' ?>>Separado</option>
                        <option value="7" <?= ($dadosPaciente['IE_ESTADO_CIVIL'] ?? '') === '7' ? 'selected' : '' ?>>União estável</option>
                        <option value="9" <?= ($dadosPaciente['IE_ESTADO_CIVIL'] ?? '') === '9' ? 'selected' : '' ?>>Outros</option>
                    </select><br>

                    <button type="submit" id="salvarBtn" class="adicionar">Salvar</button>
                </form>
            </div>
        </div>
    </div>
    <?php include("../inc/mainMedico.php") ?>
    <?php include("../inc/mainReq.php") ?>
    <?php include("../inc/pagamento.php") ?>
    <?php include("../inc/footer.php") ?>
    <script src='../js/main.js'></script>
</body>

</html>