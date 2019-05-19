$(document).ready(function () {
      if(localStorage.getItem('Checkbox-timezone') === "true"){
          $(".Checkbox_div_Timezone").hide();
          $(this).find("input:checkbox").prop("checked", "true");
      }
      if(localStorage.getItem('Checkbox-timezone') === "false")
      {
          $(".Checkbox_div_Timezone").fadeIn();
      }
    $(document).on('click','#btn_delete',function () {
        if(confirm("Вы уверенный что хотите удалить записи")){
             var id = [];
             $(':checkbox:checked').each(function (i) {
                 id[i] = $(this).val();
             });
            if(id.length === 0)
            {
                alert('Пожалуйста выберите что удалить');
            }
            else
            {
                $.ajax({
                    url:'/tablic2/delete-multi',
                    method:'get',
                    data:{id:id},
                    success:function () {
                        for(var i=0;i<id.length;i++)
                        {
                            $('tr#'+id[i]+'').css('background-color','#ccc');
                            $('tr#'+id[i]+'').fadeOut('slow');
                        }
                    }
                })
            }
        }
        else
        {
            return false;
        }
    });
    $(document).on('change','.Checkbox-timezone',function () {
        if(this.checked) {
            localStorage.setItem('Checkbox-timezone', "true");
            $(".Checkbox_div_Timezone").hide();
        }
        else
        {
            localStorage.setItem('Checkbox-timezone', "false");
            $(".Checkbox_div_Timezone").fadeIn();
        }
/*        if($('.Checkbox-timezone').prop('checked')){
            $(".Checkbox_div_Timezone").hide();

        }
        else
            {
                $(".Checkbox_div_Timezone").fadeIn();
        };*/
    });
    $(document).on('change','.dropzone',function(){
       $('.dropzone').upload({
       });
    });
})