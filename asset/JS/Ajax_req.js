/*

      $('.myDatepicker2').datetimepicker({
        format: 'DD-MM-YYYY'
    });
*/
$(document).ready(function(){

    //Belanja barang/barang masuk
    
    $('#belanja-barang').submit(function(e){
        e.preventDefault()
        const form = $(this).serialize()
        history.pushState("","",'?'+form)
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(v){
                $('#val-body').html(v.tabel)
                $('#info-belanja').html('Rp. '+v.row)
                let link = $('a[href|=unduh]').attr('href').split('?')
                $('a[href|=unduh]').attr('href',link[0]+'?'+form)
                pembelian_logistik(v.grafik,'#grafik_pembelian_logistik')
                // alert(v['row'].hg)
                // window.location.href=document.referrer
                $('#datatable').dataTable()
            }
        })
    })

    //Barang keluar
    $('#barang-keluar').submit(function(e){
        e.preventDefault()
        const form = $(this).serialize()
        history.pushState("","",'?'+form)
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(v){
                $('#val-body').html(v.tabel)
                $('#info-distribusi').html('Rp. '+v.row)
                let link = $('a[href|=unduh]').attr('href').split('?')
                $('a[href|=unduh]').attr('href',link[0]+'?'+form)
                $('#datatable').dataTable()
            }
        })
    })

    //Distribusi barang
    $('#dis-barang').submit(function(e){
        e.preventDefault()
        const form = $(this).serialize()
        history.pushState("","",'?'+form)
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(v){
                $('#val-body').html(v.tabel)
                let link = $('a[href|=unduh]').attr('href').split('?')
                $('#nilai-dist').html('Rp. '+v.row)
                $('a[href|=unduh]').attr('href',link[0]+'?'+form)
                distribusi(v.grafik,'#distribusi');
                $('#datatable').dataTable()
            }
        })
    })

    //Penyewaan aset
    $('#sewa-aset').submit(function(e){
        e.preventDefault()
        const form = $(this).serialize()
        history.pushState("","",'?'+form)
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(v){
                $('#val-body').html(v.tabel)
                let link = $('a[href|=unduh]').attr('href').split('?')
                $('a[href|=unduh]').attr('href',link[0]+'?'+form)
                $('#datatable').dataTable()
            }
        })
    })

    //Bagi hasil
    $('#bagi-has').submit(function(e){
        e.preventDefault()
        const form = $(this).serialize()
        history.pushState("","",'?'+form)
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(v){
                $('#val-body').html(v.tabel)
                $('#pen-bgh').html('Rp. '+v.row)
                let link = $('a[href|=unduh]').attr('href').split('?')
                $('a[href|=unduh]').attr('href',link[0]+'?'+form)
                $('#datatable').dataTable()
            }
        })
    })
    
    //Keuangan mingguan,bulanan, tahunan
    $('#laporan-keuangan').submit(function(e){
        e.preventDefault()
        const form = $(this).serialize()
        history.pushState("","",'?'+form)
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(v){
                // $('#val-body').removeAttr('id')
                $('#val-body').html(v.tabel)
                if (v.kd[0].dbt!=null) {
                    $('#debit').html('Rp. '+v.kd[0].dbt)
                }else{
                    $('#debit').html('Rp. ')
                }
                if (v.kd[0].kdt!=null) {
                    $('#kredit').html('Rp. '+v.kd[0].kdt)
                }else{
                    $('#kredit').html('Rp. ')
                }
                let link = $('a[href|=unduh]').attr('href').split('?')
                $('a[href|=unduh]').attr('href',link[0]+'?'+form)
                keuangan_mingguan(v.grafik,'#grafik_keuangan_mingguan')
                keuangan_bulanan(v.grafik,'#grafik_keuangan_bulanan')
                keuangan_tahunan(v.grafik,'#grafik_keuangan_tahunan')
                // $('.table').attr('id','datatable')
                $('#datatable').DataTable()
                
            }
        })
    })

    // Get saldo dividen
    $('#tahun-dividen').change(function(){
        $.ajax({
            url:$(this).attr('data-link'),
            type:'GET',
            data:'tahun='+$(this).val(),
            dataType: 'text',
            success: function(v){
                v= v.replace(',','').replace(',','').replace(',','')
                $('#nilai-dividen').val(v)
                $('#datatable').dataTable()
            }
        })
    })
})