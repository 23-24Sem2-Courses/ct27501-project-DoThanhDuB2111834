<?php

namespace App\controllers\Auth;

use App\controllers\Controller;
use App\SessionGuard as Guard;

class AddNewAccountController extends Controller 
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
        $this->sendPage('Auth/registration');
    }
}