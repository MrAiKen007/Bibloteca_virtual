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

    public function editar()
    {
        Autorizacao::precisaPapel(['admin']);

        $id = $_GET['id'] ?? null;
        if (!$id) {
            $_SESSION['erro'] = "ID não fornecido.";
            header("Location: index.php?url=utilizadores");
            exit;
        }

        $utilizador = $this->utilizadorModel->buscarPorId($id);
        if (!$utilizador) {
            $_SESSION['erro'] = "Utilizador não encontrado.";
            header("Location: index.php?url=utilizadores");
            exit;
        }

        require_once __DIR__ . '/../views/utilizadores/editar.php';
    }

    public function atualizar()
    {
        Autorizacao::precisaPapel(['admin']);

        $id = $_POST['id'] ?? null;
        if (!$id) {
            $_SESSION['erro'] = "ID não fornecido.";
            header("Location: index.php?url=utilizadores");
            exit;
        }

        $utilizadorExistente = $this->utilizadorModel->buscarPorId($id);
        if (!$utilizadorExistente) {
            $_SESSION['erro'] = "Utilizador não encontrado.";
            header("Location: index.php?url=utilizadores");
            exit;
        }

        $dados = [
            'nome_completo' => $_POST['nome_completo'] ?? $utilizadorExistente['nome_completo'],
            'email' => $_POST['email'] ?? $utilizadorExistente['email'],
            'papel' => $_POST['papel'] ?? $utilizadorExistente['papel'],
            'ativo' => isset($_POST['ativo']) ? (int)$_POST['ativo'] : $utilizadorExistente['ativo'],
        ];

        if (!empty($_POST['palavra_passe'])) {
            $dados['palavra_passe'] = password_hash($_POST['palavra_passe'], PASSWORD_BCRYPT);
        }

        try {
            $this->utilizadorModel->atualizar($id, $dados);
            header("Location: index.php?url=utilizadores");
            exit;
        } catch (Exception $e) {
            $_SESSION['erro'] = "Erro ao atualizar utilizador: " . $e->getMessage();
            header("Location: index.php?url=utilizadores/editar&id=$id");
            exit;
        }
    }

    public function eliminar()
    {
        Autorizacao::precisaPapel(['admin']);

        $id = $_GET['id'] ?? null;
        if (!$id) {
            $_SESSION['erro'] = "ID não fornecido.";
            header("Location: index.php?url=utilizadores");
            exit;
        }

        try {
            $this->utilizadorModel->eliminar($id);
            header("Location: index.php?url=utilizadores");
            exit;
        } catch (Exception $e) {
            $_SESSION['erro'] = "Erro ao eliminar utilizador: " . $e->getMessage();
            header("Location: index.php?url=utilizadores");
            exit;
        }
    }

    public function apiEditar()
    {
        Autorizacao::precisaPapel(['admin']);

        $id = $_GET['id'] ?? null;
        if (!$id) Resposta::erro("ID não fornecido.");

        $utilizador = $this->utilizadorModel->buscarPorId($id);
        if (!$utilizador) Resposta::erro("Utilizador não encontrado.", 404);

        Resposta::json($utilizador);
    }

    public function apiAtualizar()
    {
        Autorizacao::precisaPapel(['admin']);

        $input = json_decode(file_get_contents('php://input'), true);
        $id = $input['id'] ?? null;
        if (!$id) Resposta::erro("ID não fornecido.");

        $utilizadorExistente = $this->utilizadorModel->buscarPorId($id);
        if (!$utilizadorExistente) Resposta::erro("Utilizador não encontrado.", 404);

        $dados = [
            'nome_completo' => $input['nome_completo'] ?? $utilizadorExistente['nome_completo'],
            'email' => $input['email'] ?? $utilizadorExistente['email'],
            'papel' => $input['papel'] ?? $utilizadorExistente['papel'],
            'ativo' => isset($input['ativo']) ? (int)$input['ativo'] : $utilizadorExistente['ativo'],
        ];

        if (!empty($input['palavra_passe'])) {
            $dados['palavra_passe'] = password_hash($input['palavra_passe'], PASSWORD_BCRYPT);
        }

        try {
            $this->utilizadorModel->atualizar($id, $dados);
            Resposta::json(['mensagem' => "Utilizador atualizado com sucesso!"]);
        } catch (Exception $e) {
            Resposta::erro("Erro ao atualizar utilizador: " . $e->getMessage());
        }
    }

    public function apiEliminar()
    {
        Autorizacao::precisaPapel(['admin']);

        $id = $_GET['id'] ?? null;
        if (!$id) Resposta::erro("ID não fornecido.");

        try {
            $this->utilizadorModel->eliminar($id);
            Resposta::json(['mensagem' => "Utilizador eliminado com sucesso!"]);
        } catch (Exception $e) {
            Resposta::erro("Erro ao eliminar utilizador: " . $e->getMessage());
        }
    }
}
