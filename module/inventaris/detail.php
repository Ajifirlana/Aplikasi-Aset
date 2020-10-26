<?php //require_once('../../Connections/koneksi.php'); ?>
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

mysql_select_db($database_koneksi, $koneksi);
$query_rs_detail = "SELECT * FROM tampil_inventaris ORDER BY nm_barang ASC";
$rs_detail = mysql_query($query_rs_detail, $koneksi) or die(mysql_error());
$row_rs_detail = mysql_fetch_assoc($rs_detail);
$totalRows_rs_detail = mysql_num_rows($rs_detail);
$colname_rs_detail = "-1";
if (isset($_GET['kode_barang'])) {
  $colname_rs_detail = $_GET['kode_barang'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_rs_detail = sprintf("SELECT * FROM tampil_inventaris WHERE kode_barang = %s ORDER BY nm_barang ASC", GetSQLValueString($colname_rs_detail, "text"));
$rs_detail = mysql_query($query_rs_detail, $koneksi) or die(mysql_error());
$row_rs_detail = mysql_fetch_assoc($rs_detail);
$totalRows_rs_detail = mysql_num_rows($rs_detail);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<!--tombol Kembali -->
<div class=grid_12> 
   <br/>
 <a href='?mod=inventaris' class='button'>
   <span>Kembali</span>
   </a></div>

<!--Detail Data -->
<div class="grid_6">
  <div class="block-border">
    <div class="block-header">
      <h1>Detail Data</h1>
      <span></span> </div>
    <div class="block-content">
      <ul class="block-list">
        <li>
          <table width="503"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="131" height="22">Kode Barang</td>
              <td width="21">:</td>
              <td width="351"><?php echo $row_rs_detail['kode_barang']; ?></td>
            </tr>
          </table>
        </li>
        <li>
          <table width="503"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="131" height="22">Nama Barang</td>
              <td width="21">:</td>
              <td width="351"><?php echo $row_rs_detail['nm_barang']; ?></td>
            </tr>
          </table>
        </li>
        <li>
          <table width="503"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="131" height="22">Merk</td>
              <td width="21">:</td>
              <td width="351"><?php echo $row_rs_detail['merk']; ?></td>
            </tr>
          </table>
        </li>
        <li>
          <table width="503"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="131" height="22">Tipe</td>
              <td width="21">:</td>
              <td width="351"><?php echo $row_rs_detail['tipe']; ?></td>
            </tr>
          </table>
        </li>
        <li>
          <table width="503"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="131" height="22">Tahun</td>
              <td width="21">:</td>
              <td width="351"><?php echo $row_rs_detail['tahun']; ?></td>
            </tr>
          </table>
        </li>
        <li>
          <table width="503"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="131" height="22">Volume</td>
              <td width="21">:</td>
              <td width="351"><?php echo $row_rs_detail['volume']; ?></td>
            </tr>
          </table>
        </li>
        <li>
          <table width="503"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="131" height="22">Total Unit</td>
              <td width="21">:</td>
              <td width="351"><?php echo $row_rs_detail['total_unit']; ?></td>
            </tr>
          </table>
        </li>
        <li>
          <table width="503"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="131" height="22">Masa Services</td>
              <td width="21">:</td>
              <td width="351"><?php echo $row_rs_detail['masa_servis']; ?></td>
            </tr>
          </table>
        </li>
        <li>
          <table width="503"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="131" height="22">Tanggal Entri</td>
              <td width="21">:</td>
              <td width="351"><?php echo $row_rs_detail['tgl_entry']; ?></td>
            </tr>
          </table>
        </li>
        <li>
          <table width="503"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="131" height="22">Golongan</td>
              <td width="21">:</td>
              <td width="351"><?php echo $row_rs_detail['nm_golongan']; ?></td>
            </tr>
          </table>
        </li>
        <li>
          <table width="503"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="131" height="22">Sub Golongan</td>
              <td width="21">:</td>
              <td width="351"><?php echo $row_rs_detail['nm_subgolongan']; ?></td>
            </tr>
          </table>
        </li>
      </ul>
    </div>
  </div>
</div>

<div class="grid_6">
  <div class="block-border">
    <div class="block-header">
      <h1>Gambar</h1>
      <span></span></div>
    <div class="block-content">
      <ul class="block-list">
        <center><img src="img/aset/<?php echo $row_rs_detail['poto']; ?>"  width="400" height="390"/></center>
         
      </ul>
    </div>

   
  </div>
</div>
<div class="grid_6">
  <div class="block-border">
    <div class="block-header">
      <h1>QR CODE</h1>
      <span></span></div>
    <div class="block-content">
      <ul class="block-list">
        <center><img src="qrcode-img/<?php echo $row_rs_detail['barcode']; ?>"  width="400" height="390"/></center>
         
      </ul>
    </div>

   
  </div>
</div>
</body>
</html>
<?php
mysql_free_result($rs_detail);
?>
