<?php

class DashboardControlador
{
    private $pedidoModel;
    private $utilizadorModel;

    public function __construct()
    {
        $this->pedidoModel = new Pedido();
        $this->utilizadorModel = new Utilizador();
    }

    public function index()
    {
        Autorizacao::precisaPapel(['admin']);
        echo "<h1>Dashboard Admin</h1>";
        echo "<p>Sistema a funcionar</p>";
    }

    public function apiStats()
    {
        Autorizacao::precisaPapel(['admin', 'backoffice']);
        
        $stats = $this->pedidoModel->getEstatisticas();
        $vendasPorMes = $this->pedidoModel->getVendasPorMes();
        $maisVendidos = $this->pedidoModel->getMaisVendidos();
        $todosPedidos = $this->pedidoModel->listar();

        Resposta::json([
            'vendas' => $stats['receita_total'] ?? 0,
            'total_pedidos' => $stats['total_pedidos'] ?? 0,
            'vendas_por_mes' => $vendasPorMes,
            'mais_vendidos' => $maisVendidos,
            'pedidos' => $todosPedidos
        ]);
    }
}