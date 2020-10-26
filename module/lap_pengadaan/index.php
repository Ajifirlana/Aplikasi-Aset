
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<!--tombol tambah --><!-- Data  -->
<div class="grid_12">
  <div class="block-border">
    <div class="block-header">
      <h1>Laporan Pengadaan Inventarisasi</h1>
      <span></span> </div>
    <div class="block-content">
    <p>
    <form id="form1" name="form1" method="post" action="module/lap_pengadaan/laporan.php" class="block-content form">
     <fieldset><legend>Rentang Tanggal </legend>
      <div class="_25">
        <p>
          <label for="id_pengadaan"></label>
          Dari &gt;=
          <label for="tgl"></label>
        <input name="tgl" type="text" id="tgl" readonly="readonly" />
        </p>
      </div>
      
       <div class="_25">
        <p>
          <label for="id_pengadaan"></label>
        Sampai &lt;=
        <label for="tgl"></label>
        <input name="tgl1" type="text" id="tgl1" readonly="readonly" />
        <input type="submit" name="button" id="button" value="Cetak" class="button" />
        </p>
      </div>
     
     </fieldset>
    </form>
    <p></div>
  </p></div>
</html>
<?php
mysql_free_result($rs_data);
?>
