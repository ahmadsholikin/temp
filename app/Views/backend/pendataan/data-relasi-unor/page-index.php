<div class="card">
    <div class="card-header bg-transparent">
		<a class="text-success" href="<?=backend_url();?>/data-relasi-unor/export" role="button" data-toggle="tooltip" title="klik untuk mengunduh eksport hasil data" ><i class="mdi mdi-file"></i> Unduh Xls</a>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-striped table-hover table-bordered table-sm" style="width: 100%" id="datatable">
				<thead>
					<tr>
						<th>No.</th>
						<th>Unit Org. Verifikator</th>
                        <th>Unit Org. Approval</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach ($data as $row): ?>
					<tr>
						<td><?=$no++;?></td>
						<td><?=$row['unor_verifikator'];?></td>
						<td><?=$row['unor_approval'];?></td>
					</tr>	
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
