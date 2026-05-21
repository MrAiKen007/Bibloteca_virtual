<?php
// Gerar hash de password para uso direto na BD
// Uso: php scripts/gerar_hash.php
$senha = $argv[1] ?? '1234';
echo "Hash para '$senha':\n";
echo password_hash($senha, PASSWORD_DEFAULT) . "\n";