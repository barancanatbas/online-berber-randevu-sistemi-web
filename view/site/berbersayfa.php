<div class="content" >
    <div class="cntainer">
        <div class="berbercard">
            <div class="bfoto">
                <img src="<?php if(isset($values["resimler"]) and !empty($values["resimler"])){ echo $this->apiUrl.$values['resimler'][0]['resimsrc'];} else echo  $this->basedir.'view/static/berber.png'; ?>" alt="">
            </div>
            <div class="berberdetay">
                <h1><?php echo $values["berberAd"]; ?></h1>
                <p><?php echo $values["berberTel"]; ?></p>
                <p><?php echo $values['adres']['detay'].' '.$values['adres']['ilce_isim'].' '.$values['adres']['il_isim']; ?></p>
            </div>
            <button class="btn btn-success btn-lg randevubtn"> Randevu Al </button>

        </div>
        <div class="btarifeler">
            <h2>Tarifeler</h2>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Tarife</th>
                    <th scope="col">Ücret</th>
                </tr>
                </thead>
                <tbody>
                <?php if(isset($values["tarifeler"])){ foreach ($values["tarifeler"] as $tarife){ ?>
                <tr>
                    <td><?php echo $tarife["islemAdi"]; ?></td>
                    <td><?php echo $tarife["islemUcret"]; ?> TL</td>
                </tr>
                <?php }} ?>
                </tbody>
            </table>
        </div>
    </div>
</div>