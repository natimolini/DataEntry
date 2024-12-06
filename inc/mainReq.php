<body>
    <div class="atendimento">
        <h2 class="title toggle-section">Requisição</h2>
        <div class="conteudo">

            <div class="bloco-pequeno">
                <p class="titulo-info">Informações</p>
                <form action="" class="info-container">
                    <?php
                    date_default_timezone_set('America/Sao_Paulo');
                    $dataHoraAtual = date('Y-m-d\TH:i'); ?>
                    <label for="dataEntradaReq" class="tituloInfo">Data de Entrada da Requisição:</label>
                    <input type="datetime-local" id="dataEntradaReq" name="dataEntradaReq" class="input-info" value="<?php echo $dataHoraAtual; ?>"><br>

                    <label for="conv" class="tituloInfo">Convênio:</label>
                    <input type="text" id="conv" name="conv" class="input-info" placeholder="SUS, Particular, Unimed, ..." required><br>

                    <label for="cat" class="tituloInfo">Categoria:</label>
                    <input type="text" id="conv" name="cat" class="input-info" placeholder="Individual, Prata, ..." required><br>

                    <label for="matr" class="tituloInfo">Matricula:</label>
                    <input type="text" id="matr" name="matr" class="input-info" placeholder="Código do usuário no convênio" required><br>

                    <label for="vigencia" class="tituloInfo">Data de Inicio de Vigência:</label>
                    <input type="date" id="vigencia" name="vigencia" class="input-info" placeholder="Data inicial da vigência da cobertura do convênio" required><br>

                    <label for="validade" class="tituloInfo">Validade:</label>
                    <input type="date" id="validade" name="validade" class="input-info" placeholder="Data inicial de validade da carteirinha" required><br>

                    <label for="guia" class="tituloInfo">Guia:</label>
                    <input type="text" id="guia" name="guia" class="input-info" placeholder="Número da guia do convênio" required><br>

                    <label for="senha" class="tituloInfo">Senha:</label>
                    <input type="text" id="senha" name="senha" class="input-info" placeholder="Senha que autorizou o atendimento" required><br>

                    <div class="instituicoes-container">
                        <span class="tituloInst">Instituições</span>
                        <div class="instituicoes">
                            <label for="origem" class="tituloInfo">Origem:</label><br>
                            <input type="text" id="origem" name="origem" class="input-info" placeholder="Local de origem paciente" required><br>

                            <label for="destino" class="tituloInfo">Destino:</label><br>
                            <input type="text" id="destino" name="destino" class="input-info" placeholder="Local de destino paciente" required><br>

                            <label for="coleta" class="tituloInfo">Coleta:</label><br>
                            <input type="text" id="coleta" name="coleta" class="input-info" placeholder="Local de coleta paciente" required><br>
                        </div>
                    </div>

                    <label for="diag" class="tituloInfo">Diagnóstico Clínico:</label>
                    <textarea id="diag" name="diag" class="input-infoM" required></textarea><br>

                    <label for="obs" class="tituloInfo">Observações:</label>
                    <textarea id="obs" name="obs" class="input-infoM" required></textarea><br>

            </div>
            <div class="bloco-pequeno">
                <p class="titulo-info">Exames</p>
                <form class="search-container" action="" method="get">
                    <input id="searchBar" class="input-padrao" placeholder="Digite o nome ou código do exame">
                    <button class="search-button" type="submit">Adicionar</button>
                </form>
                <table class="tabela-padrao">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Código</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>ACIDO 5 HIDROXI INDOLACETICO (URINA 24H)</td>
                            <td>40305112</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <button type="submit" class="adicionar">
                Salvar
            </button>
        </div>
    </div>
</body>

</html>