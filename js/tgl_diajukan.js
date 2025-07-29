// Datepicker
$(function(){
    $( "#diajukan" ).datepicker({
    minDate: "D",
    maxDate: "+4M",
    minYear: "Y",
    minYear: "+1Y",
    dateFormat: 'yy-mm-dd', 
    changeMonth: true,
    changeYear: true
    });
});
                