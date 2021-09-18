<?php
include_once 'controller.php';

class anasayfa extends MainController {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->viewEngine("anasayfa");
    }
    public function getimage()
    {
        echo "deneme";
    }
}