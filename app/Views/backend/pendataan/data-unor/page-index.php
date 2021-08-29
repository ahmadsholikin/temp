<div class="card">
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-striped table-hover table-bordered table-sm" style="width: 100%" id="datatable">
				<thead>
					<tr>
						<th>No.</th>
						<th>Kode ID Unor</th>
						<th>Nama Unit Org.</th>
                        <th>Induk Org.</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach ($data as $row): ?>
					<tr>
						<td><?=$no++;?></td>
						<td><?=$row['UnorId'];?></td>
						<td><?=$row['NamaUnor'];?></td>
                        <td><?=$row['nama_induk'];?></td>
					</tr>	
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
