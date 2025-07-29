<?php
    $nama = $_POST['namap'];
    $gol = $_POST['golp'];
    $trans = $_POST['transp'];
    $minta = $_POST['mintap'];
    $sampel = $_POST['sampelp'];
    ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Agenda Donor</title>

    <!-- Bootstrap core CSS -->
    <link href="jadwaltpk/assets/bootstrap.css" rel="stylesheet">
    <link href="jadwaltpk/assets/fullcalendar.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <script src="jadwaltpk/assets/jquery.min.js"></script>
    <script src="jadwaltpk/assets/jquery-ui.min.js"></script>
    <script src="jadwaltpk/assets/moment.min.js"></script>
    <script src="jadwaltpk/assets/fullcalendar.min.js"></script>
  </head>

  <body>
      <br>
<h6 class="text-center">PENJADWALAN DONOR APHERESIS <br><?php echo $nama;?> | No. Form : <?php echo $trans;?> | ID. Permintaan : <?php echo $minta;?></h6>
      <br>

      <div class="container">
        <div id="calendar"></div>
      </div>

      <script>
        //Persiapan jquery
        $(document).ready(function(){
          var calendar = $('#calendar').fullCalendar({
            //izinkan tabel bisa diedit
            editable: true,
            //atur header kalendar
            header:{
              left : 'prev,next today',
              center : 'title',
              right : 'month, agendaWeek, agendaDay'
            },
            //tampilkan data dari database
            events : 'jadwaltpk/tampil.php',
            //izinkan tabel/ kalender bisa dipilih/editable
            selectable : true,
            selectHelper : true,
            select: function(start, end, allDay){
              //tampilkan pesan input
              var title = prompt("Masukan Judul Kegiatan","<?php echo $nama;?>" );
              
              if(title){
                //tampung tgl yang dipilih ke dalam variable start dan end_event
                var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                var trans = "<?php echo $trans;?>";
                var gol = "<?php echo $gol;?>";
                var pasien = "<?php echo $minta;?>";
                var sampel = "<?php echo $sampel;?>";
                //perintah ajax lempar data utk simpan
                $.ajax({
                  url :"jadwaltpk/simpan.php",
                  type : "POST",
                  data : {
                    title : title,
                    start : start,
                    end : end,
                    gol : gol,
                    trans : trans,
                    pasien : pasien,
                    sampel : sampel
                  },
                  success : function(){
                    //jika simpan sukses refresh kalender dan tampilkan Persiapan
                    calendar.fullCalendar('refetchEvents');
                    alert('Simpan Jadwal Donor Suksesss....!');

                  }
                });
              }
            },
            //event ketika edit data (seret jadwal)
            eventDrop : function(event){
              var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
              var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
              var title = event.title;
              var id = event.id;

              //ajax
              $.ajax({
                url :"jadwaltpk/ubah.php",
                type : "POST",
                data : {
                  title : title,
                  start : start,
                  end : end,
                  id : id
                },
                success : function(){
                  //jika simpan sukses refresh kalender dan tampilkan Persiapan
                  calendar.fullCalendar('refetchEvents');
                  alert('Edit Jadwal Donor Suksesss....!');

                }
              });
            },
            //event judul klik
            eventClick : function(event){
              if(confirm("Hapus data penjadwalan ?")){
              var id = event.id;
              //perintah ajax
              //ajax
              $.ajax({
                url :"jadwaltpk/hapus.php",
                type : "POST",
                data : {
                  id : id
                },
                success : function(){
                  //jika simpan sukses refresh kalender dan tampilkan Persiapan
                  calendar.fullCalendar('refetchEvents');
                  alert('Hapus Jadwal Suksesss....!');

                }
              });
              }
            }
          });
        });
      </script>


  </body>
</html>
