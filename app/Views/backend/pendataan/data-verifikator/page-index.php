<style>
	.select2-container {
		z-index: 99999;
	}

	@-webkit-keyframes drop-in-fade-out {
	0% {
		opacity: 0;
		visibility: visible;
		-webkit-transform: translate3d(0, -200%, 0);
		-moz-transform: translate3d(0, -200%, 0);
		-ms-transform: translate3d(0, -200%, 0);
		-o-transform: translate3d(0, -200%, 0);
		transform: translate3d(0, -200%, 0);
	}
	12% {
		-webkit-transform: translate3d(0, 0, 0);
		-moz-transform: translate3d(0, 0, 0);
		-ms-transform: translate3d(0, 0, 0);
		-o-transform: translate3d(0, 0, 0);
		transform: translate3d(0, 0, 0);
	}
	20% {
		opacity: 1;
	}
	70% {
		opacity: 1;
		visibility: visible;
		-webkit-transform: translate3d(0, 0, 0);
		-moz-transform: translate3d(0, 0, 0);
		-ms-transform: translate3d(0, 0, 0);
		-o-transform: translate3d(0, 0, 0);
		transform: translate3d(0, 0, 0);
	}
	80% {
		opacity: 0;
	}
	100% {
		visibility: hidden;
		-webkit-transform: translate3d(75%, 0, 0);
		-moz-transform: translate3d(75%, 0, 0);
		-ms-transform: translate3d(75%, 0, 0);
		-o-transform: translate3d(75%, 0, 0);
		transform: translate3d(25%, 0, 0);
	}
	}
	@-moz-keyframes drop-in-fade-out {
	0% {
		opacity: 0;
		visibility: visible;
		-webkit-transform: translate3d(0, -200%, 0);
		-moz-transform: translate3d(0, -200%, 0);
		-ms-transform: translate3d(0, -200%, 0);
		-o-transform: translate3d(0, -200%, 0);
		transform: translate3d(0, -200%, 0);
	}
	12% {
		-webkit-transform: translate3d(0, 0, 0);
		-moz-transform: translate3d(0, 0, 0);
		-ms-transform: translate3d(0, 0, 0);
		-o-transform: translate3d(0, 0, 0);
		transform: translate3d(0, 0, 0);
	}
	20% {
		opacity: 1;
	}
	70% {
		opacity: 1;
		visibility: visible;
		-webkit-transform: translate3d(0, 0, 0);
		-moz-transform: translate3d(0, 0, 0);
		-ms-transform: translate3d(0, 0, 0);
		-o-transform: translate3d(0, 0, 0);
		transform: translate3d(0, 0, 0);
	}
	80% {
		opacity: 0;
	}
	100% {
		visibility: hidden;
		-webkit-transform: translate3d(75%, 0, 0);
		-moz-transform: translate3d(75%, 0, 0);
		-ms-transform: translate3d(75%, 0, 0);
		-o-transform: translate3d(75%, 0, 0);
		transform: translate3d(25%, 0, 0);
	}
	}
	@-o-keyframes drop-in-fade-out {
	0% {
		opacity: 0;
		visibility: visible;
		-webkit-transform: translate3d(0, -200%, 0);
		-moz-transform: translate3d(0, -200%, 0);
		-ms-transform: translate3d(0, -200%, 0);
		-o-transform: translate3d(0, -200%, 0);
		transform: translate3d(0, -200%, 0);
	}
	12% {
		-webkit-transform: translate3d(0, 0, 0);
		-moz-transform: translate3d(0, 0, 0);
		-ms-transform: translate3d(0, 0, 0);
		-o-transform: translate3d(0, 0, 0);
		transform: translate3d(0, 0, 0);
	}
	20% {
		opacity: 1;
	}
	70% {
		opacity: 1;
		visibility: visible;
		-webkit-transform: translate3d(0, 0, 0);
		-moz-transform: translate3d(0, 0, 0);
		-ms-transform: translate3d(0, 0, 0);
		-o-transform: translate3d(0, 0, 0);
		transform: translate3d(0, 0, 0);
	}
	80% {
		opacity: 0;
	}
	100% {
		visibility: hidden;
		-webkit-transform: translate3d(75%, 0, 0);
		-moz-transform: translate3d(75%, 0, 0);
		-ms-transform: translate3d(75%, 0, 0);
		-o-transform: translate3d(75%, 0, 0);
		transform: translate3d(25%, 0, 0);
	}
	}
	@keyframes drop-in-fade-out {
	0% {
		opacity: 0;
		visibility: visible;
		-webkit-transform: translate3d(0, -200%, 0);
		-moz-transform: translate3d(0, -200%, 0);
		-ms-transform: translate3d(0, -200%, 0);
		-o-transform: translate3d(0, -200%, 0);
		transform: translate3d(0, -200%, 0);
	}
	12% {
		-webkit-transform: translate3d(0, 0, 0);
		-moz-transform: translate3d(0, 0, 0);
		-ms-transform: translate3d(0, 0, 0);
		-o-transform: translate3d(0, 0, 0);
		transform: translate3d(0, 0, 0);
	}
	20% {
		opacity: 1;
	}
	70% {
		opacity: 1;
		visibility: visible;
		-webkit-transform: translate3d(0, 0, 0);
		-moz-transform: translate3d(0, 0, 0);
		-ms-transform: translate3d(0, 0, 0);
		-o-transform: translate3d(0, 0, 0);
		transform: translate3d(0, 0, 0);
	}
	80% {
		opacity: 0;
	}
	100% {
		visibility: hidden;
		-webkit-transform: translate3d(75%, 0, 0);
		-moz-transform: translate3d(75%, 0, 0);
		-ms-transform: translate3d(75%, 0, 0);
		-o-transform: translate3d(75%, 0, 0);
		transform: translate3d(25%, 0, 0);
	}
	}
	.animate--drop-in-fade-out {
	-webkit-animation: drop-in-fade-out 3.5s 0.4s cubic-bezier(.32,1.75,.65,.91);
	-moz-animation: drop-in-fade-out 3.5s 0.4s cubic-bezier(.32,1.75,.65,.91);
	-ms-animation: drop-in-fade-out 3.5s 0.4s cubic-bezier(.32,1.75,.65,.91);
	-o-animation: drop-in-fade-out 3.5s 0.4s cubic-bezier(.32,1.75,.65,.91);
	animation: drop-in-fade-out 3.5s 0.4s cubic-bezier(.32,1.75,.65,.91);
	}
</style>
<div class="card">
    <div class="card-header bg-transparent">
		<a class="text-secondary" data-toggle="modal" data-target="#addModal" role="button" style="cursor: pointer;"><span class="mdi mdi-plus-circle" data-toggle="tooltip" title="klik untuk menambah data baru"> Data Baru</span></a>&nbsp;&nbsp;
		<a class="text-success" href="<?=backend_url();?>/data-verifikator/export" role="button" data-toggle="tooltip" title="klik untuk mengunduh eksport hasil data" ><i class="mdi mdi-file"></i> Unduh Xls</a>
	</div>
	<div class="card-body">
		<div class="table-responsive" id="target">
			
		</div>
	</div>
</div>
<!-- modal add -->
<div class="modal fade" id="addModal"  role="dialog" aria-hidden="true"  data-backdrop="static" data-keyboard="false" style="overflow:hidden;">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Entri Data Baru Verifikator dan atau Approval</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
				<form>
					<div class="form-group">
						<label for="exampleInputEmail1">Pilihan Unit Organisasi</label>
						<select id="unor_id" name="unor_id" class="form-control autosearch" aria-describedby="unor">
							<?php foreach($unor as $row_unor): ?>
							<option value="<?=$row_unor['unor_id_verifikator'];?>" data-nama="<?=$row_unor['unor_verifikator'];?>"><?=$row_unor['unor_verifikator'];?></option>
							<?php endforeach;?>
						</select>
						<small id="unor" class="form-text text-muted">Jika pengajuannya didapati unit organisasinya adalah sub, Maka pilih induk OPD-nya</small>
					</div>
					<div class="form-group">
						<label for="nip">Entrian NIP</label>
						<input type="number" class="form-control" id="nip">
					</div>
					<div class="form-group">
						<label for="nama">Entrian Nama Pegawai</label>
						<input type="text" class="form-control" id="nama">
					</div>
					<div class="form-group form-check">
						<input type="checkbox" checked class="form-check-input" id="verifikator" name="verifikator">
						<label class="form-check-label" for="verifikator">Hak akses sebagai Verifikator</label>
					</div>
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="approval" name="approval">
						<label class="form-check-label" for="approval">Hak akses sebagai Approval</label>
					</div>
					<div class="form-group form-check">
						<input type="checkbox" checked class="form-check-input" id="biro_sdm" name="biro_sdm">
						<label class="form-check-label" for="biro_sdm">Akses Semua Data Pegawai</label>
					</div>
				</form>
            </div>
            <div class="modal-footer">
				<div class="float-left">
					<div class="flash d-none">
						<span class="mdi mdi-information "> Data telah berhasil ditambahkan</span>
					</div>
				</div>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="submit()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
	$( document ).ready(function() {
		preview();
	});

	function preview()
	{
		$("#target").html("<center><img src='<?=base_url();?>/public/assets/image/loader.gif' style='padding: 50px'></center>");

		$.ajax(
		{
			url 	: '<?= backend_url();?>/data-verifikator/preview',
			type 	: 'POST',
			data 	: { 
						"csrf_app"	: $("input[name='csrf_app']").val()
					},
			success: function(data, textStatus, xhr)
			{
				$("#target").html(data);
			},
			error: function(textStatus,xhr)
			{
				$.alerify("Uups.. Sepertinya ada kesalahan pada sistem","error");
			}
		}); 
	}

	function submit()
	{
		var pilihan_unor 	= $("#unor_id");
		var unor_id			= pilihan_unor.val();
		var nama_unor 		= pilihan_unor.find(':selected').data("nama"); 
		var nip 			= $("#nip").val();
		var nama 			= $("#nama").val();
		var verifikator		= $("#verifikator");
		if(verifikator.is(":checked")){
			verifikator = 'V';
		}
		else if(verifikator.is(":not(:checked)")){
			verifikator = '-';
		}

		var approval		= $("#approval");
		if(approval.is(":checked")){
			approval = 'A';
		}
		else if(approval.is(":not(:checked)")){
			approval = '-';
		}

		var biro_sdm		= $("#biro_sdm");
		if(biro_sdm.is(":checked")){
			biro_sdm = '1';
		}
		else if(biro_sdm.is(":not(:checked)")){
			biro_sdm = '0';
		}

		$.ajax(
		{
			"url" : "<?=backend_url();?>/data-verifikator/insert",
			"type" : "POST",
			"data" : { 
				"csrf_app" 	 : $("input[name = 'csrf_app']").val(),
				"unor_id"	 : unor_id,
				"nama_unor"	 : nama_unor,
				"nip"	     : nip,
				"nama"	     : nama,
				"verifikator": verifikator,
				"approval"	 : approval,
				"biro_sdm"	 : biro_sdm,
			},
			success: function(data, textStatus, xhr)
			{
				$( ".flash" ).addClass( "d-block animate--drop-in-fade-out" );
				$("#nip").val("");
				$("#nama").val("");
				preview()

			},
			error: function(textStatus,xhr)
			{
				console.log(textStatus);
			}
		});
		setTimeout(function(){
			$( ".flash" ).removeClass( "d-block animate--drop-in-fade-out" );
		}, 2500);
	}
</script>
