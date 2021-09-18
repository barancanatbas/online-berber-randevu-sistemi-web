<?php
session_start();
ob_start();
date_default_timezone_set('Europe/Istanbul');


class settings
{
    protected $apiUrl;
    protected $user;
    public $basedir;
    protected $resimdir;

    public function __construct()
    {
        $this->resimdir ="view/tmpimg/";
        $this->basedir = "http://localhost/berberweb/";
        $this->apiUrl = 'http://localhost/berber/';
    }


    public function filtre($veri)
    {
        $bir = trim($veri);
        $iki = strip_tags($bir);
        $uc = htmlspecialchars($iki, ENT_QUOTES);
        return $uc;
    }

    public function filtreCoz($veri)
    {
        $bir = htmlspecialchars_decode($veri, ENT_QUOTES);
        return $bir;
    }

    public function getForApi($url)
    {
        $ch = curl_init($this->apiUrl.$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $veri = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($veri,true);
        return $result;

    }
    public function getImageForApi($url)
    {
        header("Content-Type: image/png");

        $url = $this->apiUrl.$url;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $res = curl_exec($ch);
        $rescode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch) ;
        return $res;
    }
    public function postForApi($param,$url)
    {
        $ch = curl_init($this->apiUrl.$url);
        curl_setopt($ch,CURLOPT_POST , true);
        curl_setopt($ch,CURLOPT_POSTFIELDS , $param);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        $veri = curl_exec($ch);
        $result = json_decode($veri,true);
        return $result;
    }

}