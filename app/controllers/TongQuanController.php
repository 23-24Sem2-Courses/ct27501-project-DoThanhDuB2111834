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
        $data = [
            'message' => session_get_once('message'),
        ];
        $this->sendPage('TongQuan', $data);
    }
}