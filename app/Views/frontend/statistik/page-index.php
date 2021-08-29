<main id="main">
    <section class="breadcrumbs">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Rekonsiliasi PDM</h2>
                <ol>
                    <li><a href="#">Helpdesk PDM Magelangkab</a></li>
                    <li>Rekonsiliasi PDM</li>
                </ol>
            </div>
        </div>
    </section>
    <section id="inner-page" class="contact">
        <div class="container">
            <div class="section-title">
                <h2>Statistik <span>Rekon</span></h2>
                <p>Berikut daftar tabulasi hasil rekon pemutakhiran data mandiri :</p>
            </div>    
            <div class="row" style="min-height:800px;">
                <div class="col-lg-12 mt-5 mt-lg-0">
                    <?php if($data==0){ ?>
                        <h4>Uupss... Sedang terjadi kesalahan pada sistem ini</h4>
                    <?php } else { ?>
                        <p>
                            Jumlah Total Pegawai : <b><?=$total;?></b><br>
                            Jumlah Pegawai yang Sudah Rekon : <b><?=$sudah;?></b><br>
                            Prosentase Rekon : <b><?=$prosentase;?> %</b>
                        </p>
                        <br>
                        <table class="table table-striped table-bordered table-hover" id="datatable">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama OPD</th>
                                    <th>Jumlah Pegawai</th>
                                    <th>Sudah Rekon</th>
                                    <th>Prosentase</th>
                                </tr>
                            </thead>    
                            <tbody>
                                <?php $no=1;foreach($data as $row):?>
                                <tr>
                                    <td><?=$no++;?></td>
                                    <td><?=$row->fms_skpd;?></td>
                                    <td><?=$row->jumlah;?></td>
                                    <td><?=$row->jumlah_rekon;?></td>
                                    <td><?=round(($row->jumlah_rekon/$row->jumlah)*100,2);?> %</td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
</main>                