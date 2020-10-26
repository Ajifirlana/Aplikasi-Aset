<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
  if(!isset($_SESSION['MM_Username']) && !isset($_SESSION['MM_UserGroup'])){
	  header('location: login.php');
	  exit();
	  
	  }
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  
  <!-- DNS prefetch 
  <link rel=dns-prefetch href="//fonts.googleapis.com">-->

  <!-- Use the .htaccess and remove these lines to avoid edge case issues.
       More info: h5bp.com/b/378 -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>Halaman Administrator</title>
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Mobile viewport optimized: j.mp/bplateviewport -->
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <!-- Place favicon.ico and apple-touch-icon.png in the root directory: mathiasbynens.be/notes/touch-icons -->

  <!-- CSS: implied media=all -->
  <!-- CSS concatenated and minified via ant build script-->
  <link rel="stylesheet" href="css/style.css"> <!-- Generic style (Boilerplate) -->
  <link rel="stylesheet" href="css/960.fluid.css"> <!-- 960.gs Grid System -->
  <link rel="stylesheet" href="css/main.css"> <!-- Complete Layout and main styles -->
  <link rel="stylesheet" href="css/buttons.css"> <!-- Buttons, optional -->
  <link rel="stylesheet" href="css/lists.css"> <!-- Lists, optional -->
  <link rel="stylesheet" href="css/icons.css"> <!-- Icons, optional -->
  <link rel="stylesheet" href="css/notifications.css"> <!-- Notifications, optional -->
  <link rel="stylesheet" href="css/typography.css"> <!-- Typography -->
  <link rel="stylesheet" href="css/forms.css"> <!-- Forms, optional -->
  <link rel="stylesheet" href="css/tables.css"> <!-- Tables, optional -->
  <link rel="stylesheet" href="css/charts.css"> <!-- Charts, optional -->
  <link rel="stylesheet" href="css/jquery-ui-1.8.15.custom.css"> <!-- jQuery UI, optional -->
  <!-- end CSS-->
  
  <!-- Fonts -->
  <link href="Fonts/REZ.ttf" rel="stylesheet" type="text/css">
  <!-- end Fonts-->

  <!-- More ideas for your <head> here: h5bp.com/d/head-Tips -->

  <!-- All JavaScript at the bottom, except for Modernizr / Respond.
       Modernizr enables HTML5 elements & feature detects; Respond is a polyfill for min/max-width CSS3 Media Queries
       For optimal performance, use a custom Modernizr build: www.modernizr.com/download/ -->
  <script src="js/libs/modernizr-2.0.6.min.js"></script>
  
  
  <script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />

<!-- boostrap -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap-theme.min.css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
<!-- end boostrap -->

</head>

<body id="top">

  <!-- Begin of #container -->
  <div id="container">
  	<!-- Begin of #header -->
    <div id="header-surround"><header id="header">
    	
    	<!-- Place your logo here -->
		<img src="img/logo.png" alt="Grape" width="119" height="30" class="logo">
		
		<!-- Divider between info-button and the toolbar-icons -->
	  <div class="divider-header divider-vertical"></div>

		<!-- Info-Button -->
		<a href="javascript:void(0);" onClick="$('#info-dialog').dialog({ modal: true });"><span class="btn-info"></span></a>
		
			<!-- Modal Box Content -->
			<div id="info-dialog" title="Tentang" style="display: none;">
				<center><p>SISTEM INFORMASI MANAJEMEN ASET</p>
				<p>Universitas ALMUSLIM PEUSANGAN</p>
                <p>Tahun 2015</p></center>
			</div> <!--! end of #info-dialog -->
		
		<!-- Begin from Toolbox -->
		<ul class="toolbox-header">
			<!-- First entry -->
			<li>
			  <div class="toolbox-content">
					
				  <!-- Box -->
				  <div class="block-border">
						<div class="block-header small">
							<h1>Create a User</h1>
						</div>
						<form id="create-user-form" class="block-content form" action="" method="post">
							<div class="_100">
								<p><label for="username">Username</label><input id="username" name="username" class="required" type="text" value="" /></p>
							</div>
							<div class="_50">
								<p class="no-top-margin"><label for="firstname">Firstname</label><input id="firstname" name="firstname" class="required" type="text" value="" /></p>
							</div>
							<div class="_50">
								<p class="no-top-margin"><label for="lastname">Lastname</label><input id="lastname" name="lastname" class="required" type="text" value="" /></p>
							</div>
							<div class="clear"></div>
							
							<!-- Buttons with actionbar  -->
							<div class="block-actions">
								<ul class="actions-left">
									<li><a class="close-toolbox button red" id="reset" href="javascript:void(0);">Cancel</a></li>
								</ul>
								<ul class="actions-right">
									<li><input type="submit" class="button" value="Create the User"></li>
								</ul>
							</div> <!--! end of #block-actions -->
						</form>
				</div> <!--! end of box -->
					
			  </div>
		  </li> <!--! end of first entry -->
			
			<!-- Second entry -->
			<li>
			  <div class="toolbox-content">
					
				  <!-- Box -->
			  <div class="block-border">
						<div class="block-header small">
							<h1>Write a Message</h1>
						</div>
						<form id="write-message-form" class="block-content form" action="" method="post">							
							<p class="inline-mini-label">
								<label for="recipient">Recipient</label>
								<input type="text" name="recipient" class="required">
							</p>
							<p class="inline-mini-label">
								<label for="subject">Subject</label>
								<input type="text" name="subject">
							</p>
							<div class="_100">
								<p class="no-top-margin"><label for="message">Message</label><textarea id="message" name="message" class="required" rows="5" cols="40"></textarea></p>
							</div>
							
							<div class="clear"></div>
							
							<!-- Buttons with actionbar  -->
							<div class="block-actions">
								<ul class="actions-left">
									<li><a class="close-toolbox button red" id="reset2" href="javascript:void(0);">Cancel</a></li>
								</ul>
								<ul class="actions-right">
									<li><input type="submit" class="button" value="Send Message"></li>
								</ul>
							</div> <!--! end of #block-actions -->
						</form>
				</div> <!--! end of box -->
					
			  </div>
			</li> <!--! end of second entry -->
			
			<!-- Third entry -->
			<li>
			  <div class="toolbox-content">
					
				  <!-- Box -->
			  <div class="block-border">
						<div class="block-header small">
							<h1>Create a Folder</h1>
						</div>
						<form id="create-folder-form" class="block-content form" action="" method="post">
							<p class="inline-mini-label">
								<label for="folder-name">Name</label>
								<input type="text" name="folder-name" class="required">
							</p>
							
							<!-- Buttons with actionbar  -->
							<div class="block-actions">
								<ul class="actions-left">
									<li><a class="close-toolbox button red" id="reset3" href="javascript:void(0);">Cancel</a></li>
								</ul>
								<ul class="actions-right">
									<li><input type="submit" class="button" value="Create Folder"></li>
								</ul>
							</div> <!--! end of #block-actions -->
						</form>
				</div> <!--! end of box -->
					
			  </div>
			</li> <!--! end of third entry -->
		</ul>
		
		<!-- Begin of #user-info -->
		<div id="user-info">
			<p>
				<span class="messages">Hello</span><?php echo $_SESSION['MM_UserGroup']; ?>
				 <a href="<?php echo $logoutAction ?>" class="button red">Logout</a>
			</p>
		</div> 
		<!--! end of #user-info -->
		
    </header></div> <!--! end of #header -->
    
    <div class="fix-shadow-bottom-height"></div>
	
	<!-- Begin of Sidebar -->
    <aside id="sidebar">
    	
    	<!-- Search -->
    	 <!--! end of #search-bar -->
		
		<!-- Begin of #login-details -->
		<section id="login-details">
    		<img class="img-left framed" src="img/misc/avatar_small.png" alt="Hello Admin">
    		<h3>Yang Login</h3>
    		<h2><a class="user-button" href="javascript:void(0);"><?php echo $_SESSION['MM_UserGroup']; ?>&nbsp;<span class="arrow-link-down"></span></a></h2>
    		<ul class="dropdown-username-menu">
    	
    			<li><a href="?mod=user&act=ubah_password">Ubah Password</a></li>
    			<li><a href="<?php echo $logoutAction ?>">Logout</a></li>
    		</ul>
    		
    		<div class="clearfix"></div>
  		</section> <!--! end of #login-details -->
    	
    	<!-- Begin of Navigation -->
    	<nav id="nav">
	    	<ul class="menu collapsible shadow-bottom">
	    		<li><a href="index.php" class="current"><img src="img/icons/packs/fugue/16x16/bank.png">Dashboard</a></li>
	    		<li>
	    			<a href="javascript:void(0);"><img src="img/icons/packs/fugue/16x16/clipboard-list.png">Master Data</a>
    			    <ul class="sub">
	    				<?php include("menu_md.php"); ?>
	    			</ul>
	    		</li>
                
           <!--     <li>
	    			<a href="javascript:void(0);"><img src="img/icons/packs/fugue/16x16/folder--pencil.png">Inguiry</a>
    			    <ul class="sub">
	    				<?php// include("menu_inguiry.php"); ?>
    			  </ul>
   		    </li> -->
	    		
	    		<li>
	    			<a href="javascript:void(0);"><img src="img/icons/packs/fugue/16x16/cigarette.png">Proses</a>
	    			<ul class="sub">
	    				<?php include("menu_proses.php"); ?>
	    			</ul>
	    		</li>
	    		<li>
	    			<a href="javascript:void(0);"><img src="img/icons/packs/fugue/16x16/user-white.png">User</a>
	    			<ul class="sub">
	    				<?php include("menu_user.php"); ?>
	    			</ul>
	    		</li>
                
                <li>
	    			<a href="javascript:void(0);"><img src="img/icons/packs/fugue/16x16/newspaper.png">Laporan</a>
	    			<ul class="sub">
	    				<?php include("menu_laporan.php"); ?>
	    			</ul>
	    		</li>
	    	</ul>
    	</nav> <!--! end of #nav -->
    	
    </aside> <!--! end of #sidebar -->
    
    <!-- Begin of #main -->
  <div id="main" role="main">
    	
    	<!-- Begin of titlebar/breadcrumbs -->
		<div id="title-bar">
			<ul id="breadcrumbs">
				<li><a href="index.php" title="Home"><span id="bc-home"></span></a></li>
                
				<li class="no-hover">Administrator</li>
			</ul>
	  </div> <!--! end of #title-bar -->
		
		<div class="shadow-bottom shadow-titlebar"></div>
		
		<!-- Begin of #main-content -->
		<div id="main-content">
			<div class="container_12">
			
			<div class="grid_12"><?php include("act.php"); ?>
				
			</div>
			<div class="clear height-fix"></div>

		</div></div> <!--! end of #main-content -->
  </div> <!--! end of #main -->

    
  </div> <!--! end of #container -->


  <!-- JavaScript at the bottom for fast page loading -->

  <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
  <script src="js/libs/jquery-1.6.2.min.js"></script>


  <!-- scripts concatenated and minified via ant build script-->
  <script defer src="js/plugins.js"></script> <!-- lightweight wrapper for consolelog, optional -->
  <script defer src="js/mylibs/jquery-ui-1.8.15.custom.min.js"></script> <!-- jQuery UI -->
  <script defer src="js/mylibs/jquery.notifications.js"></script> <!-- Notifications  -->
  <script defer src="js/mylibs/jquery.uniform.min.js"></script> <!-- Uniform (Look & Feel from forms) -->
  <script defer src="js/mylibs/jquery.validate.min.js"></script> <!-- Validation from forms -->
  <script defer src="js/mylibs/jquery.dataTables.min.js"></script> <!-- Tables -->
  <script defer src="js/mylibs/jquery.tipsy.js"></script> <!-- Tooltips -->
  <script defer src="js/mylibs/excanvas.js"></script> <!-- Charts -->
  <script defer src="js/mylibs/jquery.visualize.js"></script> <!-- Charts -->
  <script defer src="js/mylibs/jquery.slidernav.min.js"></script> <!-- Contact List -->
  <script defer src="js/common.js"></script> <!-- Generic functions -->
  <script defer src="js/script.js"></script> <!-- Generic scripts -->
  
  <script defer src="module/pengadaan_inventaris/ajax.js"></script>
    <script defer src="module/penempatan_inventaris/ajax_inventarisasi.js"></script>
    <script defer src="module/pindah_inventaris/ajax_mutasi.js"></script>
    <script defer src="module/mainten_inventaris/ajax_mainten.js"></script>
    <script defer src="module/status_inventaris/ajax_status.js"></script>

  <script type="text/javascript">
	$().ready(function() {
			
		
			
			/*
		 * Dialog Pencarian
		 */
         $('#form_cari_barang').dialog({
			autoOpen: false,
			modal	: true,
			width: 700,
	    });

		
		
		$('#kode_barang').click(function(){
		  $('#form_cari_barang').dialog('open');
		  return false;
	    });

		$("#txt_cari").keyup(function(){
				var cari	= $("#txt_cari").val();								  
				$.ajax({
					type	: "POST",
					url		: "module/pengadaan_inventaris/tampil_data_barang.php",
					data	: "cari="+cari,
					timeout	: 3000,
					beforeSend	: function(){		
						$("#info_barang").html("<img src='img/loding/loding.gif'>");			
					},				  
					success	: function(data){
						$("#info_barang").html(data);
					}
				});
		});
		
				$("#txt_penempatan_cari").keyup(function(){
				var cari	= $("#txt_penempatan_cari").val();								  
				$.ajax({
					type	: "POST",
					url		: "module/penempatan_inventaris/tampil_data_barang.php",
					data	: "cari="+cari,
					timeout	: 3000,
					beforeSend	: function(){		
						$("#info_barang").html("<img src='img/loding/loding.gif'>");			
					},				  
					success	: function(data){
						$("#info_barang").html(data);
					}
				});
		});
		
		
		$("#txt_mutasi_cari").keyup(function(){
				var cari	= $("#txt_mutasi_cari").val();								  
				$.ajax({
					type	: "POST",
					url		: "module/pindah_inventaris/tampil_data_barang.php",
					data	: "cari="+cari,
					timeout	: 3000,
					beforeSend	: function(){		
						$("#info_barang").html("<img src='img/loding/loding.gif'>");			
					},				  
					success	: function(data){
						$("#info_barang").html(data);
					}
				});
		});
		
		
		/*
		 * Datepicker
		 */
		$( "#tgl,#tgl1" ).datepicker({
			dateFormat      : "yy-mm-dd", 
			
			});	
			
	     /*
		 * DataTables
		 */
		$('#table-example').dataTable({
			"oLanguage": {
   			"sProcessing":   "Sedang proses...",
		   "sLengthMenu":   "Lihat _MENU_ entri",
		   "sZeroRecords":  "Tidak ditemukan data yang sesuai",
		   "sInfo":         "Tampilan _START_ sampai _END_ dari _TOTAL_ entri",
		   "sInfoEmpty":    "Tampilan 0 hingga 0 dari 0 entri",
		   "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
		   "sInfoPostFix":  "",
		   "sSearch":       "Cari:",
		   "sUrl":          "",
		   "oPaginate": {
			   "sFirst":    "Awal",
			   "sPrevious": "Balik",
			   "sNext":     "Lanjut",
			   "sLast":     "Akhir"
   }
}
			
			});
		
		
		/*
		 * Form Validation
		 */
		$.validator.setDefaults({
			submitHandler: function(e) {
				$(e).parent().parent().fadeOut();
				v.resetForm();
				v2.resetForm();
				v3.resetForm();
			}
		});
		var v = $("#create-user-form").validate();
		jQuery("#reset").click(function() { v.resetForm(); $.jGrowl("User was not created!", { theme: 'error' }); });
		
		var v2 = $("#write-message-form").validate();
		jQuery("#reset2").click(function() { v2.resetForm(); $.jGrowl("Message was not sent.", { theme: 'error' }); });
		
		var v3 = $("#create-folder-form").validate();
		jQuery("#reset3").click(function() { v3.resetForm(); $.jGrowl("Folder was not created!", { theme: 'error' }); });
		
		var validateform = $("#validate-form").validate();
		$("#reset-validate-form").click(function() {
			validateform.resetForm();
			
		});
	});
	
	
	
  </script>
  
<script type="text/javascript">
$(document).ready(function() {
	
		$("#kode_golongan").change(function() {
		 
		 $("#subgolongan").empty();
		 
		 
			var kode_golongan = $("#kode_golongan").val();
			$.ajax({
				url : "module/inventaris/get_subgol.php",
				data : "kode_golongan=" + kode_golongan,
				success : function(data) {
					// jika data sukses diambil dari server, tampilkan di <select id=kota>
					$("#subgolongan").html(data);
				}
			});
		});
	});
</script>
  <!-- end scripts-->

  <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
       chromium.org/developers/how-tos/chrome-frame-getting-started -->
  <!--[if lt IE 7 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
  <![endif]-->
  
</body>
</html>