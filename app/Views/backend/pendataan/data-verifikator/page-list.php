<table class="table table-striped table-hover table-bordered table-sm" style="width: 100%" id="datatable">
    <thead>
        <tr>
            <th>No.</th>
            <th>Unit Org.</th>
            <th>Status</th>
            <th>NIP</th>
            <th>Nama</th>
            <th>Akses Data</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; foreach ($data as $row): ?>
        <tr>
            <td><?=$no++;?></td>
            <td><?=$row['nama_unor'];?></td>
            <td><?=$row['status'];?></td>
            <td><?=$row['nip'];?></td>
            <td><?=$row['nama'];?></td>
            <td><?=yatidak($row['biro_sdm']);?></td>
            <td>
                <?=btn_delete('./data-verifikator/delete?id='.$row['id']);?>
            </td>
        </tr>	
        <?php endforeach ?>
    </tbody>
</table>