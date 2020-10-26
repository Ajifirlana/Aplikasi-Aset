
<?php error_reporting(0);?>
<?php
require_once('../../Connections/koneksi.php'); 
$kode	= $_POST['kode'];
$text	= "SELECT *
			FROM tampil_mutasi_cari_brg WHERE kode_barang= '$kode'";
$sql 	= mysql_query($text);
$row	= mysql_num_rows($sql);
if ($row>0){
while ($r=mysql_fetch_array($sql)){	
	$data['kode_barang'] 		= $r[kode_barang] ;
	$data['nm_barang']			= $r[nm_barang];
	$data['merk']				= $r[merk];
	$data['tipe']				= $r[tipe];
	$data['tgl_entry']			= $r[tgl_entry];
	$data['kode_ruangan']		= $r[kode_ruangan];
	$data['nm_ruangan']			= $r[nm_ruangan];
	$data['kode_unit']			= $r[kode_unit];
	$data['nm_unit']			= $r[nm_unit];
	$data['kode_inventarisasi']	= $r[kode_inventarisasi];
	$data['jumlah']			    = $r[jumlah];
	$data['id_inventarisasi']	= $r[id_inventarisasi];
	$data['kode_cabang']	= $r[kode_cabang];


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