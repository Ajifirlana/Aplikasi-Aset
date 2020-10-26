<?php if(isset($_SESSION[$LEVEL_SES_WEB])) { ?>
<p>&nbsp;</p>
<?php echo "Hai, ".$_SESSION[$USER_SES_WEB];?> | <a href="index.php?mod=log&amp;act=out">Logout</a>
<p><strong>Selamat Datang di beranda Admin </strong></p>
<p>
  <?php } else { include "module/log/login.php"; } ?>
</p>
<p>&nbsp;</p>
