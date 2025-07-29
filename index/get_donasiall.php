<?php
include ('dbi_connect.php');
$sql="SELECT DATE_FORMAT( tgl, '%y' ) AS tahun, ELT( MONTH( Tgl ) , 'JAN', 'FEB', 'MAR', 'APR', 'MEI', 'JUN', 'JUL', 'AGT', 'SEP', 'OKT', 'NOV', 'DES' ) AS Bulan, COUNT( NoTrans ) AS Donasi
    FROM htransaksi WHERE (cast( `Tgl` AS date ) >= ( now( ) - INTERVAL 11 MONTH )) AND ( Pengambilan = '0' OR Pengambilan = '2' ) GROUP BY year( tgl ) , month( Tgl )";
$tahun=date("y");

?>            

<script>
    var ctx = document.getElementById("chartdonasi");
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [<?php $query  = mysqli_query($dbi,$sql);  while ($b = mysqli_fetch_array($query)) {echo '"' . $b['Bulan'].' '.$b['tahun'] . '",';}?>],
            datasets: [
                        {
                            label: 'DONASI',
                            data: [<?php $query = mysqli_query($dbi,$sql);  while ($p = mysqli_fetch_array($query)) {echo '"' . $p['Donasi'] . '",';}?>],
                            backgroundColor: 'rgba(255, 0, 0, 1)'
                        }
                        ]
            },
        options: {
            legend: {display: false},
            title: {
                    display: true,text: 'Donasi per bulan',fontSize:22},
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                        ticks: {
                            callback: function(label, index, labels) {return label/1000+'k';},
                            beginAtZero: true
                            },
                        scaleLabel: { 
                            display: false, labelString: '1k = 1000'},
                            stacked: true     
                    }],
                xAxes: [{ stacked: true }]
            }
        }
    });
</script>
    