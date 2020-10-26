<?php require_once('Connections/koneksi.php');  //require_once('../../Connections/koneksi.php');
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

 ?>
<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form")) {
  $updateSQL = sprintf("UPDATE penanggunjawab SET nm_penanggungjawab=%s, nm_kegiatan=%s WHERE id_penanggungjawab=%s",
                       GetSQLValueString($_POST['nm_penanggungjawab'], "text"),
					    GetSQLValueString($_POST['nm_kegiatan'], "text"),
                       GetSQLValueString($_POST['id_penanggungjawab'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
  if ($Result1) {
	  $pesan = '<div class="alert success"><span class="hide">x</span><strong>Berhasil</strong> Data telah diedit.</div>' ;
	  }
	 else {
		 $pesan = '<div class="alert error"><span class="hide">x</span><strong>Gagal</strong> Data gagal diedit.</div>';


		 }
}
$colname_rs_edit = "-1";
if (isset($_GET['id_penanggungjawab'])) {
  $colname_rs_edit = $_GET['id_penanggungjawab'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_rs_edit = sprintf("SELECT * FROM penanggunjawab WHERE id_penanggungjawab = %s", GetSQLValueString($colname_rs_edit, "int"));
$rs_edit = mysql_query($query_rs_edit, $koneksi) or die(mysql_error());
$row_rs_edit = mysql_fetch_assoc($rs_edit);
$totalRows_rs_edit = mysql_num_rows($rs_edit);


?>
<!--tombol tambah -->
<div class=grid_12> 
   <br/>
<a href='?mod=penanggung_jawab' class='button red'>
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
      <h1>Edit Penanggung Jawab</h1>
      <span></span> </div>
      
    <form action="<?php echo $editFormAction; ?>" name="form"  method="POST" enctype="multipart/form-data" class="block-content form">
      <div class="_50">
        <p>
          <label for="textarea">Nama Penanggung Jawab</label><input id="textfield" name="nm_penanggungjawab" class="required" type="text" value="<?php echo $row_rs_edit['nm_penanggungjawab']; ?>" />
        </p>
        <p>
          <label for="textarea2">Nama Kegiatan</label>
          <input id="textfield2" name="textfield" class="required" type="text" value="<?php echo $row_rs_edit['nm_kegiatan']; ?>" />
        </p>
      </div>
      <div class="clear"></div>

      <div class="block-actions">
        <ul class="actions-left">
          <li><a class="button red"  href="?mod=penanggung_jawab">Kembali</a></li>
        </ul>
        <ul class="actions-right">
          <li>
            <input type="submit" class="button" value="Simpan" />
          </li>
        </ul>
      </div>
      <input type="hidden" name="MM_insert" value="validate-form" />
      <input type="hidden" name="MM_insert" value="form" />
      <input type="hidden" name="tgl_posting" id="tgl_posting"  value="<?php echo date('Y-m-d'); ?>"/>
      <input type="hidden" name="MM_update" value="form" />
      <input name="id_penanggungjawab" type="hidden" id="id_penanggungjawab" value="<?php echo $row_rs_edit['id_penanggungjawab']; ?>" />
    </form>
  </div>
</div>
<?php
mysql_free_result($rs_edit);
?>
