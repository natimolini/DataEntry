<?php
try {
    $dsn = 'oci:dbname=//177.220.133.38:4787/dbteste;charset=UTF8';
    $username = 'demo';
    $password = 'aloisktasy7818';

    $conn = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    echo "Erro ao conectar ao Oracle: " . $e->getMessage();
}
