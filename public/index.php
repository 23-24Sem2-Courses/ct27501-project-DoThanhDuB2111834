<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once __DIR__ . '/../bootstrap.php';

define('APPNAME', 'Caffee shop');

session_start();

$router = new \Bramus\Router\Router();

// //login và logout
$router->get('/login', '\App\Controllers\Auth\LoginController@create');
$router->post('/login', '\App\Controllers\Auth\LoginController@store');
$router->post('/logout', '\App\Controllers\Auth\LoginController@destroy');

// Admin thêm tài khoản mới cho nhân viên

$router->get('/AddAccount', '\App\Controllers\Auth\AddNewAccountController@create');
$router->post('/AddAccount', '\App\Controllers\Auth\AddNewAccountController@store');
$router->get('/TongQuan', '\App\Controllers\TongQuanController@index');
$router->get('/User', '\App\Controllers\Auth\UserController@index');
$router->get('/User/edit/(\d+)', 'App\Controllers\Auth\UserController@edit');
$router->post('/User/(\d+)', 'App\Controllers\Auth\UserController@update');
$router->post('/User/delete/(\d+)', 'App\Controllers\Auth\UserController@destroy');
$router->get('/User/changepass', '\App\Controllers\Auth\UserController@editpass');
$router->post('/User/changepass', '\App\Controllers\Auth\UserController@updatePass');
$router->get('/', '\App\Controllers\TongQuanController@index');


// Trang thu ngan
$router->get('/thuNganPage', '\App\Controllers\ThuNganController@index');
$router->post('/thuNganPage', '\App\Controllers\ThuNganController@store');
$router->get('/thuNganPage/edit/(.*)', '\App\Controllers\ThuNganController@edit');
$router->get('/DSMon/([^/]+)', '\App\Controllers\ThuNganController@getList');
$router->get('/DSMon', '\App\Controllers\ThuNganController@getAllMon');

// Trang sản phẩm
$router->get('/SanPham', '\App\Controllers\SanPhamController@index');
$router->post('/SanPham/TimKiem', '\App\Controllers\SanPhamController@getDSSanPham');
$router->post('/SanPham', '\App\Controllers\SanPhamController@store');
$router->get('/SanPham/edit/(.*)', '\App\Controllers\SanPhamController@edit');
$router->post('/SanPham/update/(.*)', '\App\Controllers\SanPhamController@update');
$router->post('/SanPham/delete/(.*)', '\App\Controllers\SanPhamController@delete');

// Trang giao dịch
$router->get('/GiaoDich', '\App\Controllers\GiaoDichController@index');
$router->post('/HoaDon/delete/(.*)', '\App\Controllers\GiaoDichController@delete');
$router->post('/GiaoDich/TimKiem', '\App\Controllers\GiaoDichController@search');

// Sử lý khi Client gửi yêu cầu HTTPS yêu cầu hình ảnh
// $router->get('/thucDon/img/([a-zA-Z0-9_-]+)', '\App\Controllers\imgController@getImgMon');
// $router->get('/BackGround/([^/]+)', '\App\Controllers\imgController@getbackGroundPageImg');
$router->get('/img/(.*)', '\App\Controllers\imgController@getImg');
// 404
$router->set404('\App\Controllers\Controller@sendNotFound');

$router->run();