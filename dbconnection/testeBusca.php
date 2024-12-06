<?php
require_once 'functions.php';

$id = 1;
$registro = buscarPorId('PESSOA_FISICA', $id);

echo "<h3>Registro com ID $id na Tabela pessoa_fisica:</h3>";
if ($registro && isset($registro['NM_PESSOA_FISICA'])) {
    echo "Nome: " . $registro['NM_PESSOA_FISICA'];
} else {
    echo "Registro não encontrado ou campo 'NM_PESSOA_FISICA' ausente.";
}
