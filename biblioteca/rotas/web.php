<?php

/*
|--------------------------------------------------------------------------
| AUTENTICAÇÃO
|--------------------------------------------------------------------------
*/
$router->get('login', ['AutenticacaoControlador', 'login']);

$router->post('login', ['AutenticacaoControlador', 'autenticar']);

$router->get('logout', ['AutenticacaoControlador', 'logout']);

/*
|--------------------------------------------------------------------------
| REGISTO
|--------------------------------------------------------------------------
*/
$router->get('registo', ['RegistoControlador', 'criar']);

$router->post('registo', ['RegistoControlador', 'guardar']);

/*
|--------------------------------------------------------------------------
| UTILIZADORES
|--------------------------------------------------------------------------
*/
$router->get('utilizadores', ['UtilizadorControlador', 'listar']);

$router->get('utilizadores/criar', ['UtilizadorControlador', 'criar']);

$router->post('utilizadores/guardar', ['UtilizadorControlador', 'guardar']);

$router->get('utilizadores/editar', ['UtilizadorControlador', 'editar']);

$router->post('utilizadores/atualizar', ['UtilizadorControlador', 'atualizar']);

$router->get('utilizadores/eliminar', ['UtilizadorControlador', 'eliminar']);

/*
|--------------------------------------------------------------------------
| LIVROS
|--------------------------------------------------------------------------
*/
$router->get('livros', ['LivroControlador', 'listar']);

$router->get('livros/criar', ['LivroControlador', 'criar']);

$router->post('livros/guardar', ['LivroControlador', 'guardar']);

$router->get('livros/editar', ['LivroControlador', 'editar']);

$router->post('livros/atualizar', ['LivroControlador', 'atualizar']);

$router->get('livros/eliminar', ['LivroControlador', 'eliminar']);

/*Autor*/
$router->get('autores', ['AutorControlador', 'listar']);

$router->get('autores/criar', ['AutorControlador', 'criar']);

$router->post('autores/guardar', ['AutorControlador', 'guardar']);

/*Editoras*/
$router->get('editoras', ['EditoraControlador', 'listar']);

$router->get('editoras/criar', ['EditoraControlador', 'criar']);

$router->post('editoras/guardar', ['EditoraControlador', 'guardar']);

/*
|--------------------------------------------------------------------------
| BIBLIOTECA (CLIENTE)
|--------------------------------------------------------------------------
*/
$router->get('biblioteca', ['BibliotecaControlador', 'index']);

/*
|--------------------------------------------------------------------------
| API
|--------------------------------------------------------------------------
*/
$router->get('api/livros', ['LivroControlador', 'apiListar']);
$router->get('api/livro', ['LivroControlador', 'apiDetalhes']);
$router->get('api/livro/pdf', ['LivroControlador', 'apiPdf']);
$router->post('api/livros/guardar', ['LivroControlador', 'apiGuardar']);
$router->post('api/livros/atualizar', ['LivroControlador', 'apiAtualizar']);
$router->delete('api/livros/eliminar', ['LivroControlador', 'apiEliminar']);
$router->post('api/livro/avaliar', ['LivroControlador', 'apiAvaliar']);

$router->post('api/login', ['AutenticacaoControlador', 'apiAutenticar']);
$router->post('api/registo', ['RegistoControlador', 'apiGuardar']);

$router->get('api/autores', ['AutorControlador', 'apiListar']);
$router->post('api/autores/guardar', ['AutorControlador', 'apiGuardar']);
$router->post('api/autores/atualizar', ['AutorControlador', 'apiAtualizar']);
$router->delete('api/autores/eliminar', ['AutorControlador', 'apiEliminar']);

$router->get('api/editoras', ['EditoraControlador', 'apiListar']);
$router->post('api/editoras/guardar', ['EditoraControlador', 'apiGuardar']);
$router->delete('api/editoras/eliminar', ['EditoraControlador', 'apiEliminar']);

$router->get('api/utilizadores', ['UtilizadorControlador', 'apiListar']);
$router->post('api/utilizadores/guardar', ['UtilizadorControlador', 'apiGuardar']);
$router->get('api/stats', ['DashboardControlador', 'apiStats']);

$router->get('api/biblioteca', ['BibliotecaControlador', 'apiMinhaBiblioteca']);
$router->post('api/biblioteca/checkout', ['BibliotecaControlador', 'apiCheckout']);
$router->post('api/biblioteca/comprar', ['BibliotecaControlador', 'apiComprar']);
$router->post('api/biblioteca/ler', ['BibliotecaControlador', 'apiRegistarLeitura']);
$router->get('api/biblioteca/verificar', ['BibliotecaControlador', 'apiVerificarPosse']);

$router->get('api/auditoria', ['AuditoriaControlador', 'apiRecente']);
