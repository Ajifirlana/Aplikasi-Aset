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
$query_rs_cabang = "SELECT kode_cabang, nm_cabang FROM cabang ORDER BY kode_cabang ASC";
$rs_cabang = mysql_query($query_rs_cabang, $koneksi) or die(mysql_error());
$row_rs_cabang = mysql_fetch_assoc($rs_cabang);
$totalRows_rs_cabang = mysql_num_rows($rs_cabang);
 //require_once('../../Connections/koneksi.php'); ?>
<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form")) {
  $insertSQL = sprintf("INSERT INTO user_login (user_name, password, `level`, kode_cabang) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['user_name'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['level'], "text"),
                       GetSQLValueString($_POST['kode_cabang'], "text"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());
  
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
<a href='?mod=user' class='button red'>
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
      <h1>Tambah User</h1>
      <span></span> </div>
      
    <form action="<?php echo $editFormAction; ?>" name="form"  method="POST" enctype="multipart/form-data" class="block-content form">
      <div class="_25">
        <p>
          <label for="nm_barang">Username</label>
          <input id="textfield2" name="user_name" class="required" type="text" value="<?php echo $newID ?>" />
        </p>
      </div>
      <div class="_100">
        <p>
          <label for="textarea">Password</label>
          <input id="textfield" name="password" class="required" type="password" value="" />
        </p>
      </div>
      <div class="_100">
        <p>Level
          <label for="merk"></label>
          <label for="level"></label>
          <select name="level" id="level">
            <option value="admin">admin</option>
            <option value="user">user</option>
          </select>
        </p>
      </div>
      
      <div class="_100">
        <p>Cabang
          <label for="merk2"></label>
          <label for="kode_cabang"></label>
          <select name="kode_cabang" id="kode_cabang">
          
          <option value="<?php echo $row_rs_cabang['kode_cabang']; ?>"><?php echo $row_rs_cabang['kode_cabang']; ?> | <?php echo $row_rs_cabang['nm_cabang']; ?></option>
          </select>
        </p>
      </div>
      <div class="clear"></div>

      <div class="block-actions">
        <ul class="actions-left">
          <li><a class="button red"  href="?mod=user">Kembali</a></li>
        </ul>
        <ul class="actions-right">
          <li>
            <input type="submit" class="button" value="Simpan" />
          </li>
        </ul>
      </div>
      <input type="hidden" name="MM_insert" value="validate-form" />
      <input type="hidden" name="MM_insert" value="form" />
      <input name="user_posting" type="hidden" id="user_posting" value="<?php echo $_SESSION['user_posting']; ?>" />
      <input type="hidden" name="tgl_posting" id="tgl_posting"  value="<?php echo date('Y-m-d'); ?>"/>
    </form>
  </div>
</div>
<?php
mysql_free_result($rs_cabang);
?>
