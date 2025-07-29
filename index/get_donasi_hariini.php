<?php
//include ('config/dbi_connect.php');
$data='';
$sql=mysqli_query($dbi,"SELECT
    COUNT(case when left(htransaksi.NoTrans,1)='M' THEN 1 END) As 'MU',
    COUNT(case when left(htransaksi.NoTrans,1)='D' THEN 1 END) As 'UDD'
    from htransaksi 
    where date(htransaksi.Tgl)=current_date and (htransaksi.Pengambilan='0' or htransaksi.Pengambilan='2') group by year(Tgl)");
$result=mysqli_fetch_assoc($sql);
$donor_mu = (isset($result['MU'])) ? $result['MU'] :0;
$donor_udd = (isset($result['UDD'])) ? $result['UDD'] :0;
$data ='
        <div class="card-text">Mobile Unit :<strong>'.number_format($donor_mu,'0',',','.').'</strong></div>
        <div class="card-text">Di UTD : <strong>'.number_format($donor_udd,'0',',','.').'</strong></div>';
echo $data;
?>