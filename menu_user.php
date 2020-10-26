<?php 
if ($_SESSION['MM_UserGroup'] == 'admin'){

echo "
<ul>
  <li><a href=\"?mod=user&act=ubah_password\">Ubah Password</a></li>
  <li><a href=\"?mod=user\">Data User</a></li>
  
</ul>";
}else {
echo "
<ul>
  <li><a href=\"?mod=user&act=ubah_password\">Ubah Password</a></li>
  
</ul>";
	
	
	}
?>