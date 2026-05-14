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

$router->get('biblioteca', ['BibliotecaControlador', 'index']);

/*registro*/
$router->get('registo', ['RegistoControlador', 'criar']);
$router->post('registo', ['RegistoControlador', 'guardar']);
