<?php

class AutenticacaoControlador
{
    public function login()
    {
        require_once __DIR__ . '/../views/login.php';
    }

    public function autenticar()
    {
        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';

        if (empty($email) || empty($senha)) {

            $_SESSION['erro'] = "Preencha todos os campos.";
            header("Location: index.php?url=login");
            exit;
        }

        $utilizadorModel = new Utilizador();
        $utilizador = $utilizadorModel->buscarPorEmail($email);

        if (!$utilizador) {

            $_SESSION['erro'] = "Utilizador não encontrado.";
            header("Location: index.php?url=login");
            exit;
        }

        if (!password_verify($senha, $utilizador['palavra_passe'])) {

            $_SESSION['erro'] = "Senha inválida.";
            header("Location: index.php?url=login");
            exit;
        }

        if (!$utilizador['ativo']) {

            $_SESSION['erro'] = "Conta desativada.";
            header("Location: index.php?url=login");
            exit;
        }

        // 🔥 SESSÃO CORRETA
        $_SESSION['user_id'] = $utilizador['id'];
        $_SESSION['user_nome'] = $utilizador['nome_completo'];
        $_SESSION['user_papel'] = $utilizador['papel'];

        // 🔥 REDIREÇÃO SIMPLES E SEGURA
        switch ($utilizador['papel']) {

            case 'admin':
                header("Location: index.php?url=utilizadores");
                break;

            case 'backoffice':
                header("Location: index.php?url=livros");
                break;

            default:
                header("Location: index.php?url=biblioteca");
                break;
        }

        exit;
    }

    public function logout()
    {
        session_destroy();

        header("Location: index.php?url=login");
        exit;
    }
}