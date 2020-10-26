
<?php error_reporting(0);?>
<?php
require_once('../../Connections/koneksi.php'); 
$kode	= $_POST['kode'];
$text	= "SELECT *
			FROM aset WHERE kode_barang= '$kode'";
$sql 	= mysql_query($text);
$row	= mysql_num_rows($sql);
if ($row>0){
while ($r=mysql_fetch_array($sql)){	
	
	$data['nm_barang']	= $r[nm_barang];
	$data['merk']			= $r[merk];
	$data['tipe']			= $r[tipe];
	
	echo json_encode($data);
}
}else{
	$data['nm_barang']	= '';
	$data['merk']			= '';
	$data['tipe']		= '';

	echo json_encode($data);
	
}

?>