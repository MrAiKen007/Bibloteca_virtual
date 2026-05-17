<?php

class UtilizadorControlador
{
    private $utilizadorModel;

    public function __construct()
    {
        $this->utilizadorModel = new Utilizador();
    }

    public function listar()
    {
        Autorizacao::precisaPapel(['admin', 'backoffice']);
        $utilizadores = $this->utilizadorModel->listar();
        require_once __DIR__ . '/../views/utilizadores/lista.php';
    }

    public function criar()
    {
        Autorizacao::precisaPapel(['admin']);
        require_once __DIR__ . '/../views/utilizadores/criar.php';
    }

    public function guardar()
    {
        Autorizacao::precisaPapel(['admin']);

        if (
            empty($_POST['nome_completo']) ||
            empty($_POST['email']) ||
            empty($_POST['palavra_passe']) ||
            empty($_POST['papel'])
        ) {
            $_SESSION['erro'] = "Preencha todos os campos obrigatórios.";
            header("Location: index.php?url=utilizadores/criar");
            exit;
        }

        $senhaHash = password_hash($_POST['palavra_passe'], PASSWORD_BCRYPT);

        $dados = [
            'nome_completo' => $_POST['nome_completo'],
            'email' => $_POST['email'],
            'palavra_passe' => $senhaHash,
            'papel' => $_POST['papel'],
            'ativo' => 1,
            'email_verificado' => 0
        ];

        $this->utilizadorModel->criar($dados);
        header("Location: index.php?url=utilizadores");
        exit;
    }

    public function apiListar()
    {
        Autorizacao::precisaPapel(['admin']);
        $utilizadores = $this->utilizadorModel->listar();
        Resposta::json($utilizadores);
    }

    public function apiGuardar()
    {
        Autorizacao::precisaPapel(['admin']);

        // Ler input JSON
        $input = json_decode(file_get_contents('php://input'), true);

        if (
            empty($input['nome_completo']) ||
            empty($input['email']) ||
            empty($input['palavra_passe']) ||
            empty($input['papel'])
        ) {
            Resposta::erro("Preencha todos os campos obrigatórios.");
        }

        $senhaHash = password_hash($input['palavra_passe'], PASSWORD_BCRYPT);

        $dados = [
            'nome_completo' => $input['nome_completo'],
            'email' => $input['email'],
            'palavra_passe' => $senhaHash,
            'papel' => $input['papel'],
            'ativo' => 1,
            'email_verificado' => 0
        ];

        try {
            $this->utilizadorModel->criar($dados);
            Resposta::json(['mensagem' => "Utilizador criado com sucesso!"]);
        } catch (Exception $e) {
            Resposta::erro("Erro ao criar utilizador: " . $e->getMessage());
        }
    }
}
