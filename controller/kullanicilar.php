<?php
include_once 'controller.php';

class kullanicilar extends MainController {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
    }

    public function profil()
    {
        $id = $_SESSION["user"]["id"];
        $result = [
            "user" => $_SESSION["user"]
        ];
        if ($_SESSION["user"]["berbermi"] == 1)
        {
            $result["berber"] = $this->getForApi("berber/get/".$_SESSION["user"]["id"]);
        }
        $this->viewEngine('kullaniciProfil',$result);
    }
    public function berberP($id = 0)
    {
        $veriler = $this->getForApi("berber/getbykulid/".$id);

        $this->viewEngine("berberayar",$veriler);
    }


    public function tarifeler()
    {
        $id = $_SESSION["user"]["id"];

        $veriler = $this->getForApi("tarifeler/gets/".$id);

        $this->viewEngine("tarifeler",$veriler);
    }

    public function login()
    {
        $this->viewLoginEngine("login");
    }

    public function register()
    {
        $this->viewLoginEngine("register");
    }

    public function registerNewUser()
    {
        if (isset($_POST) and !empty($_POST))
        {
            $param["kuladi"] = $this->filtre($_POST["kuladi"]);
            $param["ad"] =$this->filtre($_POST["ad"]);
            $param["soyad"] = $this->filtre($_POST["soyad"]);
            $param["telefon"] = $this->filtre($_POST["tel"]);
            $param["mail"] = $this->filtre($_POST["email"]);
            $param["sifre"] = $_POST["sifre"];
            $param["resim"] = $_POST["resim"];

            $result = $this->postForApi($param,"kullanicilar/register");
            return $result;
        }
        return false;
    }

    public function chechauth($adres = null,$kuladi = null,$sifre = null)
    {

        if (isset($_POST) and !empty($_POST) and $adres != null)
        {

            $param["kuladi"] = $this->filtre($_POST["kuladi"]);
            $param["sifre"] = $_POST["sifre"];

            $result = $this->postForApi($param,"kullanicilar/login");
            if ($result) {
                $_SESSION["user"] = $result;
                $_SESSION["user"]["sifre2"] = $param["sifre"];
                header("Location:" . $this->basedir . $adres);
                die();
            }
            else{
                header("Location:".$this->basedir."kullanicilar/login");
                die();
            }
        }
        elseif(!is_null($kuladi) and !is_null($sifre) and $adres == null)
        {
            $param["kuladi"] = $kuladi;
            $param["sifre"] = $sifre;
            $result = $this->postForApi($param,"kullanicilar/login");
            if ($result)
            {
                $_SESSION["user"] = $result;
                $_SESSION["user"]["sifre2"] = $param["sifre"];
                return true;
            }
        }
    }

    public function update()
    {
        if (isset($_POST) and !empty($_POST))
        {

            if (isset($_POST["islem"]))
            {
                $param["resim"] = $_POST["resim"];
                $param["islem"] = "resim";
                $param["kuladi"] = $_SESSION["user"]["kuladi"];
                $param["sifre"] = $_SESSION["user"]["sifre2"];
                $result = $this->postForApi($param,"kullanicilar/update/".$_SESSION["user"]["id"]);
                if ($result) {
                    $result = $this->chechauth(null,$_SESSION["user"]["kuladi"],$_SESSION["user"]["sifre2"]);
                    if ($result)
                    {
                        return true;
                    }
                }
                else
                    echo "hatalar var knks";
            }

            elseif(isset($_POST["kuladi"]))
            {
                $param["kuladi"] = $_SESSION["user"]["kuladi"];
                $param["sifre"] =$_SESSION["user"]["sifre2"];


                $param["yenikuladi"] = $this->filtre($_POST["kuladi"]);
                $param["ad"] = $this->filtre($_POST["ad"]);
                $param["soyad"] = $this->filtre($_POST["soyad"]);
                $param["telefon"] = $this->filtre($_POST["telefon"]);
                $param["mail"] = $this->filtre($_POST["mail"]);
                $param["islem"] = "genel";

                $result = $this->postForApi($param,"kullanicilar/update/".$_SESSION["user"]["id"]);
                if ($result)
                {
                    $result = $this->chechauth(null,$param["yenikuladi"],$_SESSION["user"]["sifre2"]);
                }
                header("refresh:0;url=".$this->basedir."kullanicilar/profil");
                die();
            }

            elseif(isset($_POST["sifre"]))
            {
                $param["yenisifre"] = $_POST["sifre"];
                $param["islem"] = "sifre";
                $param["kuladi"] = $_SESSION["user"]["kuladi"];
                $param["sifre"] =$_SESSION["user"]["sifre2"];

                $result = $this->postForApi($param,"kullanicilar/update/".$_SESSION["user"]["id"]);
                if ($result)
                {
                    $result = $this->chechauth(null,$param["kuladi"],$param["sifre"]);
                }
                header("refresh:0;url=".$this->basedir."kullanicilar/profil");
                die();
            }
            else{
                echo "birşey yok ";
            }
        }
    }

    public function logout()
    {
        session_destroy();
        header("refresh:0;url=".$this->basedir."anasayfa");
        die();
    }

}