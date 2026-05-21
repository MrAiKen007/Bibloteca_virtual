<?php

class Autorizacao
{
    /*
    |--------------------------------------------------------------------------
    | VERIFICAR LOGIN
    |--------------------------------------------------------------------------
    */

    public static function estaLogado()
    {
        // Sessão normal
        if (isset($_SESSION['user_id'])) return true;
        
        // Token (para CORS proxy sem cookies)
        $token = self::getToken();
        if ($token) {
            $tokenData = self::verificarToken($token);
            if ($tokenData) {
                // Preencher sessão com dados do token
                $_SESSION['user_id'] = $tokenData['user_id'];
                $_SESSION['user_nome'] = $tokenData['user_nome'];
                $_SESSION['user_papel'] = $tokenData['user_papel'];
                return true;
            }
        }
        
        return false;
    }

    /*
    |--------------------------------------------------------------------------
    | OBTER TOKEN DO REQUEST
    |--------------------------------------------------------------------------
    */

    private static function getToken()
    {
        // Query param (primário para CORS proxy)
        if (isset($_GET['token'])) return $_GET['token'];
        
        // Header Authorization: Bearer <token>
        $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? '';
        if (preg_match('/Bearer\s+(.+)/i', $authHeader, $matches)) {
            return $matches[1];
        }
        
        // Body JSON
        $input = json_decode(file_get_contents('php://input'), true);
        if ($input && isset($input['token'])) {
            return $input['token'];
        }
        
        return null;
    }

    /*
    |--------------------------------------------------------------------------
    | VERIFICAR TOKEN
    |--------------------------------------------------------------------------
    */

    private static function verificarToken($token)
    {
        $tokenFile = __DIR__ . '/../../tokens/' . $token . '.json';
        if (!file_exists($tokenFile)) return null;
        
        $data = json_decode(file_get_contents($tokenFile), true);
        if (!$data || $data['expira'] < time()) {
            if (file_exists($tokenFile)) unlink($tokenFile);
            return null;
        }
        
        return $data;
    }

    /*
    |--------------------------------------------------------------------------
    | OBRIGAR LOGIN
    |--------------------------------------------------------------------------
    */

    public static function precisaLogin()
    {
        if (!self::estaLogado()) {
            if (self::ehPedidoApi()) {
                Resposta::erro("Não autenticado.", 401);
            }
            header("Location: index.php?url=login");
            exit;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | VERIFICAR PAPEL
    |--------------------------------------------------------------------------
    */

    public static function precisaPapel($papeis = [])
    {
        self::precisaLogin();

        $papelUtilizador = $_SESSION['user_papel'];

        if (!in_array($papelUtilizador, $papeis)) {
            if (self::ehPedidoApi()) {
                Resposta::erro("Acesso negado.", 403);
            }
            echo "Acesso negado.";
            exit;
        }
    }

    private static function ehPedidoApi()
    {
        $url = $_GET['url'] ?? '';
        return strpos($url, 'api/') === 0;
    }
}