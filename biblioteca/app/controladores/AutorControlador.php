<?php

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

    /*
    |--------------------------------------------------------------------------
    | API METHODS
    |--------------------------------------------------------------------------
    */

    public function apiListar()
    {
        Resposta::json($this->autorModel->listar());
    }

    public function apiGuardar()
    {
        Autorizacao::precisaPapel(['admin', 'backoffice']);
        $input = json_decode(file_get_contents('php://input'), true);

        if (empty($input['nome'])) {
            Resposta::erro("O nome do autor é obrigatório.");
        }

        $dados = [
            'nome' => $input['nome'],
            'biografia' => $input['biografia'] ?? null
        ];

        try {
            $this->autorModel->criar($dados);
            Resposta::json(['mensagem' => "Autor criado com sucesso!"]);
        } catch (Exception $e) {
            Resposta::erro("Erro ao criar autor.");
        }
    }

    public function apiEliminar()
    {
        Autorizacao::precisaPapel(['admin', 'backoffice']);
        $id = $_GET['id'] ?? null;
        if (!$id) Resposta::erro("ID não fornecido.");

        try {
            if (method_exists($this->autorModel, 'eliminar')) {
                $this->autorModel->eliminar($id);
            }
            Resposta::json(['mensagem' => "Autor eliminado com sucesso!"]);
        } catch (Exception $e) {
            Resposta::erro("Erro ao eliminar autor.");
        }
    }

    public function apiAtualizar()
    {
        Autorizacao::precisaPapel(['admin', 'backoffice']);
        $input = json_decode(file_get_contents('php://input'), true);

        $id = $input['id'] ?? null;
        if (!$id) Resposta::erro("ID não fornecido.");

        if (empty($input['nome'])) {
            Resposta::erro("O nome do autor é obrigatório.");
        }

        $dados = [
            'nome' => $input['nome'],
            'biografia' => $input['biografia'] ?? null
        ];

        try {
            $this->autorModel->atualizar($id, $dados);
            Resposta::json(['mensagem' => "Autor atualizado com sucesso!"]);
        } catch (Exception $e) {
            Resposta::erro("Erro ao atualizar autor.");
        }
    }
}