<?php session_start();

if(!isset($_SESSION[$LEVEL_SES_WEB])) { 

if(isset($_POST['Submit']))
{
	//pengaturan session lihat di controller/session_conf.php
	
	$username = addslashes(strip_tags($_POST['username']));
	$password = md5(addslashes(strip_tags( $_POST['password'])));
				
			$sql = mysql_query("select * from admin where username='$username' and password='$password'");
			if(mysql_num_rows($sql) > 0){
			
				$row = mysql_fetch_assoc($sql);
					
				$_SESSION[$USER_SES_WEB] = $row['username'];
				$_SESSION[$USERID_SES_WEB] = $row['no_user'];
				$_SESSION[$LEVEL_SES_WEB] = $row['type'];
								
				$pesan = "Selamat Datang diberanda Admin ";
				echo "<script>alert('$pesan');location.href='index.php?mod=log';</script>";
				
			}else{
				$pesan = "Login Gagal, silakan ulangi";
				echo "<script>alert('$pesan'); window.history.back(1);</script>";
			}
}

?>
<table border="0" cellpadding="5" cellspacing="5" width="450">
    <tr>
      <td height="51" align="center" valign="middle"  class="titlegrey boxtop"><strong>LOGIN ADMINISTRATOR </strong></td>
    </tr>
    <tr><td align="center" valign="middle" class="boxbottom"></br>
	<form name="form1" method="post" action="">
	    <table border="0" cellpadding="0" cellspacing="2">
		  <tr>
			<td width="94" height="21" class="style_td">Username</td>
			<td height="21" class="style_td">: <input name="username" type="text" id="username" autocomplete="off"></td>
		  </tr>
		  <tr>
			<td height="21" class="style_td">Password</td>
			<td height="21" class="style_td">: <input name="password" type="password" id="password" autocomplete="off"></td>
		  </tr>
		  <tr>
			<td height="21" class="style_td">&nbsp;</td>
			<td height="21" class="style_td"> &nbsp; <input type="submit" name="Submit" value="Login" style="cursor: pointer;"> 
			</br></br></td>
		  </tr>
		  <tr>
			<td colspan="2"></td>
		  </tr>
		</table>
	</form></td></tr>
</table>
<?php } else { include "module/log/index.php"; } ?>