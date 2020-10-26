<?php require_once('Connections/koneksi.php'); ?>
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
if (isset($_GET['id_pengadaan'])) {
  $colname_rs_cek = $_GET['id_pengadaan'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_rs_cek = sprintf("SELECT id_pengadaan FROM inventarisasi WHERE id_pengadaan = %s", GetSQLValueString($colname_rs_cek, "text"));
$rs_cek = mysql_query($query_rs_cek, $koneksi) or die(mysql_error());
$row_rs_cek = mysql_fetch_assoc($rs_cek);
$totalRows_rs_cek = mysql_num_rows($rs_cek);
if ($totalRows_rs_cek > 0 ){
	echo "<font color='#FF0000'>Tidak dapat menghapus data ini karena terkait dengan penempatan barang. </font><a href='?mod=pengadaan_inventaris'> Kembali</a>";
	exit();
	}
if ((isset($_GET['id_pengadaan'])) && ($_GET['id_pengadaan'] != "")) {
  $deleteSQL = sprintf("DELETE FROM pengadaan WHERE id_pengadaan=%s",
                       GetSQLValueString($_GET['id_pengadaan'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($deleteSQL, $koneksi) or die(mysql_error());
    if ($Result1){
	   ?><script>alert('Data berhasil dihapus');location.href='?mod=pengadaan_inventaris';</script>
<?php
	  }
 

}

mysql_free_result($rs_cek);
?>
