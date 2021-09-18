<?php
include_once 'config/settings.php';

class MainController extends settings
{


    public function __construct()
    {
        parent::__construct();
    }

    public function checkauth($kuladi, $sifre)
    {
        $result = $this->user->login($kuladi, $sifre);
        return $result;
    }

    public function viewEngine($src,$values=false)
    {
        include_once 'view/layout/header.php';
        include_once 'view/site/'.$src.".php";
        include_once 'view/layout/footer.php';
    }
    public function viewLoginEngine($src)
    {
        include_once 'view/site/auth/'.$src.".php";
    }

}