

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
$query_rs_harta = "SELECT kode_suplier, nm_suplier FROM suplier ORDER BY kode_suplier ASC";
$rs_harta = mysql_query($query_rs_harta, $koneksi) or die(mysql_error());
$row_rs_harta = mysql_fetch_assoc($rs_harta);
$totalRows_rs_harta = mysql_num_rows($rs_harta);
 ?>
<?php


// membaca kode suplier terbesar
$query = "SELECT MAX(kode_pengadaan) as max FROM pengadaan ";
$hasil = mysql_query($query);
$data  = mysql_fetch_array($hasil);
$kodeBarang = $data['max'];

// mengambil angka atau bilangan dalam kode anggota terbesar,
// dengan cara mengambil substring mulai dari karakter ke-1 diambil 6 karakter
// misal 'BRG001', akan diambil '001'
// setelah substring bilangan diambil lantas dicasting menjadi integer
$noUrut = (int) substr($kodeBarang, 8, 10);

// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
$noUrut++;

// membentuk kode anggota baru
// perintah sprintf("%03s", $noUrut); digunakan untuk memformat string sebanyak 3 karakter
// misal sprintf("%03s", 12); maka akan dihasilkan '012'
// atau misal sprintf("%03s", 1); maka akan dihasilkan string '001'
//$char = "SP";
$char = "BRS";
$newID = $char ."-"."800"."-".sprintf("%010s", $noUrut);

?>



<div class="grid_12">
<?php 
		  echo $pesan ;
		?>
</div>

<div class="grid_6">
  <div class="block-border">
    <div class="block-header">
      <h1>Tambah Pengadaan Inventaris</h1>
      <span></span> </div>
      
    <form action="" name="form"  method="POST" enctype="multipart/form-data" class="block-content form" id="input">
    <fieldset>
		<legend>Pengadaan
      </legend><div class="_50">
        <p>
          <label for="nm_barang">Kode  </label>
          <input name="kode_pengadaan" type="text" class="required" id="kode_pengadaan" value="<?php echo $newID ?>" readonly="readonly" />
        </p>
      </div>
      
      <div class="_50">
        <p>
          <label for="nm_barang">Tanggal Beli * </label>
          <input id="tgl" name="tgl_beli" class="required" type="text" />
        </p>
      </div>
      
      <div class="_50">
        <p>
          <label for="textarea">Suplier * 	</label>
         
<select name="kode_suplier" id="kode_suplier">
            <option>--Pilih Jenis--</option>
            <?php do { ?>
            <option value="<?php echo $row_rs_harta['kode_suplier']; ?>"><?php echo $row_rs_harta['kode_suplier']; ?> - <?php echo $row_rs_harta['nm_suplier']; ?> </option>
            <?php } while ($row_rs_harta = mysql_fetch_assoc($rs_harta)); ?>
          </select>
        </p>
      </div>
      <div class="_50">
          <p>
            <label for="tahun2"></label>
            NO Faktur
            <label for="kode_harta"></label>
            <input type="text" name="no_faktur" id="no_faktur" />
          </p>
        </div>
      
       </fieldset>
       
      <fieldset> <legend>Inventaris
      </legend><div class="_100">
        <p>
          <label for="file">Kode Inventaris *</label>
          <label for="merk"></label>
          <input type="text" name="kode_barang" id="kode_barang"  />
           *Klik pada kolom untuk memilih kode </p>
      </div>
     
      <div class="_50">
        <p>
          <label for="merk"></label>
        Nama	Inventaris
        <label for="nm_barang\"></label>
        <input name="nm_barang\" type="text" disabled="disabled" id="nm_barang" />
        </p>
      </div>
      <div class="_50">
        <p>
          <label for="tahun"></label>
        Merek 
        <label for="merk"></label>
        <input name="merk" type="text" disabled="disabled" id="merk" />
        </p>
      </div>
    
        <div class="_50">
          <p>
            <label for="tahun2"></label>
            Tipe 
            <label for="kode_harta"></label>
            <input name="tipe" type="text" disabled="disabled" id="tipe" />
          </p>
        </div>
        <div class="_25">
          <p>
            <label for="tahun2"></label>
            NO Polisi
            <label for="kode_harta"></label>
            <input type="text" name="no_polisi" id="no_polisi" />
          </p>
        </div>
        
        <div class="_25">
          <p>
            <label for="tahun2"></label>
            NO BPKB
            <label for="kode_harta"></label>
            <input type="text" name="no_bpkb" id="no_bpkb" />
          </p>
        </div>
        
        <div class="_25">
          <p>
            <label for="tahun2"></label>
            NO Sertifikat
            <label for="kode_harta"></label>
            <input type="text" name="no_sertifikat" id="no_sertifikat" />
          </p>
        </div>
        
         
        
        <div class="_25">
          <p>
            <label for="tahun2"></label>
            Luas
            <label for="kode_harta"></label>
            <input type="text" name="luas" id="luas" />
          </p>
        </div>
   </fieldset>
   
   <fieldset><legend>Detail</legend>
    <div class="_25">
          <p>
            <label for="tahun2"></label>
            Jumlah Beli *
            <label for="kode_harta"></label>
            <input type="text" name="jumlah" id="jumlah" />
          Unit.</p>
        </div>
        
        <div class="_25">
          <p>
            <label for="tahun2"></label>
            Harga Per Unit *
            <label for="kode_harta"></label>
            <input type="text" name="harga_beli" id="harga_beli" />
          </p>
        </div>
        
        <div class="_25">
          <p>
            <label for="tahun2"></label>
            Sub Total Beli
            <label for="kode_harta"></label>
            <input name="sub_total" type="text" disabled="disabled" id="sub_total" />
            
          </p>
        </div>
      </fieldset> 

   
      <div class="clear"></div>
      <div class="block-actions">
        <ul class="actions-left">
          <li><a class="button red"  href="?mod=pengadaan_inventaris">Kembali</a></li>
        </ul>
        <ul class="actions-right">
          <li>
            <input name="Submit" type="submit" class="button" id="simpan" value="Simpan Pengadaan" />
          </li>
        </ul>
      </div>
      <input type="hidden" name="MM_insert" value="validate-form" />
      <input type="hidden" name="MM_insert" value="form" />
      <input name="tgl_posting" type="hidden" id="tahun" value="<?php echo date('Y-m-d');?>" />
      <input name="user_posting" type="hidden" id="tipe" value="admin" />
      <input name="kode_cabang" type="hidden" id="kode_cabang" value="800" />
    </form>
  </div>
</div>


<div id='form_cari_barang' title='Pencarian Barang'>
	  <table width='100%'>
			<tr>
				<td width='15%'>Cari Barang</td>
				<td width='2%'>:</td>
				<td><input type='text' name='txt_cari' id='txt_cari' size='50'></td>
			</tr>
		</table>
		<div id='info_barang' align='center'></div>
	</div>
    
<div id="tampil"></div>
    
    
<?php
mysql_free_result($rs_harta);
?>
