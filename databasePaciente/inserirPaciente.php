<?php

function inserirPaciente($dados, $conn)
{
    $cpfPaciente = preg_replace('/\D/', '', $dados['cpfpaciente']);
    $nomePaciente = $dados['nomePaciente'];
    $nomeMaePaciente1 = $dados['nomeMaePaciente1'];
    $nomeMaePaciente2 = $dados['nomeMaePaciente2'];
    $sexo = substr($dados['sexo'], 0, 1);
    $estadoCivil = $dados['estadoCivil'];
    $tipoPessoa = '2';
    $nomeUsuario = 'nataliamolini';

    $dataArray = explode('/', $dados['nascPaciente']);
    if (count($dataArray) == 3) {
        $nascimento = $dataArray[2] . '-' . $dataArray[1] . '-' . $dataArray[0];
    } else {
        echo "<p>Erro: Data de nascimento inválida.</p>";
        return false;
    }

    try {
        $conn->beginTransaction();

        $stmtSeq = $conn->query("SELECT pessoa_fisica_seq.NEXTVAL FROM DUAL");
        $cdPessoaFisica = $stmtSeq->fetchColumn();

        $query = "INSERT INTO 
            PESSOA_FISICA (
            CD_PESSOA_FISICA, 
            NR_CPF, 
            NM_PESSOA_FISICA, 
            DT_NASCIMENTO, 
            IE_SEXO, 
            IE_TIPO_PESSOA,
            DT_ATUALIZACAO,
            NM_USUARIO,
            IE_ESTADO_CIVIL 
            )
          VALUES 
            (:cdPessoaFisica,
            :cpf,
            :nome,
            TO_DATE(:nascimento, 'YYYY-MM-DD'),
            :sexo, 
            :tipoPessoa, 
            SYSDATE,
            :nomeUsuario,
            :estadoCivil)";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':cdPessoaFisica', $cdPessoaFisica, PDO::PARAM_INT);
        $stmt->bindParam(':cpf', $cpfPaciente, PDO::PARAM_STR);
        $stmt->bindParam(':nome', $nomePaciente, PDO::PARAM_STR);
        $stmt->bindParam(':nascimento', $nascimento, PDO::PARAM_STR);
        $stmt->bindParam(':sexo', $sexo, PDO::PARAM_STR);
        $stmt->bindParam(':tipoPessoa', $tipoPessoa, PDO::PARAM_STR);
        $stmt->bindParam(':nomeUsuario', $nomeUsuario, PDO::PARAM_STR);
        $stmt->bindParam(':estadoCivil', $estadoCivil, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $contatos = [
                ['nome' => $nomeMaePaciente1, 'tipo' => 5],
                ['nome' => $nomeMaePaciente2, 'tipo' => 4]
            ];

            foreach ($contatos as $contato) {
                if (trim($contato['nome']) === '') {
                    continue; 
                }
                $queryNextSeq = "SELECT NVL(MAX(NR_SEQUENCIA), 0) + 1 AS NEXT_SEQ
                                 FROM COMPL_PESSOA_FISICA
                                 WHERE CD_PESSOA_FISICA = :cdPessoaFisica";
                $stmtNextSeq = $conn->prepare($queryNextSeq);
                $stmtNextSeq->bindParam(':cdPessoaFisica', $cdPessoaFisica, PDO::PARAM_INT);
                $stmtNextSeq->execute();
                $nrSequencia = $stmtNextSeq->fetchColumn();

                $queryContato = "INSERT INTO COMPL_PESSOA_FISICA (
                                    CD_PESSOA_FISICA, 
                                    NR_SEQUENCIA, 
                                    NM_CONTATO, 
                                    IE_TIPO_COMPLEMENTO, 
                                    DT_ATUALIZACAO,
                                    NM_USUARIO
                                 ) VALUES (
                                    :codigo, 
                                    :nrSequencia, 
                                    :contato, 
                                    :tipoComplemento, 
                                    SYSDATE,
                                    :nomeUsuario
                                 )";
                $stmtContato = $conn->prepare($queryContato);
                $stmtContato->bindParam(':codigo', $cdPessoaFisica, PDO::PARAM_INT);
                $stmtContato->bindParam(':nrSequencia', $nrSequencia, PDO::PARAM_INT);
                $stmtContato->bindParam(':contato', $contato['nome'], PDO::PARAM_STR);
                $stmtContato->bindParam(':tipoComplemento', $contato['tipo'], PDO::PARAM_INT);
                $stmtContato->bindParam(':nomeUsuario', $nomeUsuario, PDO::PARAM_STR);
                $stmtContato->execute();
            }

            $conn->commit();
            return true;
        } else {
            $conn->rollBack();
            echo "<p>Erro ao inserir dados na tabela PESSOA_FISICA.</p>";
            return false;
        }
    } catch (PDOException $e) {
        $conn->rollBack();
        echo "<p>Erro ao inserir paciente: " . $e->getMessage() . "</p>";
        return false;
    }
}
