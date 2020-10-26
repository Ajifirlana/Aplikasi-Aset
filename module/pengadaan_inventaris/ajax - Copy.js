// JavaScript Document
$(document).ready(function() {
	$("#harga_beli").keyup(function(){
		var jml		= $("#jumlah").val();
		var harga	= $("#harga_beli").val();
		if (jml.length!='' & harga.length!='' ) {
			var total	= parseFloat(jml)*parseFloat(harga);
			$("#sub_total").val(total);
		}else{
			$("#sub_total").val(0);
		}});

	
	
	
	//membuat text kode barang menjadi Kapital
	$("#kode_barang").keyup(function(e){
		var isi = $(e.target).val();
		$(e.target).val(isi.toUpperCase());
	});

	// format datepicker untuk tanggal
	$("#txt_tgl_beli").datepicker({
				dateFormat      : "dd-mm-yy",        
	  showOn          : "button",
	  buttonImage     : "images/calendar.gif",
	  buttonImageOnly : true				
	});
	
	//hanya angka yang dapat dientry
	$("#txt_jumlah").keypress(function(data){
		if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) 
		{
			return false;
		}
	});


	function kosong(){
		$(".detail_readonly").val('');
		$(".input_detail").val('');
	}
	
	function cari_nomor() {
		var no		=1;
		$.ajax({
			type	: "POST",
			url		: "modul/pembelian/cari_nomor.php",
			data	: "no="+no,
			dataType : "json",
			success	: function(data){
				$("#txt_kode_beli").val(data.nomor);
				tampil_data();
			}
		});		
	}

	function tampil_data() {
		var kode 	= $("#txt_kode_beli").val();;
		$.ajax({
				type	: "POST",
				url		: "modul/pembelian/tampil_data.php",
				data	: "kode="+kode,
				timeout	: 3000,
				beforeSend	: function(){		
					$("#info").html("<img src='loading.gif' />");			
				},				  
				success	: function(data){
					$("#info").html(data);
				}
		});			
	}

	
	cari_nomor();
	
	$("#txt_kode_barang").autocomplete("modul/pembelian/list_barang.php", {
				width:100,
				max: 10,
				scroll:false,
	});
	
	function cari_kode() {
		var kode	= $("#txt_kode_barang").val();
		$.ajax({
			type	: "POST",
			url		: "modul/pembelian/cari_barang.php",
			data	: "kode="+kode,
			dataType : "json",
			success	: function(data){
				$("#txt_nama_barang").val(data.nama_barang);
				$("#txt_satuan").val(data.satuan);
				$("#txt_harga").val(data.harga);
			}
		});		
	}
	
	$("#txt_kode_barang").keyup(function() {
		cari_kode();
	});
	$("#txt_kode_barang").focus(function() {
		cari_kode();
	});
	
	//mengalikan jumlah dengan harga
	$("#txt_jumlah").keyup(function(){
		var jml		= $("#txt_jumlah").val();
		var harga	= $("#txt_harga").val();
		if (jml.length!='') {
			var total	= parseInt(jml)*parseInt(harga);
			$("#txt_total").val(total);
		}else{
			$("#txt_total").val(0);
		}
	});


	$("#tambah_detail").click(function(){
		kosong();	
		$("#txt_kode_barang").focus();
	});

	
	$("#simpan").click(function(){
		var kode_pengadaan	= $("#kode_pengadaan").val();	
		var kode_barang		= $("#kode_barang").val();	
		var kode_cabang		= $("#kode_cabang").val();	
		var	kode_suplier	= $("#kode_suplier").val();
		var	no_polisi		= $("#no_polisi").val();
		var	no_bpkb			= $("#no_bpkb").val();
		var	no_sertifikat	= $("#no_sertifikat").val();
		var no_faktur		= $("#no_faktur").val();	
		var tgl_beli		= $("#tgl_beli").val();	
		var harga_beli		= $("#harga_beli").val();	
		var jumlah			= $("#jumlah").val();	
		var user_posting	= $("#user_posting").val();	
		var luas			= $("#luas").val();
		
		
		
		$.ajax({
			type	: "POST",
			url		: "module/pengadaan_inventaris/simpan.php",
			data	: "kode_pengadaan="+kode_pengadaan+
						"&kode_barang="+kode_barang+
						"&kode_cabang="+kode_cabang+
						"&kode_suplier="+kode_suplier+
						"&no_polisi="+no_polisi+
						"&no_bpkb="+no_bpkb+
						"&no_sertifikat="+no_sertifikat+
						"&no_faktur="+no_faktur+
						"&tgl_beli="+tgl_beli+
						"&jumlah_beli="+jumlah_beli+
						"&harga_beli="+harga_beli+
						"&luas="+luas,
			timeout	: 3000,
			beforeSend	: function(){		
				$("#info").show();
				$("#info").html("<img src='img/loding/loding.gif'>");			
			},				  
			success	: function(data){
				$("#info").show();
				$("#info").html(data);
			}
		});
		
		return false; 
	});

	$("#tambah_beli").click(function() {
		$(".input").val('');
		kosong();
		cari_nomor();
		$("#txt_tgl_beli").focus();
	});

	$("#keluar").click(function(){
		document.location='?module=home';
	});

});

