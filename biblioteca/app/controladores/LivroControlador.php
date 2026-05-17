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
                mkdir($pasta, 0755, true);
            }

            $maxSize = 5 * 1024 * 1024;
            if ($_FILES['capa']['size'] > $maxSize) {
                $_SESSION['erro'] = "A imagem deve ter no máximo 5MB.";
                header("Location: index.php?url=livros/criar");
                exit;
            }

            $mime = mime_content_type($_FILES['capa']['tmp_name']);
            $mimePermitidos = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
            if (!in_array($mime, $mimePermitidos)) {
                $_SESSION['erro'] = "Formato de imagem não permitido. Use JPG, PNG, WebP ou GIF.";
                header("Location: index.php?url=livros/criar");
                exit;
            }

            $extensao = strtolower(pathinfo($_FILES['capa']['name'], PATHINFO_EXTENSION));
            $nome = time() . "_" . bin2hex(random_bytes(8)) . "." . $extensao;

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
                mkdir($pasta, 0755, true);
            }

            $maxSize = 50 * 1024 * 1024;
            if ($_FILES['pdf']['size'] > $maxSize) {
                $_SESSION['erro'] = "O PDF deve ter no máximo 50MB.";
                header("Location: index.php?url=livros/criar");
                exit;
            }

            $mime = mime_content_type($_FILES['pdf']['tmp_name']);
            if ($mime !== 'application/pdf') {
                $_SESSION['erro'] = "O ficheiro deve ser um PDF válido.";
                header("Location: index.php?url=livros/criar");
                exit;
            }

            $nomePdf = time() . "_" . bin2hex(random_bytes(8)) . ".pdf";

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

        $livroExistente = $this->livroModel->buscarPorId($id);
        if (!$livroExistente) {
            $_SESSION['erro'] = "Livro não encontrado.";
            header("Location: index.php?url=livros");
            exit;
        }

        $capaPath = $livroExistente['url_imagem_capa'];
        if (!empty($_FILES['capa']['name'])) {
            $pasta = "uploads/capas/";
            if (!is_dir($pasta)) {
                mkdir($pasta, 0755, true);
            }
            $extensao = strtolower(pathinfo($_FILES['capa']['name'], PATHINFO_EXTENSION));
            $mime = mime_content_type($_FILES['capa']['tmp_name']);
            $mimePermitidos = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
            if (!in_array($mime, $mimePermitidos)) {
                $_SESSION['erro'] = "Formato de imagem não permitido.";
                header("Location: index.php?url=livros/editar&id=$id");
                exit;
            }
            $nome = time() . "_" . basename($_FILES['capa']['name']);
            $caminho = $pasta . $nome;
            move_uploaded_file($_FILES['capa']['tmp_name'], $caminho);
            $capaPath = $caminho;
        }

        $dados = [
            'titulo' => $_POST['titulo'] ?? $livroExistente['titulo'],
            'sinopse' => $_POST['sinopse'] ?? $livroExistente['sinopse'],
            'isbn' => $_POST['isbn'] ?? $livroExistente['isbn'],
            'idioma' => $_POST['idioma'] ?? $livroExistente['idioma'],
            'ano_publicacao' => $_POST['ano_publicacao'] ?? $livroExistente['ano_publicacao'],
            'numero_paginas' => $_POST['numero_paginas'] ?? $livroExistente['numero_paginas'],
            'preco' => $_POST['preco'] ?? $livroExistente['preco'],
            'autor_id' => $_POST['autor_id'] ?? $livroExistente['autor_id'],
            'editora_id' => $_POST['editora_id'] ?? $livroExistente['editora_id'],
            'estado' => $_POST['estado'] ?? $livroExistente['estado'],
            'compravel' => $_POST['compravel'] ?? $livroExistente['compravel'],
            'legivel_no_site' => $_POST['legivel_no_site'] ?? $livroExistente['legivel_no_site'],
            'url_imagem_capa' => $capaPath
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

    /*
    |--------------------------------------------------------------------------
    | API METHODS
    |--------------------------------------------------------------------------
    */

    public function apiListar()
    {
        $livros = $this->livroModel->listar();
        $baseUrl = $this->getBaseUrl();
        $db = BaseDados::getInstancia()->getConexao();

        foreach ($livros as &$livro) {
            $livro['cover'] = (isset($livro['url_imagem_capa']) && $livro['url_imagem_capa'])
                ? $baseUrl . $livro['url_imagem_capa']
                : 'https://picsum.photos/seed/book' . ($livro['id'] ?? 0) . '/400/600';
            $livro['price'] = (float)($livro['preco'] ?? 0);
            $livro['pdf_url'] = (isset($livro['caminho_pdf']) && $livro['caminho_pdf'])
                ? $baseUrl . 'api/livro/pdf?id=' . $livro['id']
                : null;
            $livro['legivel_no_site'] = (int)($livro['legivel_no_site'] ?? 0);
            $livro['autor_id'] = (int)($livro['autor_id'] ?? 0);
            $livro['editora_id'] = (int)($livro['editora_id'] ?? 0);

            $stmt = $db->prepare("SELECT t.nome FROM livros_tags lt JOIN tags t ON lt.tag_id = t.id WHERE lt.livro_id = :id");
            $stmt->execute([':id' => $livro['id']]);
            $livro['tags'] = $stmt->fetchAll(PDO::FETCH_COLUMN);

            $stmt = $db->prepare("SELECT g.nome FROM livros_generos lg JOIN generos g ON lg.genero_id = g.id WHERE lg.livro_id = :id");
            $stmt->execute([':id' => $livro['id']]);
            $livro['generos'] = $stmt->fetchAll(PDO::FETCH_COLUMN);

            $stmt = $db->prepare("SELECT AVG(nota) as media, COUNT(*) as total FROM avaliacoes_livros WHERE livro_id = :id");
            $stmt->execute([':id' => $livro['id']]);
            $rating = $stmt->fetch(PDO::FETCH_ASSOC);
            $livro['rating_media'] = $rating['media'] ? round((float)$rating['media'], 1) : 0;
            $livro['rating_total'] = (int)$rating['total'];
        }

        Resposta::json($livros);
    }

    public function apiGuardar()
    {
        Autorizacao::precisaPapel(['admin', 'backoffice']);

        $isMultipart = isset($_SERVER['CONTENT_TYPE']) && strpos($_SERVER['CONTENT_TYPE'], 'multipart/form-data') !== false;

        if ($isMultipart) {
            $titulo = $_POST['titulo'] ?? '';
            $autorId = $_POST['autor_id'] ?? '';
            $editoraId = $_POST['editora_id'] ?? '';

            if (empty($titulo) || empty($autorId) || empty($editoraId)) {
                Resposta::erro("Preencha todos os campos obrigatórios.");
            }

            $capaPath = null;
            if (!empty($_FILES['capa']['name'])) {
                $pasta = __DIR__ . '/../../public/uploads/capas/';
                if (!is_dir($pasta)) { mkdir($pasta, 0755, true); }

                $maxSize = 5 * 1024 * 1024;
                if ($_FILES['capa']['size'] > $maxSize) {
                    Resposta::erro("A imagem deve ter no máximo 5MB.");
                }

                $mime = mime_content_type($_FILES['capa']['tmp_name']);
                $mimePermitidos = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
                if (!in_array($mime, $mimePermitidos)) {
                    Resposta::erro("Formato de imagem não permitido. Use JPG, PNG, WebP ou GIF.");
                }

                $extensao = strtolower(pathinfo($_FILES['capa']['name'], PATHINFO_EXTENSION));
                $nome = time() . "_" . bin2hex(random_bytes(8)) . "." . $extensao;
                $caminho = $pasta . $nome;
                move_uploaded_file($_FILES['capa']['tmp_name'], $caminho);
                $capaPath = 'uploads/capas/' . $nome;
            }

            $pdfPath = null;
            if (!empty($_FILES['pdf']['name'])) {
                $pastaPdf = __DIR__ . '/../../public/uploads/pdfs/';
                if (!is_dir($pastaPdf)) { mkdir($pastaPdf, 0755, true); }

                $maxSize = 50 * 1024 * 1024;
                if ($_FILES['pdf']['size'] > $maxSize) {
                    Resposta::erro("O PDF deve ter no máximo 50MB.");
                }

                $mime = mime_content_type($_FILES['pdf']['tmp_name']);
                if ($mime !== 'application/pdf') {
                    Resposta::erro("O ficheiro deve ser um PDF válido.");
                }

                $nomePdf = time() . "_" . bin2hex(random_bytes(8)) . ".pdf";
                $caminhoPdf = $pastaPdf . $nomePdf;
                move_uploaded_file($_FILES['pdf']['tmp_name'], $caminhoPdf);
                $pdfPath = 'uploads/pdfs/' . $nomePdf;
            }

            $tagsRaw = $_POST['tags'] ?? '[]';
            $tags = json_decode($tagsRaw, true) ?: [];
            $generosRaw = $_POST['generos'] ?? '[]';
            $generos = json_decode($generosRaw, true) ?: [];

            $dados = [
                'utilizador_id' => $_SESSION['user_id'],
                'autor_id' => $autorId,
                'editora_id' => $editoraId,
                'titulo' => $titulo,
                'sinopse' => $_POST['sinopse'] ?? null,
                'isbn' => $_POST['isbn'] ?? null,
                'idioma' => $_POST['idioma'] ?? null,
                'ano_publicacao' => $_POST['ano_publicacao'] ?? null,
                'numero_paginas' => $_POST['numero_paginas'] ?? null,
                'preco' => $_POST['preco'] ?? 0,
                'compravel' => $_POST['compravel'] ?? 1,
                'legivel_no_site' => $_POST['legivel_no_site'] ?? 1,
                'estado' => $_POST['estado'] ?? 'rascunho',
                'url_imagem_capa' => $capaPath,
                'caminho_pdf' => $pdfPath
            ];

            try {
                $livroId = $this->livroModel->criar($dados);
                if ($livroId && !empty($tags)) {
                    $this->saveTags($livroId, $tags);
                }
                if ($livroId && !empty($generos)) {
                    $this->saveGeneros($livroId, $generos);
                }

                $db = BaseDados::getInstancia()->getConexao();
                $stmt = $db->prepare("INSERT INTO auditorias (utilizador_id, acao, tabela_afetada, registo_afetado_id) VALUES (:user, 'criar', 'livros', :registo)");
                $stmt->execute([':user' => $_SESSION['user_id'], ':registo' => $livroId]);

                Resposta::json(['mensagem' => "Livro criado com sucesso!"]);
            } catch (Exception $e) {
                Resposta::erro("Erro ao criar livro: " . $e->getMessage());
            }
        } else {
            $input = json_decode(file_get_contents('php://input'), true);

            if (empty($input['titulo']) || empty($input['autor_id']) || empty($input['editora_id'])) {
                Resposta::erro("Preencha todos os campos obrigatórios.");
            }

            $dados = [
                'utilizador_id' => $_SESSION['user_id'],
                'autor_id' => $input['autor_id'],
                'editora_id' => $input['editora_id'],
                'titulo' => $input['titulo'],
                'sinopse' => $input['sinopse'] ?? null,
                'isbn' => $input['isbn'] ?? null,
                'idioma' => $input['idioma'] ?? null,
                'ano_publicacao' => $input['ano_publicacao'] ?? null,
                'numero_paginas' => $input['numero_paginas'] ?? null,
                'preco' => $input['preco'] ?? 0,
                'compravel' => $input['compravel'] ?? 1,
                'legivel_no_site' => $input['legivel_no_site'] ?? 1,
                'estado' => $input['estado'] ?? 'rascunho'
            ];

            try {
                $this->livroModel->criar($dados);
                Resposta::json(['mensagem' => "Livro criado com sucesso!"]);
            } catch (Exception $e) {
                Resposta::erro("Erro ao criar livro.");
            }
        }
    }

    public function apiEliminar()
    {
        Autorizacao::precisaPapel(['admin', 'backoffice']);
        $id = $_GET['id'] ?? null;
        if (!$id) Resposta::erro("ID não fornecido.");

        try {
            $this->livroModel->eliminar($id);
            Resposta::json(['mensagem' => "Livro eliminado com sucesso!"]);
        } catch (Exception $e) {
            Resposta::erro("Erro ao eliminar livro.");
        }
    }

    public function apiAtualizar()
    {
        Autorizacao::precisaPapel(['admin', 'backoffice']);

        $id = $_POST['id'] ?? null;
        if (!$id) Resposta::erro("ID não fornecido.");

        $livroExistente = $this->livroModel->buscarPorId($id);
        if (!$livroExistente) Resposta::erro("Livro não encontrado.");

        $isMultipart = isset($_SERVER['CONTENT_TYPE']) && strpos($_SERVER['CONTENT_TYPE'], 'multipart/form-data') !== false;

        $capaPath = $livroExistente['url_imagem_capa'];
        $pdfPath = $livroExistente['caminho_pdf'] ?? null;

        if ($isMultipart) {
            if (!empty($_FILES['capa']['name'])) {
                $pasta = __DIR__ . '/../../public/uploads/capas/';
                if (!is_dir($pasta)) { mkdir($pasta, 0755, true); }
                $maxSize = 5 * 1024 * 1024;
                if ($_FILES['capa']['size'] > $maxSize) {
                    Resposta::erro("A imagem deve ter no máximo 5MB.");
                }
                $mime = mime_content_type($_FILES['capa']['tmp_name']);
                $mimePermitidos = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
                if (!in_array($mime, $mimePermitidos)) {
                    Resposta::erro("Formato de imagem não permitido.");
                }
                $extensao = strtolower(pathinfo($_FILES['capa']['name'], PATHINFO_EXTENSION));
                $nome = time() . "_" . bin2hex(random_bytes(8)) . "." . $extensao;
                $caminho = $pasta . $nome;
                move_uploaded_file($_FILES['capa']['tmp_name'], $caminho);
                $capaPath = 'uploads/capas/' . $nome;
            }

            if (!empty($_FILES['pdf']['name'])) {
                $pastaPdf = __DIR__ . '/../../public/uploads/pdfs/';
                if (!is_dir($pastaPdf)) { mkdir($pastaPdf, 0755, true); }
                $maxSize = 50 * 1024 * 1024;
                if ($_FILES['pdf']['size'] > $maxSize) {
                    Resposta::erro("O PDF deve ter no máximo 50MB.");
                }
                $mime = mime_content_type($_FILES['pdf']['tmp_name']);
                if ($mime !== 'application/pdf') {
                    Resposta::erro("O ficheiro deve ser um PDF válido.");
                }
                $nomePdf = time() . "_" . bin2hex(random_bytes(8)) . ".pdf";
                $caminhoPdf = $pastaPdf . $nomePdf;
                move_uploaded_file($_FILES['pdf']['tmp_name'], $caminhoPdf);
                $pdfPath = 'uploads/pdfs/' . $nomePdf;
            }
        }

        $dados = [
            'titulo' => $_POST['titulo'] ?? $livroExistente['titulo'],
            'sinopse' => $_POST['sinopse'] ?? $livroExistente['sinopse'],
            'isbn' => $_POST['isbn'] ?? $livroExistente['isbn'],
            'idioma' => $_POST['idioma'] ?? $livroExistente['idioma'],
            'ano_publicacao' => $_POST['ano_publicacao'] ?? $livroExistente['ano_publicacao'],
            'numero_paginas' => $_POST['numero_paginas'] ?? $livroExistente['numero_paginas'],
            'preco' => $_POST['preco'] ?? $livroExistente['preco'],
            'autor_id' => $_POST['autor_id'] ?? $livroExistente['autor_id'],
            'editora_id' => $_POST['editora_id'] ?? $livroExistente['editora_id'],
            'estado' => $_POST['estado'] ?? $livroExistente['estado'],
            'compravel' => $_POST['compravel'] ?? $livroExistente['compravel'],
            'legivel_no_site' => $_POST['legivel_no_site'] ?? $livroExistente['legivel_no_site'],
            'url_imagem_capa' => $capaPath,
            'caminho_pdf' => $pdfPath
        ];

        try {
            $this->livroModel->atualizar($id, $dados);
            Resposta::json(['mensagem' => "Livro atualizado com sucesso!"]);
        } catch (Exception $e) {
            Resposta::erro("Erro ao atualizar livro: " . $e->getMessage());
        }
    }

    public function apiDetalhes()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) Resposta::erro("ID não fornecido");

        $livro = $this->livroModel->buscarPorId($id);
        if (!$livro) Resposta::erro("Livro não encontrado", 404);

        $baseUrl = $this->getBaseUrl();
        $livro['cover'] = (isset($livro['url_imagem_capa']) && $livro['url_imagem_capa'])
            ? $baseUrl . $livro['url_imagem_capa']
            : 'https://picsum.photos/seed/book' . ($livro['id'] ?? 0) . '/400/600';
        $livro['price'] = (float)($livro['preco'] ?? 0);
        $livro['pdf_url'] = (isset($livro['caminho_pdf']) && $livro['caminho_pdf'])
            ? $baseUrl . 'api/livro/pdf?id=' . $livro['id']
            : null;

        $db = BaseDados::getInstancia()->getConexao();
        $stmt = $db->prepare("SELECT AVG(nota) as media, COUNT(*) as total FROM avaliacoes_livros WHERE livro_id = :id");
        $stmt->execute([':id' => $id]);
        $rating = $stmt->fetch(PDO::FETCH_ASSOC);
        $livro['rating_media'] = $rating['media'] ? round((float)$rating['media'], 1) : 0;
        $livro['rating_total'] = (int)$rating['total'];

        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
        } elseif (isset($_GET['user_id'])) {
            $userId = (int)$_GET['user_id'];
        } else {
            $userId = null;
        }

        if ($userId) {
            $stmt = $db->prepare("SELECT nota FROM avaliacoes_livros WHERE livro_id = :id AND utilizador_id = :user LIMIT 1");
            $stmt->execute([':id' => $id, ':user' => $userId]);
            $userRating = $stmt->fetch(PDO::FETCH_ASSOC);
            $livro['user_rating'] = $userRating ? (int)$userRating['nota'] : 0;
        } else {
            $livro['user_rating'] = 0;
        }

        $stmt = $db->prepare("SELECT t.nome FROM livros_tags lt JOIN tags t ON lt.tag_id = t.id WHERE lt.livro_id = :id");
        $stmt->execute([':id' => $id]);
        $livro['tags'] = $stmt->fetchAll(PDO::FETCH_COLUMN);

        $stmt = $db->prepare("SELECT g.nome FROM livros_generos lg JOIN generos g ON lg.genero_id = g.id WHERE lg.livro_id = :id");
        $stmt->execute([':id' => $id]);
        $livro['generos'] = $stmt->fetchAll(PDO::FETCH_COLUMN);

        Resposta::json($livro);
    }

    public function apiAvaliar()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $livroId = $input['livro_id'] ?? null;
        $nota = $input['nota'] ?? null;
        $userId = $_SESSION['user_id'] ?? $input['user_id'] ?? null;

        if (!$userId) {
            Resposta::erro("Precisa estar autenticado. Faça login primeiro.", 401);
        }

        if (!$livroId || !$nota || $nota < 1 || $nota > 5) {
            Resposta::erro("Dados inválidos. Nota deve ser entre 1 e 5.");
        }

        $db = BaseDados::getInstancia()->getConexao();
        $stmt = $db->prepare("SELECT id FROM livros WHERE id = :id AND removido = 0 LIMIT 1");
        $stmt->execute([':id' => $livroId]);
        if (!$stmt->fetch()) {
            Resposta::erro("Livro não encontrado");
        }

        $stmt = $db->prepare("INSERT INTO avaliacoes_livros (livro_id, utilizador_id, nota) VALUES (:livro, :user, :nota) ON DUPLICATE KEY UPDATE nota = :nota2, atualizado_em = NOW()");
        $stmt->execute([':livro' => $livroId, ':user' => $userId, ':nota' => $nota, ':nota2' => $nota]);

        $stmt = $db->prepare("SELECT AVG(nota) as media, COUNT(*) as total FROM avaliacoes_livros WHERE livro_id = :id");
        $stmt->execute([':id' => $livroId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        Resposta::json([
            'sucesso' => true,
            'media' => $result['media'] ? round((float)$result['media'], 1) : 0,
            'total' => (int)$result['total'],
            'user_nota' => (int)$nota
        ]);
    }

    public function apiPdf()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) Resposta::erro("ID não fornecido", 400);

        $livro = $this->livroModel->buscarPorId($id);
        if (!$livro) Resposta::erro("Livro não encontrado", 404);

        if (empty($livro['caminho_pdf'])) {
            Resposta::erro("PDF não disponível para este livro", 404);
        }

        $pdfFile = __DIR__ . '/../../public/' . $livro['caminho_pdf'];
        if (!file_exists($pdfFile)) {
            Resposta::erro("Ficheiro PDF não encontrado", 404);
        }

        header('Content-Type: application/pdf');
        header('Content-Length: ' . filesize($pdfFile));
        header('Content-Disposition: inline; filename="' . basename($pdfFile) . '"');
        readfile($pdfFile);
        exit;
    }

    private function getBaseUrl()
    {
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'];
        $scriptDir = dirname($_SERVER['SCRIPT_NAME']);
        return $protocol . '://' . $host . $scriptDir . '/';
    }

    private function saveTags($livroId, $tags)
    {
        $db = BaseDados::getInstancia()->getConexao();

        foreach ($tags as $tag) {
            $tag = trim($tag);
            if (empty($tag)) continue;

            $stmt = $db->prepare("SELECT id FROM tags WHERE nome = :nome LIMIT 1");
            $stmt->execute([':nome' => $tag]);
            $tagRow = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($tagRow) {
                $tagId = $tagRow['id'];
            } else {
                $stmt = $db->prepare("INSERT INTO tags (nome) VALUES (:nome)");
                $stmt->execute([':nome' => $tag]);
                $tagId = $db->lastInsertId();
            }

            $stmt = $db->prepare("INSERT IGNORE INTO livros_tags (livro_id, tag_id) VALUES (:livro_id, :tag_id)");
            $stmt->execute([':livro_id' => $livroId, ':tag_id' => $tagId]);
        }
    }

    private function saveGeneros($livroId, $generos)
    {
        $db = BaseDados::getInstancia()->getConexao();

        foreach ($generos as $genero) {
            $genero = trim($genero);
            if (empty($genero)) continue;

            $stmt = $db->prepare("SELECT id FROM generos WHERE nome = :nome LIMIT 1");
            $stmt->execute([':nome' => $genero]);
            $generoRow = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($generoRow) {
                $generoId = $generoRow['id'];
            } else {
                $stmt = $db->prepare("INSERT INTO generos (nome) VALUES (:nome)");
                $stmt->execute([':nome' => $genero]);
                $generoId = $db->lastInsertId();
            }

            $stmt = $db->prepare("INSERT IGNORE INTO livros_generos (livro_id, genero_id) VALUES (:livro_id, :genero_id)");
            $stmt->execute([':livro_id' => $livroId, ':genero_id' => $generoId]);
        }
    }
}