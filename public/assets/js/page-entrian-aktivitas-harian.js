function entrianShow()
{
    $('#mailCompose').addClass('show');
    $("#uraian_kegiatan").html('');
}

$('.mailComposeClose').on('click', function(e){
    e.preventDefault()

    if($('#mailCompose').hasClass('minimize') || $('#mailCompose').hasClass('shrink')) {
    $('#mailCompose').addClass('d-none');

    setTimeout(function(){
        $('#mailCompose').attr('class', 'mail-compose');
    },500);

    } else {
        $('#mailCompose').removeClass('show');
    }
})

$('#mailComposeShrink').on('click', function(e){
    e.preventDefault()
    $('#mailCompose').toggleClass('shrink')
    $('#mailCompose').removeClass('minimize')
})

$('#mailComposeMinimize').on('click', function(e){
    e.preventDefault()
    $('#mailCompose').toggleClass('minimize')
})

$('.form').submit(function () {
    var jam_mulai   = $.trim($('#entrian-mulai').val());
    var jam_selesai = $.trim($('#entrian-selesai').val());
    if ((jam_selesai  == '')||(jam_mulai  == ''))
    {
        alert('Silakan pilih jam mulai dan atau jam selesai terlebih dahulu.');
        $( "#jam_mulai" ).focus();
        return false;
    }
    else
    {
        if ((compareTime(jam_mulai,jam_selesai)===-1))
        {
            return true;
        }
        else
        {
            alert('Silakan pilih jam mulai dan atau jam selesai terlebih dahulu dengan benar.');
            $( "#jam_mulai" ).focus();
            return false;
        }
    }
});

function compareTime(str1, str2)
{
    if(str1 === str2)
    {
        return 0;
    }

    var time1 = str1.split(':');
    var time2 = str2.split(':');
    if(eval(time1[0]) > eval(time2[0]))
    {
        return 1;
    } 
    else if(eval(time1[0]) == eval(time2[0]) && eval(time1[1]) > eval(time2[1]))
    {
        return 1;
    } 
    else
    {
        return -1;
    }
}


function getConfirm(id,status,list)
{
    $.confirm({
        title: 'konfirmasi',
        content: 'Apakah yang Anda ingin lakukan dengan konten entrian aktivitas kegiatan ini ?',
        type: 'red',
        typeAnimated: true,
        icon:'mdi mdi-alert',
        buttons: {
            edit: function () {
                if(status=="Belum")
                {
                    $("#id").val(id);
                    $("#proses").val("update");
                    $('#mailCompose').addClass('show');
                    
                    $("#poin").val($("#tb-poin"+list).val());
                    $("#entrian-tanggal").val($("#tb-tanggal_kegiatan"+list).val());
                    $("#entrian-penilai_nip").val($("#tb-penilai_nip"+list).val());
                    $("#entrian-link_skp_id").val($("#tb-link_skp_id"+list).val());
                    $("#entrian-is_submit").val($("#tb-is_submit"+list).val());
                    $("#uraian_kegiatan").html($("#tb-uraian_kegiatan"+list).val());
                    $("#entrian-mulai").val($("#tb-jam_mulai"+list).val());
                    $("#entrian-selesai").val($("#tb-jam_selesai"+list).val());
                }
                else
                {
                    $.alert({
                        title: 'Informasi',
                        content: 'Entrian yang Anda pilih sudah dieksekusi oleh Penilai, sehingga Anda tidak dapat mengubahnya. Terimakasih :)',
                    });
                }
            },
            hapus: function (){
                if(status=="Belum")
                {
                    window.location=backend_url+"/aktivitas-harian/delete?id="+id;
                }
                else
                {
                    $.alert({
                        title: 'Informasi',
                        content: 'Entrian yang Anda pilih sudah dieksekusi oleh Penilai, sehingga Anda tidak dapat mengubahnya. Terimakasih :)',
                    });
                }
            },
            batal: function () {
                $("#proses").val("insert");
            },
        }
    });
}