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

$colname_rs_edit = "-1";
if (isset($_GET['kode_harta'])) {
  $colname_rs_edit = $_GET['kode_harta'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_rs_edit = sprintf("SELECT * FROM harta_berwujud WHERE kode_harta = %s", GetSQLValueString($colname_rs_edit, "text"));
$rs_edit = mysql_query($query_rs_edit, $koneksi) or die(mysql_error());
$row_rs_edit = mysql_fetch_assoc($rs_edit);
$totalRows_rs_edit = mysql_num_rows($rs_edit);
 //require_once('../../Connections/koneksi.php'); ?>
<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form")) {
  $updateSQL = sprintf("UPDATE harta_berwujud SET nm_harta=%s, ket=%s, tgl_posting=%s, user_posting=%s WHERE kode_harta=%s",
                       GetSQLValueString($_POST['nm_harta'], "text"),
                       GetSQLValueString($_POST['ket'], "text"),
                       GetSQLValueString($_POST['tgl_posting'], "date"),
                       GetSQLValueString($_POST['user_posting'], "text"),
                       GetSQLValueString($_POST['kode_harta'], "text"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());


  if ($Result1) {
	  $pesan = '<div class="alert success"><span class="hide">x</span><strong>Berhasil</strong> Data telah disimpan.</div>' ;
	  }
	 else {
		 $pesan = '<div class="alert error"><span class="hide">x</span><strong>Gagal</strong> Data gagal disimipan.</div>';


		 }
}


?>
<!--tombol tambah -->
<script src="../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />

<div class=grid_12> 
   <br/>
<a href='?mod=jenisaset' class='button red'>
   <span>Kembali</span>
   </a></div>


<div class="grid_12">
<?php 
		  echo $pesan ;
		?>
</div>

<div class="grid_12">
  <div class="block-border">
    <div class="block-header">
      <h1>Edit Jenis Aset</h1>
      <span></span> </div>
      
    <form action="<?php echo $editFormAction; ?>" name="form"  method="POST" enctype="multipart/form-data" class="block-content form">
      <div class="_25">
        <p>
          <label for="nm_barang">Kode  </label>
          <input name="kode_harta" type="text" class="required" id="textfield2" value="<?php echo $row_rs_edit['kode_harta']; ?>" readonly="readonly" />
        </p>
      </div>
      <div class="_100">
        <p>
          <label for="textarea">Jenis Aset</label>
          <span id="sprytextfield1">
          <input id="textfield" name="nm_harta" class="required" type="text" value="<?php echo $row_rs_edit['nm_harta']; ?>" />
          <span class="textfieldRequiredMsg">Harus diisi</span></span></p>
      </div>
      <div class="_100">
        <p>
          <label for="file">Keterangan</label>
          <label for="merk"></label>
          <input name="ket" type="text" id="merk" value="<?php echo $row_rs_edit['ket']; ?>" />
        </p>
      </div>
      <div class="_50">
        <p>
          <label for="tipe"></label>
        </p>
      </div>
      <div class="_50">
        <p>
          <label for="tahun"></label>
        </p>
      </div>
      <div class="clear"></div>

      <div class="block-actions">
        <ul class="actions-left">
          <li><a class="button red"  href="?mod=inventaris">Kembali</a></li>
        </ul>
        <ul class="actions-right">
          <li>
            <input type="submit" class="button" value="Simpan" />
          </li>
        </ul>
      </div>
      <input type="hidden" name="MM_insert" value="validate-form" />
      <input type="hidden" name="MM_insert" value="form" />
      <input name="tgl_posting" type="hidden" id="tahun" value="<?php echo $row_rs_edit['tgl_posting']; ?>" />
      <input name="user_posting" type="hidden" id="tipe" value="<?php echo $row_rs_edit['user_posting']; ?>" />
      <input type="hidden" name="MM_update" value="form" />
    </form>
  </div>
</div>
<?php
mysql_free_result($rs_edit);
?>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
</script>
