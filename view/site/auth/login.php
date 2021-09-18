<!DOCTYPE html>
<html lang="en">
<head>
    <base href="<?php echo $this->basedir; ?>">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="view/css/login.css">
</head>
<body>

<div class="container" id="container">

    <div class="form-container sign-in-container">
        <form action="<?php echo $this->basedir; ?>kullanicilar/chechauth/anasayfa"  method="POST">
            <h1>Login</h1>
            <input type="text" placeholder="Kullanıcı Adı" name="kuladi"/>
            <input type="password" placeholder="Şifre" name="sifre"/>
            <a href="#">Şifremi unuttum</a>
            <button>Giriş Yap</button>
            <p>bir hesabın yok mu? Hemen <a href="<?php echo $this->basedir; ?>/kullanicilar/register" style="color: red;">Kayıt Ol</a></p>
        </form>
    </div>
    <div class="overlay-container">
        <img src="view/static/loginfoto.png" alt="">
    </div>
</div>

</body>
</html>