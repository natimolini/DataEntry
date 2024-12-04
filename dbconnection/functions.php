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

