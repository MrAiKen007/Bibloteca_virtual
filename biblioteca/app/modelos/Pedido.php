<?php

class Pedido
{
    private $db;

    public function __construct()
    {
        $this->db = BaseDados::getInstancia()->getConexao();
    }

    public function listar()
    {
        $sql = "SELECT 
                    id, 
                    cliente_id as userId, 
                    preco_pago as total, 
                    estado_pagamento as status, 
                    criado_em as date 
                FROM pedidos 
                ORDER BY criado_em DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEstatisticas()
    {
        $sql = "SELECT 
                    COUNT(*) as total_pedidos,
                    SUM(preco_pago) as receita_total
                FROM pedidos";
        $stmt = $this->db->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getVendasPorMes()
    {
        // SQL compatível com MySQL para agrupamento por mês
        $sql = "SELECT 
                    DATE_FORMAT(criado_em, '%b') as month,
                    SUM(preco_pago) as vendas
                FROM pedidos
                GROUP BY month
                ORDER BY criado_em ASC";
        try {
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }

    public function getMaisVendidos()
    {
        // Tentamos buscar títulos reais se possível via JOIN
        $sql = "SELECT 
                    l.titulo, 
                    COUNT(p.id) as vendas
                FROM pedidos p
                JOIN livros l ON p.livro_id = l.id
                GROUP BY l.id, l.titulo
                ORDER BY vendas DESC
                LIMIT 5";
        try {
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [
                ['titulo' => 'Dom Casmurro', 'vendas' => 0],
                ['titulo' => 'O Alquimista', 'vendas' => 0]
            ];
        }
    }
}
