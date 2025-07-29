
<?php
    include ('../config/db_connect.php');
if(!empty($_POST["keyword"])) {
$query =mysql_query("SELECT kode,namabrg,stoktotal,satuan FROM hstok where namabrg like '%" . $_POST["keyword"] . "%'");

if($query) {
?>
<ul id="country-list">
<?php
while ($country = mysql_fetch_assoc($query)) {
?>
<li onClick="selectCountry('<?php echo $country['kode']; ?>');"><?php echo $country['namabrg']; ?><br>Tersedia : <?php echo $country['stoktotal']." ".$country['satuan']; ?></li>
<?php } ?>
</ul>
<?php } } ?>

