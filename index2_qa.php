			<font size="1"><a href="pmiqa.php?module=serahterima" target="isiadmin" class="fisheyeItem"><img src="images/serahterima1.png" />Serah Terima Kantong</a></font>
			<font size="1"><a href="pmiqa.php?module=release" target="isiadmin" class="fisheyeItem"><img src="images/qa_input.png" />Input Release</a></font><p>
			<font size="1"><a href="pmiqa.php?module=input_qa" target="isiadmin" class="fisheyeItem"><img src="images/qa.png" />Input Quality Assurance</a></font><p>
			<!--font size="1"><a href="pmiqa.php?module=serahterima" target="isiadmin" class="fisheyeItem"><img src="images/serahterima1.png" />Serah Terima Kantong</a></font-->
			<!--font size="1"><a href="pmiqa.php?module=qa_distribusi" target="isiadmin" class="fisheyeItem"><img src="images/distribusi_darah.png" />Distribusi Darah</a></font-->
			<font size="1"><a href="pmiqa.php?module=komponen_musnah" target="isiadmin" class="fisheyeItem"><img src="musnah/images/musnah_icon.png" />Pemusnahan Produk</a></font>
			<font size="1"><a href="pmiqa.php?module=qa_permintaan" target="isiadmin" class="fisheyeItem"><img src="images/stock2.png" />Permintaan QA</a></font>
			<font size="1"><a href="pmiqa.php?rstock=1" target="isiadmin" class="fisheyeItem"><img src="images/stok.png" />Check Stok</a></font>
			<font size="1"><a href="pmiqa.php?rstock=4" target="isiadmin" class="fisheyeItem"><img src="images/aftap2.png" />Check Kantong</a></font>
			<font size="1"><a href="pmiqa.php?module=ganti_passwd&act=edituser&id=<?=$_SESSION['namauser']?>" target="isiadmin" class="fisheyeItem"><img src="images/change_password.png" />Edit Profil</a></font>
<? if ($_SESSION[multilevel]!='') { ?>
			<font size="1"><a href="pmiqa.php?module=ganti_menu" target="isiadmin" class="fisheyeItem"><img src="images/multi.png" />Ganti Level</a></font>
<? } ?>
			<font size="1"><a href="javascript:logout();" class="fisheyeItem"><img src="images/out.png"/>Logout</a></font>
