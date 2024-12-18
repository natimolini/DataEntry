<?php
include('../dbconnection/connection.php');
function buscarMedicos($conn, $pesquisa)
{
    try {
        $sql = "SELECT
                    M.CD_PESSOA_FISICA,
                    M.NM_GUERRA,
                    M.NR_CRM,
                    M.UF_CRM,
                    P.NR_CPF,
                    P.IE_SEXO,
                    P.DT_NASCIMENTO,
                    P.IE_ESTADO_CIVIL
                FROM
                    PESSOA_FISICA P,
                    MEDICO M
                WHERE
                    P.CD_PESSOA_FISICA = M.CD_PESSOA_FISICA
                    AND (M.NM_GUERRA LIKE :PESQUISA OR M.NR_CRM LIKE :PESQUISA)";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':PESQUISA', "%$pesquisa%");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erro ao buscar médicos: " . $e->getMessage());
    }
}

function buscarMedicoPorCodigo($conn, $codigo)
{
    $sql = "SELECT 
                M.CD_PESSOA_FISICA,
                M.NM_GUERRA,
                M.NR_CRM,
                M.UF_CRM,
                M.IE_VINCULO_MEDICO,
                P.NR_CPF,
                P.IE_SEXO,
                P.DT_NASCIMENTO,
                P.IE_ESTADO_CIVIL
            FROM 
                MEDICO M
            INNER JOIN 
                PESSOA_FISICA P
            ON 
                M.CD_PESSOA_FISICA = P.CD_PESSOA_FISICA
            WHERE 
                M.CD_PESSOA_FISICA = :codigo";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}


