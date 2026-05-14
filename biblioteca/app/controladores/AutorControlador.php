<?php

require_once __DIR__ . '/../modelos/Autor.php';

class AutorControlador
{
    private $autorModel;

    public function __construct()
    {
        $this->autorModel = new Autor();
    }

    /*
    |--------------------------------------------------------------------------
    | LISTAR
    |--------------------------------------------------------------------------
    */

    public function listar()
    {
        Autorizacao::precisaPapel(['admin', 'backoffice']);

        $autores = $this->autorModel->listar();

        require_once __DIR__ . '/../views/autores/listar.php';
    }

    /*
    |--------------------------------------------------------------------------
    | FORM CRIAR
    |--------------------------------------------------------------------------
    */

    public function criar()
    {
        Autorizacao::precisaPapel(['admin', 'backoffice']);

        require_once __DIR__ . '/../views/autores/criar.php';
    }

    /*
    |--------------------------------------------------------------------------
    | GUARDAR
    |--------------------------------------------------------------------------
    */

    public function guardar()
    {
        Autorizacao::precisaPapel(['admin', 'backoffice']);

        // 🔥 VALIDAÇÃO BD
        if (empty($_POST['nome'])) {

            $_SESSION['erro'] = "O nome do autor é obrigatório.";

            header("Location: index.php?url=autores/criar");
            exit;
        }

        $dados = [
            'nome' => $_POST['nome'],
            'biografia' => $_POST['biografia'] ?? null
        ];

        $this->autorModel->criar($dados);

        header("Location: index.php?url=autores");
        exit;
    }
}