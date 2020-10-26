<?php require_once('../../Connections/koneksi.php'); ?>
<?php //require_once('../../Connections/koneksi.php'); ?>

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

$colname_rs_subgol = "-1";
if (isset($_GET['kode_golongan'])) {
  $colname_rs_subgol = $_GET['kode_golongan'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_rs_subgol = sprintf("SELECT * FROM tampil_combosubgol WHERE kode_golongan = %s", GetSQLValueString($colname_rs_subgol, "text"));
$rs_subgol = mysql_query($query_rs_subgol, $koneksi) or die(mysql_error());
$row_rs_subgol = mysql_fetch_assoc($rs_subgol);
$totalRows_rs_subgol = mysql_num_rows($rs_subgol);
?>
<option>-- Pilih Subgolongan -- </option>
<?php do { ?>
  <option value="<?php echo $row_rs_subgol['sub_golongan']; ?>"><?php echo $row_rs_subgol['nm_subgolongan']; ?></option>
  <?php } while ($row_rs_subgol = mysql_fetch_assoc($rs_subgol)); ?>
<?php

mysql_free_result($rs_subgol);
?>


