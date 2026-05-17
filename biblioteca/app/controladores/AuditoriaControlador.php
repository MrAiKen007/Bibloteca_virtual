<?php

class AuditoriaControlador
{
    public function apiRecente()
    {
        Autorizacao::precisaPapel(['admin', 'backoffice']);

        $db = BaseDados::getInstancia()->getConexao();
        $limit = $_GET['limit'] ?? 20;

        $stmt = $db->prepare("
            SELECT a.*, u.nome_completo as utilizador_nome, u.email as utilizador_email
            FROM auditorias a
            LEFT JOIN utilizadores u ON a.utilizador_id = u.id
            ORDER BY a.criado_em DESC
            LIMIT :limit
        ");
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        Resposta::json($logs);
    }
}
