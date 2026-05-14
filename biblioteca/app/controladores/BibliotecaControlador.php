<?php

class BibliotecaControlador
{
    private $livroModel;

    public function __construct()
    {
        $this->livroModel = new Livro();
    }

    /*
    |--------------------------------------------------------------------------
    | BIBLIOTECA PÚBLICA
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        Autorizacao::precisaPapel([
            'cliente',
            'admin',
            'backoffice'
        ]);

        $livros = $this->livroModel->listar();

        require_once __DIR__ . '/../views/biblioteca/index.php';
    }
}