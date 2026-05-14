<?php

class LivroControlador
{
    private $livroModel;

    public function __construct()
    {
        $this->livroModel = new Livro();
    }

    /*
    |--------------------------------------------------------------------------
    | LISTAR LIVROS
    |--------------------------------------------------------------------------
    */

    public function listar()
    {
        Autorizacao::precisaPapel(['admin', 'backoffice']);

        $livros = $this->livroModel->listar();

        require_once __DIR__ . '/../views/livros/lista.php';
    }

    /*
    |--------------------------------------------------------------------------
    | FORMULÁRIO CRIAR LIVRO
    |--------------------------------------------------------------------------
    */

        public function criar()
    {
        Autorizacao::precisaPapel(['admin', 'backoffice']);

        require_once __DIR__ . '/../modelos/Autor.php';
        require_once __DIR__ . '/../modelos/Editora.php';

        $autorModel = new Autor();
        $editoraModel = new Editora();

        $autores = $autorModel->listar();
        $editoras = $editoraModel->listar();

        require_once __DIR__ . '/../views/livros/criar.php';
    }

    /*
    |--------------------------------------------------------------------------
    | SALVAR LIVRO
    |--------------------------------------------------------------------------
    */

            public function guardar()
    {
        Autorizacao::precisaPapel(['admin', 'backoffice']);

        /*
        |--------------------------------------------------------------------------
        | CAPA
        |--------------------------------------------------------------------------
        */
        $capaPath = null;

        if (!empty($_FILES['capa']['name'])) {

            $pasta = "uploads/capas/";

            if (!is_dir($pasta)) {
                mkdir($pasta, 0777, true);
            }

            $nome = time() . "_" . basename($_FILES['capa']['name']);

            $caminho = $pasta . $nome;

            move_uploaded_file($_FILES['capa']['tmp_name'], $caminho);

            $capaPath = $caminho;
        }

        /*
        |--------------------------------------------------------------------------
        | PDF
        |--------------------------------------------------------------------------
        */
        $pdfPath = null;

        if (!empty($_FILES['pdf']['name'])) {

            $pasta = "uploads/pdfs/";

            if (!is_dir($pasta)) {
                mkdir($pasta, 0777, true);
            }

            $nomePdf = time() . "_" . basename($_FILES['pdf']['name']);

            $caminhoPdf = $pasta . $nomePdf;

            move_uploaded_file($_FILES['pdf']['tmp_name'], $caminhoPdf);

            $pdfPath = $caminhoPdf;
        }

        if (
            empty($_POST['titulo']) ||
            empty($_POST['autor_id']) ||
            empty($_POST['editora_id'])
        ) {
            $_SESSION['erro'] = "Preencha os campos obrigatórios.";

            header("Location: index.php?url=livros/criar");
            exit;
        }

        /*
        |--------------------------------------------------------------------------
        | DADOS (EXATAMENTE IGUAL À BD)
        |--------------------------------------------------------------------------
        */

        $dados = [

            'utilizador_id' => $_SESSION['user_id'],
            'autor_id' => $_POST['autor_id'],
            'editora_id' => $_POST['editora_id'],

            'titulo' => $_POST['titulo'],
            'sinopse' => $_POST['sinopse'] ?? null,
            'isbn' => $_POST['isbn'] ?? null,
            'idioma' => $_POST['idioma'] ?? null,
            'ano_publicacao' => $_POST['ano_publicacao'] ?? null,
            'numero_paginas' => $_POST['numero_paginas'] ?? null,
            'preco' => $_POST['preco'] ?? 0,

            'compravel' => $_POST['compravel'] ?? 1,
            'legivel_no_site' => $_POST['legivel_no_site'] ?? 1,

            'url_imagem_capa' => $capaPath,
            'caminho_pdf' => $pdfPath,

            'estado' => 'rascunho'
        ];

        $this->livroModel->criar($dados);

        header("Location: index.php?url=livros");
        exit;
    }


    /* EDITAR*/
        public function editar()
    {
        Autorizacao::precisaPapel(['admin', 'backoffice']);

        $id = $_GET['id'] ?? null;

        if (!$id) {

            header("Location: index.php?url=livros");
            exit;
        }

        $livro = $this->livroModel->buscarPorId($id);

        require_once __DIR__ . '/../views/livros/editar.php';
    }

        /* ACTUALIZAR*/
        public function atualizar()
    {
        Autorizacao::precisaPapel(['admin', 'backoffice']);

        $id = $_POST['id'] ?? null;

        if (!$id) {

            header("Location: index.php?url=livros");
            exit;
        }

        $dados = [

            'titulo' => $_POST['titulo'] ?? '',
            'isbn' => $_POST['isbn'] ?? null,
            'idioma' => $_POST['idioma'] ?? null,
            'ano_publicacao' => $_POST['ano_publicacao'] ?? null,
            'numero_paginas' => $_POST['numero_paginas'] ?? null,
            'preco' => $_POST['preco'] ?? 0
        ];

        $this->livroModel->atualizar($id, $dados);

        header("Location: index.php?url=livros");
        exit;
    }

        /* ELIMINAR*/
        public function eliminar()
    {
        Autorizacao::precisaPapel(['admin', 'backoffice']);

        $id = $_GET['id'] ?? null;

        $this->livroModel->eliminar($id);

        header("Location: index.php?url=livros");
        exit;
    }
}