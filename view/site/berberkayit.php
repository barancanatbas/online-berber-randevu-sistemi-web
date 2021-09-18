</section>
<div style="width: 100%;height: 150px;"></div>
<div class="container">
    <form method="post" action="<?php echo $this->basedir; ?>berberler/insert">
        <h1>Berber Kayit</h1>
        <div class="form-group">
            <label for="exampleInputEmail1">Berber Ad</label>
            <input type="text" class="form-control"  placeholder="Berber Adı" name="berberad" required>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Telefon Numarası</label>
            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Telefon Numarası" name="telefon" required>
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Açılış</label>
            <select class="form-control" required id="aciliselect" name="acilis">
                <option>lütfen bir açılış saati seçiniz</option>
            </select>
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Kapanış</label>
            <select class="form-control" disabled required id="kapaniselect" name="kapanis">
                <option>lütfen bir kapanış saati seçiniz</option>
            </select>
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Periot</label>
            <select class="form-control"  required id="periotselect" name="periot">
                <option>lütfen randevu aralığı belirleyin</option>
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

            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">İlçe</label>
            <select class="form-control" disabled="none" required id="ilceselect" name="ilcefk">
                <option></option>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Adres Detay</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="detay"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<img src="" alt="">
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

