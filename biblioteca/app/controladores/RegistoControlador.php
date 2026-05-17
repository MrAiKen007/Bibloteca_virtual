<?php

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

    /*
    |--------------------------------------------------------------------------
    | API METHODS
    |--------------------------------------------------------------------------
    */

    public function apiGuardar()
    {
        $input = json_decode(file_get_contents('php://input'), true);

        $nome = $input['nome'] ?? $input['nome_completo'] ?? '';
        $email = $input['email'] ?? '';
        $senha = $input['password'] ?? $input['senha'] ?? '';

        if (empty($nome) || empty($email) || empty($senha)) {
            Resposta::erro("Nome, e-mail e palavra-passe são obrigatórios.");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Resposta::erro("E-mail inválido.");
        }

        if (strlen($senha) < 6) {
            Resposta::erro("A palavra-passe deve ter pelo menos 6 caracteres.");
        }

        $utilizadorModel = new Utilizador();

        if ($utilizadorModel->buscarPorEmail($email)) {
            Resposta::erro("E-mail já está em uso.");
        }

        $dados = [
            'nome_completo' => $nome,
            'email' => $email,
            'palavra_passe' => password_hash($senha, PASSWORD_DEFAULT),
            'papel' => 'cliente',
            'ativo' => 1
        ];

        if ($utilizadorModel->criar($dados)) {
            $user = $utilizadorModel->buscarPorEmail($email);
            Resposta::json([
                'id' => $user['id'],
                'name' => $user['nome_completo'],
                'email' => $user['email'],
                'role' => $user['papel'],
                'active' => true
            ], 201);
        } else {
            Resposta::erro("Erro ao criar conta.");
        }
    }
}