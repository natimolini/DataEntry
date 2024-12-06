<?php
include('../functions.php');

// Defina os campos da query como uma string em letras maiúsculas
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

// Especifique a tabela base e os JOINs em letras maiúsculas
$tabela = "
    PESSOA_FISICA P
    LEFT JOIN COMPL_PESSOA_FISICA C ON P.CD_PESSOA_FISICA = C.CD_PESSOA_FISICA
    LEFT JOIN CEP_LOC CEP ON P.NR_CEP_CIDADE_NASC = CEP.CD_CEP
";

// Condições adicionais para o WHERE em letras maiúsculas
$where = "WHERE P.NR_CPF IS NOT NULL";

// Agrupamento e outros elementos extras em letras maiúsculas
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
    // Exibir consulta gerada para depuração
    $query = "SELECT $aCampos FROM $tabela WHERE $where $extras";

    // Execute a função com os parâmetros especificados
    $result = selectComposto($conn, $aCampos, $tabela, "$where $extras");
    print_r($result); // Exibe os resultados
} catch (PDOException $e) {
    echo "Erro ao executar consulta: " . $e->getMessage();
}
