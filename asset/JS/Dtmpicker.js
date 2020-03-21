
$(document).ready(function(){
    const minDate = moment().subtract(7, 'days').millisecond(0).second(0).minute(0).hour(0)
    const maxDate = moment().add(1, 'days').millisecond(0).second(0).minute(0).hour(0)
    $('.tanggal_new').datetimepicker({
      ignoreReadonly: true,
      format: 'DD-MM-YYYY',
      maxDate: maxDate,
      minDate: minDate
      //allowInputToggle: true
    });
    
    let tanggal = $('#tanggal_edit').val()
    // alert()
    if (typeof(tanggal)!='undefined') {
        tanggal = tanggal.split('-')
        tanggal = tanggal[2]+'-'+tanggal[1]+'-'+tanggal[0]
        // alert(tanggal)
        const minDate2 = moment(tanggal).subtract(7, 'days').millisecond(0).second(0).minute(0).hour(0)
        const maxDate2 = moment(new Date()).add(1, 'days').millisecond(0).second(0).minute(0).hour(0)
        $('.tanggal_edit').datetimepicker({
          ignoreReadonly: true,
          format: 'DD-MM-YYYY',
          maxDate: maxDate2,
          minDate: minDate2
          //allowInputToggle: true
        });
    }
  })