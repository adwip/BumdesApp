$(document).ready(function(){

    $('#gov-stok-masuk').submit(function(e){
        e.preventDefault()
        const form = $(this).serialize()
        history.pushState("","",'?'+form)
        $.ajax({
            url:$(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(v){
                $('#tbm').html(v['tbm'])
                $('#tnb').html('Rp. '+v['tnb'])
                $('.g-tahun').html('Tahun '+v['y'])
                pembelian_logistik(v['v_grafik'],'#grafik_perdagangan')
            }
        })
    })
    
    $('#gov-stok-masuk').submit(function(e){
        e.preventDefault()
        const form = $(this).serialize()
        history.pushState("","",'?'+form)
        $.ajax({
            url:$(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(v){
                $('#tbm').html(v['tbm'])
                $('#tnb').html('Rp. '+v['tnb'])
                pembelian_logistik(v['v_grafik'],'#grafik_perdagangan')
            }
        })
    })
})