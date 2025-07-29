<?php
include ('../config/dbi_connect.php');
$query  = mysqli_query($dbi,"SELECT ELT(MONTH(Tgl), 'Januari','Februari','Maret', 'April','Mei','Juni', 'Juli', 'Agustus', 'September','Oktober','November','Desember') As Bulan,
            COUNT(KodePendonor) As `jml`
            from htransaksi where year(Tgl)='2020' and (Pengambilan='0' or Pengambilan='2') group by month(Tgl)");
            while($res = mysqli_fetch_array($query)){
                $bulan = $res['Bulan'];
                $jml= $res['jml'];
                $data .= '["'.$bulan.'",'.$jml.'],';
            }
            $data = substr($data,0,(strlen($data)-1));
            ?>
            <script type="text/javascript">
                //google.charts.load('current', {packages: ['columnchart']});
                //google.setOnLoadCallback(drawChart);
                google.charts.load('current', {
                    callback: function () {
                        drawChart();
                        $(window).resize(drawChart);
                    },
                    packages:['corechart']
                });
                function drawChart() {
                    var data = google.visualization.arrayToDataTable([['Bulan', 'Jumlah'],<?php echo $data;?>]);
                    var options = {'title':'',
                        chartArea: {
                            left: 0,
                            width: '100%',
                            height:'50vm'
                            },
                        legend: {
                            position: 'none'
                            },
                        width: '100%',
                        height:'50vh',
                        annotations: {alwaysOutside: true},
                        bar: {groupWidth: '90%'},
                        is3D: true,
                        titleY:'',
                        titleX:''
                    };
                    var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
                    chart.draw(data, options);
                };
            </script>

