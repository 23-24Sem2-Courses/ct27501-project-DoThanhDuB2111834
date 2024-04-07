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
$router->get('/AddAccount', '\App\Controllers\Auth\AddNewAccountController@index');

$router->get('/TongQuan', '\App\Controllers\TongQuanController@index');
$router->get('/', '\App\Controllers\TongQuanController@index');


// Trang thu ngan
$router->get('/thuNganPage', '\App\Controllers\ThuNganController@index');
$router->post('/thuNganPage', '\App\Controllers\ThuNganController@store');
$router->get('/DSMon/([^/]+)', '\App\Controllers\ThuNganController@getList');
$router->get('/DSMon', '\App\Controllers\ThuNganController@getAllMon');

// Trang sản phẩm
$router->get('/SanPham', '\App\Controllers\SanPhamController@index');
$router->post('/SanPham/TimKiem', '\App\Controllers\SanPhamController@getDSSanPham');
$router->post('/SanPham', '\App\Controllers\SanPhamController@store');
$router->get('/SanPham/edit/(.*)', '\App\Controllers\SanPhamController@edit');
$router->post('/SanPham/update/(.*)', '\App\Controllers\SanPhamController@update');
$router->post('/SanPham/delete/(.*)', '\App\Controllers\SanPhamController@delete');

// Sử lý khi Client gửi yêu cầu HTTPS yêu cầu hình ảnh
// $router->get('/thucDon/img/([a-zA-Z0-9_-]+)', '\App\Controllers\imgController@getImgMon');
// $router->get('/BackGround/([^/]+)', '\App\Controllers\imgController@getbackGroundPageImg');
$router->get('/img/(.*)', '\App\Controllers\imgController@getImg');
// 404
$router->set404('\App\Controllers\Controller@sendNotFound');

$router->run();