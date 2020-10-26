// JavaScript Document
$(document).ready(function() {
	$("#jumlah-").keyup(function(){
		var sisa_jml		= $("#sisa_jumlah2").val();
		var jumlah	        = $("#jumlah").val();
		if (sisa_jml.length!='' & jumlah.length!='' ) {
			var total	= parseFloat(sisa_jml)-parseFloat(jumlah);
			$("#sisa_jumlah").val(total);
			
		}else{
			$("#sisa_jumlah").val($("#sisa_jumlah2").val());
		}
		if (jumlah > sisa_jml) {
			 alert('jumlah tidak boleh lebih besar dari sisa jumlah');
			}
		});

	
	
	
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
	$("#jumlah,#harga_beli").keypress(function(data){
		if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) 
		{
			return false;
		}
	});


	function kosong(){
		$("#kode_barang").val('');
		$("#kode_cabang").val('');
		$("#sisa_jumlah").val('');
		$("#nm_barang").val('');
		$("#kode_pengadaan").val('');
		$("#id_pengadaan").val('');
		$("#jumlah").val(0);
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
		var kode 	= $("#kode_pengadaan").val();;
		$.ajax({
				type	: "POST",
				url		: "module/pengadaan_inventaris/tampil_data.php",
				data	: "kode_pengadaan="+kode,
				timeout	: 3000,
				beforeSend	: function(){		
					$("#tampil").html("<img src=\"img/loding/loding.gif\"  alt=\"loading\">");			
				},				  
				success	: function(data){
					$("#tampil").html(data);
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

    	
function hapus_data(ID) {
		var kode = $("#kode_pengadaan").val(); 
		var id	= ID;
	   var pilih = confirm('Data yang akan dihapus kode = '+id+ '?');
		if (pilih==true) {
			$.ajax({
				type	: "POST",
				url		: "module/pengadaan_inventaris/hapus_detail.php",
				data	: "kode="+kode+"&id="+id+"&kode_pengadaan="+kode,
				success	: function(data){
					$("#tampil").html(data);
					tampil_data();
				}
			});
		}
}

	
	$('#input_inventarisasi').submit(function(e){
                    e.preventDefault();
                    $.ajax({
                        'type': 'POST',
                        'url': 'module/penempatan_inventaris/simpan.php',
                        'data': $(this).serialize(),
						'timeout'	: 3000,
						'beforeSend'	: function(){		
						    $('#tampil').show();
						    $('#tampil').html('<img src="img/loding/loding.gif"  alt="loading">');			
			            },	
                        'success': function(html){
							$("#tampil").show();
                            $('#tampil').html(html);
							
                        }
                    });
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

