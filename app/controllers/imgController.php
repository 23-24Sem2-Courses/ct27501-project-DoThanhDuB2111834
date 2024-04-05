<?php 

namespace App\controllers;

class imgController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getImgMon ($imgPath)
    {
        // Loại bỏ đuôi '.JPG' ra khỏi đường dẫn
        $imgPath = str_replace('.jpg', '', $imgPath);
        $this->sendImg('img/thucDon/'.$imgPath);
        // $this->sendImg('img/thucDon/traDao');
    }

    public function getbackGroundPageImg($imgPath)
    {   
        $this->sendImg('img/Login/'.$imgPath);
    }
}