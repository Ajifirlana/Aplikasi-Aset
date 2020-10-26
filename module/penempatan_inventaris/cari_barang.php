
<?php error_reporting(0);?>
<?php
require_once('../../Connections/koneksi.php'); 
$kode	= $_POST['kode'];
$nm_barang	= $_POST['nm_barang'];
$text	= "SELECT *
			FROM tampil_inventarisasi_cari_brg WHERE kode_barang= '$kode'";
$sql 	= mysql_query($text);
$row	= mysql_num_rows($sql);
if ($row>0){
while ($r=mysql_fetch_array($sql)){	
	$data['kode_barang'] = $r[kode_barang] ;
	$data['nm_barang']				= $r[nm_barang];
	$data['id_pengadaan']			= $r[id_pengadaan];
	$data['kode_cabang']			= $r[kode_cabang];
	$data['sisa_jumlah']			= $r[sisa_jumlah];
	$data['kode_pengadaan']			= $r[kode_pengadaan];
	

	echo json_encode($data);
}
}else{
	$data['nm_barang']	= '';
	$data['id_pengadaan']			= '';
	$data['kode_cabang']			= '';
	$data['sisa_jumlah']			= '';
	
	echo json_encode($data);
	
}

?>