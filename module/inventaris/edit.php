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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form")) {

  include "phpqrcode/qrlib.php";

  if (empty($_POST['barcode']))
           exit;
       
       //buat folder untuk simpan file image
       $tempdir = "qrcode-img/";
       if (!file_exists($tempdir))
           mkdir($tempdir);

    //Isi Teks dalam QRCode
    $isi_teks .= 'Kode Barang:'.$_POST['kode_barang']."\n";

    $isi_teks .= 'Nama Barang:'.$_POST['nm_barang']."\n";
    
    $isi_teks .= 'Merek:'.$_POST['merk']."\n";

    $isi_teks .= 'Tipe:'.$_POST['tipe']."\n";

    $isi_teks .= 'Tahun:'.$_POST['tahun']."\n";

    $isi_teks .= 'Volume:'.$_POST['volume']."\n";

    $isi_teks .= 'Total Unit:'.$_POST['total_unit']."\n";
    $isi_teks .= 'Masa Servis:'.$_POST['masa_servis']."\n";

    $isi_teks .= 'Tanggal Entry:'.$_POST['tgl_entry']."\n";

    $isi_teks .= 'Golongan:'.$_POST['kode_golongan']."\n";

    $isi_teks .= 'Kode Sub Golongan:'.$_POST['sub_golongan']."\n";
 

          $nm_barcode = $_POST['barcode'] . ".png";
            //Nama file yang akan disimpan pada folder temp 
            $namafile = $_POST['barcode'] . ".png";
            //Kualitas dari QRCode 
            $quality = 'H'; 
            //Ukuran besar QRCode
            $ukuran = 8; 
            $padding = 0; 

       QRcode::png($isi_teks,$tempdir.$nm_barcode,$tempdir.$namafile,$quality,$ukuran,$padding);

    //cek apakah server menggunakan http atau https
       $protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === 0 ? 'https://' : 'http://';
       
       //url file image barcode 
       $fileImage = $protocol . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/qrcode-img/=" . $_POST['barcode'] . "&print=true&size=65";
       
       //ambil gambar barcode dari url diatas
       $content = file_get_contents($fileImage);
       
       //simpan gambar
       file_put_contents($target_path, $content);
      //tutup baris barcode

	
	$cek_foto= $_FILES['poto']['name'];
	$tmp = $_FILES['poto']['tmp_name'];
if ($cek_foto == ''){
	$Gambar = $_POST['foto'];
	}else{
	$Gambar = $_FILES['poto']['name'];	
	move_uploaded_file($tmp,"img/aset/$Gambar");
		}
	
	
  $updateSQL = sprintf("UPDATE aset SET nm_barang=%s, kode_golongan=%s, sub_golongan=%s, merk=%s, tipe=%s, tahun=%s, volume=%s, tgl_entry=%s, user_posting=%s, total_unit=%s, masa_servis=%s,barcode=%s, poto=%s WHERE kode_barang=%s",
                       GetSQLValueString($_POST['nm_barang'], "text"),
                       GetSQLValueString($_POST['kode_golongan'], "text"),
                       GetSQLValueString($_POST['sub_golongan'], "int"),
                       GetSQLValueString($_POST['merk'], "text"),
                       GetSQLValueString($_POST['tipe'], "text"),
                       GetSQLValueString($_POST['tahun'], "text"),
                       GetSQLValueString($_POST['volume'], "text"),
                       GetSQLValueString($_POST['tgl_entry'], "date"),
                       GetSQLValueString($_POST['user_posting'], "text"),
                       GetSQLValueString($_POST['total_unit'], "double"),
                       GetSQLValueString($_POST['masa_servis'], "int"),
                        GetSQLValueString($_POST['barcode'], "text"),
                       GetSQLValueString($Gambar, "text"),
                       GetSQLValueString($_POST['kode_barang'], "text"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
    if ($Result1) {
	  $pesan = '<div class="alert success"><span class="hide">x</span><strong>Berhasil</strong> Data telah disimpan.</div>' ;
	  }
	 else {
		 $pesan = '<div class="alert error"><span class="hide">x</span><strong>Gagal</strong> Data gagal disimipan.</div>';


		 }

}

mysql_select_db($database_koneksi, $koneksi);
$query_rs_golongan = "SELECT kode_golongan, nm_golongan FROM golongan ORDER BY nm_golongan ASC";
$rs_golongan = mysql_query($query_rs_golongan, $koneksi) or die(mysql_error());
$row_rs_golongan = mysql_fetch_assoc($rs_golongan);
$totalRows_rs_golongan = mysql_num_rows($rs_golongan);

$colname_rs_edit = "-1";
if (isset($_GET['kode_barang'])) {
  $colname_rs_edit = $_GET['kode_barang'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_rs_edit = sprintf("SELECT * FROM tampil_inventaris WHERE kode_barang = %s", GetSQLValueString($colname_rs_edit, "text"));
$rs_edit = mysql_query($query_rs_edit, $koneksi) or die(mysql_error());
$row_rs_edit = mysql_fetch_assoc($rs_edit);
$totalRows_rs_edit = mysql_num_rows($rs_edit);

  

?>
<!--tombol tambah -->
<div class=grid_12> 
   <br/>
<a href='?mod=inventaris&amp' class='button red'>
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
      <h1>Edit Inventaris</h1>
      <span></span> </div>
      
    <form name="form"  action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" class="block-content form">
      <div class="_25">
        <p>
          <label for="nm_barang">Kode Barang</label>
          <input id="textfield2" name="kode_barang" class="required" type="text" value="<?php echo $row_rs_edit['kode_barang']; ?>" />
        </p>
      </div>
      <div class="_100">
        <p>
          <label for="textarea">Nama Barang</label>
          <input id="textfield" name="nm_barang" class="required" type="text" value="<?php echo $row_rs_edit['nm_barang']; ?>" />
        </p>
      </div>
      <div class="_25">
        <p>
          <label for="golongan">Golongan</label>
            <select name="kode_golongan" id="kode_golongan">
            <option value="<?php echo $row_rs_edit['kode_golongan']; ?>"><?php echo $row_rs_edit['nm_golongan']; ?></option>
          <?php do { ?>
              <option value="<?php echo $row_rs_golongan['kode_golongan']; ?>"><?php echo $row_rs_golongan['nm_golongan']; ?></option>
          <?php } while ($row_rs_golongan = mysql_fetch_assoc($rs_golongan)); ?>
            </select>
        </p>
      </div>
      <div class="_25">
        <p>
          <label for="sub_golongan">Sub Golongan</label>
          <select name="sub_golongan" id="subgolongan">
          <option value="<?php echo $row_rs_edit['sub_golongan']; ?>"><?php echo $row_rs_edit['nm_subgolongan']; ?></option>
</select>
        </p>
      </div>
      <div class="_100">
        <p>
          <label for="file">Merek</label>
          <label for="merk"></label>
          <input name="merk" type="text" id="merk" value="<?php echo $row_rs_edit['merk']; ?>" />
        </p>
      </div>
      <div class="_50">
        <p> <span class="label">Tipe</span>
          <label for="tipe"></label>
          <input name="tipe" type="text" id="tipe" value="<?php echo $row_rs_edit['tipe']; ?>" />
        </p>
      </div>
      <div class="_50">
        <p> <span class="label">Tahun</span>
          <label for="tahun"></label>
          <input name="tahun" type="text" id="tahun" value="<?php echo $row_rs_edit['tahun']; ?>" />
        </p>
      </div>
      <div class="clear">
        <div class="_50">
          <p> <span class="label">Volume</span>
            <label for="volume"></label>
            <input name="volume" type="text" id="volume" value="<?php echo $row_rs_edit['volume']; ?>" />
          </p>
        </div>
      </div>
      <div class="_50">
        <p> <span class="label">Jumlah Unit</span>
          <label for="total_unit"></label>
          <input name="total_unit" type="text" id="total_unit" value="<?php echo $row_rs_edit['total_unit']; ?>" />
        </p>
      </div>
         <div class="_50">
        <p> <span class="label">Masa Servis</span>
          <label for="masa_servis"></label>
          <input name="masa_servis" type="text" id="masa_servis" value="<?php echo $row_rs_edit['masa_servis']; ?>" />
        </p>
      </div>
      
         <div class="_50">
        <p> <span class="label">Gambar 
          <label for="poto"></label>
          <input type="file" name="poto" id="poto" />
        </span>
          <input name="foto" type="hidden" id="foto" value="<?php echo $row_rs_edit['poto']; ?>" />
        </p>
</div>
<div class="_50">
        <p> 
          <label for="total_unit"></label>
          <input type="hidden" name="barcode" id="barcode" value="<?php echo $row_rs_edit['kode_barang']; ?>" />
          <?php
          $tanggal= date('Y-m-d');
        {
        ?>
           <input type="hidden" name="tgl_entry" id="tgl_entry" value="<?php echo $tanggal; ?>" />
           <?php }?>
        </p>

        
      </div>
            <div class="clear"></div>

      <div class="block-actions">
        <ul class="actions-left">
          <li><a class="button red"  href="?mod=inventaris">Kembali</a>
           
            <input type="hidden" name="user_posting" id="user_posting" value="admin" />
          </li>
        </ul>
        <ul class="actions-right">
          <li>
            <input type="submit" class="button" value="Simpan" />
          </li>
        </ul>
      </div>
      <input type="hidden" name="MM_insert" value="validate-form" />
      <input type="hidden" name="MM_update" value="form" />
    </form>
  </div>
</div>


<?php
mysql_free_result($rs_golongan);

mysql_free_result($rs_edit);
?>
