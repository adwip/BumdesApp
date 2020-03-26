$(document).ready(function(){

    //Menghapus daftar pembyaran bagi hasil
    $('.hapus-pbgh').click(function(){
        const act = $(this).closest('tbody')
        const rem = $(this).closest('tr')
        const mitra = $('#mitra').html()
        const aset = $('#aset').html()
        const id2 = act.attr('data-id')
        swal({title:"Lanjutkan menghapus ?",dangerMode: true,button:'Lanjut'}).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: act.attr('data-act'),
                    type: act.attr('data-meth'),
                    data: 'id='+$(this).val()+'&mitra='+mitra+'&aset='+aset+'&id2='+id2,
                    dataType: 'json',
                    success: function(v){
                        if (v['res']==200) {
                            $('').html('Rp. '+v['jl'])
                            $('').html('Rp. '+v['pnb'])
                            rem.remove()
                            swal({text:"Berhasil menghapus",buttons: false,timer:3000,icon:"success"})
                        }else{
                            swal({text:"Gagal menghapus",buttons: false,timer:3000,icon:"error"})
                        }
                    }
                })
            }
        })
    })
})