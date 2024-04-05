<?php

namespace App\controllers;

use League\Plates\Engine;

class Controller {
    protected $view;
    protected $img;

    public function __construct ()
    {
        $this->view = new Engine(ROOTDIR . 'app/views');
        $this->img = new Engine(ROOTDIR . 'app/views', 'jpg');
    }
    public function sendPage($page, array $data = [])
    {
        exit($this->view->render($page, $data));
    }

    public function sendImg($img)
    {
        exit($this->img->render($img));
    }

    // Lưu các giá trị của form được cho trong $data vào $_SESSION 
    protected function saveFormValues(array $data, array $except = [])
    {
        $form = [];
        foreach ($data as $key => $value) {
            if (!in_array($key, $except, true)) {
                $form[$key] = $value;
            }
        }
        $_SESSION['form'] = $form;
    }

    protected function getSavedFormValues()
    {
        return session_get_once('form', []);
    }

    public function sendNotFound()
    {
        http_response_code(404);
        exit($this->view->render('errors/404'));
    }
}