<div class="card">
    <div class="card-header">
        From Edit Data Menu Navigasi
    </div>
    <div class="card-body">
        <form method="POST" action="<?= backend_url().'/menu/update';?>" data-toggle="validator" role="form">
            <?= csrf_field() ?>
            <div class="form-row">
                <div class="col-md-2 col-sm-12 form-group">
                    <label>Sisi</label>
                    <select class="form-control form-control-sm" name="sisi">
                        <option value="backend">Backend</option>
                        <option value="frontend">Frontend</option>
                    </select>
                </div>
                <div class="col-md-3 col-sm-12 form-group">
                    <label>Nama</label>
                    <input class="form-control form-control-sm" name="menu_nama" 
                            type="text"
                            value="<?=$var['menu_nama'];?>" 
                            pattern="^[A-z0-9\s/@]{1,}$" 
                            data-error="Maaf, entrian hanya berupa huruf dan angka"
                            required>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-md-6 col-sm-12 form-group">
                    <label>Deskripsi</label>
                    <input class="form-control form-control-sm" name="deskripsi" type="text" value="<?=$var['deskripsi'];?>" >
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-md-1 col-sm-12 form-group">
                    <label>Menu ID</label>
                    <input class="form-control form-control-sm" name="menu_id" readonly value="<?=$var['menu_id'];?>" >
                    <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-4 col-sm-12 form-group">
                    <label>Main Link ?</label>
                    <input class="form-control form-control-sm" name="link" type="text" value="<?=$var['link'];?>" >
                    <div class="help-block with-errors"></div>
                </div>        
                <div class="col-md-3 col-sm-12 form-group">
                    <label>Ikon</label>
                    <div class="form-group has-icon">
                        <!-- <span id="input-icon" class="mdi mdi-home form-control-icon"></span> -->
                        <input class="form-control form-control-sm bg-white" readonly name="ikon" value="<?=$var['ikon'];?>" type="text" value="mdi mdi-home" onclick="open_icon_modal()">
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-md-2 col-sm-12 form-group">
                    <label>Aktif ?</label>
                    <select class="form-control form-control-sm" name="aktif">
                        <option <?=selected('1',$var['aktif']);?> value="1">Ya</option>
                        <option <?=selected('0',$var['aktif']);?> value="0">Tidak</option>
                    </select>
                </div>
                <div class="col-md-1 col-sm-12 form-group">
                    <label>Urutan</label>
                    <input class="form-control form-control-sm" name="urutan" type="text" value="<?=$var['urutan'];?>" >
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-2 col-sm-12 form-group">
                    <label>Root ?</label>
                    <select class="form-control form-control-sm" name="hirarki">
                        <option <?=selected('1',$var['hirarki']);?> value="1">Menu</option>
                        <option <?=selected('2',$var['hirarki']);?> value="2">Sub Menu</option>
                    </select>
                </div>
                <div class="col-md-2 col-sm-12 form-group">
                    <label>Sub</label>
                    <select class="form-control form-control-sm" name="sub">
                        <option <?=selected('1',$var['sub']);?> value="1">Ya</option>
                        <option <?=selected('0',$var['sub']);?> value="0">Tidak</option>
                    </select>
                </div>
                <div class="col-md-2 col-sm-12 form-group">
                    <label>Hirarki ?</label>
                    <select class="form-control form-control-sm" name="induk_id">
                        <option value="">-</option>
                        <?php foreach($MenuModel as $row) : ?>
                            <option <?=selected($row['menu_id'],$var['induk_id']);?> value="<?=$row['menu_id'];?>#<?=$row['menu_nama'];?>"><?=$row['menu_nama'];?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2 col-sm-12 form-group">
                    <label>Sumber Tabel</label>
                    <select class="form-control form-control-sm" name="nama_tabel" onchange="get_primary_key()">
                        <option value="">-</option>
                        <?php foreach($table as $tables) : ?>
                            <option <?=selected($tables,$var['nama_tabel']);?> value="<?=$tables;?>"><?=$tables;?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2 col-sm-12 form-group">
                    <label>Primary Key</label>
                    <input class="form-control form-control-sm bg-white" name="primary_key" type="text" readonly value="<?=$var['primary_key'];?>" >
                </div>
                <div class="col-md-2 col-sm-12 form-group">
                    <label>Root Folder ?</label>
                    <select class="form-control form-control-sm" name="new_folder">
                        <option value="on">Ya</option>
                        <option selected value="off">Tidak</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
            <button type="button" class="btn btn-secondary btn-sm" onclick="window.history.back();">Kembali</button>
        </form>
        
        <div class="modal fade" id="modal-icon" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="">Gunakan klik ganda untuk memilih ikon</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php echo view('backend/option/menu/page-feather');?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    function get_primary_key()
    {
        var pilihan = $( "select[name='nama_tabel']" ).val();
        if(pilihan!='')
        {
            // ajax to get_primary_key
            $.ajax(
            {
                url     : '<?=base_url();?>/menu/get_primary_key',
                type    : 'POST',
                data    : { 
                            "pilihan"   : pilihan,
                            "csrf_app"  : $("input[name='csrf_app']").val()
                        },
                success: function(data)
                {
                    console.log('sukses');
                    //called when successful
                    $("input[name='primary_key']").val(data);                  
                },
                error: function(data)
                {
                    //called when there is an error
                    console.log('error');
                    //alert("Error "+data);
                }
            });
        }
    }

    function open_icon_modal()
    {
        $('#modal-icon').modal('show');
    }

    $('.grid-icon').click(function(){
        var $class = $(this).closest('.grid-icon').find('.mdi').attr('class');
        $("#input-icon").removeClass();
        $("#input-icon").addClass($class+" form-control-icon");
        $("input[name='ikon']").val($class);
        $('#modal-icon').modal('hide');
    });

</script>