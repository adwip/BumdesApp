$(document).ready(function(){
    $('#login-system').submit(function(e){
        e.preventDefault()
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(v){
                if (v['stat']==200) {
                    window.location.href=v['url']
                    $('#failed-login').hide()
                }else{
                    $('#failed-login').show()
                }
            }
        })
    })
})