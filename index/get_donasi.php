<?php
include ('dbi_connect.php');
$sql="SELECT year(tgl) as tahun, ELT(MONTH(Tgl), 'JAN','FEB','MAR', 'APR','MEI','JUN', 'JUL', 'AGT', 'SEP','OKT','NOV','DES') As Bulan, 
      COUNT(KodePendonor) As `jml` 
      from htransaksi 
      where (cast(`Tgl` as date) >= (now() - interval 11 month))
      and (Pengambilan='0' or Pengambilan='2') 
      group by year(tgl),month(Tgl)";

?>            
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.js"></script>
<canvas id="myChart" width="100%" height="100%"></canvas>
        <script>
            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [<?php $query  = mysqli_query($dbi,$sql);  while ($b = mysqli_fetch_array($query)) {echo '"' . $b['Bulan'].' '.$b['tahun'] . '",';}?>],
                    datasets: [{
                            label: 'Donasi',
                            data: [<?php $query = mysqli_query($dbi,$sql);  while ($p = mysqli_fetch_array($query)) { echo '"' . $p['jml'] . '",';}?>],
                            backgroundColor: [
                                'rgba(255, 0, 0, 0.45)',
                                'rgba(255, 0, 0, 0.50)',
                                'rgba(255, 0, 0, 0.55)',
                                'rgba(255, 0, 0, 0.60)',
                                'rgba(255, 0, 0, 0.65)',
                                'rgba(255, 0, 0, 0.70)',
                                'rgba(255, 0, 0, 0.75)',
                                'rgba(255, 0, 0, 0.80)',
                                'rgba(255, 0, 0, 0.85)',
                                'rgba(255, 0, 0, 0.90)',
                                'rgba(255, 0, 0, 0.95)',
                                'rgba(255, 0, 0, 1)',
                            ],
                            borderWidth: 1
                        }]
                    },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        yAxes: [{
                                ticks: {
                                    callback: function(label, index, labels) {return label/1000+'k';},
                                    beginAtZero: true
                                    },
                                scaleLabel: { 
                                    display: false, labelString: '1k = 1000'}
                            }]
                    }
                }
            });
        </script>
    </body>
</html>