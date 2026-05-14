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
        return isset($_SESSION['utilizador']);
    }

    /*
    |--------------------------------------------------------------------------
    | OBRIGAR LOGIN
    |--------------------------------------------------------------------------
    */

    public static function precisaLogin()
    {
        if (!self::estaLogado()) {

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

        $papelUtilizador = $_SESSION['utilizador']['papel'];

        if (!in_array($papelUtilizador, $papeis)) {

            echo "Acesso negado.";
            exit;
        }
    }
}