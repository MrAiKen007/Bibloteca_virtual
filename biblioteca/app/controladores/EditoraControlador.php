<?php

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

    /*
    |--------------------------------------------------------------------------
    | API METHODS
    |--------------------------------------------------------------------------
    */

    public function apiListar()
    {
        Resposta::json($this->editoraModel->listar());
    }

    public function apiGuardar()
    {
        Autorizacao::precisaPapel(['admin', 'backoffice']);
        $input = json_decode(file_get_contents('php://input'), true);

        if (empty($input['nome'])) {
            Resposta::erro("O nome da editora é obrigatório.");
        }

        $dados = [
            'nome' => $input['nome'],
            'pais' => $input['pais'] ?? null
        ];

        try {
            $this->editoraModel->criar($dados);
            Resposta::json(['mensagem' => "Editora criada com sucesso!"]);
        } catch (Exception $e) {
            Resposta::erro("Erro ao criar editora.");
        }
    }

    public function apiEliminar()
    {
        Autorizacao::precisaPapel(['admin', 'backoffice']);
        $id = $_GET['id'] ?? null;
        if (!$id) Resposta::erro("ID não fornecido.");

        try {
            if (method_exists($this->editoraModel, 'eliminar')) {
                $this->editoraModel->eliminar($id);
            }
            Resposta::json(['mensagem' => "Editora eliminada com sucesso!"]);
        } catch (Exception $e) {
            Resposta::erro("Erro ao eliminar editora.");
        }
    }
}