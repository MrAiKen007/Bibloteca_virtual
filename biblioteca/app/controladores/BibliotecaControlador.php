<?php

class BibliotecaControlador
{
    private $livroModel;
    private $bibliotecaModel;

    public function __construct()
    {
        $this->livroModel = new Livro();
        require_once __DIR__ . '/../modelos/BibliotecaModel.php';
        $this->bibliotecaModel = new BibliotecaModel();
    }

    public function index()
    {
        Autorizacao::precisaPapel(['cliente', 'admin', 'backoffice']);
        $livros = $this->livroModel->listar();
        require_once __DIR__ . '/../views/biblioteca/index.php';
    }

    public function apiCheckout()
    {
        $rawInput = file_get_contents('php://input');
        $input = json_decode($rawInput, true);

        if (!$input) {
            $input = $_POST;
        }

        $items = $input['items'] ?? [];
        $userId = $_SESSION['user_id'] ?? ($input['user_id'] ?? null);

        if (empty($items)) {
            Resposta::erro("Carrinho vazio.");
        }

        if (!$userId) {
            Resposta::erro("Faça login para finalizar a compra.");
        }

        $total = 0;
        $comprados = [];

        foreach ($items as $item) {
            $livroId = $item['livro_id'] ?? null;
            if (!$livroId) continue;

            $livro = $this->livroModel->buscarPorId($livroId);
            if (!$livro) continue;

            $jaComprou = $this->bibliotecaModel->jaComprou($userId, $livroId);
            if ($jaComprou) continue;

            $this->bibliotecaModel->comprarLivro($userId, $livroId, $livro['preco']);
            $total += (float)$livro['preco'];
            $comprados[] = $livro['titulo'];
        }

        if (empty($comprados)) {
            Resposta::erro("Todos os livros já foram comprados.");
        }

        Resposta::json([
            'mensagem' => count($comprados) . " livro(s) comprado(s) com sucesso!",
            'total' => $total,
            'livros' => $comprados
        ]);
    }

    public function apiMinhaBiblioteca()
    {
        Autorizacao::precisaPapel(['cliente', 'admin', 'backoffice']);

        $utilizadorId = $_SESSION['user_id'];
        $livros = $this->bibliotecaModel->getMeusLivros($utilizadorId);
        $baseUrl = $this->getBaseUrl();

        foreach ($livros as &$livro) {
            $livro['cover'] = (isset($livro['url_imagem_capa']) && $livro['url_imagem_capa'])
                ? $baseUrl . $livro['url_imagem_capa']
                : 'https://picsum.photos/seed/book' . ($livro['id'] ?? 0) . '/400/600';
            $livro['price'] = (float)($livro['preco'] ?? 0);
            $livro['pdf_url'] = (isset($livro['caminho_pdf']) && $livro['caminho_pdf'])
                ? $baseUrl . 'api/livro/pdf?id=' . $livro['id']
                : null;
            $livro['legivel_no_site'] = (int)($livro['legivel_no_site'] ?? 0);

            $db = BaseDados::getInstancia()->getConexao();
            $stmt = $db->prepare("SELECT AVG(nota) as media, COUNT(*) as total FROM avaliacoes_livros WHERE livro_id = :id");
            $stmt->execute([':id' => $livro['id']]);
            $rating = $stmt->fetch(PDO::FETCH_ASSOC);
            $livro['rating_media'] = $rating['media'] ? round((float)$rating['media'], 1) : 0;
            $livro['rating_total'] = (int)$rating['total'];
        }

        Resposta::json($livros);
    }

    public function apiComprar()
    {
        Autorizacao::precisaPapel(['cliente']);

        $input = json_decode(file_get_contents('php://input'), true);
        $livroId = $input['livro_id'] ?? null;

        if (!$livroId) Resposta::erro("ID do livro não fornecido.");

        $livro = $this->livroModel->buscarPorId($livroId);
        if (!$livro) Resposta::erro("Livro não encontrado.");

        $jaComprou = $this->bibliotecaModel->jaComprou($_SESSION['user_id'], $livroId);
        if ($jaComprou) Resposta::erro("Já comprou este livro.");

        try {
            $this->bibliotecaModel->comprarLivro($_SESSION['user_id'], $livroId, $livro['preco']);
            Resposta::json(['mensagem' => "Livro comprado com sucesso!"]);
        } catch (Exception $e) {
            Resposta::erro("Erro ao comprar livro: " . $e->getMessage());
        }
    }

    public function apiRegistarLeitura()
    {
        Autorizacao::precisaPapel(['cliente']);

        $input = json_decode(file_get_contents('php://input'), true);
        $livroId = $input['livro_id'] ?? null;

        if (!$livroId) Resposta::erro("ID do livro não fornecido.");

        $livro = $this->livroModel->buscarPorId($livroId);
        if (!$livro) Resposta::erro("Livro não encontrado.");

        if (!$livro['legivel_no_site']) Resposta::erro("Este livro não está disponível para leitura online.");

        $jaAcessou = $this->bibliotecaModel->jaAcessou($_SESSION['user_id'], $livroId);
        if ($jaAcessou) {
            Resposta::json(['mensagem' => "Leitura já registada."]);
            return;
        }

        try {
            $this->bibliotecaModel->registarLeitura($_SESSION['user_id'], $livroId);
            Resposta::json(['mensagem' => "Leitura registada com sucesso!"]);
        } catch (Exception $e) {
            Resposta::erro("Erro ao registar leitura: " . $e->getMessage());
        }
    }

    public function apiVerificarPosse()
    {
        Autorizacao::precisaPapel(['cliente']);

        $livroId = $_GET['id'] ?? null;
        if (!$livroId) Resposta::erro("ID do livro não fornecido.");

        $comprou = $this->bibliotecaModel->jaComprou($_SESSION['user_id'], $livroId);
        $acedeu = $this->bibliotecaModel->jaAcessou($_SESSION['user_id'], $livroId);

        Resposta::json([
            'comprado' => (bool)$comprou,
            'acedeu' => (bool)$acedeu,
            'pode_ler' => (bool)$comprou || (bool)$acedeu
        ]);
    }

    private function getBaseUrl()
    {
        $configuredUrl = $_ENV['APP_URL'] ?? null;
        if ($configuredUrl) {
            return rtrim($configuredUrl, '/') . '/';
        }
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'];
        $scriptDir = dirname($_SERVER['SCRIPT_NAME']);
        return $protocol . '://' . $host . $scriptDir . '/';
    }
}
