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
                        <li><a href="#">Berber Kayıt</a></li>
                    <?php } else{ ?>
                        <li><a href="<?php echo $this->basedir; ?>berberler/save">Berber Profil</a></li>
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

            <h1 style="padding-bottom: 10px;">Berber Bilgilerim</h1>
            <hr>

            <form method="post" action="<?php echo $this->basedir; ?>berberler/update"  class="form" >
                <div class="form-group">
                    <label for="exampleInputEmail1">Berber Ad</label>
                    <input type="text" class="form-control"  placeholder="Berber Adı" name="berberad" value="<?php echo $values['berberAd']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Telefon Numarası</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Telefon Numarası" name="telefon" value="<?php echo $values['berberTel']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Açılış</label>
                    <select class="form-control" required id="aciliselect" name="acilis">
                        <option value="<?php echo $values['acilis']; ?>"><?php echo $values['acilis']; ?></option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Kapanış</label>
                    <select class="form-control" required id="kapaniselect" name="kapanis">
                        <option value="<?php echo $values['kapanis']; ?>"><?php echo $values['kapanis']; ?></option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Periot</label>
                    <select class="form-control"  required id="periotselect" name="periot">
                        <option value="<?php echo $values['periot']; ?>"><?php echo $values['periot']; ?></option>
                        <option value="0.3">0:30</option>
                        <option value="0.4">0:40</option>
                        <option value="0.5">0:50</option>
                        <option value="1">1:00</option>
                        <option value="1.3">1:30</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlSelect1">Şehir</label>
                    <select class="form-control" id="ilselect">
                        <option value="<?php echo $values['adres']['il_no']; ?>"><?php echo $values['adres']['il_isim']; ?></option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">İlçe</label>
                    <select class="form-control"  required id="ilceselect" name="ilcefk">
                        <option value="<?php echo $values['adres']['ilce_no']; ?>"><?php echo $values['adres']['ilce_isim']; ?></option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Adres Detay</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="detay"><?php echo $values["adres"]["detay"]; ?></textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-success">Güncelle</button>
                </div>
            </form>



        </div>
    </div>
</div>

<script>
    var $j = jQuery.noConflict();
    const url = 'http://localhost/berber/';
    $j(document).ready(function (){

        for (var i =1;i <= 24;i +=0.5)
        {
            $j("#aciliselect").append(new Option(i,i.toPrecision(4)));
        }
        $j("#aciliselect").change(function (){
            $j("#kapaniselect").empty();
            var acilis = parseFloat($j("#aciliselect").val());
            $j("#kapaniselect").removeAttr('disabled');
            for (var i =acilis;i <= 24;i +=0.5)
            {

                $j("#kapaniselect").append(new Option(i,i.toPrecision(4)));
            }
        })

        $j.ajax({
            type:"GET",
            url:url+'iller',
            success:function(data)
            {
                const json = JSON.parse(data);

                json.forEach(element => {
                    $j("#ilselect").append(new Option(element.il_isim,element.il_no));
                });
            },
            error:function(error)
            {
                console.error("hata");
            }
        })
        $j("#ilselect").change(function (){
            $('#ilceselect').empty();
            $j.ajax({
                type:"GET",
                url:url+'ilce/get/'+$j("#ilselect").val(),
                success:function(data)
                {
                    const json = JSON.parse(data);

                    json.forEach(element => {
                        $j("#ilceselect").append(new Option(element.ilce_isim,element.ilce_no));

                    });
                    $j("#ilceselect").removeAttr('disabled');
                },
                error:function(error)
                {
                    console.error("hata");
                }
            })
        })
    })
</script>