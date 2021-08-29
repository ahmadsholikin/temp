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
                <h2>Unggah <span>Bukti</span></h2>
                <p>Silakan unggah screenshot bukti proses penyelesaian pemutkahiran data mandiri Anda dikolom bawah ini, isikan NIP dan unggah foto halaman pemutakhiran data mandiri :</p>
            </div>    
            <div class="row" style="min-height:800px;">
                <div class="col-lg-12 mt-5 mt-lg-0">
                    <?php if (!empty(session()->getFlashdata('error'))) : ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Informasi</strong>
                            <br><br>
                            <?php echo session()->getFlashdata('error'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        </hr />
                    <?php endif; ?>
                    <?php if (!empty(session()->getFlashdata('success'))) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Unggahan Berhasil</strong>
                            <br><br>
                            <?php echo session()->getFlashdata('success'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        </hr />
                    <?php endif; ?>
                    <form action="<?=base_url();?>/rekon/ajukan" method="post" role="form" enctype="multipart/form-data" >
                        <?php csrf_field();?>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <div class="mb-3">
                                    <label for="" class="form-label">Entrian NIP</label>
                                    <input type="text" onblur="cariNIP(this)" name="nip" class="form-control" id="nip" placeholder="NIP Anda" required value="<?= old('nip'); ?>">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="mb-3">
                                    <label for="" class="form-label">Nama Pegawai</label>
                                    <input type="text" name="nama" class="form-control" id="nama" required readonly>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="mb-3">
                                    <label for="" class="form-label">Unggahan Bukti Selesai PDM</label>
                                    <input type="file" class="form-control" name="cover" id="cover" required>
                                    <div class="help-block with-errors"></div>
                                    <div id="" class="form-text">File berupa foto screenshot. Tipe JPG/Jpeg berukuran maksimal 1 Mb</div>
                                </div>
                            </div>
                        </div>
                        <div class="text-left">
                            <button class="btn btn-success btn-md" disabled id="submit" type="submit">Kirim Rekon</button>
                            <a class="text-secondary" href="<?=base_url();?>/statistik">Lihat Statistik</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
<script>
    function cariNIP(x)
    {
        var pjg =  x.value.length;
        $.ajax({
            type: "POST",
            url: "<?=base_url();?>/rekon/cari",
            data: {
                nip : x.value,
            }, 
            success: function(data)
            {
                console.log(data);
                if(data==0){
                    swal("Uupps.. ", "Data tidak ditemukan. Mohon cek ulang entrian NIP", "error");
                    $("#nama").val("");
                    $("#submit").prop('disabled', true);
                }
                else{
                    $("#nama").val(data);
                    $("#submit").prop('disabled', false);
                }
            }
        });
    }
</script>

