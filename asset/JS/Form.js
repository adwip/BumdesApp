

$(document).ready(function(){
    $('#set-tambah-logistik').submit(function(e){
        e.preventDefault()
        swal({title:"Lanjutkan pengiriman data ?",buttons:['Batal','Lanjut'],closeOnClickOutside:false}).then((Ok) => {
            if (Ok) {
                const n_kom = '&n_kom='+$('option:selected','#komoditas').html();
                const sat = '&sat='+$('option:selected','#komoditas').attr('data-s2');
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize()+n_kom+sat,
                    dataType: 'json',
                    success: function(v){
                        if (v['resp']==200) {
                            reset_form()
                            $('#saldo').val('Rp. '+v['sld'])
                            swal({text:"Data terkirim",buttons: false,timer:3000,icon:"success"})
                        }else{
                            swal({text:"Data gagal terkirim",buttons: false,timer:3000,icon:"error"})
                        }
                    }
                })
            }
        })
    })

    $('#set-barang-keluar').submit(function(e){
        e.preventDefault()
        swal({title:"Lanjutkan pengiriman data ?",buttons:['Batal','Lanjut'],closeOnClickOutside:false}).then((Ok) => {
            if (Ok) {
                const n_kom = '&n_kom='+$('option:selected','#komoditas').html();
                const n_mitra = '&n_mit='+$('option:selected','#mitra').html();
                const sat = '&sat='+$('option:selected','#komoditas').attr('data-s2');
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize()+n_kom+sat+n_mitra,
                    dataType: 'json',
                    success: function(v){
                        if (v==200) {
                            reset_form()
                            swal({text:"Berhasil menyimpan",buttons: false,timer:3000,icon:"success"})
                        }else{
                            swal({text:"Gagal menyimpan",buttons: false,timer:3000,icon:"error"})
                        }
                    }
                })
            }
        })
    })

    $('#set-distribusi-barang').submit(function(e){
        e.preventDefault()
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(v){
                // alert(v['status'])
                // alert('Berhasil menginput '+v['msg'].length)
                // window.location.href=document.referrer
            }
        })
    })

    $('#set-tambah-komoditas').submit(function(e){
        e.preventDefault()
        swal({title:"Lanjutkan pengiriman data ?",buttons:['Batal','Lanjut'],closeOnClickOutside:false}).then((Ok) => {
            if (Ok) {
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(v){
                        if (v==200) {
                            reset_form()
                            swal({text:"Berhasil menyimpan",buttons: false,timer:3000,icon:"success"})
                        }else{
                            swal({text:"Gagal menyimpan",buttons: false,timer:3000,icon:"error"})
                        }
                    }
                })
            }
        })
    })

    $('#set-tambah-satuan').submit(function(e){
        e.preventDefault()
        swal({title:"Lanjutkan menambah ?",buttons:['Batal','Lanjut'],closeOnClickOutside:false}).then((Ok) => {
            if (Ok) {
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(v){
                        if (v==200) {
                            reset_form()
                            swal({text:"Berhasil menambahkan",buttons: false,timer:3000,icon:"success"})
                        }else{
                            swal({text:"Gagal menambahkan",buttons: false,timer:3000,icon:"error"})
                        }
                    }
                })
            }
        })
    })

    $('#set-tambah-penyewaan').submit(function(e){
        e.preventDefault()
        const n_aset = '&n_aset='+$('option:selected','#aset').html();
        swal({title:"Lanjutkan menyimpan ?",buttons:['Batal','Lanjut'],closeOnClickOutside:false}).then((Ok) => {
            if (Ok) {
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize()+n_aset,
                    dataType: 'json',
                    success: function(v){
                        if (v==200) {
                            reset_form()
                            swal({text:"Berhasil menyimpan",buttons: false,timer:3000,icon:"success"})
                        }else{
                            swal({text:"Gagal menyimpan",buttons: false,timer:3000,icon:"error"})
                        }
                    }
                })
            }
        })
    })

    $('#set-aset-sewaan').submit(function(e){
        e.preventDefault()
        const n_aset = '&n_aset='+$('option:selected','#tambah-aset-sewa').html();
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize()+n_aset,
            dataType: 'json',
            success: function(v){
                // alert(v['status'])
                // alert(v)
                // window.location.href=document.referrer
            }
        })
    })

    $('#set-bagi-hasil').submit(function(e){
        e.preventDefault()
        const n_mitra = '&n_mitra='+$('option:selected','#mitra').html();
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize()+n_mitra,
            dataType: 'json',
            success: function(v){
                // alert(v['status'])
                // alert(v)
                // window.location.href=document.referrer
            }
        })
    })

    $('#set-pemb-bgh').submit(function(e){
        e.preventDefault()
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(v){
                // alert(v['status'])
                // alert(v)
                // window.location.href=document.referrer
            }
        })
    })

    $('#set-aset-baru').submit(function(e){
        e.preventDefault()
        const data = new FormData(this);
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(v){
                v = v.split('|')
                // alert(v['status'])
                // alert(v)
                // window.location.href=document.referrer
            }
        })
    })

    $('#set-arus-kas').submit(function(e){
        e.preventDefault()
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(v){
                // alert(v['status'])
                // alert(v)
                // window.location.href=document.referrer
            }
        })
    })

    $('#set-mitra-baru').submit(function(e){
        e.preventDefault()
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(v){
                // alert(v['status'])
                // alert(v)
                // window.location.href=document.referrer
            }
        })
    })

    $('#set-user-baru').submit(function(e){
        e.preventDefault()
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(v){
                // alert(v['status'])
                // alert(v)
                // window.location.href=document.referrer
            }
        })
    })

    $('#set-bagi-dividen').submit(function(e){
        e.preventDefault()
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(v){
                // alert(v['status'])
                // alert(v)
                // window.location.href=document.referrer
            }
        })
    })

    /*========================================Edit form========================================= */
    $('#edit-barang-masuk').submit(function(e){
        e.preventDefault()
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(v){
                if (v['resp']==200) {
                    $('#saldo').val('Rp. '+v['sld'])
                }
            }
        })
    })

    $('#edit-barang-keluar').submit(function(e){
        e.preventDefault()
        const n_mitra = '&n_mit='+$('option:selected','#mitra').html();
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize()+n_mitra,
            dataType: 'json',
            success: function(v){
                // alert(v['status'])
                // alert(v)
                // window.location.href=document.referrer
            }
        })
    })

    $('#edit-penyewaan').submit(function(e){
        e.preventDefault()
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(v){
                // alert(v['status'])
                // alert(v)
                // window.location.href=document.referrer
            }
        })
    })

    $('#edit_aset_sewa').submit(function(e){
        e.preventDefault()
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(v){
                // alert(v['status'])
                // alert(v)
                // window.location.href=document.referrer
            }
        })
    })

    $('#edit-bagi-hasil').submit(function(e){
        e.preventDefault()
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(v){
                // alert(v['status'])
                // alert(v)
                // window.location.href=document.referrer
            }
        })
    })

    $('#edit-comp-asset').submit(function(e){
        e.preventDefault()
        const data = new FormData(this);
        // alert('Ok')
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(v){
                v = v.split('|')
                if (v[0]==200) {
                    if (v[2]=='Change') {
                        $('#image-asset').attr('src',v[3])
                        $('#gan-fot').attr('disabled',false)
                    }else if(v[2]=='Del'){
                        $('#image-asset').attr('src',v[3])
                        $('#hid-img').val('')
                        $('#gan-fot').attr('checked',false)
                        $('#gan-fot').attr('disabled',true)
                        // alert('Del')
                    }
                }
            }
        })
    })

    $('#edit-arus-kas').submit(function(e){
        e.preventDefault()
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(v){
                if (v['resp']==200) {
                    $('#saldo').val('Rp. '+v['b'])
                }
                // alert(v['status'])
                // alert(v)
                // window.location.href=document.referrer
            }
        })
    })

    $('#edit-rekanan').submit(function(e){
        e.preventDefault()
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(v){
                // alert(v['status'])
                // alert(v)
                // window.location.href=document.referrer
            }
        })
    })
    $('#edit-komoditas-dagang').submit(function(e){
        e.preventDefault()
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(v){
                // alert(v['status'])
                // alert(v)
                // window.location.href=document.referrer
            }
        })
    })

    $('#edit-bagi-dividen').submit(function(e){
        e.preventDefault()
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(v){
                // alert(v['status'])
                // alert(v)
                // window.location.href=document.referrer
            }
        })
    })

    $('tbody').on('click','.bayar',function(){
        const act = $(this).closest('tbody')
        const ent = $(this).closest('tr').find(' td:nth-child(2)').html()
        const harga = $(this).closest('tr').find(' td:nth-child(4)').html()
        const fin = $(this).closest('td').find('.fbut:checked').length//on('checked','.fbut').length
        swal({title:"Lanjutkan pembayaran ?",buttons:['Batal','Lanjut'],closeOnClickOutside:false}).then((Ok) => {
            if (Ok) {
                $.ajax({
                    url: act.attr('data-act2'),
                    type: act.attr('data-meth'),
                    data: 'id='+$(this).val()+'&nm='+ent+'&hg='+harga+'&fin='+fin+'&idm='+act.attr('data-mid'),
                    dataType: 'json',
                    success: function(v){
                        if (v==200) {
                            $('#val-body').html(v['html'])
                            swal({text:"Berhasil membayar",buttons: false,timer:3000,icon:"success"}).then(()=>{
                                window.location.reload()
                            })
                        }else{
                            swal({text:"Gagal membayar",buttons: false,timer:3000,icon:"error"})
                        }
                    }
                })
            }
        })
    })

    /*==================HAPUS==================================*/
    
    //Untuk menghapus
    $('tbody').on('click','.hapus',function(){
        const act = $(this).closest('tbody')
        const rem = $(this).closest('tr')
        const hb = $(this)
        let bt = 'membatalkan';
        swal({title:"Lanjutkan ?",dangerMode: true,button:'Lanjut'}).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: act.attr('data-act'),
                    type: act.attr('data-meth'),
                    data: 'id='+$(this).val()+'&nm='+rem.attr('data-nam'),
                    dataType: 'text',
                    success: function(v){
                        if (v==200) {
                            if (act.attr('data-act')!='hapus-bagi-hasil'||hb.html()=='Hapus') {
                                rem.remove()
                                bt = 'menghapus';
                            }else{
                                hb.closest('td').find('.btn').remove()
                            }
                            swal({text:"Berhasil "+bt,buttons: false,timer:3000,icon:"success"})
                        }else{
                            if (hb.html()=='Hapus') {
                                bt = 'menghapus'
                            }
                            swal({text:"Gagal "+bt,buttons: false,timer:3000,icon:"error"})
                        }
                    }
                })
            }
        })
        
    })
    // Untuk pembatalan pembayaran bagi hasil usaha
    $('tbody').on('click','.batal',function(){
        const act = $(this).closest('tbody')
        const rem = $(this).closest('tr')
        const html = $(this).closest('tr').find(' td:nth-child(2)').html()
        // alert(html)
        // return false
        const hb = $(this)
        let bt = 'membatalkan';
        swal({title:"Lanjutkan ?",dangerMode: true,button:'Lanjut'}).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: act.attr('data-act'),
                    type: act.attr('data-meth'),
                    data: 'id='+$(this).val()+'&nm='+rem.attr('data-nam')+'&ent='+html,
                    dataType: 'text',
                    success: function(v){
                        if (v==200) {
                            swal({text:"Berhasil membatalkan",buttons: false,timer:3000,icon:"success"}).then(()=>{
                                window.location.reload()
                            })
                        }else{
                            
                            swal({text:"Gagal membatalkan",buttons: false,timer:3000,icon:"error"})
                        }
                    }
                })
            }
        })
        
    })
    //Untuk pembatalan kerjasama bagi hasil 
    $('tbody').on('click','.batal2',function(){
        const act = $(this).closest('tbody')
        const rem = $(this).closest('tr')
        const html = $(this).closest('tr').find(' td:nth-child(2)').html()
        const hb = $(this)
        let bt = 'membatalkan';
        swal({title:"Lanjutkan ?",dangerMode: true,button:'Lanjut'}).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: act.attr('data-act'),
                    type: act.attr('data-meth'),
                    data: 'id='+$(this).val()+'&nm='+rem.attr('data-nam')+'&ent='+html,
                    dataType: 'text',
                    success: function(v){
                        if (v==200) {
                            swal({text:"Berhasil membatalkan",buttons: false,timer:3000,icon:"success"})
                        }else{
                            
                            swal({text:"Gagal membatalkan",buttons: false,timer:3000,icon:"error"})
                        }
                    }
                })
            }
        })
        
    })

})