$(document).ready(function () {

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
    })
})