<?php
include_once 'controller.php';

class hakkimizda extends MainController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->viewEngine("hakkimizda");
    }
}