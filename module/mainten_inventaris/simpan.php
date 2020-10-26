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
if (isset($_POST['kode_barang'])) {
  $colname_rs_cek = $_POST['kode_barang'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_rs_cek = sprintf("SELECT kode_barang, masa_servis FROM aset WHERE kode_barang = %s", GetSQLValueString($colname_rs_cek, "text"));
$rs_cek = mysql_query($query_rs_cek, $koneksi) or die(mysql_error());
$row_rs_cek = mysql_fetch_assoc($rs_cek);
$totalRows_rs_cek = mysql_num_rows($rs_cek);




$date= $_POST['tgl_servis'];
$durasi= $row_rs_cek['masa_servis'];
$next=mktime(0,0,0,date("m")+$durasi,date("d"),date("Y"));
$servis_berikut = date("Y-m-d",$next);

$masa_servis = $row_rs_cek["masa_servis"];
if (($masa_servis <= 0) or (!$masa_servis)) {
	$pesan = '<div class="alert error"><span class="hide">x</span><strong>Gagal.</strong> Barang yang anda pilih tidak mempunyai masa servis.<br />' ; 
	

	}else {

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form")) {
  $insertSQL = sprintf("INSERT INTO maintenance (kode_inventarisasi, tgl_servis, tgl_servis_berikutnya, tempat_servis, keluhan, keterangan_pem, tgl_posting, user_posting, biaya_servis) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['kode_inventarisasi'], "text"),
                       GetSQLValueString($_POST['tgl_servis'], "date"),
                       GetSQLValueString($servis_berikut, "date"),
                       GetSQLValueString($_POST['tempat_servis'], "text"),
                       GetSQLValueString($_POST['keluhan'], "text"),
                       GetSQLValueString($_POST['keterangan_pem'], "text"),
                       GetSQLValueString($_POST['tgl_posting'], "date"),
                       GetSQLValueString($_POST['user_posting'], "text"),
                       GetSQLValueString($_POST['biaya_servis'], "double"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());

  
    if ($Result1) {
	  $pesan = '<div class="alert success"><span class="hide">x</span><strong>Berhasil</strong> Data telah disimpan.</div>' ;
	  ?><script>kosong();alert('data berhasil disimpan'); </script><?php
	  }
	 else {
		 $pesan = '<div class="alert error"><span class="hide">x</span><strong>Gagal</strong> Data gagal disimpan.<br />'.mysql_error().'.</div>' ; 


		 }
}

	}
?>

 <div class="grid_12">
<?php echo $pesan ?>
<?php echo $jml ?>

</div>
<?php
mysql_free_result($rs_cek);
?>
