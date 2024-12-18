<?php
include('../dbconnection/connection.php');
include('../databaseMedico/selecionarMedico.php');
include('../databaseMedico/atualizarMedico.php');
include('../databaseMedico/inserirMedico.php'); 

$codigoMedico = isset($_GET['codigo']) ? $_GET['codigo'] : null;
$pesquisa = isset($_GET['pesquisa']) ? $_GET['pesquisa'] : '';
$resultados = !empty($pesquisa) ? buscarMedicos($conn, $pesquisa) : [];

$medicoSelecionado = null;
if ($codigoMedico) {
    $medicoSelecionado = buscarMedicoPorCodigo($conn, $codigoMedico);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'updateDoctor' && isset($_POST['codigoMedico']) && !empty($_POST['codigoMedico'])) {
            $resultado = atualizarMedico($_POST, $conn);
            if ($resultado) {
                echo "<p>Médico atualizado com sucesso.</p>";
            } else {
                echo "<p>Erro ao atualizar médico.</p>";
            }
        } elseif ($_POST['action'] === 'insertDoctor') {
            $resultado = inserirMedico($_POST, $conn);
            if ($resultado) {
                echo "<p>Médico inserido com sucesso.</p>";
            } else {
                echo "<p>Erro ao inserir médico.</p>";
            }
        }
    }
}
?>

<body>
    <div class="medico">
        <h2 class="title toggle-section">Médico</h2>
        <div class="conteudo">
            <div class="bloco-pequeno">
                <p class="titulo-loc">Localizar</p>
                <form class="search-container" action="main.php" method="get">
                    <input type="search" id="searchBar" name="pesquisa" class="input-padrao" placeholder="Digite o CRM ou nome do médico" value="<?php echo htmlspecialchars($pesquisa); ?>">
                    <button class="search-button btn-padrao" type="submit">OK</button>
                </form>

                <?php if (!empty($pesquisa)): ?>
                    <table class="tabela-padrao">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>CRM</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($resultados)): ?>
                                <?php foreach ($resultados as $medico): ?>
                                    <tr>
                                        <td>
                                            <a class="selectMedico" href="?codigo=<?php echo urlencode($medico['CD_PESSOA_FISICA']); ?>">
                                                <?php echo htmlspecialchars($medico['NM_GUERRA']); ?>
                                            </a>
                                        </td>
                                        <td><?php echo htmlspecialchars($medico['NR_CRM']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="2">Nenhum médico encontrado.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>

            <div class="bloco-pequeno">
                <p class="titulo-info">Informações</p>
                <form action="" class="info-container" method="post">
                    <?php if ($medicoSelecionado): ?>
                        <input type="hidden" name="action" value="updateDoctor">
                        <input type="hidden" id="codigoMedico" name="codigoMedico" class="input-info" value="<?php echo htmlspecialchars($medicoSelecionado['CD_PESSOA_FISICA']); ?>" required>
                    <?php else: ?>
                        <input type="hidden" name="action" value="insertDoctor">
                    <?php endif; ?>

                    <label for="nomeMedico" class="tituloInfo">Nome:</label>
                    <input type="text" id="nomeMedico" name="nomeMedico" class="input-info" placeholder="Nome do médico" value="<?php echo htmlspecialchars($medicoSelecionado['NM_GUERRA'] ?? ''); ?>" required><br>

                    <label for="crm" class="tituloInfo">CRM:</label>
                    <input type="text" id="crm" name="crm" class="input-info" placeholder="CRM 00000" value="<?php echo htmlspecialchars($medicoSelecionado['NR_CRM'] ?? ''); ?>" required><br>

                    <label for="UFcrm" class="tituloInfo">UF-CRM:</label>
                    <input type="text" id="UFcrm" name="UFcrm" class="input-info" placeholder="UF" value="<?php echo htmlspecialchars($medicoSelecionado['UF_CRM'] ?? ''); ?>" required><br>

                    <label for="vinculoMedico" class="tituloInfo">Vínculo do Médico:</label>
                    <select id="vinculoMedico" name="vinculoMedico" class="input-info" required>
                        <option value="1" <?= ($medicoSelecionado['IE_VINCULO_MEDICO'] ?? '') === '1' ? 'selected' : '' ?>>Funcionário</option>
                        <option value="2" <?= ($medicoSelecionado['IE_VINCULO_MEDICO'] ?? '') === '2' ? 'selected' : '' ?>>Contratado</option>
                        <option value="3" <?= ($medicoSelecionado['IE_VINCULO_MEDICO'] ?? '') === '3' ? 'selected' : '' ?>>Residente</option>
                        <option value="4" <?= ($medicoSelecionado['IE_VINCULO_MEDICO'] ?? '') === '4' ? 'selected' : '' ?>>Visitante</option>
                        <option value="5" <?= ($medicoSelecionado['IE_VINCULO_MEDICO'] ?? '') === '5' ? 'selected' : '' ?>>Prestador</option>
                        <option value="9" <?= ($medicoSelecionado['IE_VINCULO_MEDICO'] ?? '') === '9' ? 'selected' : '' ?>>Outros</option>
                        <option value="11" <?= ($medicoSelecionado['IE_VINCULO_MEDICO'] ?? '') === '11' ? 'selected' : '' ?>>Efetivo</option>
                        <option value="12" <?= ($medicoSelecionado['IE_VINCULO_MEDICO'] ?? '') === '12' ? 'selected' : '' ?>>Pré-Efetivo</option>
                        <option value="13" <?= ($medicoSelecionado['IE_VINCULO_MEDICO'] ?? '') === '13' ? 'selected' : '' ?>>Plantonista</option>
                        <option value="14" <?= ($medicoSelecionado['IE_VINCULO_MEDICO'] ?? '') === '14' ? 'selected' : '' ?>>Externo</option>
                        <option value="15" <?= ($medicoSelecionado['IE_VINCULO_MEDICO'] ?? '') === '15' ? 'selected' : '' ?>>Temporário</option>
                        <option value="16" <?= ($medicoSelecionado['IE_VINCULO_MEDICO'] ?? '') === '16' ? 'selected' : '' ?>>Eventual</option>
                        <option value="17" <?= ($medicoSelecionado['IE_VINCULO_MEDICO'] ?? '') === '17' ? 'selected' : '' ?>>Consultor</option>
                        <option value="18" <?= ($medicoSelecionado['IE_VINCULO_MEDICO'] ?? '') === '18' ? 'selected' : '' ?>>Estagiário</option>
                        <option value="19" <?= ($medicoSelecionado['IE_VINCULO_MEDICO'] ?? '') === '19' ? 'selected' : '' ?>>Voluntário</option>
                        <option value="20" <?= ($medicoSelecionado['IE_VINCULO_MEDICO'] ?? '') === '20' ? 'selected' : '' ?>>Autônomo</option>
                    </select><br>

                    <label for="cpfMedico" class="tituloInfo">CPF:</label>
                    <input type="text" id="cpfMedico" name="cpfMedico" class="input-info" placeholder="CPF médico" value="<?php echo htmlspecialchars($medicoSelecionado['NR_CPF'] ?? ''); ?>" required><br>

                    <label for="sexo" class="tituloInfo">Sexo:</label>
                    <select id="sexo" name="sexo" class="input-info" required>
                        <option value="M" <?= ($medicoSelecionado['IE_SEXO'] ?? '') === 'M' ? 'selected' : '' ?>>Masculino</option>
                        <option value="F" <?= ($medicoSelecionado['IE_SEXO'] ?? '') === 'F' ? 'selected' : '' ?>>Feminino</option>
                        <option value="O" <?= ($medicoSelecionado['IE_SEXO'] ?? '') === 'O' ? 'selected' : '' ?>>Outro</option>
                    </select><br>

                    <label for="nascPaciente" class="tituloInfo nascimento">Data de Nascimento:</label>
                    <input type="text" id="nascPaciente" name="nascPaciente" class="input-info"
                        value="<?= isset($medicoSelecionado['DT_NASCIMENTO']) ? date('d/m/Y', strtotime($medicoSelecionado['DT_NASCIMENTO'])) : '' ?>" required><br>

                    <label for="estadoCivil" class="tituloInfo">Estado Civil:</label>
                    <select id="estadoCivil" name="estadoCivil" class="input-info" required>
                        <option value="1" <?= ($medicoSelecionado['IE_ESTADO_CIVIL'] ?? '') === '1' ? 'selected' : '' ?>>Solteiro</option>
                        <option value="2" <?= ($medicoSelecionado['IE_ESTADO_CIVIL'] ?? '') === '2' ? 'selected' : '' ?>>Casado</option>
                        <option value="3" <?= ($medicoSelecionado['IE_ESTADO_CIVIL'] ?? '') === '3' ? 'selected' : '' ?>>Divorciado</option>
                        <option value="4" <?= ($medicoSelecionado['IE_ESTADO_CIVIL'] ?? '') === '4' ? 'selected' : '' ?>>Desquitado</option>
                        <option value="5" <?= ($medicoSelecionado['IE_ESTADO_CIVIL'] ?? '') === '5' ? 'selected' : '' ?>>Viúvo</option>
                        <option value="6" <?= ($medicoSelecionado['IE_ESTADO_CIVIL'] ?? '') === '6' ? 'selected' : '' ?>>Separado</option>
                        <option value="7" <?= ($medicoSelecionado['IE_ESTADO_CIVIL'] ?? '') === '7' ? 'selected' : '' ?>>União estável</option>
                        <option value="9" <?= ($medicoSelecionado['IE_ESTADO_CIVIL'] ?? '') === '9' ? 'selected' : '' ?>>Outros</option>
                    </select><br>


                    <button type="submit" class="adicionar">
                        <?php echo $medicoSelecionado ? 'Salvar' : 'Adicionar'; ?>
                    </button>
                </form>
                <?php if (!$medicoSelecionado): ?>
                    <p>Nenhum médico selecionado.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="atendimento">
        <h2 class="title toggle-section">Atendimento</h2>
        <div class="conteudo">
            <div class="bloco-pequeno">
                <p class="titulo-info">Informações</p>
                <form action="" class="info-container">
                    <?php date_default_timezone_set('America/Sao_Paulo');
                    $dataAtual = date("d/m/Y H:i"); ?>
                    <label for="dataEntrada" class="tituloInfo">Data de Entrada:</label>
                    <input type="text" id="dataEntrada" name="dataEntrada" class="input-info" value="<?php echo $dataAtual; ?>" readonly><br>

                    <label for="tipoAtend" class="tituloInfo">Tipo de Atendimento:</label>
                    <input type="text" id="tipoAtend" name="tipoAtend" class="input-info" placeholder="Pronto Socorro, ..." required><br>

                    <label for="proc" class="tituloInfo">Procedência:</label>
                    <input type="text" id="proc" name="proc" class="input-info" placeholder="SAMU, Residência, ..." required><br>

                    <button type="submit" class="adicionar">
                        Salvar
                    </button>
                </form>
            </div>
        </div>
    </div>

</body>