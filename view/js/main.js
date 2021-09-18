const url = 'http://localhost/berber/';

$(document).ready(loadpage())


function loadpage()
{
    $.ajax(
        {
            type:"GET",
            url:url+'iller',
            success:function(data)
            {
                const json = JSON.parse(data);

                json.forEach(element => {
                    $("#iller").append(new Option(element.il_isim,element.il_id));
                    console.log(element);
                });
            },
            error:function(error)
            {
                console.error("hata");
            }
        }
    )
}