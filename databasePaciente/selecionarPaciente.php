<?php

include('../dbconnection/connection.php');

/**
 * Busca informações do paciente pelo CPF.
 *
 * @param string $cpf CPF do paciente.
 * @param PDO $conn Conexão com o banco de dados.
 * @return array|null Retorna os dados do paciente ou null se não encontrado.
 */
function buscarDadosPacientePorCPF($cpf, $conn)
{
    $cpf = preg_replace('/\D/', '', $cpf);

    $aCampos = "
        P.CD_PESSOA_FISICA,
        P.NM_PESSOA_FISICA,
        LISTAGG(C.NM_CONTATO, ', ') WITHIN GROUP (ORDER BY C.NM_CONTATO) AS NM_CONTATO,
        CEP.DS_UF,
        P.NR_CPF,
        P.DT_NASCIMENTO,
        TRUNC((MONTHS_BETWEEN(SYSDATE, P.DT_NASCIMENTO)) / 12) AS IDADE,
        MAX(CEP.NM_LOCALIDADE) AS NM_LOCALIDADE,
        P.IE_ESTADO_CIVIL,
        CASE 
            WHEN P.IE_SEXO = 'M' THEN 'Masculino'
            WHEN P.IE_SEXO = 'F' THEN 'Feminino'
            ELSE 'Outro'
        END AS SEXO
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
            P.NR_CEP_CIDADE_NASC,
            P.IE_SEXO,
            P.IE_ESTADO_CIVIL
    ";

    try {
        $query = "SELECT $aCampos FROM $tabela $where $extras";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->execute();
        $dadosPaciente = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dadosPaciente) {
            $contatos = explode(', ', $dadosPaciente['NM_CONTATO']);
            $dadosPaciente['NM_CONTATO1'] = $contatos[0] ?? '';
            $dadosPaciente['NM_CONTATO2'] = $contatos[1] ?? '';
        }

        return $dadosPaciente;
    } catch (PDOException $e) {
        echo "Erro ao buscar paciente: " . $e->getMessage();
        return null;
    }
}
