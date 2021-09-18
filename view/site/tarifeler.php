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
            <div class="row col-md-11" style="margin: auto">
                <a href="#" class="btn btn-info" style="margin-top: 10px;margin-bottom: 20px;">Yeni Tarife</a>
            </div>
            <table class="table col-md-10" style="margin: auto">
                <thead>
                <tr>
                    <th scope="col">Tarife</th>
                    <th scope="col">Ücret</th>
                    <th scope="col">İşlem</th>
                </tr>
                </thead>
                <tbody>
                <?php if(!empty($values)){ foreach ($values as $value){ ?>
                <tr>
                    <td><?php echo $value["islemAdi"]; ?></td>
                    <td><?php echo $value["islemUcret"]; ?> TL</td>
                    <td width="200px">
                        <button class="btn btn-danger">Sil</button>
                        <button class="btn btn-info">Güncelle</button>
                    </td>
                </tr>
                <?php }} ?>

                </tbody>
            </table>

        </div>
    </div>
</div>