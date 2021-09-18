<!DOCTYPE html>
<html lang="en">
<head>
    <base href="<?php echo $this->basedir; ?>">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="view/css/login.css">
    <script src="view/js/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="containerRegister" id="container">

    <div class="sign-in-container">
        <form action="" enctype="multipart/form-data">
            <h1>KAYIT OL</h1>
            <input type="file" id="file" class="file" name="resim">
            <label for="file" class="img">
                <img id="newFoto" src="view/static/iconupload.png" alt="">
            </label>
            <input type="text" placeholder="Adın" id="ad" required/>
            <input type="text" placeholder="Soyadın" id="soyad" required/>
            <input type="email" placeholder="E-mail" id="email" required>
            <input type="tel" placeholder="555 555 55 55" id="tel" pattern="[0-9]{3} [0-9]{3} [0-9]{2} [0-9]{2}"required>
            <input type="text" placeholder="Kullanıcı Adı" id="kuladi" required/>
            <input type="password" placeholder="Şifre" id="sifre" required/>
            <button class="btn">Kayıt Ol</button>
        </form>
    </div>
    <div class="overlay-container">
        <img src="view/static/loginfoto.png" alt="">
    </div>
</div>


<script>
    let base64imge;
   $(document).ready(function (){
       const file = document.getElementById('file');
       const image = document.querySelector('#newFoto');

       file.addEventListener('change',function(){
           [... this.files].map(file =>{
               const reader = new FileReader();
               reader.addEventListener('load',function(){
                   image.src = this.result
               })
               reader.readAsDataURL(file);
           })
       })

       function readFile() {
           if (this.files && this.files[0]) {

               var FR= new FileReader();

               FR.addEventListener("load", function(e) {
                   base64imge = e.target.result;
               });

               FR.readAsDataURL( this.files[0] );
           }
       }

       document.getElementById("file").addEventListener("change", readFile);

       $(".btn").click(function (){
           var ad = document.getElementById("ad").value;
           var soyad = document.getElementById("soyad").value;
           var email = document.getElementById("email").value;
           var tel = document.getElementById("tel").value;
           var kuladi = document.getElementById("kuladi").value;
           var sifre = document.getElementById("sifre").value;

           var formData = {kuladi:kuladi,ad:ad,soyad:soyad,sifre:sifre,tel:tel,email:email,resim:base64imge};
           $.ajax({
               url : "http://localhost/berberweb/kullanicilar/registerNewUser",
               type: "POST",
               data : formData,
               success: function(data, textStatus, jqXHR)
               {
                   window.location = "http://localhost/berberweb/";
               },
               error: function (jqXHR, textStatus, errorThrown)
               {
                    alert("hata");
               }
           })
       })
   })

</script>

</body>
</html>