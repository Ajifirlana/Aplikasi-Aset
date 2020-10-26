<?php error_reporting(0);?>

<?php
//include "../../inc/inc.koneksi.php";
//include "../../inc/fungsi_tanggal.php";

$table		="pengadaan";

$kode		=$_POST[kode];
$tgl		=jin_date_sql($_POST[tgl]);
$supplier	=$_POST[supplier];
$kode_barang=$_POST[kode_barang];
$jumlah		=$_POST[jumlah];
$harga		=$_POST[harga];

         $kode_pengadaan	= $_POST['kode_pengadaan'];	
		 $kode_barang		= $_POST['kode_barang'];	
		 $kode_cabang		= $_POST['kode_cabang'];	
		 $kode_suplier		= $_POST['kode_suplier'];	
		 $no_polisi		    = $_POST['no_polisi'];	
		 $no_bpkb			= $_POST['no_bpkb'];	
		 $no_sertifikat		= $_POST['no_sertifikat'];	
		 $no_faktur			= $_POST['no_faktur'];	
		 $tgl_beli			= $_POST['tgl_beli'];	
		 $harga_beli		= $_POST['harga_beli'];	
		 $jumlah			= $_POST['jumlah'];	
		 $user_posting		= $_POST['user_posting'];	
		 $luas			    = $_POST['luas'];	

$sql = mysql_query("SELECT *
				   FROM $table 
				   WHERE kode_pengadaan= '$kode_pengadaan' AND kode_suplier='$kode_suplier' AND kode_barang='$kode_barang'");
$row	= mysql_num_rows($sql);
if ($row>0){
	$input	= "UPDATE $table SET jumlah	=$jumlah,
								harga_beli		=$harga,_beli
								tgl_beli		='$tgl_beli'
					WHERE kode_pengadaan= '$kode_pengadaan' AND kode_supplier='$kode_supplier' AND kode_barang='$kode_barang'";
	mysql_query($input);								
	echo "<label id='info'><b>Data Sukses diubah</b></label>";
}else{
	$input = "INSERT INTO $table (kode_beli,tgl_beli,kode_supplier,kode_barang,jumlah_beli,harga_beli)
				VALUES('$kode','$tgl','$supplier',
					   '$kode_barang','$jumlah','$harga')";
	mysql_query($input);
	echo "<label id='info'><b>Data sukses disimpan</b></label>";
}	
//echo $input."<br/>";
include "tampil_data.php";
?>