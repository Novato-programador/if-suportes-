<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//Login
$routes->get('/login', 'Login::index');
$routes->post('login/signin', 'Login::signin');
$routes->get('/login/signout', 'Login::signout');
$routes->post('/login/store', 'Login::store');
$routes->get('registrar', 'Login::register');

//Chamados
$routes->get('/chamados', 'Chamados::index');
$routes->get('/chamados/create', 'Chamados::create');
$routes->post('/chamados/store', 'Chamados::store');
$routes->get('/chamados/(:hash)/edit', 'Chamados::edit/$1');
$routes->get('/chamados/(:hash)/cancel', 'Chamados::cancel/$1');
$routes->get('/chamados/carregarChamados', 'Chamados::carregarChamados');
$routes->get('/chamados/paginar', 'Chamados::paginar');
$routes->options('/chamados/paginar', 'Chamados::paginar');
$routes->get('/chamados/(:hash)/siga', 'Chamados::siga/$1');
$routes->post('/chamados/atribuirChamado', 'Chamados::atribuirChamado');
$routes->post('/chamados/registrarAtendimento', 'Chamados::registrarAtendimento');

//Dashboard
$routes->get('/dashboard', 'Dashborad::index');
$routes->get('/dashboard/obterDados', 'Dashborad::obterDados');

//Usuario
$routes->get('/usuario', 'Usuario::index');
$routes->post('/usuario/store', 'Usuario::store');
$routes->get('/usuario/(:hash)/edit', 'Usuario::edit/$1');
$routes->post('/usuario/processar_solicitacao', 'Usuario::processar_solicitacao');
$routes->get('solicitacoes', 'Usuario::solicitacoes');
$routes->post('/resetPass', 'Usuario::resetPass');
$routes->get('/usuario/obterUsuarios', 'Usuario::obterUsuarios');

//Pagina inicial
$routes->get('/', 'Home::index');
$routes->get('/home', 'Home::index');
$routes->get('/home/obterDados', 'Home::obterDados');

//Relatórios
$routes->get('/relatorios', 'Relatorio::index');
$routes->post('/relatorio/gerarRelatorio', 'Relatorio::gerarRelatorio');

//Profile
$routes->get('/meus-chamados', 'Profile::index');
$routes->get('/profile/obterDados', 'Profile::obterDados');
$routes->post('/profile/carregarViewSiga', 'Profile::carregarViewSiga');
$routes->post('/profile/sendAvaliacao', 'Profile::sendAvaliacao');
$routes->post('/profile/sendComentario', 'Profile::sendComentario');
