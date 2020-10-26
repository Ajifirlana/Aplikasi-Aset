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
 //require_once('../../Connections/koneksi.php'); ?>
<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form")) {
  $insertSQL = sprintf("INSERT INTO suplier (kode_suplier, nm_suplier, alamat, kota, telepon, bidang_usaha) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['kode_suplier'], "text"),
                       GetSQLValueString($_POST['nm_suplier'], "text"),
                       GetSQLValueString($_POST['alamat'], "text"),
                       GetSQLValueString($_POST['kota'], "text"),
					   GetSQLValueString($_POST['telepon'], "text"),
                       GetSQLValueString($_POST['bidang_usaha'], "text"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());
  
  if ($Result1) {
	  $pesan = '<div class="alert success"><span class="hide">x</span><strong>Berhasil</strong> Data telah disimpan.</div>' ;
	  }
	 else {
		 $pesan = '<div class="alert error"><span class="hide">x</span><strong>Gagal</strong> Data gagal disimipan.</div>';


		 }
}

// membaca kode suplier terbesar
$query = "SELECT MAX(kode_suplier) as max FROM suplier ";
$hasil = mysql_query($query);
$data  = mysql_fetch_array($hasil);
$kodeBarang = $data['max'];

// mengambil angka atau bilangan dalam kode anggota terbesar,
// dengan cara mengambil substring mulai dari karakter ke-1 diambil 6 karakter
// misal 'BRG001', akan diambil '001'
// setelah substring bilangan diambil lantas dicasting menjadi integer
$noUrut = (int) substr($kodeBarang, 3, 3);

// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
$noUrut++;

// membentuk kode anggota baru
// perintah sprintf("%03s", $noUrut); digunakan untuk memformat string sebanyak 3 karakter
// misal sprintf("%03s", 12); maka akan dihasilkan '012'
// atau misal sprintf("%03s", 1); maka akan dihasilkan string '001'
$char = "SP";
$newID = $char . sprintf("%03s", $noUrut);

?>
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
      <h1>Tambah Supplier</h1>
      <span></span> </div>
      
    <form action="<?php echo $editFormAction; ?>" name="form"  method="POST" enctype="multipart/form-data" class="block-content form">
      <div class="_25">
        <p>
          <label for="nm_barang">Kode  </label>
          <input id="textfield2" name="kode_suplier" class="required" type="text" value="<?php echo $newID ?>" />
        </p>
      </div>
      <div class="_50">
        <p>
          <label for="textarea">Nama Supplier</label>
          <span id="sprytextfield1">
          <input id="textfield" name="nm_suplier" class="required" type="text" value="" />
          <span class="textfieldRequiredMsg">Harus diisi</span></span></p>
      </div>
      <div class="_50">
        <p>
          <label for="file">Alamat</label>
          <label for="merk"></label>
          <input type="text" name="alamat" id="merk" />
        </p>
      </div>
      <div class="_50">
        <p> <span class="label">Kota</span>
          <label for="tipe"></label>
          <input type="text" name="kota" id="tipe" />
        </p>
      </div>
      <div class="_50">
        <p> <span class="label">Bidang Usaha</span>
          <label for="tahun"></label>
          <label for="bidang_usaha"></label>
            <select name="bidang_usaha" id="bidang_usaha">
              <option>Pilih </option>
          <?php do { ?>
              <option value="<?php echo $row_rs_bu['nm_bidang']; ?>"><?php echo $row_rs_bu['nm_bidang']; ?></option>
            <?php } while ($row_rs_bu = mysql_fetch_assoc($rs_bu)); ?>
            </select>
        </p>
      </div>
      
      <div class="_50">
        <p> <span class="label">Telepon</span>
          <label for="tahun"></label>
          <input type="text" name="telepon" id="tahun" />
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
    </form>
  </div>
</div>
<?php
mysql_free_result($rs_bu);
?>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
</script>
