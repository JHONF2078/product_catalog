function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#img_photo').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function readProductURL(input) {
    if (input.files && input.files[0]) {

         var input_name=input.name;

         var img_name="img_"+input_name       

       // var name_file=input.files[0].name
        
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#'+img_name).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#photo").change(function(){   
    readURL(this);
});

$(".photo_product").change(function(){   
    readProductURL(this);
});

function format(input)
{

    var usd_value=$("#usd_value").val()
      
    var num = input.value.replace(/\,/g,'');
    if(!isNaN(num)){
        num = num.toString().split('').reverse().join('').replace(/(?=\d*\,?)(\d{3})/g,'$1,');
        num = num.split('').reverse().join('').replace(/^[\,]/,'');
        input.value = num;

        var usd_price=num.split(',').join('');

        var usd_price_format=usd_price

        $('#usd').val(usd_price/usd_value);
    }    
    else{ 
        alert('Solo se permiten numeros');
        input.value = input.value.replace(/[^\d\.]*/g,'');
    }
}






