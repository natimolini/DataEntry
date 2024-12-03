<?php
try {
    $dsn = 'oci:dbname=//177.220.133.38:4787/dbteste';
    $username = 'demo';
    $password = 'aloisk';

    $conn = new PDO($dsn, $username, $password);
    echo "Conexão bem-sucedida!";
} catch (PDOException $e) {
    echo "Erro ao conectar ao Oracle: " . $e->getMessage();
}
