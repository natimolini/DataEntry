<?php

function atualizarPaciente($dados, $conn)
{
    $codigoPaciente = $dados['codigoPaciente'];
    $nomePaciente = $dados['nomePaciente'];
    $nomeMaePaciente1 = $dados['nomeMaePaciente1'];
    $nomeMaePaciente2 = $dados['nomeMaePaciente2'];
    $sexo = substr($dados['sexo'], 0, 1);

    $dataArray = explode('/', $dados['nascPaciente']);
    if (count($dataArray) == 3) {
        $nascimento = $dataArray[2] . '-' . $dataArray[1] . '-' . $dataArray[0];
    } else {
        echo "<p>Erro: Data de nascimento inválida.</p>";
        return false;
    }

    $contatoConcatenado = trim($nomeMaePaciente1) . (trim($nomeMaePaciente1) && trim($nomeMaePaciente2) ? ', ' : '') . trim($nomeMaePaciente2);

    try {
        // Atualiza de PESSOA_FISICA
        $query = "UPDATE PESSOA_FISICA SET 
                  NM_PESSOA_FISICA = :nome,
                  DT_NASCIMENTO = TO_DATE(:nascimento, 'YYYY-MM-DD'),
                  IE_SEXO = :sexo 
                  WHERE CD_PESSOA_FISICA = :codigo";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':nome', $nomePaciente);
        $stmt->bindParam(':nascimento', $nascimento);
        $stmt->bindParam(':sexo', $sexo);
        $stmt->bindParam(':codigo', $codigoPaciente, PDO::PARAM_INT);
        $stmt->execute();

        // Atualiza de COMPL_PESSOA_FISICA
        $queryContato = "UPDATE COMPL_PESSOA_FISICA SET 
                         NM_CONTATO = :contato 
                         WHERE CD_PESSOA_FISICA = :codigo";
        $stmtContato = $conn->prepare($queryContato);
        $stmtContato->bindParam(':contato', $contatoConcatenado);
        $stmtContato->bindParam(':codigo', $codigoPaciente, PDO::PARAM_INT);
        $stmtContato->execute();

        return true;
    } catch (PDOException $e) {
        echo "<p>Erro ao atualizar paciente: " . $e->getMessage() . "</p>";
        return false;
    }
}