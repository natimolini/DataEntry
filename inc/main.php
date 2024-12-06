<?php
include('../dbconnection/functions.php');

$dadosPaciente = null;

if (isset($_GET['cpf']) && !empty($_GET['cpf'])) {
    $cpf = preg_replace('/\D/', '', $_GET['cpf']);

    $aCampos = "
        P.CD_PESSOA_FISICA,
        P.NM_PESSOA_FISICA,
        LISTAGG(C.NM_CONTATO, ', ') WITHIN GROUP (ORDER BY C.NM_CONTATO) AS NM_CONTATOS,
        CEP.DS_UF, 
        P.NR_CPF,
        P.DT_NASCIMENTO,
        TRUNC((MONTHS_BETWEEN(SYSDATE, P.DT_NASCIMENTO)) / 12) AS IDADE,
        MAX(CEP.NM_LOCALIDADE) AS NM_LOCALIDADE
    ";

    $tabela = "
        PESSOA_FISICA P
        LEFT JOIN COMPL_PESSOA_FISICA C ON P.CD_PESSOA_FISICA = C.CD_PESSOA_FISICA
        LEFT JOIN CEP_LOC CEP ON P.NR_CEP_CIDADE_NASC = CEP.CD_CEP
    ";

    $where = "WHERE P.NR_CPF = :cpf";
    $extras = "
        GROUP BY
            P.CD_PESSOA_FISICA,
            P.NM_PESSOA_FISICA,
            CEP.DS_UF, 
            P.NR_CPF,
            P.DT_NASCIMENTO,
            P.NR_CEP_CIDADE_NASC
    ";

    try {
        $query = "SELECT $aCampos FROM $tabela $where $extras";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->execute();
        $dadosPaciente = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erro ao buscar paciente: " . $e->getMessage();
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
    <?php include("header.php") ?>
    <div class="paciente">
        <h2 class="title" id="togglePaciente">Paciente</h2>
        <div class="conteudo" id="conteudoPaciente">
            <div class="localizarPaciente bloco-pequeno">
                <p class="titulo-loc">Localizar</p>
                <form class="search-container" action="main.php" method="get">
                    <input id="searchBar" class="input-padrao" name="cpf" placeholder="Digite o CPF do paciente: 000.000.000-00">
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
                                <td><?= htmlspecialchars($dadosPaciente['NM_PESSOA_FISICA']) ?></td>
                                <td><?= htmlspecialchars($dadosPaciente['IDADE']) ?></td>
                                <td><?= htmlspecialchars(date('d/m/Y', strtotime($dadosPaciente['DT_NASCIMENTO']))) ?></td>
                                <td><?= htmlspecialchars($dadosPaciente['NM_CONTATOS'] ?: 'N/A') ?></td>
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
                <form class="info-container" action="">
                    <label for="codigoPaciente" class="tituloInfo">Código:</label>
                    <input type="number" id="codigoPaciente" name="codigoPaciente" class="input-info"
                        value="<?= htmlspecialchars($dadosPaciente['CD_PESSOA_FISICA'] ?? '') ?>" readonly><br>

                    <label for="nomePaciente" class="tituloInfo">Nome:</label>
                    <input type="text" id="nomePaciente" name="nomePaciente" class="input-info"
                        value="<?= htmlspecialchars($dadosPaciente['NM_PESSOA_FISICA'] ?? '') ?>" readonly><br>

                    <label for="nomeMaePaciente" class="tituloInfo">Filiação:</label>
                    <input type="text" id="nomeMaePaciente" name="nomeMaePaciente" class="input-info"
                        value="<?= htmlspecialchars($dadosPaciente['NM_CONTATOS'] ?? '') ?>" readonly>

                    <label for="nascPaciente" class="tituloInfo nascimento">Nascimento:</label>
                    <input type="date" id="nascPaciente" name="nascPaciente" class="input-info"
                        value="<?= $dadosPaciente['DT_NASCIMENTO'] ? date('Y-m-d', strtotime($dadosPaciente['DT_NASCIMENTO'])) : '' ?>" readonly><br>

                    <label for="estado" class="tituloInfo">Estado:</label>
                    <input type="text" id="estado" name="estado" class="input-info"
                        value="<?= htmlspecialchars($dadosPaciente['DS_UF'] ?? '') ?>" readonly><br>

                    <label for="cidade" class="tituloInfo">Cidade:</label>
                    <input type="text" id="cidade" name="cidade" class="input-info"
                        value="<?= htmlspecialchars($dadosPaciente['NM_LOCALIDADE'] ?? '') ?>" readonly><br>

                </form>
            </div>

            <button type="submit" class="adicionar">
                Salvar
            </button>
        </div>
    </div>
    <?php include("../inc/mainMedico.php") ?>
    <?php include("../inc/mainReq.php") ?>
    <?php include("../inc/pagamento.php") ?>
    <?php include("../inc/footer.php") ?>
</body>

</html>