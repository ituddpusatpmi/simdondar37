<?php
include ('dbi_connect.php');
$sql="SELECT DATE_FORMAT(tgl,'%y') as tahun, ELT(MONTH(Tgl), 'JAN','FEB','MAR', 'APR','MEI','JUN', 'JUL', 'AGT', 'SEP','OKT','NOV','DES') As Bulan, 
      COUNT(case when JenisDonor=0 THEN 1 END) As DS, COUNT(case when JenisDonor=1 THEN 1 END) As DP
      from htransaksi 
      where (cast(`Tgl` as date) >= (now() - interval 12 month))
      and (Pengambilan='0' or Pengambilan='2') 
      group by year(tgl),month(Tgl)";
$tahun=date("y");

?>            
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.js"></script>
<canvas id="myChart" width="100%" height="100%"></canvas>
        <script>
            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [<?php $query  = mysqli_query($dbi,$sql);  while ($b = mysqli_fetch_array($query)) {if ($b['tahun']==$tahun){echo '"' . $b['Bulan'].' '.$b['tahun'] . '",';}}?>],
                    datasets: [
                                {
                                    label: 'DS',
                                    data: [<?php $query = mysqli_query($dbi,$sql);  while ($p = mysqli_fetch_array($query)) {if ($p['tahun']==$tahun){ echo '"' . $p['DS'] . '",';}}?>],
                                    backgroundColor: 'rgba(255, 0, 0, 1)'
                                },
                                {
                                    label: 'DP',
                                    data: [<?php $query = mysqli_query($dbi,$sql);  while ($p = mysqli_fetch_array($query)) {if ($p['tahun']==$tahun){ echo '"' . $p['DP'] . '",';}}?>],
                                    backgroundColor: 'rgba(0, 0, 255,1)' // yellow
                                }
                                ]
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
                                    display: false, labelString: '1k = 1000'},
                                    stacked: true     
                            }],
                        xAxes: [{ stacked: true }]
                    }
                }
            });
        </script>
    </body>
</html>