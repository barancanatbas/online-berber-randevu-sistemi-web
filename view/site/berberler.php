</section>
<div class="content" >
    <div class="cntainer">
        <div class="searchBerber">
            <form action="" class="berberSearch">
                <input type="text" placeholder="Berber Adı">
                <select name="" id="">
                    <option value="">denemeler</option>
                    <option value="">baran can atbaş</option>
                </select>
                <input type="submit" value="Ara">
            </form>
        </div>
        <div class="berberler">
            <?php if (isset($values) and !empty($values)){
                foreach ($values as $value){?>
                <div class="berberitem">
                <div class="berberFoto">
                    <img src="<?php if(isset($value["resimler"])){ echo $this->apiUrl.$value['resimler'][0]['resimsrc'];} else echo  $this->basedir.'view/static/berber.png'; ?>" alt="">
                </div>
                <div class="berberBilgi">
                    <a href="<?php echo $this->basedir; ?>berberler/berber/<?php echo $value['id']; ?>"><h3><?php echo $value["berberAd"]; ?></h3></a>
                    <h6 class="berberp">ali</h6>
                    <h6 class="berberp"><?php echo $value['berberTel']; ?></h6>
                    <h6 class="berberp"><?php echo $value['adres']['detay'].' '.$value['adres']['ilce_isim'].' '.$value['adres']['il_isim']; ?></h6>
                </div>
                <div class="randevuAl">
                    <a href="#" class="btn btn-danger">Randevu al</a>
                </div>
            </div>

            <?php }}?>
        </div>
    </div>
</div>