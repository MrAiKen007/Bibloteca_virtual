<?php
require_once __DIR__ . "/../app/controladores/RegistoControlador.php";
class RegistoControlador
{
    public function criar()
    {
        require_once __DIR__ . '/../views/registo.php';
    }

    public function guardar()
    {
        $nome = $_POST['nome_completo'] ?? '';
        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';

        if (empty($nome) || empty($email) || empty($senha)) {

            $_SESSION['erro'] = "Preencha todos os campos.";
            header("Location: index.php?url=registo");
            exit;
        }

        $utilizadorModel = new Utilizador();

        $dados = [
            'nome_completo' => $nome,
            'email' => $email,
            'palavra_passe' => password_hash($senha, PASSWORD_DEFAULT),
            'papel' => 'cliente',
            'ativo' => 1
        ];

        $utilizadorModel->criar($dados);

        header("Location: index.php?url=login");
        exit;
    }
}