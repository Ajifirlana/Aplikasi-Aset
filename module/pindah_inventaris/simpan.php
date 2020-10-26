<?php require_once('../../Connections/koneksi.php'); ?>

<?php 
error_reporting(0);
// membaca kode suplier terbesar
$query = "SELECT MAX(kode_inventarisasi) as max FROM inventarisasi ";
$hasil = mysql_query($query);
$data  = mysql_fetch_array($hasil);
$kodeBarang = $data['max'];

// mengambil angka atau bilangan dalam kode anggota terbesar,
// dengan cara mengambil substring mulai dari karakter ke-1 diambil 6 karakter
// misal 'BRG001', akan diambil '001'
// setelah substring bilangan diambil lantas dicasting menjadi integer
$noUrut = (int) substr($kodeBarang, 21, 28);

// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
$noUrut++;

// membentuk kode anggota baru
// perintah sprintf("%03s", $noUrut); digunakan untuk memformat string sebanyak 3 karakter
// misal sprintf("%03s", 12); maka akan dihasilkan '012'
// atau misal sprintf("%03s", 1); maka akan dihasilkan string '001'
//$char = "SP";
$newID = sprintf("%07s", $noUrut);



$kode_inventarisasi_baru = $_POST[kode_cabang].'-'.$_POST[kode_barang].'-'.$_POST[ruang_baru].'-'.$_POST[unit_baru].'-'.$newID  ?>





<?php 
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_rs_cek = "-1";
if (isset($_POST['id_inventarisasi'])) {
  $colname_rs_cek = $_POST['id_inventarisasi'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_rs_cek = sprintf("SELECT id_inventarisasi, jumlah FROM tampil_mutasi_cari_brg WHERE id_inventarisasi = %s", GetSQLValueString($colname_rs_cek, "int"));
$rs_cek = mysql_query($query_rs_cek, $koneksi) or die(mysql_error());
$row_rs_cek = mysql_fetch_assoc($rs_cek);
$totalRows_rs_cek = mysql_num_rows($rs_cek);


if ($_POST['jumlah'] <= $row_rs_cek['jumlah'] ){

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form")) {
  $insertSQL = sprintf("INSERT INTO mutasi (tgl_mutasi, kode_cabang, kode_inventarisasi, kode_inventarisasi_baru, kode_aset, ruang_lama, ruang_baru, unit_lama, unit_baru, jumlah, user_posting, keterangan, id_inventarisasi) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['tgl_mutasi'], "date"),
                       GetSQLValueString($_POST['kode_cabang'], "text"),
                       GetSQLValueString($_POST['kode_inventarisasi'], "text"),
                       GetSQLValueString($kode_inventarisasi_baru, "text"),
					   GetSQLValueString($_POST['kode_barang'], "text"),
                       GetSQLValueString($_POST['ruang_lama'], "text"),
                       GetSQLValueString($_POST['ruang_baru'], "text"),
                       GetSQLValueString($_POST['unit_lama'], "int"),
                       GetSQLValueString($_POST['unit_baru'], "int"),
                       GetSQLValueString($_POST['jumlah'], "int"),
                       GetSQLValueString($_POST['user_posting'], "text"),
                       GetSQLValueString($_POST['keterangan'], "text"),
                       GetSQLValueString($_POST['id_inventarisasi'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) ;

  
    if ($Result1) {
	  $pesan = '<div class="alert success"><span class="hide">x</span><strong>Berhasil</strong> Data telah disimpan.</div>' ;
	  ?><script>kosong();alert('data berhasil disimpan'); </script><?php
	  }
	 else {
		 $pesan = '<div class="alert error"><span class="hide">x</span><strong>Gagal</strong> Data gagal disimipan.<br />'.mysql_error().'.</div>' ; 


		 }
}
}else {
		 $jml = '<div class="alert error"><span class="hide">x</span><strong> Proses Gagal.</strong> Jumlah tidak boleh melebihi jumlah asal<br /></div>' ;
	
	}
  

?>

 <div class="grid_12">
<?php echo $pesan ?>
<?php echo $jml ?>

</div>
<?php
mysql_free_result($rs_cek);
?>
