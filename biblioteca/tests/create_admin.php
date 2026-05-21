<?php
require_once 'biblioteca/app/core/BaseDados.php';
require_once 'biblioteca/app/modelos/Utilizador.php';

$utilizadorModel = new Utilizador();

$email = 'admin@biblio.com';
$senha = '12345678';

if ($utilizadorModel->buscarPorEmail($email)) {
    echo "Utilizador admin já existe.\n";
    exit;
}

$dados = [
    'nome_completo' => 'Administrador Geral',
    'email' => $email,
    'palavra_passe' => password_hash($senha, PASSWORD_DEFAULT),
    'papel' => 'admin',
    'ativo' => 1,
    'email_verificado' => 1
];

if ($utilizadorModel->criar($dados)) {
    echo "Conta de administrador criada com sucesso!\n";
    echo "E-mail: $email\n";
    echo "Senha: $senha\n";
} else {
    echo "Erro ao criar conta de administrador.\n";
}
