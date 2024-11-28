<body>
    <div class="medico">
        <h2 class="title">Médico</h2>
        <div class="bloco-pequeno">
            <p class="titulo-loc">Localizar</p>
            <form class="search-container" action="" method="get">
                <input type="search" id="searchBar" class="input-padrao" placeholder="Digite o CRM do médico">
                <button class="search-button btn-padrao" type="submit">Pesquisar</button>
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

                <label for="estado" class="tituloInfo">Estado:</label>
                <select class="input-info" id="estado" name="estado" required onchange="atualizarCidades()">
                    <option value="">Selecione o estado</option>
                    <option value="AC">Acre</option>
                    <option value="AL">Alagoas</option>
                    <option value="AP">Amapá</option>
                    <option value="AM">Amazonas</option>
                    <option value="BA">Bahia</option>
                    <option value="CE">Ceará</option>
                    <option value="DF">Distrito Federal</option>
                    <option value="ES">Espírito Santo</option>
                    <option value="GO">Goiás</option>
                    <option value="MA">Maranhão</option>
                    <option value="MT">Mato Grosso</option>
                    <option value="MS">Mato Grosso do Sul</option>
                    <option value="MG">Minas Gerais</option>
                    <option value="PA">Pará</option>
                    <option value="PB">Paraíba</option>
                    <option value="PR">Paraná</option>
                    <option value="PE">Pernambuco</option>
                    <option value="PI">Piauí</option>
                    <option value="RJ">Rio de Janeiro</option>
                    <option value="RN">Rio Grande do Norte</option>
                    <option value="RS">Rio Grande do Sul</option>
                    <option value="RO">Rondônia</option>
                    <option value="RR">Roraima</option>
                    <option value="SC">Santa Catarina</option>
                    <option value="SP">São Paulo</option>
                    <option value="SE">Sergipe</option>
                    <option value="TO">Tocantins</option>
                </select><br>

                <label class="tituloInfo" for="cidade">Cidade:</label>
                <select class="input-info" id="cidade" name="cidade" required>
                    <option value="">Selecione a cidade</option>
                </select>
            </form>
        </div>

        <button type="submit" class="adicionar">
            Novo Médico
        </button>
    </div>
    <div class="atendimento">
        <h2 class="title">Atendimento</h2>

        <div class="bloco-pequeno">
            <p class="titulo-info">Informações</p>
            <form action="" class="info-container">
                <?php date_default_timezone_set('America/Sao_Paulo');
                $dataAtual = date("d/m/Y H:i");
                ?>
                <label for="dataEntrada" class="tituloInfo">Data de Entrada:</label>
                <input type="text" id="dataEntrada" name="dataEntrada" class="input-info" value="<?php echo $dataAtual; ?>" readonly><br>

                <label for="tipoAtend" class="tituloInfo">Tipo de Atendimento:</label>
                <input type="text" id="tipoAtend" name="tipoAtend" class="input-info" placeholder="Tipo de Atendimento: Pronto Socorro, ..." required><br>

                <label for="proc" class="testeinfo">Procedência:</label>
                <input type="text" id="proc" name="proc" class="input-info" placeholder="Procêdencia: SAMU, Residência, ..." required><br>
            </form>
        </div>

    </div>
    <script src="../js/main.js"></script>
</body>

</html>