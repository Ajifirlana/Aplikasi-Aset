<?php 
if ($_SESSION['MM_UserGroup'] == 'admin'){

echo "
<ul>
   
  <li><a href=\"?mod=pengadaan_inventaris\">Pengadaan Inventaris</a></li>
  <li><a href=\"?mod=penempatan_inventaris\">Penempatan Inventaris</a></li>
  <li><a href=\"?mod=pindah_inventaris\">Pindah/Mutasi Inventaris</a></li>
  <li><a href=\"?mod=mainten_inventaris\">Maintenance Inventaris</a></li>
  <li><a href=\"?mod=status_inventaris\">Perubahan Status Inventaris</a></li>
</ul>";
}else {
	
echo "
<ul>
  <li><a href=\"?mod=pengadaan_inventaris\">Pengadaan Inventaris</a></li>
  <li><a href=\"?mod=penempatan_inventaris\">Penempatan Inventaris</a></li>

</ul>";
	
	
	}
?>
