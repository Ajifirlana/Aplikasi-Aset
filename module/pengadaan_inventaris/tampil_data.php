<?php require_once('../../Connections/koneksi.php'); ?>
<?php
error_reporting(0);
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
$colname_rs_data = "-1";
if (isset($_POST['kode_pengadaan'])) {
  $colname_rs_data = $_POST['kode_pengadaan'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_rs_data = sprintf("SELECT * FROM tampil_detail_pengadaan WHERE kode_pengadaan = %s", GetSQLValueString($colname_rs_data, "text"));
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

	function tampil_data() {
		var kode 	= $("#kode_pengadaan").val();;
		$.ajax({
				type	: "POST",
				url		: "module/pengadaan_inventaris/tampil_data.php",
				data	: "kode_pengadaan="+kode,
				timeout	: 3000,
				beforeSend	: function(){		
					$("#tampil").html("<img src=\"img/loding/loding.gif\"  alt=\"loading\">");			
				},				  
				success	: function(data){
					$("#tampil").html(data);
				}
		});			
	}



function hapus_data(ID) {
		var kode = $("#kode_pengadaan").val(); 
		var id	= ID;
	   var pilih = confirm('Data yang akan dihapus kode = '+id+ '?');
		if (pilih==true) {
			$.ajax({
				type	: "POST",
				url		: "module/pengadaan_inventaris/hapus_detail.php",
				data	: "kode="+kode+"&id="+id+"&kode_pengadaan="+kode,
				success	: function(data){
					$("#tampil").html(data);
					tampil_data();
				}
			});
		}
}


	function tambah_barang(ID){
		var kode = ID;
		$.ajax({
			type	: "POST",
			url		: "module/pengadaan_inventaris/cari_barang.php",
			data	: "kode="+kode,
			dataType	: "json",
			success	: function(data){
				$("#kode_barang").val(kode);
				$("#nm_barang").val(data.nm_barang);
				$("#merk").val(data.merk);
				$("#tipe").val(data.tipe);
				$("#sisa_jumlah").val(data.sisa_jumlah);
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
<div class="grid_6">
  <div class="block-border">
    <div class="block-header">
      <h1>Tampil Data</h1>
      <span></span> </div>

<?php if ($totalRows_rs_data > 0) { // Show if recordset not empty ?>
  <table id="table-example" class="table" cellpadding="0" cellspacing="0" border="0">
    <thead>
      <tr>
        <th>NO</th>
        <th>Kode Aset</th>
        <th>Nama Aset</th>
        <th>Jumlah</th>
        <th>Harga</th>
        <th>Total</th>
        <th>Hapus</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1;?>
      <?php do { ?>
     <?php $kode = $row_rs_data[kode_pengadaan].$row_rs_data[kode_suplier].$row_rs_data[kode_barang] ;?>
        <tr class="gradeX">
          <td><center>
            <?php echo $no++ ?>
          </center></td>
          <td><center>
            <?php echo $row_rs_data['kode_barang']; ?>
          </center></td>
          <td><?php echo $row_rs_data['nm_barang']; ?></td>
          <td ><?php echo $row_rs_data['jumlah']; ?></td>
          <td ><?php echo $row_rs_data['harga_beli']; ?></td>
          <td  width="50"><center>
            <?php echo $row_rs_data['total']; ?>
          </center></td>
          <td   width="90"><div align="center">
        <a href="javascript:void(0);"  onClick="hapus_data('<?php echo $kode ?>')">
          <img src="img/icons/packs/silk/16x16/cross.png" width="16" height="16" alt="Pilih" id="pilih" /> </a>
          </div></td>
         
        </tr>
        
        <?php } while ($row_rs_data = mysql_fetch_assoc($rs_data)); ?>
      
    </tbody>
  </table>
  <?php } // Show if recordset not empty ?>

    
  </div>
  </div>
 <div id="info"></div> 
</body>
</html>
<?php
mysql_free_result($rs_data);
?>
