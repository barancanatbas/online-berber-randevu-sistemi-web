<!doctype html>
<html lang="en">
<head>
    <base href="<?php echo $this->basedir; ?>">
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="view/css/main.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="view/js/jquery-3.6.0.min.js"></script>
</head>
<body>

<section class="header">
    <img class="backgroundimg" src="view/static/resim1.jpg" alt="">
    <div class="header-menu">
        <img src="view/static/baranberberv3.png" alt="">
        <nav>
            <ul>
                <li><a href="<?php echo $this->basedir; ?>anasayfa">Anasayfa</a></li>
                <li><a href="<?php echo $this->basedir; ?>hakkimizda">Hakkımızda</a></li>
                <li><a href="<?php echo $this->basedir; ?>berberler">Berberler</a></li>
                <?php if (isset($_SESSION["user"])){ ?>
                    <li><a href="<?php echo $this->basedir; ?>kullanicilar/profil"><?php echo $_SESSION["user"]["ad"].' '.$_SESSION["user"]["soyad"]; ?></a></li>
                <?php }else{?>
                    <li><a href="<?php echo $this->basedir; ?>kullanicilar/login">Login</a></li>
                <?php }?>
            </ul>
        </nav>
    </div>

    <br>
