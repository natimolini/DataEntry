<?php

function inserirMedico($dados, $conn)
{
    try {
        $conn->beginTransaction();

        if (empty($dados['cpfMedico'])) {
            throw new Exception("CPF não foi fornecido.");
        }

        $cpfMedico = preg_replace('/\D/', '', $dados['cpfMedico']); 
        $nomeMedico = $dados['nomeMedico'];
        $sexo = substr($dados['sexo'], 0, 1);
        $estadoCivil = $dados['estadoCivil'];
        $ufCrm = $dados['UFcrm'];
        $crm = $dados['crm'];
        $vinculoMedico = $dados['vinculoMedico'];
        $tipoPessoa = '2';
        $nomeUsuario = 'nataliamolini';

        $dataArray = explode('/', $dados['nascPaciente']);
        if (count($dataArray) == 3) {
            $nascimento = $dataArray[2] . '-' . $dataArray[1] . '-' . $dataArray[0];
        } else {
            echo "<p>Erro: Data de nascimento inválida.</p>";
            $conn->rollBack();
            return false;
        }

        $stmtSeq = $conn->query("SELECT pessoa_fisica_seq.NEXTVAL FROM DUAL");
        $cdPessoaFisica = $stmtSeq->fetchColumn();

        $queryPessoa = "
            INSERT INTO PESSOA_FISICA (
                CD_PESSOA_FISICA, 
                NR_CPF, 
                NM_PESSOA_FISICA, 
                DT_NASCIMENTO, 
                IE_SEXO, 
                IE_TIPO_PESSOA, 
                DT_ATUALIZACAO, 
                NM_USUARIO, 
                IE_ESTADO_CIVIL
            ) VALUES (
                :cdPessoaFisica, 
                :cpf, 
                :nome, 
                TO_DATE(:nascimento, 'YYYY-MM-DD'), 
                :sexo, 
                :tipoPessoa, 
                SYSDATE, 
                :nomeUsuario, 
                :estadoCivil
            )";

        $stmtPessoa = $conn->prepare($queryPessoa);
        $stmtPessoa->bindParam(':cdPessoaFisica', $cdPessoaFisica, PDO::PARAM_INT);
        $stmtPessoa->bindParam(':cpf', $cpfMedico, PDO::PARAM_STR);
        $stmtPessoa->bindParam(':nome', $nomeMedico, PDO::PARAM_STR);
        $stmtPessoa->bindParam(':nascimento', $nascimento, PDO::PARAM_STR);
        $stmtPessoa->bindParam(':sexo', $sexo, PDO::PARAM_STR);
        $stmtPessoa->bindParam(':tipoPessoa', $tipoPessoa, PDO::PARAM_STR);
        $stmtPessoa->bindParam(':nomeUsuario', $nomeUsuario, PDO::PARAM_STR);
        $stmtPessoa->bindParam(':estadoCivil', $estadoCivil, PDO::PARAM_INT);

        if (!$stmtPessoa->execute()) {
            $conn->rollBack();
            echo "<p>Erro ao inserir dados na tabela PESSOA_FISICA.</p>";
            return false;
        }

        $queryMedico = "
            INSERT INTO MEDICO (
                CD_PESSOA_FISICA, 
                NM_GUERRA, 
                NR_CRM, 
                UF_CRM, 
                IE_VINCULO_MEDICO, 
                IE_CORPO_CLINICO,
                IE_CORPO_ASSIST,
                DT_ATUALIZACAO, 
                NM_USUARIO
            ) VALUES (
                :cdPessoaFisica, 
                :nome, 
                :crm, 
                :ufCrm, 
                :vinculoMedico, 
                'N',  -- Valor fixo para IE_CORPO_CLINICO
                'N',  -- Valor fixo para IE_CORPO_ASSIST
                SYSDATE, 
                :nomeUsuario
            )";

        $stmtMedico = $conn->prepare($queryMedico);
        $stmtMedico->bindParam(':cdPessoaFisica', $cdPessoaFisica, PDO::PARAM_INT);
        $stmtMedico->bindParam(':nome', $nomeMedico, PDO::PARAM_STR);
        $stmtMedico->bindParam(':crm', $crm, PDO::PARAM_STR);
        $stmtMedico->bindParam(':ufCrm', $ufCrm, PDO::PARAM_STR);
        $stmtMedico->bindParam(':vinculoMedico', $vinculoMedico, PDO::PARAM_STR);
        $stmtMedico->bindParam(':nomeUsuario', $nomeUsuario, PDO::PARAM_STR);

        if ($stmtMedico->execute()) {
            $conn->commit();
            return true;
        } else {
            $conn->rollBack();
            echo "<p>Erro ao inserir dados na tabela MEDICO.</p>";
            return false;
        }
    } catch (Exception $e) {
        $conn->rollBack();
        echo "<p>Erro: " . $e->getMessage() . "</p>";
        return false;
    } catch (PDOException $e) {
        $conn->rollBack();
        echo "<p>Erro ao inserir médico: " . $e->getMessage() . "</p>";
        return false;
    }
}
