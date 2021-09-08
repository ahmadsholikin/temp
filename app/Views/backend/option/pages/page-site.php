<div class="card">
    <div class="card-header bg-transparent">
        Pengaturan Informasi Website <?=session('nama');?>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <p>Formulir pengaturan informasi website.</p>
                <form action="" data-toggle="validator" role="form" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="nama">Nama Website</label>
                                <input type="text" class="form-control form-control-sm" id="nama" name="nama" required value="<?=$site['nama'];?>">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="site">Site URL</label>
                                <input type="text" class="form-control form-control-sm" id="site" name="site" required value="<?=$site['site'];?>">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="pengembang">Hak Cipta Pengembang</label>
                                <input type="text" class="form-control form-control-sm" id="pengembang" name="pengembang" required value="<?=$site['pengembang'];?>">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="kontak">Kontak</label>
                                <input type="text" class="form-control form-control-sm" id="kontak" name="kontak" required value="<?=$site['kontak'];?>">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control form-control-sm" id="email" name="email" required value="<?=$site['email'];?>">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control form-control-sm" id="alamat" name="alamat" required value="<?=$site['alamat'];?>">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="versi">Versi</label>
                                <input type="text" class="form-control form-control-sm" id="versi" name="versi" required value="<?=$site['versi'];?>">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="logo">Logo</label>
                                <input type="file" class="form-control form-control-sm dropify" id="logo" name="logo" required data-default-file="<?=base_url();?>/public/assets/image/<?=$site['logo'];?>" data-max-file-size="1M" data-allowed-file-extensions="png jpg jpeg">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>    
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi Site</label>
                                <textarea class="form-control summernote" id="deskripsi" name="deskripsi"></textarea>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>    
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="tentang">Keteranga Tentang Selayang Pandang Site</label>
                                <textarea class="form-control summernote" id="tentang" name="tentang"></textarea>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Simpan Profil Site</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>