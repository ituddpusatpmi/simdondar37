// Datepicker
$(function(){
    $( "#datepicker" ).datepicker({
    yearRange: '2008:2030',
    dateFormat: 'yy-mm-dd', 
    changeMonth: true,
    changeYear: true
    });
});
$(function(){
    $( "#datepicker1" ).datepicker({
    yearRange: '2008:2030',
    dateFormat: 'yy-mm-dd',
    changeMonth: true,
    changeYear: true
    });
});                
function Age(dt){
    var dt;
    var bday=dt.substr(8,2);
    var ibday=parseInt(bday);
    var byr=dt.substr(0,4);
    var ibyr=parseInt(byr);
    var bmo=dt.substr(5,2);
    var ibmo=parseInt(bmo)-1;
    var age;
    var now = new Date();
    tday=now.getDate();
    tmo=(now.getMonth());
    tyr=(now.getFullYear());
                      
    if((tmo > ibmo)||((tmo==ibmo) && (tday>=ibday))){
        age=ibyr
	}else{
        age=ibyr+1;
    }
    return tyr-age;
}
