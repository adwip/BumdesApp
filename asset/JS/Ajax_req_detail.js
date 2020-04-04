$(document).ready(function(){

    $('#detail-belanja').submit(function(e){
        e.preventDefault()
        $.ajax({
            url:$(this).attr('action'),
            data: $(this).serialize(),
            type: $(this).attr('method'),
            dataType: 'html',
            success: function(v){
                $('#val-body').html(v)
            }
        })
    })
    
    $('#detail-penjualan').submit(function(e){
        e.preventDefault()
        $.ajax({
            url:$(this).attr('action'),
            data: $(this).serialize(),
            type: $(this).attr('method'),
            dataType: 'html',
            success: function(v){
                $('#val-body').html(v)
            }
        })
    })
})