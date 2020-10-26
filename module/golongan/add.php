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
$query_rs_harta = "SELECT kode_harta, nm_harta FROM harta_berwujud";
$rs_harta = mysql_query($query_rs_harta, $koneksi) or die(mysql_error());
$row_rs_harta = mysql_fetch_assoc($rs_harta);
$totalRows_rs_harta = mysql_num_rows($rs_harta);
 //require_once('../../Connections/koneksi.php'); ?>
<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form")) {
  $insertSQL = sprintf("INSERT INTO golongan (kode_golongan, kode_harta, nm_golongan, keterangan, persen_susut, masa_manfaat, tgl_posting, user_posting) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['kode_golongan'], "text"),
                       GetSQLValueString($_POST['kode_harta'], "int"),
                       GetSQLValueString($_POST['nm_golongan'], "text"),
                       GetSQLValueString($_POST['keterangan'], "text"),
                       GetSQLValueString($_POST['persen_susut'], "double"),
                       GetSQLValueString($_POST['masa_manfaat'], "int"),
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
$query = "SELECT MAX(kode_golongan) as max FROM golongan ";
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
<script src="../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />

<div class=grid_12> 
   <br/>
<a href='?mod=golongan' class='button red'>
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
      <h1>Tambah Golongan Inventaris</h1>
      <span></span> </div>
      
    <form action="<?php echo $editFormAction; ?>" name="form"  method="POST" enctype="multipart/form-data" class="block-content form">
      <div class="_25">
        <p>
          <label for="nm_barang">Kode  </label>
          <input id="textfield2" name="kode_golongan" class="required" type="text" value="<?php echo $newID ?>" />
        </p>
      </div>
      <div class="_100">
        <p>
          <label for="textarea">Nama Golongan</label>
          <span id="sprytextfield1">
          <input id="textfield" name="nm_golongan" class="required" type="text" value="" />
          <span class="textfieldRequiredMsg">Harus diisi</span></span></p>
      </div>
      <div class="_100">
        <p>
          <label for="file">Keterangan</label>
          <label for="merk"></label>
          <input type="text" name="keterangan" id="merk" />
        </p>
      </div>
      <div class="_50">
        <p>
          <label for="tipe"></label>
        Penyusutan(%)	
        <label for="persen_susut"></label>
        <input type="text" name="persen_susut" id="persen_susut" />
        </p>
      </div>
      <div class="_50">
        <p>
          <label for="tahun"></label>
        Masa Manfaat (Tahun)
        <label for="masa_manfaat"></label>
        <input type="text" name="masa_manfaat" id="masa_manfaat" />
        </p>
      </div>
    
        <div class="_50">
          <p>
            <label for="tahun2"></label>
            Jenis Harta 
            <label for="kode_harta"></label>
            <select name="kode_harta" id="kode_harta">
              <option>--Pilih Jenis--</option>
            <?php do { ?>
              <option value="<?php echo $row_rs_harta['kode_harta']; ?>"><?php echo $row_rs_harta['nm_harta']; ?></option>
              <?php } while ($row_rs_harta = mysql_fetch_assoc($rs_harta)); ?>
            </select>
          </p>
        </div>
  
      <div class="clear"></div>
      <div class="block-actions">
        <ul class="actions-left">
          <li><a class="button red"  href="?mod=golongan">Kembali</a></li>
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
mysql_free_result($rs_harta);
?>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
</script>
