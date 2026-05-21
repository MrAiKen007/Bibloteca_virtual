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

        $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        $rateKey = 'login_attempts_' . $ip;
        $attempts = $_SESSION[$rateKey] ?? ['count' => 0, 'time' => time()];

        if (time() - $attempts['time'] > 300) {
            $attempts = ['count' => 0, 'time' => time()];
        }

        if ($attempts['count'] >= 10) {
            $_SESSION['erro'] = "Muitas tentativas. Aguarde 5 minutos.";
            header("Location: index.php?url=login");
            exit;
        }

        $utilizadorModel = new Utilizador();
        $utilizador = $utilizadorModel->buscarPorEmail($email);

        if (!$utilizador) {
            $attempts['count']++;
            $_SESSION[$rateKey] = $attempts;
            $_SESSION['erro'] = "Utilizador não encontrado.";
            header("Location: index.php?url=login");
            exit;
        }

        if (!password_verify($senha, $utilizador['palavra_passe'])) {
            $attempts['count']++;
            $_SESSION[$rateKey] = $attempts;
            $_SESSION['erro'] = "Senha inválida.";
            header("Location: index.php?url=login");
            exit;
        }

        if (!$utilizador['ativo']) {

            $_SESSION['erro'] = "Conta desativada.";
            header("Location: index.php?url=login");
            exit;
        }

        unset($_SESSION[$rateKey]);

        //  SESSÃO CORRETA
        session_regenerate_id(true);
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

        $frontendUrl = $_ENV['FRONTEND_URL'] ?? 'http://localhost:3000';

        switch ($utilizador['papel']) {

            case 'admin':
                header("Location: $frontendUrl/admin/dashboard?user=" . $userDataEncoded);
                break;

            case 'backoffice':
                header("Location: $frontendUrl/backoffice/dashboard?user=" . $userDataEncoded);
                break;

            default:
                header("Location: $frontendUrl/catalogo?user=" . $userDataEncoded);
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
        session_regenerate_id(true);

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