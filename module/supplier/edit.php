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
$query_rs_bu = "SELECT * FROM bidang_usaha";
$rs_bu = mysql_query($query_rs_bu, $koneksi) or die(mysql_error());
$row_rs_bu = mysql_fetch_assoc($rs_bu);
$totalRows_rs_bu = mysql_num_rows($rs_bu);


$colname_rs_edit = "-1";
if (isset($_GET['kode_suplier'])) {
  $colname_rs_edit = $_GET['kode_suplier'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_rs_edit = sprintf("SELECT * FROM suplier WHERE kode_suplier = %s", GetSQLValueString($colname_rs_edit, "text"));
$rs_edit = mysql_query($query_rs_edit, $koneksi) or die(mysql_error());
$row_rs_edit = mysql_fetch_assoc($rs_edit);
$totalRows_rs_edit = mysql_num_rows($rs_edit);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form")) {
  $updateSQL = sprintf("UPDATE suplier SET nm_suplier=%s, alamat=%s, kota=%s,  telepon=%s WHERE kode_suplier=%s",
                       GetSQLValueString($_POST['nm_suplier'], "text"),
                       GetSQLValueString($_POST['alamat'], "text"),
                       GetSQLValueString($_POST['kota'], "text"),
                       GetSQLValueString($_POST['telepon'], "text"),
					
                       GetSQLValueString($_POST['kode_suplier'], "text"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
  
  if ($Result1) {
	  $pesan = '<div class="alert success"><span class="hide">x</span><strong>Berhasil</strong> Data telah disimpan.</div>' ;
	  }
	 else {
		 $pesan = '<div class="alert error"><span class="hide">x</span><strong>Gagal</strong> Data gagal disimipan.</div>';


		 }

}
 //require_once('../../Connections/koneksi.php'); ?>
 <!--tombol tambah -->
 <script src="../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
 <link href="../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
 
<div class=grid_12> 
   <br/>
<a href='?mod=supplier' class='button red'>
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
      <h1>Edit Mitra Kerja</h1>
      <span></span> </div>
      
    <form action="<?php echo $editFormAction; ?>" name="form"  method="POST" enctype="multipart/form-data" class="block-content form">
      <div class="_25">
        <p>
          <label for="nm_barang">Kode Mitra </label>
          <input name="kode_suplier" type="text" class="required" id="textfield2" value="<?php echo $row_rs_edit['kode_suplier']; ?>" readonly="readonly" />
        </p>
      </div>
      <div class="_50">
        <p>
          <label for="textarea">Nama Mitra</label>
          <span id="sprytextfield1">
          <input id="textfield" name="nm_suplier" class="required" type="text" value="<?php echo $row_rs_edit['nm_suplier']; ?>" />
          <span class="textfieldRequiredMsg">Harus diisi</span></span></p>
      </div>
      <div class="_50">
        <p>
          <label for="file">Alamat</label>
          <label for="merk"></label>
          <input name="alamat" type="text" id="merk" value="<?php echo $row_rs_edit['alamat']; ?>" />
        </p>
      </div>
      <div class="_50">
        <p> <span class="label">Kota</span>
          <label for="tipe"></label>
          <input name="kota" type="text" id="tipe" value="<?php echo $row_rs_edit['kota']; ?>" />
        </p>
      </div>
      
    <div class="_50">
        <p> <span class="label">Bidang Usaha</span>
          <label for="tahun"></label>
          <label for="bidang_usaha"></label>
            <select name="bidang_usaha" id="bidang_usaha">
              <option>Pilih </option>
          <?php do { ?>
              <option value="<?php echo $row_rs_bu['nm_bidang']; ?>"
              <?php if ($row_rs_bu['nm_bidang']== $row_rs_edit['bidang_usaha']) {echo "selected=\"selected\"";} ?>
              
              ><?php echo $row_rs_bu['nm_bidang']; ?></option>
            <?php } while ($row_rs_bu = mysql_fetch_assoc($rs_bu)); ?>
            </select>
        </p>
      </div>




      <div class="_50">
        <p> <span class="label">Telepon</span>
          <label for="tahun"></label>
          <input name="telepon" type="text" id="tahun" value="<?php echo $row_rs_edit['telepon']; ?>" />
        </p>
      </div>
      <div class="clear"></div>

      <div class="block-actions">
        <ul class="actions-left">
          <li><a class="button red"  href="?mod=supplier">Kembali</a></li>
        </ul>
        <ul class="actions-right">
          <li>
            <input type="submit" class="button" value="Simpan" />
          </li>
        </ul>
      </div>
      <input type="hidden" name="MM_insert" value="validate-form" />
      <input type="hidden" name="MM_insert" value="form" />
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
 