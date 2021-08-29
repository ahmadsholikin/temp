<div class="card">
	<div class="card-header bg-transparent">
		<a class="text-success" href="<?=backend_url();?>/data-unor-verifikator/export" role="button" data-toggle="tooltip" title="klik untuk mengunduh eksport hasil data" ><i class="mdi mdi-file"></i> Unduh Xls</a>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-striped table-hover table-bordered table-sm" style="width: 100%" id="datatable">
				<thead>
					<tr>
						<th>No.</th>
						<th>Nama Unit Org.</th>
                        <th>Induk Org.</th>
                        <th>Verifikasi</th>
                        <th>Approve</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach ($data as $row): ?>
					<tr>
						<td><?=$no;?></td>
						<td><?=$row['NamaUnor'];?></td>
                        <td><?=$row['nama_induk'];?></td>
                        <td>
                            <div class="form-check" >
                                <input class="form-check-input" type="checkbox" value="<?=$row['UnorId'];?>" id="v_<?=$no;?>" <?=($row['status_v']=='V'?'checked':'');?> onclick="setRole('<?=$row['UnorId'];?>','V')">
                                <label class="form-check-label" for="v_<?=$no;?>">
                                    Izinkan
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check" onclick="setRole('<?=$row['UnorId'];?>','A')">
                                <input class="form-check-input" type="checkbox" value="<?=$row['UnorId'];?>" id="a_<?=$no;?>" <?=($row['status_a']=='A'?'checked':'');?> onclick="setRole('<?=$row['UnorId'];?>','A')">
                                <label class="form-check-label" for="a_<?=$no;?>">
                                    Izinkan
                                </label>
                            </div>
                        </td>
					</tr>	
					<?php $no++;endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
    function setRole(unorId,status)
	{
		$.ajax(
		{
		  	url 	: '<?= backend_url();?>/data-unor-verifikator/update',
		  	type 	: 'POST',
		  	data 	: { 
		  				"unorId"	: unorId,
		  				"status"	: status, 
		  				"csrf_app"	: $("input[name='csrf_app']").val()
		  			},
		  	success: function(data, textStatus, xhr)
		  	{
		  	},
		  	error: function(textStatus,xhr)
		  	{
		    	$.toast({
							heading:'Uuppss Eror', 
							text:"Proses pembaharuan data tidak berhasil, ada kesalahan dalam proses penyimpanan pada sistem ini :(", 
							icon:'error',
							position: 'bottom-right',
							bgColor: '#444444',
    						textColor: 'white'
						});
		  	}
		});
	}
</script>