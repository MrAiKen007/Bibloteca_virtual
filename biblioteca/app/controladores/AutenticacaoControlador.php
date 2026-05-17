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

        //  SESSÃO CORRETA
        $_SESSION['user_id'] = $utilizador['id'];
        $_SESSION['user_nome'] = $utilizador['nome_completo'];
        $_SESSION['user_papel'] = $utilizador['papel'];

        //  REDIREÇÃO PARA O FRONTEND COM DADOS DO USUÁRIO
        $userData = [
            'id' => $utilizador['id'],
            'nome_completo' => $utilizador['nome_completo'],
            'email' => $utilizador['email'],
            'papel' => $utilizador['papel'],
            'ativo' => $utilizador['ativo']
        ];
        $userDataEncoded = urlencode(json_encode($userData));

        switch ($utilizador['papel']) {

            case 'admin':
                header("Location: ../../biblio-front/pages/admin/dashboard.html?user=" . $userDataEncoded);
                break;

            case 'backoffice':
                header("Location: ../../biblio-front/pages/backoffice/dashboard.html?user=" . $userDataEncoded);
                break;

            default:
                header("Location: ../../biblio-front/pages/catalogo.html?user=" . $userDataEncoded);
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

    /*
    |--------------------------------------------------------------------------
    | API METHODS
    |--------------------------------------------------------------------------
    */

    public function apiAutenticar()
    {
        // JSON Input
        $input = json_decode(file_get_contents('php://input'), true);
        $email = $input['email'] ?? '';
        $senha = $input['password'] ?? $input['senha'] ?? '';

        if (empty($email) || empty($senha)) {
            Resposta::erro("E-mail e senha são obrigatórios.");
        }

        $utilizadorModel = new Utilizador();
        $utilizador = $utilizadorModel->buscarPorEmail($email);

        if (!$utilizador || !password_verify($senha, $utilizador['palavra_passe'])) {
            Resposta::erro("Credenciais inválidas.");
        }

        if (!$utilizador['ativo']) {
            Resposta::erro("Conta desativada.");
        }

        $_SESSION['user_id'] = $utilizador['id'];
        $_SESSION['user_nome'] = $utilizador['nome_completo'];
        $_SESSION['user_papel'] = $utilizador['papel'];

        $db = BaseDados::getInstancia()->getConexao();
        $stmt = $db->prepare("INSERT INTO auditorias (utilizador_id, acao, tabela_afetada) VALUES (:user, 'login', 'utilizadores')");
        $stmt->execute([':user' => $utilizador['id']]);

        Resposta::json([
            'id' => $utilizador['id'],
            'name' => $utilizador['nome_completo'],
            'nome_completo' => $utilizador['nome_completo'],
            'email' => $utilizador['email'],
            'role' => $utilizador['papel'],
            'papel' => $utilizador['papel'],
            'active' => (bool)$utilizador['ativo'],
            'ativo' => (bool)$utilizador['ativo']
        ]);
    }
}