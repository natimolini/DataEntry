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
                <form class="search-container" action="" method="get">
                    <input id="searchBar" class="input-padrao" placeholder="Digite o CPF do paciente: 000.000.000-00">
                    <button class="search-button" type="submit">Pesquisar</button>
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
                        <tr>
                            <td>Teste1</td>
                            <td>13</td>
                            <td>19/07/2005</td>
                            <td>Teste</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="infoPaciente bloco-pequeno">
                <p class="titulo-info">Informações</p>
                <form class="info-container" action="">
                    <label for="codigoPaciente" class="tituloInfo">Código:</label>
                    <input type="number" id="codigoPaciente" name="codigoPaciente" class="input-info" placeholder="Código do paciente" required><br>

                    <label for="nomePaciente" class="tituloInfo">Nome:</label>
                    <input type="text" id="nomePaciente" name="nomePaciente" class="input-info" placeholder="Nome do paciente" required><br>

                    <label for="nomeMaePaciente" class="tituloInfo">Filiação:</label>
                    <input type="text" id="nomeMaePaciente" name="nomeMaePaciente" class="input-info" placeholder="Nome da filiação do paciente" required>

                    <label class="tituloInfo">Sexo:</label>
                    <div class="sexo-opcoes">
                        <input type="radio" id="fem" name="sexoPaciente" value="Feminino" required>
                        <label class="labelsexo" for="fem">Feminino</label>

                        <input type="radio" id="masc" name="sexoPaciente" value="Masculino" required>
                        <label class="labelsexo" for="masc">Masculino</label>

                        <input type="radio" id="outro" name="sexoPaciente" value="Outro" required>
                        <label class="labelsexo" for="outro">Outro</label>
                    </div>

                    <label for="nascPaciente" class="tituloInfo">Nascimento:</label>
                    <input type="date" id="nascPaciente" name="nascPaciente" class="input-info" required><br>

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
                Salvar
            </button>
        </div>
    </div>
    <?php include("../inc/mainMedico.php") ?>
    <?php include("../inc/mainReq.php") ?>
    <?php include("../inc/pagamento.php") ?>
    <?php include("../inc/footer.php") ?>
    <script src="../js/main.js"></script>
</body>

</html>