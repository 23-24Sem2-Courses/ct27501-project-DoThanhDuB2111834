<?php

namespace App\controllers;

use App\SessionGuard as Guard;

class TongQuanController extends Controller
{
    public function __construct()
    {
        if (!Guard::isTaiKhoanLoggedIn()) {
            redirect('/login');
        }

        parent::__construct();
    }

    public function index()
    {
        // require_once __DIR__ . '../views/home.php';
        $this->sendPage('TongQuan');
    }
}