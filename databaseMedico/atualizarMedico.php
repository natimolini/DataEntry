<?php
function atualizarMedico($dados, $conn)
{
    $codigoMedico = $dados['codigoMedico'];
    $nomeMedico = $dados['nomeMedico'];
    $vinculoMedico = $dados['vinculoMedico'];
    $sexo = substr($dados['sexo'], 0, 1);
    $estadoCivil = $dados['estadoCivil'];

    $dataArray = explode('/', $dados['nascPaciente']);
    if (count($dataArray) == 3) {
        $nascimento = $dataArray[2] . '-' . $dataArray[1] . '-' . $dataArray[0];
    } else {
        echo "<p>Erro: Data de nascimento inválida.</p>";
        return false;
    }

    try {
        $conn->beginTransaction();

        $queryPessoa = "UPDATE PESSOA_FISICA SET 
                        DT_NASCIMENTO = TO_DATE(:nascimento, 'YYYY-MM-DD'),
                        IE_SEXO = :sexo,
                        IE_ESTADO_CIVIL = :estadoCivil
                        WHERE CD_PESSOA_FISICA = :codigoMedico";

        $stmtPessoa = $conn->prepare($queryPessoa);
        $stmtPessoa->bindParam(':nascimento', $nascimento);
        $stmtPessoa->bindParam(':sexo', $sexo);
        $stmtPessoa->bindParam(':estadoCivil', $estadoCivil, PDO::PARAM_INT);
        $stmtPessoa->bindParam(':codigoMedico', $codigoMedico, PDO::PARAM_INT);
        $stmtPessoa->execute();

        $queryVinculo = "UPDATE MEDICO SET 
                        NM_GUERRA = :nomeMedico,
                        IE_VINCULO_MEDICO = :vinculoMedico
                        WHERE CD_PESSOA_FISICA = :codigoMedico";

        $stmtVinculo = $conn->prepare($queryVinculo);
        $stmtVinculo->bindParam(':nomeMedico', $nomeMedico); 
        $stmtVinculo->bindParam(':vinculoMedico', $vinculoMedico);
        $stmtVinculo->bindParam(':codigoMedico', $codigoMedico, PDO::PARAM_INT);
        $stmtVinculo->execute();

        $conn->commit();
        return true;
    } catch (PDOException $e) {
        $conn->rollBack();
        echo "<p>Erro ao atualizar médico: " . $e->getMessage() . "</p>";
        return false;
    }
}
?>

