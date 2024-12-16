<?php

function atualizarPaciente($dados, $conn)
{
    $codigoPaciente = $dados['codigoPaciente'];
    $nomePaciente = $dados['nomePaciente'];
    $nomeMaePaciente1 = $dados['nomeMaePaciente1'];
    $nomeMaePaciente2 = $dados['nomeMaePaciente2'];
    $estadoCivil = $dados['estadoCivil'];
    $sexo = substr($dados['sexo'], 0, 1);

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
                        NM_PESSOA_FISICA = :nome,
                        DT_NASCIMENTO = TO_DATE(:nascimento, 'YYYY-MM-DD'),
                        IE_SEXO = :sexo,
                        IE_ESTADO_CIVIL = :estadoCivil
                        WHERE CD_PESSOA_FISICA = :codigo";

        $stmtPessoa = $conn->prepare($queryPessoa);
        $stmtPessoa->bindParam(':nome', $nomePaciente);
        $stmtPessoa->bindParam(':nascimento', $nascimento);
        $stmtPessoa->bindParam(':sexo', $sexo);
        $stmtPessoa->bindParam(':codigo', $codigoPaciente, PDO::PARAM_INT);
        $stmtPessoa->bindParam(':estadoCivil', $estadoCivil, PDO::PARAM_INT);
        $stmtPessoa->execute();

        if (trim($nomeMaePaciente1) !== '') {
            $queryContato1 = "UPDATE COMPL_PESSOA_FISICA SET 
                              NM_CONTATO = :contato
                              WHERE CD_PESSOA_FISICA = :codigo 
                              AND IE_TIPO_COMPLEMENTO = 5";

            $stmtContato1 = $conn->prepare($queryContato1);
            $stmtContato1->bindParam(':contato', $nomeMaePaciente1);
            $stmtContato1->bindParam(':codigo', $codigoPaciente, PDO::PARAM_INT);
            $stmtContato1->execute();
        }

        if (trim($nomeMaePaciente2) !== '') {
            $queryContato2 = "UPDATE COMPL_PESSOA_FISICA SET 
                              NM_CONTATO = :contato
                              WHERE CD_PESSOA_FISICA = :codigo 
                              AND IE_TIPO_COMPLEMENTO = 4";

            $stmtContato2 = $conn->prepare($queryContato2);
            $stmtContato2->bindParam(':contato', $nomeMaePaciente2);
            $stmtContato2->bindParam(':codigo', $codigoPaciente, PDO::PARAM_INT);
            $stmtContato2->execute();
        }

        $conn->commit();
        return true;
    } catch (PDOException $e) {
        $conn->rollBack();
        echo "<p>Erro ao atualizar paciente: " . $e->getMessage() . "</p>";
        return false;
    }
}
