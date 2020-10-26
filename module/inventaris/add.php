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

$query = "SELECT MAX(kode_barang) as max FROM aset ";
$hasil = mysql_query($query);
$data  = mysql_fetch_array($hasil);
$kodeBarang = $data['max'];

// mengambil angka atau bilangan dalam kode anggota terbesar,
// dengan cara mengambil substring mulai dari karakter ke-1 diambil 6 karakter
// misal 'BRG001', akan diambil '001'
// setelah substring bilangan diambil lantas dicasting menjadi integer
$noUrut = (int) substr($kodeBarang, 3, 8);

// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
$noUrut++;

// membentuk kode anggota baru
// perintah sprintf("%03s", $noUrut); digunakan untuk memformat string sebanyak 3 karakter
// misal sprintf("%03s", 12); maka akan dihasilkan '012'
// atau misal sprintf("%03s", 1); maka akan dihasilkan string '001'
$char = "AST";
$newID = $char . sprintf("%04s", $noUrut);





mysql_select_db($database_koneksi, $koneksi);
$query_rs_golongan = "SELECT kode_golongan, nm_golongan FROM golongan ORDER BY nm_golongan ASC";
$rs_golongan = mysql_query($query_rs_golongan, $koneksi) or die(mysql_error());
$row_rs_golongan = mysql_fetch_assoc($rs_golongan);
$totalRows_rs_golongan = mysql_num_rows($rs_golongan);

mysql_select_db($database_koneksi, $koneksi);
$query_rs_subgolongan = "SELECT sub_golongan, nm_subgolongan FROM subgolongan ORDER BY nm_subgolongan ASC";
$rs_subgolongan = mysql_query($query_rs_subgolongan, $koneksi) or die(mysql_error());
$row_rs_subgolongan = mysql_fetch_assoc($rs_subgolongan);
$totalRows_rs_subgolongan = mysql_num_rows($rs_subgolongan);



$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}


if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "validate-form")) {


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

	$Gambar=($_FILES['poto']['name']);
	$tmp = ($_FILES['poto']['tmp_name']);

    //direktori dan nama logo
    
  $insertSQL = sprintf("INSERT INTO aset (kode_barang, nm_barang, kode_golongan, sub_golongan, merk, tipe, tahun, volume, tgl_entry, user_posting, total_unit, masa_servis,barcode, poto) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['kode_barang'], "text"),
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
                       GetSQLValueString($Gambar, "text"));
  move_uploaded_file($tmp,"img/aset/$Gambar");
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

<script src="../../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />

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
      <h1>Tambah Inventaris</h1>
      <span></span> </div>
      
    <form  action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" class="block-content form" id="input_inventaris">
      <div class="_25">
        <p>
          <label for="nm_barang">Kode Barang</label>
          <input id="textfield2" name="kode_barang" class="required" type="text" value="<?php echo $newID ?>" />
        </p>
      </div>
      <div class="_100">
        <p>
          <label for="textarea">Nama Barang</label>
          <span id="sprytextfield1">
          <input id="textfield" name="nm_barang" class="required" type="text" value="" />
          <span class="textfieldRequiredMsg">Harus diisi</span></span></p>
      </div>
      <div class="_25">
        <p>
          <label for="golongan">Golongan</label>
          <span id="spryselect1">
          <select name="kode_golongan" id="kode_golongan">
            <option>--Pilih Golongan--</option>
            <?php do { ?>
            <option value="<?php echo $row_rs_golongan['kode_golongan']; ?>"><?php echo $row_rs_golongan['nm_golongan']; ?></option>
            <?php } while ($row_rs_golongan = mysql_fetch_assoc($rs_golongan)); ?>
          </select>
          <span class="selectRequiredMsg">Harus dipilih.</span></span></p>
      </div>
      <div class="_25">
        <p>
          <label for="sub_golongan">Sub Golongan</label>
          <span id="spryselect2">
          <select name="sub_golongan" id="subgolongan">
          </select>
          <span class="selectRequiredMsg">Harus dipilih</span></span></p>
      </div>
      <div class="_100">
        <p>
          <label for="file">Merek</label>
          <label for="merk"></label>
          <input type="text" name="merk" id="merk" />
        </p>
      </div>
      <div class="_50">
        <p> <span class="label">Tipe</span>
          <label for="tipe"></label>
          <input type="text" name="tipe" id="tipe" />
        </p>
      </div>
      <div class="_25">
        <p> <span class="label">Tahun</span>
          <label for="tahun"></label>
          <input type="text" name="tahun" id="tahun" />
        </p>
      </div>
      <div class="_25">
        <div class="_50">
          <p> <span class="label">Volume</span>
            <label for="volume"></label>
            <input type="text" name="volume" id="volume" />
          </p>
        </div>
      </div>
      <div class="_50">
        <p> <span class="label">Jumlah Unit</span>
          <label for="total_unit"></label>
          <input type="text" name="total_unit" id="total_unit" />
        </p>
      </div>
         <div class="_25">
        <p> <span class="label">Masa Servis</span>
          <label for="masa_servis"></label>
          <input type="text" name="masa_servis" id="masa_servis" />
        . Bulan (kosongkan jika barang bertipe habis pakai).</p>
      </div>
      
     

         <div class="_50">
        <p> <span class="label">Gambar 
          <label for="poto"></label>
          <input type="file" name="poto" id="poto" />
        </span></p>
      </div>
       <div class="_50">
        <p> 
          <label for="total_unit"></label>
          <input type="hidden" name="barcode" id="barcode" value="<?php echo $newID ?>" />
        </p>

        <?php
          $tanggal= date('Y-m-d');
        {
        ?>
           <input type="hidden" name="tgl_entry" id="tgl_entry" value="<?php echo $tanggal; ?>" />
           <?php }?>
        
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
            <input type="submit" class="button" name="simpan" value="Simpan" />
          </li>
        </ul>
      </div>
      <input type="hidden" name="MM_insert" value="validate-form" />
    </form>
  </div>
</div>


<?php
mysql_free_result($rs_golongan);

mysql_free_result($rs_subgolongan);
?>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2");
</script>
