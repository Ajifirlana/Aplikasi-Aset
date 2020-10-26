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
$query_rs_combo = "SELECT kode_golongan, nm_golongan FROM golongan ORDER BY nm_golongan ASC";
$rs_combo = mysql_query($query_rs_combo, $koneksi) or die(mysql_error());
$row_rs_combo = mysql_fetch_assoc($rs_combo);
$totalRows_rs_combo = mysql_num_rows($rs_combo);

$colname_rs_edit = "-1";
if (isset($_GET['sub_golongan'])) {
  $colname_rs_edit = $_GET['sub_golongan'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_rs_edit = sprintf("SELECT * FROM tampil_subgolongan WHERE sub_golongan = %s", GetSQLValueString($colname_rs_edit, "text"));
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
  $updateSQL = sprintf("UPDATE subgolongan SET kode_golongan=%s, nm_subgolongan=%s, tgl_posting=%s, user_posting=%s WHERE sub_golongan=%s",
                       GetSQLValueString($_POST['kode_golongan'], "text"),
                       GetSQLValueString($_POST['nm_subgolongan'], "text"),
                       GetSQLValueString($_POST['tgl_posting'], "date"),
                       GetSQLValueString($_POST['user_posting'], "text"),
                       GetSQLValueString($_POST['sub_golongan'], "text"));

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
<div class=grid_12> 
   <br/>
<a href='?mod=subgolongan' class='button red'>
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
      <h1>Tambah Sub Golongan </h1>
      <span></span> </div>
      
    <form action="<?php echo $editFormAction; ?>" name="form"  method="POST" enctype="multipart/form-data" class="block-content form">
      <div class="_25">
        <p>
          <label for="nm_barang">Kode  </label>
          <input name="sub_golongan" type="text" class="required" id="textfield2" value="<?php echo $row_rs_edit['sub_golongan']; ?>" readonly="readonly" />
        </p>
      </div>
      <div class="_100">
        <p>
          <label for="textarea">Golongan	</label>
          <select name="kode_golongan" id="kode_golongan">
            <option>--Pilih Jenis--</option>
            <?php do { ?>
            <option value="<?php echo $row_rs_combo['kode_golongan']; ?>" 
             <?php if ($row_rs_combo['kode_golongan']== $row_rs_edit['kode_golongan']) {echo "selected=\"selected\"";} ?>
			><?php echo $row_rs_combo['nm_golongan']; ?></option>
            <?php } while ($row_rs_combo = mysql_fetch_assoc($rs_combo)); ?>
          </select>
        </p>
      </div>
      <div class="_100">
        <p>
          <label for="file">Nama Sub Golongan</label>
          <label for="merk"></label>
          <input name="nm_subgolongan" type="text" id="merk" value="<?php echo $row_rs_edit['nm_subgolongan']; ?>" />
        </p>
      </div>
      <div class="clear"></div>
      <div class="block-actions">
        <ul class="actions-left">
          <li><a class="button red"  href="?mod=subgolongan">Kembali</a></li>
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
mysql_free_result($rs_combo);

mysql_free_result($rs_edit);
?>
