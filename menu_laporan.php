<?php 
if ($_SESSION['MM_UserGroup'] == 'admin'){
echo "
<ul>
  <li><a href=\"?mod=lap_inventaris\">Laporan Inventaris</a></li>
  <li><a href=\"?mod=lap_suplier\">Laporan Data Suplier</a></li>
  <li><a href=\"?mod=lap_cabang\">Laporan Data Cabang</a></li>
  <li><a href=\"?mod=lap_unit\">Laporan Data Unit</a></li>
  <li><a href=\"?mod=lap_ruang\">Laporan Data Ruang</a></li>
  <li><a href=\"?mod=lap_pengadaan\">Laporan Pengadaan Inventaris</a></li>
  <li><a href=\"?mod=lap_inventarisasi\">Laporan Data Inventarisasi</a></li>
  <li><a href=\"?mod=lap_mainten\">Laporan Data Jadwal Maintenance</a></li>
  <li><a href=\"?mod=lap_mutasi\">Laporan Mutasi Inventarisasi</a></li>

</ul>";
}else {
echo "
 <ul>	
	<li><a href=\"?mod=lap_inventaris\">Laporan Inventaris</a></li>
  <li><a href=\"?mod=lap_suplier\">Laporan Data Suplier</a></li>
  <li><a href=\"?mod=lap_cabang\">Laporan Data Cabang</a></li>
  <li><a href=\"?mod=lap_unit\">Laporan Data Unit</a></li>
  <li><a href=\"?mod=lap_ruang\">Laporan Data Ruang</a></li>
</ul>";	
	}
?>
