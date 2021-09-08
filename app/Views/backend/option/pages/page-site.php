<div class="card">
    <div class="card-header bg-transparent">
        Pengaturan Informasi Website <?=session('nama');?>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <p>Formulir pengaturan informasi website.</p>
                <form action="" data-toggle="validator" role="form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nama">Nama Website</label>
                        <input type="text" class="form-control form-control-sm" id="nama" name="nama" required>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label for="site">Site URL</label>
                        <input type="text" class="form-control form-control-sm" id="site" name="site" required>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label for="pengembang">Hak Cipta Pengembang</label>
                        <input type="text" class="form-control form-control-sm" id="pengembang" name="pengembang" required>
                        <div class="help-block with-errors"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>