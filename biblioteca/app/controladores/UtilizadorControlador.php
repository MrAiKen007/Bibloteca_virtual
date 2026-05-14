<?php

class UtilizadorControlador
{
    /*
    |--------------------------------------------------------------------------
    | MODEL
    |--------------------------------------------------------------------------
    */

    private $utilizadorModel;

    public function __construct()
    {
        $this->utilizadorModel = new Utilizador();
    }

        public function criar()
    {
        Autorizacao::precisaPapel(['admin']);

        require_once __DIR__ . '/../views/utilizadores/criar.php';
    }

        public function guardar()
    {
        Autorizacao::precisaPapel(['admin']);

        /*
        |--------------------------------------------------------------------------
        | VALIDAÇÃO BD (campos NOT NULL)
        |--------------------------------------------------------------------------
        */

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

        /*
        |--------------------------------------------------------------------------
        | HASH DA SENHA
        |--------------------------------------------------------------------------
        */

        $senhaHash = password_hash($_POST['palavra_passe'], PASSWORD_BCRYPT);

        /*
        |--------------------------------------------------------------------------
        | DADOS (IGUAL À BD)
        |--------------------------------------------------------------------------
        */

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
    /*
    |--------------------------------------------------------------------------
    | LISTAR UTILIZADORES
    |--------------------------------------------------------------------------
    */

    public function listar()
{
    Autorizacao::precisaPapel(['admin', 'backoffice']);

    $utilizadores = $this->utilizadorModel->listar();

    require_once __DIR__ . '/../views/utilizadores/lista.php';
}
}