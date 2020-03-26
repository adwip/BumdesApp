$(document).ready(function(){
    $('#edit-barang-masuk').submit(function(e){
        e.preventDefault()
        swal({title:"Lanjutkan menyimpan ?",buttons:['Batal','Lanjut'],closeOnClickOutside:false}).then((Ok) => {
            if (Ok) {
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(v){
                        if (v['resp']==200) {
                            $('#saldo').val('Rp. '+v['sld'])
                            swal({text:"Berhasil menyimpan",buttons: false,timer:3000,icon:"success"})
                        }else{
                            swal({text:"Gagal menyimpan",buttons: false,timer:3000,icon:"error"})
                        }
                    }
                })
            }
        })
    })

    $('#edit-barang-keluar').submit(function(e){
        e.preventDefault()
        const n_mitra = '&n_mit='+$('option:selected','#mitra').html();
        swal({title:"Lanjutkan menyimpan ?",buttons:['Batal','Lanjut'],closeOnClickOutside:false}).then((Ok) => {
            if (Ok) {
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize()+n_mitra,
                    dataType: 'json',
                    success: function(v){
                        if (v==200) {
                            swal({text:"Berhasil menyimpan",buttons: false,timer:3000,icon:"success"})
                        }else{
                            swal({text:"Gagal menyimpan",buttons: false,timer:3000,icon:"error"})
                        }
                    }
                })
            }
        })
    })

    $('#edit-penyewaan').submit(function(e){
        e.preventDefault()
        swal({title:"Lanjutkan menyimpan ?",buttons:['Batal','Lanjut'],closeOnClickOutside:false}).then((Ok) => {
            if (Ok) {
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(v){
                        if (v==200) {
                            swal({text:"Berhasil menyimpan",buttons: false,timer:3000,icon:"success"})
                        }else{
                            swal({text:"Gagal menyimpan",buttons: false,timer:3000,icon:"error"})
                        }
                    }
                })
            }
        })
    })

    $('#edit_aset_sewa').submit(function(e){
        e.preventDefault()
        swal({title:"Lanjutkan menyimpan ?",buttons:['Batal','Lanjut'],closeOnClickOutside:false}).then((Ok) => {
            if (Ok) {
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(v){
                        if (v==200) {
                            swal({text:"Berhasil menyimpan",buttons: false,timer:3000,icon:"success"})
                        }else{
                            swal({text:"Gagal menyimpan",buttons: false,timer:3000,icon:"error"})
                        }
                    }
                })
            }
        })
    })

    $('#edit-bagi-hasil').submit(function(e){
        e.preventDefault()
        swal({title:"Lanjutkan menyimpan ?",buttons:['Batal','Lanjut'],closeOnClickOutside:false}).then((Ok) => {
            if (Ok) {
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(v){
                        if (v==200) {
                            swal({text:"Berhasil menyimpan",buttons: false,timer:3000,icon:"success"})
                        }else{
                            swal({text:"Gagal menyimpan",buttons: false,timer:3000,icon:"error"})
                        }
                    }
                })
            }
        })
    })

    $('#edit-comp-asset').submit(function(e){
        e.preventDefault()
        const data = new FormData(this);
        swal({title:"Lanjutkan menyimpan ?",buttons:['Batal','Lanjut'],closeOnClickOutside:false}).then((Ok) => {
            if (Ok) {
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
                            swal({text:"Berhasil menyimpan",buttons: false,timer:3000,icon:"success"})
                            if (v[2]=='Change') {
                                $('#image-asset').attr('src',v[3])
                                $('#gan-fot').attr('disabled',false)
                            }else if(v[2]=='Del'){
                                $('#image-asset').attr('src',v[3])
                                $('#hid-img').val('')
                                $('#gan-fot').attr('checked',false)
                                $('#gan-fot').attr('disabled',true)
                            }
                        }else{
                            swal({text:"Gagal menyimpan",buttons: false,timer:3000,icon:"error"})
                        }
                    }
                })
            }
        })
    })

    $('#edit-arus-kas').submit(function(e){
        e.preventDefault()
        swal({title:"Lanjutkan menyimpan ?",buttons:['Batal','Lanjut'],closeOnClickOutside:false}).then((Ok) => {
            if (Ok) {
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(v){
                        if (v==200) {
                            swal({text:"Berhasil menyimpan",buttons: false,timer:3000,icon:"success"})
                        }else{
                            swal({text:"Gagal menyimpan",buttons: false,timer:3000,icon:"error"})
                        }
                    }
                })
            }
        })
    })

    $('#edit-rekanan').submit(function(e){
        e.preventDefault()
        swal({title:"Lanjutkan menyimpan ?",buttons:['Batal','Lanjut'],closeOnClickOutside:false}).then((Ok) => {
            if (Ok) {
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(v){
                        if (v==200) {
                            swal({text:"Berhasil menyimpan",buttons: false,timer:3000,icon:"success"})
                        }else{
                            swal({text:"Gagal menyimpan",buttons: false,timer:3000,icon:"error"})
                        }
                    }
                })
            }
        })
    })

    $('#edit-komoditas-dagang').submit(function(e){
        e.preventDefault()
        swal({title:"Lanjutkan menyimpan ?",buttons:['Batal','Lanjut'],closeOnClickOutside:false}).then((Ok) => {
            if (Ok) {
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(v){
                        if (v==200) {
                            swal({text:"Berhasil menyimpan",buttons: false,timer:3000,icon:"success"})
                        }else{
                            swal({text:"Gagal menyimpan",buttons: false,timer:3000,icon:"error"})
                        }
                    }
                })
            }
        })
    })

    $('#edit-bagi-dividen').submit(function(e){
        e.preventDefault()
        swal({title:"Lanjutkan menyimpan ?",buttons:['Batal','Lanjut'],closeOnClickOutside:false}).then((Ok) => {
            if (Ok) {
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(v){
                        if (v==200) {
                            swal({text:"Berhasil menyimpan",buttons: false,timer:3000,icon:"success"})
                        }else{
                            swal({text:"Gagal menyimpan",buttons: false,timer:3000,icon:"error"})
                        }
                    }
                })
            }
        })
    })

    $('#edit-pemb-bgh').submit(function(e){
        e.preventDefault()
        swal({title:"Lanjutkan menyimpan ?",buttons:['Batal','Lanjut'],closeOnClickOutside:false}).then((Ok) => {
            if (Ok) {
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(v){
                        if (v==200) {
                            swal({text:"Berhasil menyimpan",buttons: false,timer:3000,icon:"success"})
                        }else{
                            swal({text:"Gagal menyimpan",buttons: false,timer:3000,icon:"error"})
                        }
                    }
                })
            }
        })
    })
})