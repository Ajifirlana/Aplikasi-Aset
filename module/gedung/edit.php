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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "input_inventaris")) {
		
	$cek_gambar_denah=($_FILES['gambar_denah']['name']);
	$tmp_gambar_denah = ($_FILES['gambar_denah']['tmp_name']);
	
    $cek_gambar_bangunan=($_FILES['gambar_bangunan']['name']);
	$tmp_gambar_bangunan = ($_FILES['gambar_bangunan']['tmp_name']);
 if ($cek_gambar_denah == '' ){
	 $gambar_denah = $_POST['gb_denah'];
	 }else {
		 $gambar_denah = $cek_gambar_denah ;
		 move_uploaded_file($tmp_gambar_denah,"img/denah/$gambar_denah");
		 }
  if ($cek_gambar_bangunan == '' ){
	 $gambar_bangunan = $_POST['gb_bangunan'];
	 }else {
		 $gambar_bangunan = $cek_gambar_bangunan ;
		 move_uploaded_file($tmp_gambar_denah,"img/gedung/$gambar_bangunan");
		 }


  $updateSQL = sprintf("UPDATE gedung SET nm_gedung=%s, tahun_pemerolehan=%s, id_dana=%s, biaya_pembangunan=%s, luas_tanah=%s, luas_bangunan=%s, umur_ekonomis=%s, umur_teknis=%s, sifat_bangunan=%s, id_peruntukan=%s, id_kepemilikan=%s, kondisi=%s, kampus=%s, id_penanggungjawab=%s, gambar_denah=%s, gambar_bangunan=%s, tgl_posting=%s, user_posting=%s WHERE kode_gedung=%s",
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
                       GetSQLValueString($_POST['user_posting'], "text"),
                       GetSQLValueString($_POST['kode_gedung'], "text"));

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
if (isset($_GET['kode_gedung'])) {
  $colname_rs_edit = $_GET['kode_gedung'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_rs_edit = sprintf("SELECT * FROM gedung WHERE kode_gedung = %s", GetSQLValueString($colname_rs_edit, "text"));
$rs_edit = mysql_query($query_rs_edit, $koneksi) or die(mysql_error());
$row_rs_edit = mysql_fetch_assoc($rs_edit);
$totalRows_rs_edit = mysql_num_rows($rs_edit);

?>
<!--tombol tambah -->
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
      <h1>Edit Gedung</h1>
      <span></span> </div>
      
    <form name="input_inventaris"  action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" class="block-content form" id="input_inventaris">
      <div class="_25">
        <p>
          <label for="nm_gedung">Kode Gedung</label>
          <input name="kode_gedung" type="text" class="required" id="textfield2" value="<?php echo $row_rs_edit['kode_gedung']; ?>" readonly="readonly" />
        </p>
      </div>
      <div class="_75">
        <p>
          <label for="textarea">Nama Gedung</label>
          <input id="textfield" name="nm_gedung" class="required" type="text" value="<?php echo $row_rs_edit['nm_gedung']; ?>" />
        </p>
      </div>
      <div class="_25">
        <p>
          <label for="golongan">Tahun Pemerolehan</label>
          <label for="tahun_pemerolehan"></label>
          <input name="tahun_pemerolehan" type="text" id="tahun_pemerolehan" value="<?php echo $row_rs_edit['tahun_pemerolehan']; ?>" />
        </p>
      </div>
      <div class="_25">
        <p>
         <label for="golongan">Sumber Dana</label>
            <select name="id_dana" id="subgolongan">
          <?php do { ?>
              <option value="<?php echo $row_rs_dana['id_dana']; ?>" 
              <?php if ($row_rs_dana['id_dana']== $row_rs_edit['id_dana']) {echo "selected=\"selected\"";} ?>

              ><?php echo $row_rs_dana['nm_dana']; ?></option>
              
            <?php } while ($row_rs_dana = mysql_fetch_assoc($rs_dana)); ?>
            </select>
        </p>
      </div>
      <div class="_50">
        <p>
          <label for="file">Biaya Pembangunan/Harga Pembelian Rp.</label>
          <label for="biaya_pembangunan"></label>
          <input name="biaya_pembangunan" type="text" id="biaya_pembangunan" value="<?php echo $row_rs_edit['biaya_pembangunan']; ?>" />
        </p>
      </div>
      <div class="_25">
        <p>
          <label for="luas_tanah">Luas Tanah</label>
          <input name="luas_tanah" type="text" id="luas_tanah" value="<?php echo $row_rs_edit['luas_tanah']; ?>" />
        (dalam m²)</p>
      </div>
      <div class="_25">
        <p> <span class="label">Luas Bangunan</span>
          <label for="luas_bangunan"></label>
          <input name="luas_bangunan" type="text" id="luas_bangunan" value="<?php echo $row_rs_edit['luas_bangunan']; ?>" />
        (dalam m²)</p>
      </div>
      <div class="_25">
        <p> <span class="label">Umur Ekonomis Bangunan</span>
          <label for="umur_ekonomis"></label>
          <input name="umur_ekonomis" type="text" id="umur_ekonomis" value="<?php echo $row_rs_edit['umur_ekonomis']; ?>" />
        (dalam bulan)</p>
      </div>
         <div class="_25">
        <p> <span class="label">Umur Teknis Bangunan</span>
          <label for="umur_teknis"></label>
          <input name="umur_teknis" type="text" id="umur_teknis" value="<?php echo $row_rs_edit['umur_teknis']; ?>" />
        (dalam bulan)</p>
   </div>
      
         <div class="_50">
        <p> <span class="label">Sifat Bangunan</span>
          <label for="sifat_bangunan"></label>
          <select name="sifat_bangunan" id="sifat_bangunan">
            <option value="Semi Permanen" <?php if (!(strcmp("Semi Permanen", $row_rs_edit['sifat_bangunan']))) {echo "selected=\"selected\"";} ?>>Permanen</option>
            <option value="Semi Permanen" <?php if (!(strcmp("Semi Permanen", $row_rs_edit['sifat_bangunan']))) {echo "selected=\"selected\"";} ?>>Semi Permanen</option>
            <option value="Sederhana" <?php if (!(strcmp("Sederhana", $row_rs_edit['sifat_bangunan']))) {echo "selected=\"selected\"";} ?>>Sederhana</option>
          </select>
        </p>
      </div>
      
      <div class="_50">
        <p> <span class="label">Peruntukan Bangunan</span>
          <label for="id_peruntukan"></label>
            <select name="id_peruntukan" id="id_peruntukan">
          <?php do { ?>
              <option value="<?php echo $row_rs_peruntukan['id_peruntukan']; ?>"
             <?php if ($row_rs_peruntukan['id_peruntukan']== $row_rs_edit['id_peruntukan']) {echo "selected=\"selected\"";} ?>

              
              ><?php echo $row_rs_peruntukan['nm_peruntukan']; ?></option>
            <?php } while ($row_rs_peruntukan = mysql_fetch_assoc($rs_peruntukan)); ?>
            </select>
        </p>
      </div>
      
      <div class="_50">
        <p> <span class="label">Kepemilikan Bangunan</span>
          <label for="id_kepemilikan"></label>
          
            <select name="id_kepemilikan" id="id_kepemilikan">
          <?php do { ?>
              <option value="<?php echo $row_rs_kepemilikan['id_kepemilikan']; ?>"
             <?php if ($row_rs_kepemilikan['id_kepemilikan']== $row_rs_edit['id_kepemilikan']) {echo "selected=\"selected\"";} ?>
              
              ><?php echo $row_rs_kepemilikan['nm_kepemilikan']; ?></option>
            <?php } while ($row_rs_kepemilikan = mysql_fetch_assoc($rs_kepemilikan)); ?>
            </select>
        </p>
      </div>
      
      <div class="_50">
        <p> <span class="label">Kondisi</span>
          <label for="kondisi"></label>
            <select name="kondisi" id="kondisi">
          <?php do { ?>
              <option value="<?php echo $row_rs_kondisi['status']; ?>"
             <?php if ($row_rs_kondisi['status']== $row_rs_edit['status']) {echo "selected=\"selected\"";} ?>
              
              ><?php echo $row_rs_kondisi['nm_status']; ?></option>
            <?php } while ($row_rs_kondisi = mysql_fetch_assoc($rs_kondisi)); ?>
            </select>
        </p>
      </div>
      
      <div class="_50">
        <p> <span class="label">Kampus</span>
          <label for="kampus"></label>
            <select name="kampus" id="kampus">
          <?php do { ?>
              <option value="<?php echo $row_rs_kampus['kode_cabang']; ?>"
             <?php if ($row_rs_kampus['kode_cabang']== $row_rs_edit['kode_cabang']) {echo "selected=\"selected\"";} ?>
              
              ><?php echo $row_rs_kampus['nm_cabang']; ?></option>
            <?php } while ($row_rs_kampus = mysql_fetch_assoc($rs_kampus)); ?>
            </select>
        </p>
      </div>
      
      <div class="_50">
        <p> <span class="label">Penanggung Jawab</span>
          <label for="id_penanggungjawab"></label>
            <select name="id_penanggungjawab" id="id_penanggungjawab">
          <?php do { ?>
              <option value="<?php echo $row_rs_penanggungjawab['id_penanggungjawab']; ?>"
             <?php if ($row_rs_penanggungjawab['id_penanggungjawab']== $row_rs_edit['id_penanggungjawab']) {echo "selected=\"selected\"";} ?>
              
              ><?php echo $row_rs_penanggungjawab['nm_penanggungjawab']; ?></option>
            <?php } while ($row_rs_penanggungjawab = mysql_fetch_assoc($rs_penanggungjawab)); ?>

            </select>
        </p>
      </div>
      
      <div class="_50">
        <p> <span class="label">Gambar Denah</span>
          <label for="gambar_denah"></label>
          <input type="file" name="gambar_denah" id="gambar_denah" />
          <label for="gb_denah"></label>
          <input name="gb_denah" type="hidden" id="gb_denah" value="<?php echo $row_rs_edit['gambar_denah']; ?>" />
        </p>
      </div>
      
      <div class="_50">
        <p> <span class="label">Gambar Bangunan</span>
          <label for="gambar_bangunan"></label>
          <input type="file" name="gambar_bangunan" id="gambar_bangunan" />
          <label for="gb_bangunan"></label>
          <input name="gb_bangunan" type="hidden" id="gb_bangunan" value="<?php echo $row_rs_edit['gambar_bangunan']; ?>" />
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
      <input type="hidden" name="MM_update" value="input_inventaris" />
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

mysql_free_result($rs_edit);
?>
