<?php
error_reporting(0);
$md = addslashes(strip_tags($_GET['mod']));
$act = addslashes(strip_tags($_GET['act']));

$fdname = 'module/'.$md;
if (file_exists($fdname)) {

$mod = "module/".$md;
switch ((isset($act) ?  $act : ''))
{
	case 'add':
	include("$mod/add.php");
    break;
	
	case 'tes':
	include("$mod/coba.php");
    break;

	case 'edit':
	include("$mod/edit.php");
	break;

	case 'delete':
	include("$mod/delete.php");
    break;
	
	case 'delupload':
	include("$mod/delupload.php");
    break;
	
	case 'pdf':
	include("$mod/pdf.php");
    break;

	case 'copy':
	include("$mod/copy.php");
    break;

	case 'detail':
	include("$mod/detail.php");
    break;
	
	case 'reply':
	include("$mod/reply.php");
    break;
	
	case 'stat':
	include("$mod/status.php");
    break;
	
	case 'out':
	include("$mod/out.php");
    break;
	
	case 'in':
	include("$mod/login.php");
    break;
	
	case 'data':
	include("$mod/table.php");
    break;
	
	case 'cek_pengaduan':
	include("$mod/cek_pengaduan.php");
    break;
	
	case 'cek':
	include("$mod/cek.php");
    break;
	
	case 'ubah_password':
	include("$mod/ubah_password.php");
    break;

	default: 
    include ("$mod/index.php");
}

}else{
    include ("module/404/index.php");
}
?>
        