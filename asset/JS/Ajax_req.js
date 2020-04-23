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
                if (v['ses']=='Ok') {
                    $('#val-body').html(v['tabel']['val'])
                    $('.pgn-cust').html(v['tabel']['paginasi'])
                    $('#info-belanja').html('Rp. '+v['row'])
                    let link = $('a[href|=unduh]').attr('href').split('?')
                    $('a[href|=unduh]').attr('href',link[0]+'?'+form)
                    pembelian_logistik(v['grafik'],'#grafik_pembelian_logistik', v['tahun'])
                }else if(v['ses']=='OUT'){

                }
                // alert(v['row'].hg)
                // window.location.href=document.referrer
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
                if (v['ses']=='Ok') {
                    $('#val-body').html(v['tabel']['value'])
                    $('#info-distribusi').html('Rp. '+v['row'])
                    $('.pgn-cust').html(v['tabel']['paginasi'])
                    let link = $('a[href|=unduh]').attr('href').split('?')
                    $('a[href|=unduh]').attr('href',link[0]+'?'+form)
                }else{
                    
                }
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
                if (v['ses']=='Ok') {
                    $('#val-body').html(v['tabel']['value'])
                    $('.pgn-cust').html(v['tabel']['paginasi'])
                    $('#nilai-dist').html('Rp. '+v['row'])
                    const link = $('a[href|=unduh]').attr('href').split('?')
                    $('a[href|=unduh]').attr('href',link[0]+'?'+form)
                    distribusi(v['grafik'],'#distribusi',v['tahun']);
                    non_distribusi(v['grafik2'],'#non-distribusi', v['tahun']);
                }
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
    
    $('#log-admin').submit(function(e){
        e.preventDefault()
        const form = $(this).serialize()
        history.pushState("","",'?'+form)
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

    //request based on index/paginasi
    $('.pgn-cust').on('click','button',function(){
        // alert($(this).val())
        // return false;
        const aktif = $(this).closest('.pgn-cust').find('.active')//button yang berwarna
        let nomor_limit = $(this).closest('.pgn-cust').find('.limit-number').val() //nilai button angka yang terpilih
        nomor_limit = parseInt(nomor_limit)
        let val = $(this).val()//nilai button yang terpilih
        const form = $('.form-filter')//ambil nilai dari form
        const limit = $('#limit').val() //nilai limit dari form
        let nomor_akhir = $('.pgn-cust button:last-child').val() //nilai button terakhir
        nomor_akhir = parseInt(nomor_akhir)
        if (val=='prev') {//tombol sebelumnya
            if (nomor_limit!=0) {
                val = nomor_limit-limit
            }else{
                return false
            }
        }else if (val=='next') {//tombol selanjutnya
            if (nomor_akhir>nomor_limit) {
                val = nomor_limit+limit
            }else{
                return false
            }
        }else if (val=='...'||aktif==val&&(val!='next'||val!='prev')) {//tombol ...
            return false;
        }else{//tombol angkan
            if (val==nomor_limit) {
                return false
                // console.log(val+' '+nomor_limit+' '+nomor_akhir)
            }else{
                $(this).closest('.pgn-cust').find('button').removeClass('limit-number')
                $(this).addClass('limit-number')
                // console.log(val+' '+nomor_limit+' '+nomor_akhir)
            }
            
        }

        $.ajax({
            url: form.attr('action'),
            data: form.serialize()+'&offset='+val,
            type: form.attr('method'),
            dataType: 'json',
            success: function(v){
                if (v['ses']=='Ok') {
                    $('#val-body').html(v['tabel']['val'])
                }else if(v['ses']=='OUT'){

                }
            }
        })
        $(this).closest('.pgn-cust').find('.active').removeClass('active')
        $(this).addClass('active')
    })
})