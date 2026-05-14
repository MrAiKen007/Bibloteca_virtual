<?php

class DashboardControlador
{
    public function index()
    {
        Autorizacao::precisaPapel(['admin']);

        echo "<h1>Dashboard Admin</h1>";
        echo "<p>Sistema a funcionar</p>";
    }
}