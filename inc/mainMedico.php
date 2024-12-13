<body>
    <div class="medico">
        <h2 class="title toggle-section">Médico</h2>
        <div class="conteudo">
            <div class="bloco-pequeno">
                <p class="titulo-loc">Localizar</p>
                <form class="search-container" action="" method="get">
                    <input type="search" id="searchBar" class="input-padrao" placeholder="Digite o CRM ou nome do médico">
                    <button class="search-button btn-padrao" type="submit">OK</button>
                </form>
                <table class="tabela-padrao">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>CRM</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Teste1</td>
                            <td>1365</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="bloco-pequeno">
                <p class="titulo-info">Informações</p>
                <form action="" class="info-container">
                    <label for="codigoMedico" class="tituloInfo">Código:</label>
                    <input type="number" id="codigoMedico" name="codigoMedico" class="input-info" placeholder="Código do médico" required><br>

                    <label for="nomeMedico" class="tituloInfo">Nome:</label>
                    <input type="text" id="nomeMedico" name="nomeMedico" class="input-info" placeholder="Nome do médico" required><br>

                    <label for="crm" class="tituloInfo">CRM:</label>
                    <input type="text" id="crm" name="crm" class="input-info" placeholder="CRM-UF 00000" required><br>

                </form>
            </div>

            <button type="submit" class="adicionar">
                Salvar
            </button>
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
                </form>
            </div>
            <button type="submit" class="adicionar">
                Salvar
            </button>
        </div>
    </div>

    <script src="../js/main.js"></script>
</body>