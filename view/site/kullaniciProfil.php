</section>
<div class="bosluk" style="height: 120px;"></div>
<div class="content" >

    <div class="cntainer">
        <div class="user">
            <div class="foto">
                <img class="profilFoto" src="<?php echo $this->apiUrl.$_SESSION['user']['profilResim']; ?>" alt="">
                <h3> <?php echo $_SESSION["user"]["ad"].' '.$_SESSION["user"]["soyad"]; ?></h3>
                <h6><?php echo $_SESSION["user"]["telefon"]; ?></h6>
                <h6><?php echo $_SESSION["user"]["mail"] ?></h6>
                <ul class="user-p-ul">
                    <?php if($_SESSION["user"]["berbermi"] ==0){ ?>
                    <li><a href="<?php echo $this->basedir; ?>berberler/save">Berber Kayıt</a></li>
                    <?php } else{ ?>
                    <li><a href="<?php echo $this->basedir; ?>kullanicilar/berberP/<?php  echo $_SESSION["user"]["id"];?>">Berber Profil</a></li>
                    <li><a href="<?php echo $this->basedir; ?>kullanicilar/tarifeler">Tarifeler</a></li>
                    <?php }?>
                    <li><a href="<?php echo $this->basedir; ?>kullanicilar/logout">Çıkış yap</a></li>
                </ul>
                <div class="sosial">
                    <div class="sosialItem">
                        <img class="sosialFoto" src="view/static/iconface.png" alt="">
                    </div>
                    <div class="sosialItem">
                        <img class="sosialFoto" src="view/static/iconinsta.png" alt="">
                    </div>
                    <div class="sosialItem">
                        <img class="sosialFoto" src="view/static/iconyoutube.png" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="userinfo">

            <h1 style="padding-bottom: 10px;">Bilgilerim</h1>
            <hr>
                <div class="formeleman">
                    <input type="file" id="file" class="file">
                    <label for="file">
                        <img id="newFoto" src="view/static/iconupload.png" alt="">
                    </label>
                </div>
                <div class="formeleman">
                    <button class="btnfotoupdate">Güncelle</button>
                </div>
            <form method="post" action="<?php echo $this->basedir; ?>kullanicilar/update"  class="form" >
                <div class="formeleman">
                    <label for="">Kullanıcı Adı</label>
                    <input type="text" placeholder="kullanıcı adı" name="kuladi" value="<?php echo $values['user']['kuladi']; ?>">
                </div>
                <div class="formeleman" >
                    <label for="">Adın</label>
                    <input type="text" placeholder="adın" name="ad" value="<?php echo $values['user']['ad']; ?>">
                </div>
                <div class="formeleman">
                    <label for="">Soyadın</label>
                    <input type="text" placeholder="soyadın" name="soyad" value="<?php echo $values['user']['soyad']; ?>">
                </div>
                <div class="formeleman">
                    <label for="">Mail</label>
                    <input type="text" placeholder="mail" name="mail" value="<?php echo $values['user']['mail']; ?>">
                </div>
                <div class="formeleman">
                    <label for="">Telefon</label>
                    <input type="text" align="center" placeholder="Telefon" name="telefon" value="<?php echo $values['user']['telefon']; ?>">
                </div>
                <div class="formeleman">
                    <button>Güncelle</button>
                </div>
            </form>
            <form action="<?php echo $this->basedir; ?>kullanicilar/update" method="POST" class="form" onsubmit="return kontrol()">
                <div class="formeleman">
                    <label for="">Yeni Şifre</label>
                    <input type="password" placeholder="Şifre" id="yenisifre1" name="sifre">
                </div>
                <div class="formeleman">
                    <label for="">Yeni Şifre (Tekrardan)</label>
                    <input type="password" placeholder="Şifre" id="yenisifre2">
                </div>
                <div class="formeleman">
                    <button class="btnsifreupdate">Güncelle</button>
                </div>
            </form>
            <div class="formeleman" style="width: auto; float: right;margin-right: 60px;margin-top: 60px;">
                <a href="<?php echo $this->basedir; ?>berberler/save" class="btn btn-info">Berber Kayıt</a>
            </div>


        </div>
    </div>
</div>

<script>


    function kontrol(){
        let sifre1 = $("#yenisifre1").val();
        let sifre2 = $("#yenisifre2").val();
        if (sifre1 == sifre2)
        {
            return true;
        }
        else{
            alert("Şifreler aynı değil");
            return false;
        }
        return false;
    }

    var $j = jQuery.noConflict();
    $j(document).ready(function (){
        let base64image;
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
                    base64image = e.target.result;
                });

                FR.readAsDataURL( this.files[0] );
            }
        }

        document.getElementById("file").addEventListener("change", readFile);

        $j(".btnfotoupdate").on('click',function (){
            var formData = {resim:base64image,islem:'resim'};
            $j.ajax({
                url : "kullanicilar/update",
                type: "POST",
                data : formData,
                success: function(data)
                {
                    window.location.reload(false)
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert("hata");
                }
            })
        })



    })
</script>