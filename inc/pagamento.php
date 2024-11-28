<body>
    <div class="pagamento">
        <h2 class="title">Pagamento Particular</h2>

        <div class="localizarPaciente bloco-pequeno">
            <form class="search-container" action="" method="get">

                <input id="valor" class="input-padrao" placeholder="Digite o valor: R$ 0,00">
            </form>
            <table class="tabela-padrao">
                <thead>
                    <tr>
                        <th>Sequência</th>
                        <th>Data da Parcela</th>
                        <th>Valor a Receber</th>
                        <th>Pago?</th>
                        <th>Forma de Recebimento</th>
                        <th>Conta Corrente</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>
                            <input type="date" class="input-medium" name="dataParcela">
                        </td>
                        <td>
                            <input type="text" class="input-medium" name="valorReceber" placeholder="R$ 0,00">
                        </td>
                        <td>
                            <input type="checkbox" name="pago">
                        </td>
                        <td>
                            <select class="input-medium" name="formaRecebimento">
                                <option value="dinheiro">Dinheiro</option>
                                <option value="cartao">Cartão</option>
                                <option value="transferencia">Transferência</option>
                                <option value="pix">Pix</option>
                                <option value="outro">Outro</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" class="input-medium" name="contaCorrente" placeholder="Conta Corrente">
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td><input type="date" class="input-medium" name="dataParcela"></td>
                        <td><input type="text" class="input-medium" name="valorReceber" placeholder="R$ 0,00"></td>
                        <td><input type="checkbox" name="pago"></td>
                        <td>
                            <select class="input-medium" name="formaRecebimento">
                                <option value="dinheiro">Dinheiro</option>
                                <option value="cartao">Cartão</option>
                                <option value="transferencia">Transferência</option>
                                <option value="pix">Pix</option>
                                <option value="outro">Outro</option>
                            </select>
                        </td>
                        <td><input type="text" class="input-medium" name="contaCorrente" placeholder="Conta Corrente"></td>
                    </tr>
                </tbody>
            </table>
        </div>


    </div>

</body>