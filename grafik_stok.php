<html>
    <head>
        <title>Stok Darah</title>
        <script src="Chartjs/Chart.bundle.js"></script>
        <style type="text/css">
            .container {
                width: 25%;
                margin: 15px auto;
            }
        </style>
    </head>
    <body>
	<?php include 'config/db_connect.php'; ?>
        <div class="container">
            <canvas id="myChart" width="100" height="100"></canvas>
        </div>
        <script>
            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ["A", "B", "O", "AB"],
                    datasets: [{
                            label: 'STOK SEHAT',
                            data: [	<?  $A=mysql_query("select * from stokkantong where status='2' and gol_darah='A' and (length(produk)>0) and kadaluwarsa > current_date and (produk is not null) and (stat2='0' or stat2 is null) and sah='1' and statKonfirmasi='1'"); echo mysql_num_rows($A);?>, 
					<?  $B=mysql_query("select * from stokkantong where status='2' and gol_darah='B' and (length(produk)>0) and kadaluwarsa > current_date and (produk is not null) and (stat2='0' or stat2 is null) and sah='1' and statKonfirmasi='1'"); echo mysql_num_rows($B);?>, 
					<?  $O=mysql_query("select * from stokkantong where status='2' and gol_darah='O' and (length(produk)>0) and kadaluwarsa > current_date and (produk is not null) and (stat2='0' or stat2 is null) and sah='1' and statKonfirmasi='1'"); echo mysql_num_rows($O);?>, 
					<?  $AB=mysql_query("select * from stokkantong where status='2' and gol_darah='AB' and (length(produk)>0) and kadaluwarsa > current_date and (produk is not null) and (stat2='0' or stat2 is null) and sah='1' and statKonfirmasi='1'"); echo mysql_num_rows($AB);?>],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)'
                               
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)'
                            ],
                            borderWidth: 1
                        }]
                },
                options: {
                    scales: {
                        yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                    }
                }
            });
        </script>
    </body>
</html>
