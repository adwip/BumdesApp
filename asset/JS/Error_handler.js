

$(document).ready(function() {

    $('#komoditas').change(function(){
        // alert('Change')
        const sat = $('option:selected',this).attr('data-s')
        $('#satuan').val(sat)
    })

    //Tambah barang/stok masuk
    $('.jenis').change(function(){
        if ($(this).val()!='Beli') {
            $('#cut-saldo').attr('disabled',true)
            $('#harga').attr('disabled',true)
        }else{
            $('#cut-saldo').attr('disabled',false)
            $('#harga').attr('disabled',false)
        }
    })
    

    $('#harga, #cut-saldo, .jenis').change(function(){
        const harga = parseInt($('#harga').val())
        const saldo = parseInt($('#saldo').val().replace('Rp. ','').replace(',','').replace(',',''))
        const jenis = $('.jenis:checked').val()
        if (harga>saldo&&$('#cut-saldo').is(":checked")&&jenis=='Beli') {
            $('button[type=submit]').attr('disabled',true)
            $('#warning').show()
            // alert('show')
        }else{
            $('button[type=submit]').attr('disabled',false)
            $('#warning').hide()
            // alert('hide'+' '+jenis)
        }
    })

    // Barang keluar/distribusi
    $('#komoditas').change(function(){
        // alert('Change')
        const sat = $('option:selected',this).attr('data-sk')
        $('#stok').val(sat)
    })

    $('.tujuan').change(function(){
        if ($(this).val()!='Distribusi') {
            $('#mitra').attr('disabled',true)
        }else{
            $('#mitra').attr('disabled',false)
        }
    })

    
    $('#jumlah, #komoditas').change(function(){
        const jumlah = parseFloat($('#jumlah').val())
        const stok = parseFloat($('#stok').val())
        if (jumlah>stok) {
            $('button[type=submit]').attr('disabled',true)
            // alert('lebih'+jumlah+' '+stok)
            $('#ov-val').show()
        }else{
            $('button[type=submit]').attr('disabled',false)
            // alert('kurang'+jumlah+' '+stok)
            $('#ov-val').hide()
        }
    })

    // Tambah jadwal sewa aset
    $('#aset, #jum_har').change(function(){
        // alert('Change')
        const harga = $('option:selected','#aset').attr('data-hg')
        if (harga!='') {
            $('#nominal').val('Rp. '+harga+' / hari')
            const jh = $('#jum_har').val()
            $('#harga').val(jh*harga.replace(',','').replace(',',''))
        }else{
            $('#nominal').val('')
            $('#harga').val('')
        }
    })

    // Tambah aset disewakan
    $('#tambah-aset-sewa').change(function(){
        const nomor = $('option:selected',this).attr('data-na')
        $('#nomor-aset').val(nomor)
    })

    //Tambah kerjasama bagi hasil aset
    $('.s-aset').change(function(){
        const nm = $(this).val()
        if (nm=='Internal') {
            $('#external').css('display','none');
            $('#external > input').attr('disabled',true);
            $('#internal').css('display','block');
            $('#internal > select').attr('disabled',false);
        }else{
            $('#internal').css('display','none');
            $('#internal > select').attr('disabled',true);
            $('#external').css('display','block');
            $('#external > input').attr('disabled',false);
        }
    })

    $('#pers-bumdes').keyup(function(){
        const nil = 100-parseInt($(this).val())
        if (nil>=0) {
            $('#pers-mitra').val(nil)
        }else{
            $('#pers-mitra').val(0)
        }
    })

    // Tambah aset
    $('.sumber').change(function(){
        const val = $(this).val()
        if (val=='Beli') {
            $('#cut-saldo, #harga').attr('disabled',false)
        }else{
            $('#cut-saldo, #harga').attr('disabled',true)
        }
    })

    // Catatan keuangan
    $('#jumlah-kas, .kas').change(function(){
        const harga = parseInt($('#jumlah-kas').val())
        const saldo = parseInt($('#saldo').val().replace('Rp. ','').replace(',','').replace(',',''))
        const jenis = $('.kas:checked').val()
        // alert(jenis)
        if (harga>saldo&&jenis=='OUT') {
            $('button[type=submit]').attr('disabled',true)
        }else{
            $('button[type=submit]').attr('disabled',false)
        }
    })

    // Penerimaan bagi hasil
    $('#plh-kjs, #nominal').change(function(){
        const b = $('option:selected','#plh-kjs').attr('data-b')
        const m = $('option:selected','#plh-kjs').attr('data-m')
        const n = $('#nominal').val()
        // alert(typeof n + typeof b)
        $('#pers-b').val(b+'%')
        $('#pers-m').val(m+'%')
        if (parseInt(n)>0) {
            $('#val-b').val(n*(b/100))
            $('#val-m').val(n*(m/100))
        }
    })

    $('.passwords2').keyup(function(){
        const p1 = $('.passwords').val()
        const p2 = $('.passwords2').val()

        if (p1!=p2) {
            $('.conf-pass').show()
            $('button[type=submit]').attr('disabled',true)
        }else{
            $('.conf-pass').hide()
            $('button[type=submit]').attr('disabled',false)
        }
    })

    //cek jadwal penyewaan
    $('#tanggal_sewa, #jum_har, #aset').on('dp.change change',function(){
        if ($('#aset').val()!=''&&$('#jum_har').val()!='') {
            $.ajax({
                url: $('#set-tambah-penyewaan').attr('data-cek'),
                data: $('#set-tambah-penyewaan').serialize(),
                type: 'POST',
                dataType: 'text',
                success:function(v){
                    if (v>0) {
                        $('button[type=submit]').attr('disabled',true)
                        $('#warning').show()
                    }else{
                        $('button[type=submit]').attr('disabled',false)
                        $('#warning').hide()
                    }
                }
            })
        }else{
            $('button[type=submit]').attr('disabled',false)
            $('#warning').hide()
        }
    })

    // $('#tanggal_sewa').on('#dp.change, change',function(){
    //     alert('Change')
    // })

})
