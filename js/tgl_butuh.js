// Datepicker
$(function(){
    $( "#butuh" ).datepicker({
    // minDate: "D",
    maxDate: "+4M",
    minYear: "Y",
    minYear: "+1Y",
    dateFormat: 'yy-mm-dd', 
    changeMonth: true,
    changeYear: true
    });
});
$(function () {
  $("#tgl_permintaan").datepicker({
    // minDate: "D",
    maxDate: "+4M",
    minYear: "Y",
    minYear: "+1Y",
    dateFormat: "yy-mm-dd",
    changeMonth: true,
    changeYear: true,
  });
});
                