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


if (isset($_GET['kode_gedung'])) {
  $colname_rs_detail = $_GET['kode_gedung'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_rs_detail = sprintf("SELECT * FROM tampil_gedung WHERE kode_gedung = %s", GetSQLValueString($colname_rs_detail, "text"));
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
 <a href='?mod=gedung' class='button'>
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
              <td width="131" height="22">Kode Gedung</td>
              <td width="21">:</td>
              <td width="351"><?php echo $row_rs_detail['kode_gedung']; ?></td>
            </tr>
          </table>
        </li>
        <li>
          <table width="503"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="131" height="22">Nama Gedung</td>
              <td width="21">:</td>
              <td width="351"><?php echo $row_rs_detail['nm_gedung']; ?></td>
            </tr>
          </table>
        </li>
        <li>
          <table width="503"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="131" height="22">Tahun Pemerolehan</td>
              <td width="21">:</td>
              <td width="351"><?php echo $row_rs_detail['merk']; ?></td>
            </tr>
          </table>
        </li>
        <li>
          <table width="503"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="131" height="22">Sumber Dana</td>
              <td width="21">:</td>
              <td width="351"><?php echo $row_rs_detail['nm_dana']; ?></td>
            </tr>
          </table>
        </li>
        <li>
          <table width="503"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="131" height="22">Biaya Pembangunan/</td>
              <td width="21">:</td>
              <td width="351"><?php echo $row_rs_detail['biaya_pembangunan']; ?></td>
            </tr>
          </table>
        </li>
        <li>
          <table width="503"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="131" height="22">Luas Tanah</td>
              <td width="21">:</td>
              <td width="351"><?php echo $row_rs_detail['luas_tanah']; ?></td>
            </tr>
          </table>
        </li>
        <li>
          <table width="503"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="131" height="22">Luas Bangunan</td>
              <td width="21">:</td>
              <td width="351"><?php echo $row_rs_detail['luas_bangunan']; ?></td>
            </tr>
          </table>
        </li>
        <li>
          <table width="503"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="131" height="22">Umur Ekonomis</td>
              <td width="21">:</td>
              <td width="351"><?php echo $row_rs_detail['umur_ekonomis']; ?></td>
            </tr>
          </table>
        </li>
        <li>
          <table width="503"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="131" height="22">Umur Teknis</td>
              <td width="21">:</td>
              <td width="351"><?php echo $row_rs_detail['tgl_entry']; ?><?php echo $row_rs_detail['umur_teknis']; ?></td>
            </tr>
          </table>
        </li>
        <li>
          <table width="503"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="131" height="22">Sifat Bangunan</td>
              <td width="21">:</td>
              <td width="351"><?php echo $row_rs_detail['sifat_bangunan']; ?></td>
            </tr>
          </table>
        </li>
        <li>
          <table width="503"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="131" height="22">Peruntukan Bangunan</td>
              <td width="21">:</td>
              <td width="351"><?php echo $row_rs_detail['nm_peruntukan']; ?></td>
            </tr>
          </table>
        </li>
        <li>
          <table width="503"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="131" height="22">Kepemilikan</td>
              <td width="21">:</td>
              <td width="351"><?php echo $row_rs_detail['nm_kepemilikan']; ?></td>
            </tr>
          </table>
        </li>
        <li>
          <table width="503"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="131" height="22">Kondisi</td>
              <td width="21">:</td>
              <td width="351"><?php echo $row_rs_detail['nm_status']; ?></td>
            </tr>
          </table>
        </li>
        <li>
          <table width="503"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="131" height="22">Kampus</td>
              <td width="21">:</td>
              <td width="351"><?php echo $row_rs_detail['nm_cabang']; ?></td>
            </tr>
          </table>
        </li>
        <li>
          <table width="503"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="131" height="22">Penanggung Jawab</td>
              <td width="21">:</td>
              <td width="351"><?php echo $row_rs_detail['nm_penanggungjawab']; ?></td>
            </tr>
          </table>
        </li>
        <li>
          <table width="503"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="131" height="22">Tanggal Posting</td>
              <td width="21">:</td>
              <td width="351"><?php echo $row_rs_detail['tgl_posting']; ?></td>
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
      <p>&nbsp;</p>
      <p>&nbsp;</p>
    </div>
  </div>
</div>

<div class="grid_6">
  <div class="block-border">
    <div class="block-header">
      <h1>Gambar Denah</h1>
      <span></span></div>
    <div class="block-content">
      <ul class="block-list">
        <center><img src="img/denah/<?php echo $row_rs_detail['gambar_denah']; ?>"  width="400" height="390"/></center>
         
      </ul>
    </div>
  </div>
</div>

<div class="grid_6">
  <div class="block-border">
    <div class="block-header">
      <h1>Gambar Gedung</h1>
      <span></span></div>
    <div class="block-content">
      <ul class="block-list">
        <center><img src="img/gedung/<?php echo $row_rs_detail['gambar_bangunan']; ?>"  width="400" height="390"/></center>
         
      </ul>
    </div>
  </div>
</div>

</body>
</html>
<?php
mysql_free_result($rs_detail);
?>
