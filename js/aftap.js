var reagen_kode = [];
var reagen_nama = [];
var n_kt = [];
var cle;

function clearForm() {
	document.getElementById('id_kantong11').value="";
	document.getElementById('id_kantong11').focus();
}

function detect(Event) {
  // Event appears to be passed by Mozilla
  // IE does not appear to pass it, so lets use global var
    if(Event==null) {
        alert('null');
        Event=event;
    }
    cle = Event.keyCode;
}

function chang(Event,quoi) {
    detect(Event);
    setTimeout('cle=""',100);
    if(cle=='13')
        while(quoi!=null) {
            check();
            quoi = quoi.nextSibling;
            if(quoi.tagName=='INPUT') {
                //focus(document.hasillab.nokantong);
                quoi=null;
            }
        }
}

function ok() {
    if(cle != '13'){
        return true;
    }
    else return false;
}

function check() {
    valid_darah0 = '0';
    var no_kantong = document.periksa.id_kantong11.value;
	no_kantong=no_kantong.toUpperCase();
        $.ajax({
            url: "json_cekkantong.php?NoKantong="+no_kantong,
            async: false,
            dataType: 'json',
            success: function(json) {
            valid_darah0 = json.kantong.valid;
        }
    });
	if (valid_darah0=='0'){
		clearForm();
                $( "#kantong_tdk_sesuai" ).dialog( "open" );
     
    }
}

$(function() {
		$( "#kantong_tdk_sesuai" ).dialog({
            autoOpen: false,
			height: 200,
			modal: true,
            hide: "explode"
		});
			$('select#speedA').selectmenu();
			
			$('select#speedAa').selectmenu({maxHeight: 150});
			
			$('select#speedB').selectmenu({
				width: 300,
				format: addressFormatting
			});
			
			$('select#speedC').selectmenu({style:'dropdown'});
			
			$('select#speedD').selectmenu({
				style:'dropdown', 
				menuWidth: 400,
				format: addressFormatting
			});
			
			$('select#files, select#filesC').selectmenu({
				icons: [
					{find: '.script', icon: 'ui-icon-script'},
					{find: '.image', icon: 'ui-icon-image'}
				]
			});
			
			$('select#filesB').selectmenu({
				icons: [
					{find: '.video'},
					{find: '.podcast'},
					{find: '.rss'}
				]
			});
	});

		//a custom format option callback
		var addressFormatting = function(text){
			var newText = text;
			//array of find replaces
			var findreps = [
				{find:/^([^\-]+) \- /g, rep: '<span class="ui-selectmenu-item-header">$1</span>'},
				{find:/([^\|><]+) \| /g, rep: '<span class="ui-selectmenu-item-content">$1</span>'},
				{find:/([^\|><\(\)]+) (\()/g, rep: '<span class="ui-selectmenu-item-content">$1</span>$2'},
				{find:/([^\|><\(\)]+)$/g, rep: '<span class="ui-selectmenu-item-content">$1</span>'},
				{find:/(\([^\|><]+\))$/g, rep: '<span class="ui-selectmenu-item-footer">$1</span>'}
			];
			
			for(var i in findreps){
				newText = newText.replace(findreps[i].find, findreps[i].rep);
			}
			return newText;
        }

