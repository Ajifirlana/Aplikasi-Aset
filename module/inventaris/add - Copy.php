<?php require_once('../../Connections/koneksi.php'); ?>
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
  $insertSQL = sprintf("INSERT INTO aset (kode_barang, nm_barang, kode_golongan, sub_golongan, merk, tipe, tahun, volume, tgl_entry, user_posting, total_unit, masa_servis, poto) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
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
                       GetSQLValueString($_POST['poto'], "text"));

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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
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
      <h1>Tambah Inventaris</h1>
      <span></span> </div>
      
    <form  action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" class="block-content form">
      <div class="_25">
        <p>
          <label for="nm_barang">Kode Barang</label>
          <input id="textfield2" name="kode_barang" class="required" type="text" value="" />
        </p>
      </div>
      <div class="_100">
        <p>
          <label for="textarea">Nama Barang</label>
          <input id="textfield" name="nm_barang" class="required" type="text" value="" />
        </p>
      </div>
      <div class="_25">
        <p>
          <label for="golongan">Golongan</label>
            <select name="kode_golongan" id="golongan">
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
            
          </select>
        </p>
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
      <div class="_50">
        <p> <span class="label">Tahun</span>
          <label for="tahun"></label>
          <input type="text" name="tahun" id="tahun" />
        </p>
      </div>
      <div class="clear">
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
         <div class="_50">
        <p> <span class="label">Masa Servis</span>
          <label for="masa_servis"></label>
          <input type="text" name="masa_servis" id="masa_servis" />
        </p>
      </div>
      
         <div class="_50">
        <p> <span class="label">Gambar 
          <label for="poto"></label>
          <input type="file" name="poto" id="poto" />
        </span></p>
      </div>
            <div class="clear"></div>

      <div class="block-actions">
        <ul class="actions-left">
          <li><a class="button red"  href="?mod=inventaris">Kembali</a>
            <input type="hidden" name="tgl_entry" id="tgl_entry" value="<?php echo date('d-m-Y'); ?>" />
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
    </form>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
		$("#golongan").change(function() {
			var kode_golongan = $("#kode_golongan").val();
			$.ajax({
				url : "get_subgol.php",
				data : "kode_golongan=" + kode_golongan,
				success : function(data) {
					// jika data sukses diambil dari server, tampilkan di <select id=kota>
					$("#subgolongan").html(data);
				}
			});
		});
	});
</script>


</body>
</html>
<?php
mysql_free_result($rs_golongan);

mysql_free_result($rs_subgolongan);
?>
