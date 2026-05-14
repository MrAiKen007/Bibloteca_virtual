<?php

require_once __DIR__ . '/../modelos/Editora.php';

class EditoraControlador
{
    private $editoraModel;

    public function __construct()
    {
        $this->editoraModel = new Editora();
    }

    /*
    |--------------------------------------------------------------------------
    | LISTAR
    |--------------------------------------------------------------------------
    */

    public function listar()
    {
        Autorizacao::precisaPapel(['admin', 'backoffice']);

        $editoras = $this->editoraModel->listar();

        require_once __DIR__ . '/../views/editoras/listar.php';
    }

    /*
    |--------------------------------------------------------------------------
    | FORM CRIAR
    |--------------------------------------------------------------------------
    */

    public function criar()
    {
        Autorizacao::precisaPapel(['admin', 'backoffice']);

        require_once __DIR__ . '/../views/editoras/criar.php';
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

            $_SESSION['erro'] = "O nome da editora é obrigatório.";

            header("Location: index.php?url=editoras/criar");
            exit;
        }

        $dados = [
            'nome' => $_POST['nome'],
            'pais' => $_POST['pais'] ?? null
        ];

        $this->editoraModel->criar($dados);

        header("Location: index.php?url=editoras");
        exit;
    }
}