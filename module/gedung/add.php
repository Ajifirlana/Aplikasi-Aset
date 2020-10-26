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

mysql_select_db($database_koneksi, $koneksi);
$query_rs_dana = "SELECT * FROM sumber_dana";
$rs_dana = mysql_query($query_rs_dana, $koneksi) or die(mysql_error());
$row_rs_dana = mysql_fetch_assoc($rs_dana);
$totalRows_rs_dana = mysql_num_rows($rs_dana);

mysql_select_db($database_koneksi, $koneksi);
$query_rs_peruntukan = "SELECT * FROM peruntukan_bangunan";
$rs_peruntukan = mysql_query($query_rs_peruntukan, $koneksi) or die(mysql_error());
$row_rs_peruntukan = mysql_fetch_assoc($rs_peruntukan);
$totalRows_rs_peruntukan = mysql_num_rows($rs_peruntukan);

mysql_select_db($database_koneksi, $koneksi);
$query_rs_kepemilikan = "SELECT * FROM kepemililkan";
$rs_kepemilikan = mysql_query($query_rs_kepemilikan, $koneksi) or die(mysql_error());
$row_rs_kepemilikan = mysql_fetch_assoc($rs_kepemilikan);
$totalRows_rs_kepemilikan = mysql_num_rows($rs_kepemilikan);

mysql_select_db($database_koneksi, $koneksi);
$query_rs_penanggungjawab = "SELECT * FROM penanggunjawab";
$rs_penanggungjawab = mysql_query($query_rs_penanggungjawab, $koneksi) or die(mysql_error());
$row_rs_penanggungjawab = mysql_fetch_assoc($rs_penanggungjawab);
$totalRows_rs_penanggungjawab = mysql_num_rows($rs_penanggungjawab);

mysql_select_db($database_koneksi, $koneksi);
$query_rs_kampus = "SELECT kode_cabang, nm_cabang FROM cabang";
$rs_kampus = mysql_query($query_rs_kampus, $koneksi) or die(mysql_error());
$row_rs_kampus = mysql_fetch_assoc($rs_kampus);
$totalRows_rs_kampus = mysql_num_rows($rs_kampus);

mysql_select_db($database_koneksi, $koneksi);
$query_rs_kondisi = "SELECT * FROM status";
$rs_kondisi = mysql_query($query_rs_kondisi, $koneksi) or die(mysql_error());
$row_rs_kondisi = mysql_fetch_assoc($rs_kondisi);
$totalRows_rs_kondisi = mysql_num_rows($rs_kondisi);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "input_inventaris")) {
	
	$gambar_denah=($_FILES['gambar_denah']['name']);
	$tmp_gambar_denah = ($_FILES['gambar_denah']['tmp_name']);
	
    $gambar_bangunan=($_FILES['gambar_bangunan']['name']);
	$tmp_gambar_bangunan = ($_FILES['gambar_bangunan']['tmp_name']);


	
  $insertSQL = sprintf("INSERT INTO gedung (kode_gedung, nm_gedung, tahun_pemerolehan, id_dana, biaya_pembangunan, luas_tanah, luas_bangunan, umur_ekonomis, umur_teknis, sifat_bangunan, id_peruntukan, id_kepemilikan, kondisi, kampus, id_penanggungjawab, gambar_denah, gambar_bangunan, tgl_posting, user_posting) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['kode_gedung'], "text"),
                       GetSQLValueString($_POST['nm_gedung'], "text"),
                       GetSQLValueString($_POST['tahun_pemerolehan'], "date"),
                       GetSQLValueString($_POST['id_dana'], "int"),
                       GetSQLValueString($_POST['biaya_pembangunan'], "int"),
                       GetSQLValueString($_POST['luas_tanah'], "int"),
                       GetSQLValueString($_POST['luas_bangunan'], "int"),
                       GetSQLValueString($_POST['umur_ekonomis'], "int"),
                       GetSQLValueString($_POST['umur_teknis'], "int"),
                       GetSQLValueString($_POST['sifat_bangunan'], "text"),
                       GetSQLValueString($_POST['id_peruntukan'], "int"),
                       GetSQLValueString($_POST['id_kepemilikan'], "int"),
                       GetSQLValueString($_POST['kondisi'], "text"),
                       GetSQLValueString($_POST['kampus'], "text"),
                       GetSQLValueString($_POST['id_penanggungjawab'], "int"),
                       GetSQLValueString($gambar_denah, "text"),
                       GetSQLValueString($gambar_bangunan, "text"),
                       GetSQLValueString($_POST['tgl_posting'], "date"),
                       GetSQLValueString($_POST['user_posting'], "text"));
  move_uploaded_file($tmp_gambar_denah,"img/denah/$gambar_denah");
  move_uploaded_file($tmp_gambar_bangunan,"img/gedung/$gambar_bangunan");

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
<script src="../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />

<div class=grid_12> 
   <br/>
<a href='?mod=gedung&amp;amp' class='button red'>
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
      <h1>Tambah Gedung</h1>
      <span></span> </div>
      
    <form name="input_inventaris"  action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" class="block-content form" id="input_inventaris">
      <div class="_25">
        <p>
          <label for="nm_gedung">Kode Gedung</label>
          <span id="sprytextfield1">
          <input id="textfield2" name="kode_gedung" class="required" type="text" />
          <span class="textfieldRequiredMsg">Harus diisi</span></span></p>
      </div>
      <div class="_75">
        <p>
          <label for="textarea">Nama Gedung</label>
          <span id="sprytextfield2">
          <input id="textfield" name="nm_gedung" class="required" type="text" value="" />
          <span class="textfieldRequiredMsg">Harus diisi</span></span></p>
      </div>
      <div class="_25">
        <p>
          <label for="golongan">Tahun Pemerolehan</label>
          <label for="tahun_pemerolehan"></label>
          <input type="text" name="tahun_pemerolehan" id="tahun_pemerolehan" />
        </p>
      </div>
      <div class="_25">
        <p>
         <label for="golongan">Sumber Dana</label>
            <select name="id_dana" id="subgolongan">
          <?php do { ?>
              <option value="<?php echo $row_rs_dana['id_dana']; ?>"><?php echo $row_rs_dana['nm_dana']; ?></option>
              
            <?php } while ($row_rs_dana = mysql_fetch_assoc($rs_dana)); ?>
            </select>
        </p>
      </div>
      <div class="_50">
        <p>
          <label for="file">Biaya Pembangunan/Harga Pembelian Rp.</label>
          <label for="biaya_pembangunan"></label>
          <input type="text" name="biaya_pembangunan" id="biaya_pembangunan" />
        </p>
      </div>
      <div class="_25">
        <p>
          <label for="luas_tanah">Luas Tanah</label>
          <input type="text" name="luas_tanah" id="luas_tanah" />
        (dalam m²)</p>
      </div>
      <div class="_25">
        <p> <span class="label">Luas Bangunan</span>
          <label for="luas_bangunan"></label>
          <input type="text" name="luas_bangunan" id="luas_bangunan" />
        (dalam m²)</p>
      </div>
      <div class="_25">
        <p> <span class="label">Umur Ekonomis Bangunan</span>
          <label for="umur_ekonomis"></label>
          <input type="text" name="umur_ekonomis" id="umur_ekonomis" />
        (dalam bulan)</p>
      </div>
         <div class="_25">
        <p> <span class="label">Umur Teknis Bangunan</span>
          <label for="umur_teknis"></label>
          <input type="text" name="umur_teknis" id="umur_teknis" />
        (dalam bulan)</p>
   </div>
      
         <div class="_50">
        <p> <span class="label">Sifat Bangunan</span>
          <label for="sifat_bangunan"></label>
          <select name="sifat_bangunan" id="sifat_bangunan">
            <option value="Semi Permanen">Permanen</option>
            <option value="Semi Permanen">Semi Permanen</option>
            <option value="Sederhana">Sederhana</option>
          </select>
        </p>
      </div>
      
      <div class="_50">
        <p> <span class="label">Peruntukan Bangunan</span>
          <label for="id_peruntukan"></label>
            <select name="id_peruntukan" id="id_peruntukan">
          <?php do { ?>
              <option value="<?php echo $row_rs_peruntukan['id_peruntukan']; ?>"><?php echo $row_rs_peruntukan['nm_peruntukan']; ?></option>
            <?php } while ($row_rs_peruntukan = mysql_fetch_assoc($rs_peruntukan)); ?>
            </select>
        </p>
      </div>
      
      <div class="_50">
        <p> <span class="label">Kepemilikan Bangunan</span>
          <label for="id_kepemilikan"></label>
          
            <select name="id_kepemilikan" id="id_kepemilikan">
          <?php do { ?>
              <option value="<?php echo $row_rs_kepemilikan['id_kepemilikan']; ?>"><?php echo $row_rs_kepemilikan['nm_kepemilikan']; ?></option>
            <?php } while ($row_rs_kepemilikan = mysql_fetch_assoc($rs_kepemilikan)); ?>
            </select>
        </p>
      </div>
      
      <div class="_50">
        <p> <span class="label">Kondisi</span>
          <label for="kondisi"></label>
            <select name="kondisi" id="kondisi">
          <?php do { ?>
              <option value="<?php echo $row_rs_kondisi['status']; ?>"><?php echo $row_rs_kondisi['nm_status']; ?></option>
            <?php } while ($row_rs_kondisi = mysql_fetch_assoc($rs_kondisi)); ?>
            </select>
        </p>
      </div>
      
      <div class="_50">
        <p> <span class="label">Kampus</span>
          <label for="kampus"></label>
            <select name="kampus" id="kampus">
          <?php do { ?>
              <option value="<?php echo $row_rs_kampus['kode_cabang']; ?>"><?php echo $row_rs_kampus['nm_cabang']; ?></option>
            <?php } while ($row_rs_kampus = mysql_fetch_assoc($rs_kampus)); ?>
            </select>
        </p>
      </div>
      
      <div class="_50">
        <p> <span class="label">Penanggung Jawab</span>
          <label for="id_penanggungjawab"></label>
            <select name="id_penanggungjawab" id="id_penanggungjawab">
          <?php do { ?>
              <option value="<?php echo $row_rs_penanggungjawab['id_penanggungjawab']; ?>"><?php echo $row_rs_penanggungjawab['nm_penanggungjawab']; ?></option>
            <?php } while ($row_rs_penanggungjawab = mysql_fetch_assoc($rs_penanggungjawab)); ?>

            </select>
        </p>
      </div>
      
      <div class="_50">
        <p> <span class="label">Gambar Denah</span>
          <label for="gambar_denah"></label>
          <input type="file" name="gambar_denah" id="gambar_denah" />
        </p>
      </div>
      
      <div class="_50">
        <p> <span class="label">Gambar Bangunan</span>
          <label for="gambar_bangunan"></label>
          <input type="file" name="gambar_bangunan" id="gambar_bangunan" />
        </p>
      </div>
      
      <div class="clear"></div>

      <div class="block-actions">
        <ul class="actions-left">
          <li><a class="button red"  href="?mod=gedung&amp;amp">Kembali</a>
            <input type="hidden" name="tgl_posting" id="tgl_posting" value="<?php echo date('d-m-Y'); ?>" />
            <input type="hidden" name="user_posting" id="user_posting" value="<?php echo $_SESSION['user_posting']; ?>" />
          </li>
        </ul>
        <ul class="actions-right">
          <li>
            <input type="submit" class="button" value="Simpan" />
          </li>
        </ul>
      </div>
      <input type="hidden" name="MM_insert" value="validate-form" />
      <input type="hidden" name="MM_insert" value="input_inventaris" />
    </form>
  </div>
</div>
<?php
mysql_free_result($rs_golongan);

mysql_free_result($rs_subgolongan);

mysql_free_result($rs_dana);

mysql_free_result($rs_peruntukan);

mysql_free_result($rs_kepemilikan);

mysql_free_result($rs_penanggungjawab);

mysql_free_result($rs_kampus);

mysql_free_result($rs_kondisi);
?>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
</script>
