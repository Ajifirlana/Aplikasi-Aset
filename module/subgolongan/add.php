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
 //require_once('../../Connections/koneksi.php'); ?>
<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form")) {
  $insertSQL = sprintf("INSERT INTO subgolongan (sub_golongan,kode_golongan, nm_subgolongan, tgl_posting, user_posting) VALUES (%s,%s, %s, %s, %s)",
                       GetSQLValueString($_POST['sub_golongan'], "text"),
					   GetSQLValueString($_POST['kode_golongan'], "text"),
                       GetSQLValueString($_POST['nm_subgolongan'], "text"),
                       GetSQLValueString($_POST['tgl_posting'], "date"),
                       GetSQLValueString($_POST['user_posting'], "text"));

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
$query = "SELECT MAX(sub_golongan) as max FROM subgolongan ";
$hasil = mysql_query($query);
$data  = mysql_fetch_array($hasil);
$kodeBarang = $data['max'];

// mengambil angka atau bilangan dalam kode anggota terbesar,
// dengan cara mengambil substring mulai dari karakter ke-1 diambil 6 karakter
// misal 'BRG001', akan diambil '001'
// setelah substring bilangan diambil lantas dicasting menjadi integer
$noUrut = (int) $kodeBarang ;

// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
$noUrut++;

// membentuk kode anggota baru
// perintah sprintf("%03s", $noUrut); digunakan untuk memformat string sebanyak 3 karakter
// misal sprintf("%03s", 12); maka akan dihasilkan '012'
// atau misal sprintf("%03s", 1); maka akan dihasilkan string '001'
//$char = "SP";
$newID = sprintf($noUrut);

?>
<!--tombol tambah -->
<script src="../../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />

<script src="../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>

<link href="../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />

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
          <input id="textfield2" name="sub_golongan" class="required" type="text" value="<?php echo $newID ?>" />
        </p>
      </div>
      <div class="_100">
        <p>
          <label for="textarea">Golongan	</label>
          <span id="spryselect1">
          <select name="kode_golongan" id="kode_golongan">
            <option>--Pilih Jenis--</option>
            <?php do { ?>
            <option value="<?php echo $row_rs_combo['kode_golongan']; ?>"><?php echo $row_rs_combo['nm_golongan']; ?></option>
            <?php } while ($row_rs_combo = mysql_fetch_assoc($rs_combo)); ?>
          </select>
          <span class="selectRequiredMsg">Harus dipilih</span></span></p>
      </div>
      <div class="_100">
        <p>
          <label for="file">Nama Sub Golongan</label>
          <label for="merk"></label>
          <span id="sprytextfield1">
          <input type="text" name="nm_subgolongan" id="merk" />
          <span class="textfieldRequiredMsg">Harus diisi</span></span></p>
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
      <input name="tgl_posting" type="hidden" id="tahun" value="<?php echo date('Y-m-d');?>" />
      <input name="user_posting" type="hidden" id="tipe" value="admin" />
    </form>
  </div>
</div>
<?php
mysql_free_result($rs_combo);
?>
<script type="text/javascript">
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
</script>
