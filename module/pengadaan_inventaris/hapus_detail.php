<?php error_reporting(0);?>
<?php
 require_once('../../Connections/koneksi.php'); 

$kode	= $_POST['kode'];
$id		= $_POST['id'];

$query	= "SELECT CONCAT(kode_pengadaan,kode_suplier,kode_barang) as kode 
					FROM pengadaan 
					WHERE CONCAT(kode_pengadaan,kode_suplier,kode_barang)= '$id'";
$sql 	= mysql_query($query);
$row	= mysql_num_rows($sql);
if ($row>0){
	$input = "DELETE FROM pengadaan  WHERE CONCAT(kode_pengadaan,kode_suplier,kode_barang)= '$id'";
	mysql_query($input);
	echo "<div class=\"alert success\"><span class=\"hide\">x</span><strong>Berhasil</strong> Data telah dihapus.</div>";
}else{
	echo "<div class=\"alert error\"><span class=\"hide\">x</span><strong>Gagal</strong> Data gagal dihapus.<br />".mysql_error().".</div>";
}
//echo $query."<br>".$input;
?>