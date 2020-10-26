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



if (isset($_POST['cari'])) {
  $colname_rs_data = $_POST['cari'];
}

mysql_select_db($database_koneksi, $koneksi);
$query_rs_data = sprintf("SELECT * FROM tampil_mutasi_cari_brg WHERE kode_barang LIKE %s", GetSQLValueString("%" . $colname_rs_data . "%", "text"));
$rs_data = mysql_query($query_rs_data, $koneksi) or die(mysql_error());
$row_rs_data = mysql_fetch_assoc($rs_data);
$totalRows_rs_data = mysql_num_rows($rs_data);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript">
$(document).ready(function() {

}); 

	function tambah_barang(ID){
		var kode = ID;
		$.ajax({
			type	: "POST",
			url		: "module/pindah_inventaris/cari_barang.php",
			data	: "kode="+kode,
			dataType	: "json",
			success	: function(data){
				$("#kode_barang").val(kode);
				$("#nm_barang").val(data.nm_barang);
				$("#merk").val(data.merk);
				$("#tipe").val(data.tipe);
				$("#ruang_lama").val(data.kode_ruangan) ;
				$("#nm_ruangan").val(data.nm_ruangan);
				$("#unit_lama").val(data.kode_unit);
				$("#nm_unit").val(data.nm_unit);
				$("#tgl_entry").val(data.tgl_entry);
				$("#kode_inventarisasi").val(data.kode_inventarisasi);
				$("#id_inventarisasi").val(data.id_inventarisasi);
				$("#kode_cabang").val(data.kode_cabang);
				
				$("#jml").val(data.jumlah);
				$("#form_cari_barang").dialog('close');
				$("#jumlah").val(0);
				$("#harga_beli").val(0);
				$("#sub_total").val(0);
				$("#jumlah").focus();
			}
		});
	}


</script>

</head>

<body>
<?php if ($totalRows_rs_data > 0) { // Show if recordset not empty ?>
  <table id="table-example" class="table" cellpadding="0" cellspacing="0" border="0">
    <thead>
      <tr>
        <th>NO</th>
        <th>Kode Aset</th>
        <th>Nama Aset</th>
        <th>Ruangan</th>
        <th>Unit</th>
        <th>Pilih</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1;?>
      <?php do { ?>
        <tr class="gradeX">
          <td><center>
            <?php echo $no++ ?>
          </center></td>
          <td><center>
            <?php echo $row_rs_data['kode_barang']; ?>
          </center></td>
          <td><?php echo $row_rs_data['nm_barang']; ?></td>
          <td ><?php echo $row_rs_data['nm_ruangan']; ?></td>
          <td ><?php echo $row_rs_data['nm_unit']; ?></td>
          <td   width="90"><div align="center">
            <a href="javascript:void(0);" onclick="tambah_barang('<?php echo $row_rs_data['kode_barang']; ?>');">
              <img src="img/icons/packs/fugue/16x16/tick-red.png" width="16" height="16" alt="Pilih" id="pilih" /> </a>
          </div></td>
         
        </tr>
        
        <?php } while ($row_rs_data = mysql_fetch_assoc($rs_data)); ?>
      
    </tbody>
  </table>
  <?php } // Show if recordset not empty ?>
  <?php if ($totalRows_rs_data == 0) { // Show if recordset empty ?>
    Data tidak ditemukan
    <?php } // Show if recordset empty ?>
</body>
</html>
<?php
mysql_free_result($rs_data);
?>
