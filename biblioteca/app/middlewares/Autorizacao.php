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
        return isset($_SESSION['user_id']);
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