<?php
require_once 'connection.php';

function buscarPorId($tabela, $id)
{
    global $conn;
    $query = "SELECT NM_PESSOA_FISICA FROM $tabela WHERE CD_PESSOA_FISICA = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado ?: null;
    } else {
        throw new Exception("Erro ao executar a consulta");
    }
}

function select($conn, $aCampos, $tabela, $condicao)
{
    $_SESSION['LAST_ACTIVITY'] = time();
    $campos = $aCampos == "*" ? "*" : implode(',', $aCampos);
    $consulta = "SELECT $campos FROM $tabela";
    if ($condicao) {
        $consulta .= " WHERE $condicao";
    }

    $stmt = $conn->prepare($consulta);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}
function selectComposto($conn, $aCampos, $tabela, $extras)
{
    // Atualiza a última atividade (se necessário para a aplicação)
    $_SESSION['LAST_ACTIVITY'] = time();

    // Trata os campos da consulta
    if (is_array($aCampos)) {
        $campos = implode(',', $aCampos);
    } else {
        $campos = $aCampos;
    }

    // Inicia a consulta
    $consulta = "SELECT $campos FROM $tabela";

    // Adiciona extras, se houver
    if (!empty($extras)) {
        $consulta .= " " . $extras;
    }

    try {
        // Prepara e executa a consulta
        $stmt = $conn->prepare($consulta);
        $stmt->execute();

        // Retorna os resultados
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Gera uma mensagem de erro com a consulta e a exceção
        throw new Exception(
            "Erro ao executar consulta: " . $e->getMessage() . "\nConsulta: $consulta"
        );
    }
}


function create($conn, $aCampos, $aValores, $tabela)
{
    $_SESSION['LAST_ACTIVITY'] = time();
    $campos = implode(',', $aCampos);
    $placeholders = implode(',', array_fill(0, count($aValores), '?'));
    $consulta = "INSERT INTO $tabela ($campos) VALUES ($placeholders)";

    try {
        $stmt = $conn->prepare($consulta);
        $stmt->execute($aValores);
        return "Registro inserido com sucesso.";
    } catch (PDOException $e) {
        if (strpos($e->getMessage(), 'ORA-00001') !== false) { // Detect duplicate entry
            return "Erro ao inserir registro: Entrada duplicada.";
        } else {
            return "Erro ao inserir registro: " . $e->getMessage();
        }
    }
}

function update($conn, $tabela, $aSet, $condicao)
{
    $_SESSION['LAST_ACTIVITY'] = time();
    $sets = [];
    $valores = [];
    foreach ($aSet as $campo => $valor) {
        $sets[] = "$campo = ?";
        $valores[] = $valor;
    }
    $consulta = "UPDATE $tabela SET " . implode(', ', $sets) . " WHERE $condicao";

    try {
        $stmt = $conn->prepare($consulta);
        $stmt->execute($valores);
        return "Registro atualizado com sucesso.";
    } catch (PDOException $e) {
        return "Erro ao atualizar registro: " . $e->getMessage();
    }
}

function deleteByCondition($conn, $tabela, $condicao)
{
    $consulta = "DELETE FROM $tabela WHERE $condicao";
    try {
        $stmt = $conn->prepare($consulta);
        $stmt->execute();
        return "Registro(s) deletado(s) com sucesso.";
    } catch (PDOException $e) {
        return "Erro ao deletar registro(s): " . $e->getMessage();
    }
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$s_name = session_name();

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 600)) {
    session_unset();
    session_destroy();
    echo "<script>alert('Sessão expirada!')</script>";
    header('Location: ../index.php');
}
$_SESSION['LAST_ACTIVITY'] = time();
