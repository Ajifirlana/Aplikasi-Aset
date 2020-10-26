<?php require_once('../../Connections/koneksi.php'); ?>

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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form")) {
  $insertSQL = sprintf("INSERT INTO pengadaan (kode_pengadaan, kode_barang, kode_cabang, kode_suplier, no_polisi, no_bpkb, no_sertifikat, no_faktur, tgl_beli, harga_beli, jumlah, sisa_jumlah, user_posting, luas) VALUES (%s, %s, %s, %s,%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['kode_pengadaan'], "text"),
                       GetSQLValueString($_POST['kode_barang'], "text"),
					   GetSQLValueString($_POST['kode_cabang'], "text"),
                       GetSQLValueString($_POST['kode_suplier'], "text"),
                       GetSQLValueString($_POST['no_polisi'], "text"),
                       GetSQLValueString($_POST['no_bpkb'], "text"),
                       GetSQLValueString($_POST['no_sertifikat'], "text"),
                       GetSQLValueString($_POST['no_faktur'], "text"),
                       GetSQLValueString($_POST['tgl_beli'], "date"),
					   GetSQLValueString($_POST['harga_beli'], "int"),
                       GetSQLValueString($_POST['jumlah'], "int"),
					   GetSQLValueString($_POST['jumlah'], "int"),
                       GetSQLValueString($_POST['user_posting'], "text"),
                       GetSQLValueString($_POST['luas'], "text"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi);
  if ($Result1) {
	  $pesan = '<div class="alert success"><span class="hide">x</span><strong>Berhasil</strong> Data telah disimpan.</div>' ;
	  }
	 else {
		 $pesan = '<div class="alert error"><span class="hide">x</span><strong>Gagal</strong> Data gagal disimipan.<br />'.mysql_error().'.</div>' ;


		 }
}



?>
<div class="grid_6">
<?php echo $pesan; ?>
</div>
<?php include('tampil_data.php'); ?>