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

$colname_rs_detail = "-1";
if (isset($_GET['kode_pengadaan'])) {
  $colname_rs_detail = $_GET['kode_pengadaan'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_rs_detail = sprintf("SELECT * FROM tampil_pengadaan WHERE kode_pengadaan = %s", GetSQLValueString($colname_rs_detail, "text"));
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
 <a href='?mod=pengadaan_inventaris' class='button'>
   <span>Kembali</span>
   </a></div>

<!--Detail Data -->
<div class="grid_6">
  <div class="block-border">
    <div class="block-header">
      <h1> Data</h1>
      <span></span> </div>
    <div class="block-content">
      <ul class="block-list">
        <li>
          <table width="503"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="131" height="22">Kode Pengadaan</td>
              <td width="21">:</td>
              <td width="351"><?php echo $row_rs_detail['kode_pengadaan']; ?></td>
            </tr>
          </table>
        </li>
        <li>
          <table width="503"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="131" height="22">Tanggal Beli</td>
              <td width="21">:</td>
              <td width="351"><?php echo $row_rs_detail['tgl_beli']; ?></td>
            </tr>
          </table>
        </li>
        <li>
          <table width="503"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="131" height="22">User Posting</td>
              <td width="21">:</td>
              <td width="351"><?php echo $row_rs_detail['user_posting']; ?></td>
            </tr>
          </table>
        </li>
      </ul>
    </div>
  </div>
</div>
<div class="grid_12">
  <div class="block-border">
    <div class="block-header">
      <h1>Detail Data </h1>
      <span></span></div>
    <div class="block-content">
      <table id="table-example" class="table" cellpadding="0" cellspacing="0" border="0">
        <thead>
          <tr>
            <th>NO</th>
            <th>Kode Barang</th>
            <th>Barang</th>
            <th>Suplier</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>NO BPKB</th>
            <th>NO Faktur</th>
            <th>NO Polisi</th>
            <th>NO Sertfikat</th>
            <th>Subtotal</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;?>
          <?php do { ?>
          <tr class="gradeX">
            <td><center>
              <?php echo $no++ ?>
            </center></td>
            <td><center>
              <?php echo $row_rs_detail['kode_barang']; ?>
            </center></td>
            <td><?php echo $row_rs_detail['nm_barang']; ?></td>
            <td ><?php echo $row_rs_detail['nm_suplier']; ?></td>
            <td ><?php echo $row_rs_detail['jumlah']; ?></td>
            <td  width="80"><?php echo $row_rs_detail['harga_beli']; ?></td>
            <td  width="80"><?php echo $row_rs_detail['no_bpkb']; ?></td>
            <td  width="80"><?php echo $row_rs_detail['no_faktur']; ?></td>
            <td  width="80"><?php echo $row_rs_detail['no_polisi']; ?></td>
            <td  width="80"><?php echo $row_rs_detail['no_sertifikat']; ?></td>
            <td  width="50"><?php echo $row_rs_detail['harga_beli'] * $row_rs_detail['jumlah']; ?></td>
            </tr>
          <?php } while ($row_rs_detail = mysql_fetch_assoc($rs_detail)); ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</body>
</html>
<?php
mysql_free_result($rs_detail);
?>
