<?php
include_once 'controller.php';

class berberler extends MainController {

    public function __construct()
    {
        parent::__construct();
    }


    public function index()
    {
        $veriler = $this->getForApi("berber/gets");

        $this->viewEngine("berberler",$veriler);
    }
    public function berber($id =0)
    {
        if ($id > 0 and $id != 0) {
            $veri = $this->getForApi("berber/get/" . $id);

            $this->viewEngine("berbersayfa",$veri);
        }
    }

    public function update()
    {
        if (isset($_POST) and !empty($_POST))
        {
            $param["islem"] = "genel";
            $param["kuladi"] = $_SESSION["user"]["kuladi"];
            $param["sifre"] = $_SESSION["user"]["sifre2"];
            $param["berberad"] = $this->filtre($_POST["berberad"]);
            $param["berbertel"] = $this->filtre($_POST["telefon"]);
            $param["acilis"] = $this->filtre($_POST["acilis"]);
            $param["kapanis"] = $this->filtre($_POST["kapanis"]);
            $param["periot"] = $this->filtre($_POST["periot"]);
            $param["ilceFk"] = $this->filtre($_POST["ilcefk"]);
            $param["adresDetay"] = $this->filtre($_POST["detay"]);
            $id = $_SESSION["user"]["id"];

            $result = $this->postForApi($param,"berber/update/".$id);
            if ($result)
            {
                header("Location:" . $this->basedir . "kullanicilar/berberP/".$id);
                die();
            }
            else{
                header("Location:" . $this->basedir . "kullanicilar/berberP/".$id);
                die();
            }

        }
    }

    public function save(){
        $this->viewEngine("berberkayit");
    }

    // şimdilik bunlar askıda
    private function imgtobase64($resimler)
    {
        $base64array = [];
        for ($i =0;$i < sizeof($resimler);$i++)
        {
            $type = pathinfo($resimler[$i], PATHINFO_EXTENSION);
            $data = file_get_contents($resimler[$i]);
            $base64 = base64_encode($data);
            $base64array[$i] = $base64;
            unlink($resimler[$i]);
        }
        return $base64array;

    }

    private function updatetmpimage($resimler)
    {
        $tmpresim = [];
        for($i=0; $i < sizeof($resimler["name"]);$i++)
        {
            $resimTmp = $resimler["tmp_name"][$i];
            $uri = $this->resimdir.uniqid().".png";
            if (!move_uploaded_file($resimTmp,$uri))
            {
                return false;
            }
            $tmpresim[$i] = $uri;
        }
        return $tmpresim;
    }

    public function insert()
    {
        if (isset($_POST) and !empty($_POST))
        {
            $param["berberad"] = $this->filtre($_POST["berberad"]);
            $param["berbertel"] = $this->filtre($_POST["telefon"]);

            $param["acilis"] = $this->filtre($_POST["acilis"]);
            $param["kapanis"] = $this->filtre($_POST["kapanis"]);
            $param["periot"] = $this->filtre($_POST["periot"]);

            $param["ilceFk"] = (int)$this->filtre($_POST["ilcefk"]);
            $param["adresDetay"] = $this->filtre($_POST["detay"]);

            $param["kullaniciFk"] = $_SESSION["user"]["id"];
            $param["kuladi"] = $_SESSION["user"]["kuladi"];
            $param["sifre"] = $_SESSION["user"]["sifre2"];
;

            /*$resimler = $_FILES["resimler"];
            $param["count"] = sizeof($resimler["name"]);
            $tmpresimler = $this->updatetmpimage($resimler);
            $result = $this->imgtobase64($tmpresimler);
            for($i = 0;$i < sizeof($result); $i++)
            {

                $param["resim".$i] = $result[$i];
            }*/

            $result = $this->postForApi($param,"berber/insert");
            if ($result) {
                header("Location:" . $this->basedir . "berberler");
                die();
            }
            else {
                header("Location:" . $this->basedir . "berberler/save");
                die();
            }

        }
    }

}