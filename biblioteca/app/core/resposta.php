<?php

class Resposta
{
    public static function json($dados, $codigo = 200)
    {
        header("Content-Type: application/json; charset=utf-8");
        http_response_code($codigo);

        // Se já tiver 'sucesso', enviamos como está (provavelmente erro ou resposta manual)
        // Se não tiver, envolvemos no formato esperado pelo frontend {sucesso: true, dados: ...}
        if (!isset($dados['sucesso']) && !isset($dados['erro'])) {
            $dados = [
                'sucesso' => ($codigo >= 200 && $codigo < 300),
                'dados' => $dados
            ];
        } elseif (isset($dados['erro']) && !isset($dados['sucesso'])) {
            $dados['sucesso'] = false;
            $dados['mensagem'] = $dados['erro']; // Para compatibilidade com app.js que usa data.mensagem
        }

        echo json_encode($dados);
        exit;
    }

    public static function erro($mensagem, $codigo = 400)
    {
        self::json(['erro' => $mensagem], $codigo);
    }
}
