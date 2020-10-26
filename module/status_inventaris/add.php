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
$query_rs_status = "SELECT * FROM status";
$rs_status = mysql_query($query_rs_status, $koneksi) or die(mysql_error());
$row_rs_status = mysql_fetch_assoc($rs_status);
$totalRows_rs_status = mysql_num_rows($rs_status);


?>




<div class="grid_12">
  <?php 
		  echo $pesan ;
		?>
</div>

<div class="grid_12">
  <div class="block-border">
    <div class="block-header">
      <h1>Ubah Status Inventaris</h1>
      <span></span> </div>
     
      
    <form action="<?php echo $editFormAction; ?>" name="form"  method="POST" enctype="multipart/form-data" class="block-content form" id="input_status">
   
   
       
      <fieldset> <legend>Data Inventaris</legend><div class="_100">
        <p>
          <label for="file">Kode Barang*</label>
          <label for="merk"></label>
          <input type="text" name="kode_barang" id="kode_barang"  />
           *Klik pada kolom untuk memilih kode 
           <label for="kode_pengadaan"></label>
           <input name="kode_pengadaan" type="hidden" id="kode_pengadaan" value="" />
        </p>
      </div>
     
      <div class="_25">
        <p>
          <label for="merk"></label>
        Nama	Barang
        <label for="nm_barang"></label>
        <input name="nm_barang" type="text" id="nm_barang" readonly="readonly" />
        </p>
      </div>
      <div class="_25">
        <p>
          <label for="tahun"></label>
        Merk
        <label for="merk"></label>
        <input name="merk" type="text" id="merk" readonly="readonly" />
        </p>
      </div>
    
        <div class="_25">
          <p>
            <label for="tahun2"></label>
            Tipe
            <label for="kode_harta"></label>
            <input name="tipe" type="text" id="tipe" readonly="readonly" />
          </p>
        </div>
        
        
        <div class="_25">
          <p>
            <label for="tahun2"></label>
            Tgl Pengadaan
            <label for="kode_harta"></label>
            <input name="tgl_entry" type="text" id="tgl_entry" readonly="readonly" />
          </p>
        </div>
        
        
          <fieldset>
           <legend>Ruangan</legend><div class="_25">
          <p>
            <label for="tahun2"></label>
            Ruangan
            <label for="kode_harta"></label>
            <input name="nm_ruangan" type="text" id="nm_ruangan" readonly="readonly" />
            <input name="ruang_lama" type="hidden" id="ruang_lama" value="" />
          </p>
        </div>
        
         <div class="_25">
          <p>
            <label for="tahun2"></label>
            Unit
            <label for="kode_harta"></label>
            <input name="nm_unit" type="text" id="nm_unit" readonly="readonly" />
            <input name="unit_lama" type="hidden" id="unit_lama" value="" />
          </p>
        </div>
        
         <div class="_25">
          <p>
            <label for="tahun2"></label>
            Kode Inventarisasi
            <label for="kode_harta"></label>
            <input name="kode_inventarisasi" type="text" id="kode_inventarisasi" readonly="readonly" />
            <label for="id_inventarisasi"></label>
            <input name="id_inventarisasi" type="hidden" id="id_inventarisasi" value="" />
            <input name="kode_cabang" type="hidden" id="kode_cabang" value="" />
          </p>
        </div>
         <div class="_25">
           <p>
            <label for="tahun2"></label>
            Status
            <label for="kode_harta"></label>
            <input name="status_before" type="text" id="status_before" readonly="readonly" />
            <input name="status" type="hidden" id="status" value="" />
           </p>
  </div>
          </fieldset>
        
      </fieldset>
   
   <fieldset>
    <legend>Ubah Status
    </legend><div class="_25">
          <p>
            <label for="tahun2"></label>
            Status
            <label for="status_after"></label>
              <select name="status_after" id="status_after">
            <?php do { ?>
                <option value="<?php echo $row_rs_status['status']; ?>"><?php echo $row_rs_status['nm_status']; ?></option>
              <?php } while ($row_rs_status = mysql_fetch_assoc($rs_status)); ?>
              </select>
          </p>
    </div>
    <div class="_25">
          <p>
            <label for="tahun2"></label>
            Keterangan 
            <label for="kode_harta"></label>
            <input name="keterangan_ubah" type="text" id="keterangan_ubah" />
            
          </p>
        </div>
   </fieldset> 

   
      <div class="clear"></div>
      <div class="block-actions">
        <ul class="actions-left">
          <li><a class="button red"  href="?mod=status_inventaris">Kembali</a></li>
        </ul>
        <ul class="actions-right">
          <li>
            <input name="Submit" type="submit" class="button" id="simpan" value="Simpan Pengadaan" />
          </li>
        </ul>
      </div>
      <input type="hidden" name="MM_insert" value="validate-form" />
      <input type="hidden" name="MM_insert" value="form" />
      <input name="tgl_ubah" type="hidden" id="tahun" value="<?php echo date('Y-m-d');?>" />
      <input name="user_ubah" type="hidden" id="tipe" value="<?php echo $_SESSION['user_posting']; ?>" />
    </form>
  </div>
</div>


<div id='form_cari_barang' title='Daftar Inventarisasi'>
	  <table width='100%'>
			<tr>
				<td width='15%'>Cari Barang</td>
				<td width='2%'>:</td>
				<td><input type='text' name='txt_status_cari' id='txt_status_cari' size='50'></td>
			</tr>
		</table>
		<div id='info_barang' align='center'></div>
	</div>
    
<div id="tampil"></div>
<?php
mysql_free_result($rs_status);
?>
