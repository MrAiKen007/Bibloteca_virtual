<?php
// Ativar reporte de erros para desenvolvimento
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Permitir que o frontend (Live Server ou outro) aceda à API
$origin = $_SERVER['HTTP_ORIGIN'] ?? '*';
header("Access-Control-Allow-Origin: $origin");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Access-Control-Allow-Credentials: true");

// Lidar com pedidos OPTIONS (pre-flight)
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit;
}

/*
|--------------------------------------------------------------------------
| GLOBAL API ERROR HANDLER
|--------------------------------------------------------------------------
*/
$url = $_GET['url'] ?? 'login';
$isApi = strpos($url, 'api/') === 0;

if ($isApi) {
    ini_set('display_errors', 0);
    set_error_handler(function($severity, $message, $file, $line) {
        if (!(error_reporting() & $severity)) return;
        Resposta::erro("Erro Interno: $message em $file:$line", 500);
    });

    set_exception_handler(function($e) {
        Resposta::erro("Excepção: " . $e->getMessage(), 500);
    });
}

session_start();

/*
|--------------------------------------------------------------------------
| CORE
|--------------------------------------------------------------------------
*/
require_once __DIR__ . "/../app/core/Router.php";
require_once __DIR__ . "/../app/core/resposta.php";
require_once __DIR__ . "/../app/core/BaseDados.php";

/*
|--------------------------------------------------------------------------
| MODELOS
|--------------------------------------------------------------------------
*/
require_once __DIR__ . "/../app/modelos/Utilizador.php";
require_once __DIR__ . "/../app/modelos/Livro.php";
require_once __DIR__ . "/../app/modelos/Autor.php";
require_once __DIR__ . "/../app/modelos/Editora.php";
require_once __DIR__ . "/../app/modelos/Pedido.php";

/*
|--------------------------------------------------------------------------
| CONTROLADORES
|--------------------------------------------------------------------------
*/
require_once __DIR__ . "/../app/controladores/AutenticacaoControlador.php";
require_once __DIR__ . "/../app/controladores/UtilizadorControlador.php";
require_once __DIR__ . "/../app/controladores/LivroControlador.php";
require_once __DIR__ . "/../app/controladores/BibliotecaControlador.php";
require_once __DIR__ . "/../app/controladores/AutorControlador.php";
require_once __DIR__ . "/../app/controladores/EditoraControlador.php";
require_once __DIR__ . "/../app/controladores/RegistoControlador.php";
require_once __DIR__ . "/../app/controladores/AuditoriaControlador.php";

/*
|--------------------------------------------------------------------------
| MIDDLEWARES
|--------------------------------------------------------------------------
*/
require_once __DIR__ . "/../app/middlewares/Autorizacao.php";

/*
|--------------------------------------------------------------------------
| ROUTER
|--------------------------------------------------------------------------
*/
$router = new Router();

/*
|--------------------------------------------------------------------------
| ROTAS
|--------------------------------------------------------------------------
*/
require_once __DIR__ . "/../rotas/web.php";

/*
|--------------------------------------------------------------------------
| URL E MÉTODO
|--------------------------------------------------------------------------
*/
$url = $_GET['url'] ?? 'login';
$metodo = $_SERVER['REQUEST_METHOD'];

/*
|--------------------------------------------------------------------------
| ROTAS PÚBLICAS
|--------------------------------------------------------------------------
*/
$rotasPublicas = [
    'login'
];

/*
|--------------------------------------------------------------------------
| PROTEÇÃO (CORRIGIDA)
|--------------------------------------------------------------------------
*/
$urlBase = explode('/', $url)[0];

if (!isset($_SESSION['user_id']) && !in_array($url, $rotasPublicas) && $urlBase !== 'api') {

    header("Location: index.php?url=login");
    exit;
}

/*
|--------------------------------------------------------------------------
| EXECUTAR
|--------------------------------------------------------------------------
*/
$router->executar($url, $metodo);