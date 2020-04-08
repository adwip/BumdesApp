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
    
    $('#gov-penjualan').submit(function(e){
        e.preventDefault()
        const form = $(this).serialize()
        history.pushState("","",'?'+form)
        $.ajax({
            url:$(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(v){
                $('.g-time').html('Tahun '+v['y'])
                $('#jdb').html(v['jdb'])
                $('#ndb').html('Rp. '+v['ndb'])
                $('#jndb').html(v['jndb'])
                $('#nndb').html('Rp. '+v['nndb'])
                pertumbuhan_perdagangan(v['v_grafik'],'#grafik-laba-dagang')
                distribusi(v['v_grafik2'],'#grafik-distribusi', v['y'])
                non_distribusi(v['v_grafik3'],'#grafik-non-distribusi', v['y'])
            }
        })
    })
    
    $('#gov-sewa').submit(function(e){
        e.preventDefault()
        const form = $(this).serialize()
        history.pushState("","",'?'+form)
        $.ajax({
            url:$(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(v){
                $('#jpn').html(v['jpn'])
                $('#tps').html('Rp. '+v['tps'])
                $('.g-tahun').html('Tahun '+v['y'])
                penyewaan(v['v_grafik'],'#grafik_penyewaan')
            }
        })
    })
    
    $('#gov-fin').submit(function(e){
        e.preventDefault()
        const form = $(this).serialize()
        history.pushState("","",'?'+form)
        $.ajax({
            url:$(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(v){
                $('#dbw').html('Rp. '+v['dkw_d'])
                $('#kdw').html('Rp. '+v['dkw_k'])
                $('#dbm').html('Rp. '+v['dkm_d'])
                $('#kdm').html('Rp. '+v['dkm_k'])
                $('#dby').html('Rp. '+v['dky_d'])
                $('#kdy').html('Rp. '+v['dky_k'])
                $('#ig_w').html(v['nb']+' '+v['y'])
                $('#ig_m').html('Tahun '+v['y'])
                keuangan_mingguan(v['gf_w'],'#grafik_keuangan_mingguan')
                keuangan_bulanan(v['gf_m'],'#grafik_keuangan_bulanan')
                keuangan_tahunan(v['gf_y'],'#grafik_keuangan_tahunan')
            }
        })
    })
})