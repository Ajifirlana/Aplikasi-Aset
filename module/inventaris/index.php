<?php 

require_once('Connections/koneksi.php');

?>

  <?php
        include "phpqrcode/qrlib.php";

        $tempdir = "qrcode-img/";        // Nama folder untuk pemyimpanan file img qrcode
        
        if (!file_exists($tempdir))        //jika folder belum ada, maka buat
        mkdir($tempdir);
      ?>

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
$query_rs_aset = "SELECT * FROM aset ORDER BY nm_barang ASC";
$rs_aset = mysql_query($query_rs_aset, $koneksi) or die(mysql_error());
$row_rs_aset = mysql_fetch_assoc($rs_aset);
$totalRows_rs_aset = mysql_num_rows($rs_aset);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<!--tombol tambah -->
<div class=grid_12> 
   <br/>
   <a href='?mod=inventaris&amp;act=add' class='button'>
   <span>Tambahkan Inventaris</span>
   </a></div>

<!-- Data  -->
<div class="grid_12">
  <div class="block-border">
    <div class="block-header">
      <h1>Data Inventaris</em></em></h1>
      <span></span> </div>
    <div class="block-content">
      <table id="table-example" class="table" cellpadding="0" cellspacing="0" border="0">
        <thead>
          <tr> 
            <th>NO</th>
            <th>Kode Barcode</th>
            <th>Nama Aset</th>
            <th>Merk</th>
            <th>Tipe</th>
            <th>Tahun</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
         <?php $no = 1;?>
          <?php do { ?>
            <tr class=gradeX>
              <td><center><?php echo $no++ ?></center></td>
              <td style="padding: 10px;"><center><img src="qrcode-img/<?php echo $row_rs_aset ['kode_barang']; ?>" width="65px"></center></td>
              <td><?php echo $row_rs_aset['nm_barang']; ?></td>
              <td ><?php echo $row_rs_aset['merk']; ?></td>
              <td ><?php echo $row_rs_aset['tipe']; ?></td>
              <td  width="50"><center><?php echo $row_rs_aset['tahun']; ?></center></td>
              <td   width="90"><a href="?mod=inventaris&amp;act=detail&kode_barang=<?php echo $row_rs_aset['kode_barang']; ?>"><img src="img/icons/packs/silk/16x16/zoom.png" width="16" height="16" alt="Detail" title="Detail" /></a> | 
              <a href="?mod=inventaris&amp;act=edit&kode_barang=<?php echo $row_rs_aset['kode_barang']; ?>"><img src="img/icons/packs/silk/16x16/pencil.png" width="16" height="16" alt="Edit" title="Edit" /></a> | 
              <a href="?mod=inventaris&amp;act=delete&kode_barang=<?php echo $row_rs_aset['kode_barang']; ?>" onclick="return confirm('Hapus Data <?php echo $row_rs_aset['nm_barang']; ?> ')">
              <img src="img/icons/packs/silk/16x16/cross.png" width="16" height="16" alt="Hapus" title="Hapus" /></a></td>
            </tr>
            <?php } while ($row_rs_aset = mysql_fetch_assoc($rs_aset)); ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</body>
</html>
<?php
mysql_free_result($rs_aset);
?>
