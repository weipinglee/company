/**
 * Created by lenovo on 2016/5/28.
 */

function getNav(_this){
    var url = $('input[name=ajaxUrl]').val();
    var type = $(_this).attr('value');
    var box = $(_this).parents('form').find('select[name=parent_id]');
    $.ajax({
        url:url,
        type:'post',
        data:{'type':type},
        dataType:'json',
        success : function(data){
            if(data){
                box.html('<option value="0">无</option>');
                $.each(data,function(index,val){
                    var option = ' <option value="'+val.id+'">'+val.nav_name+'</option>'
                    box.append(option);
                })
            }
        }
    })
}
