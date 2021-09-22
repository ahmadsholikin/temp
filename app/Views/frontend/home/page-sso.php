<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="apple-touch-icon" sizes="180x180" href="<?=base_url('favicon');?>/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?=base_url('favicon');?>/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url('favicon');?>/favicon-16x16.png">
        <!-- Meta -->
        <title>Biana</title>
        <link rel="stylesheet" href="<?=base_url();?>/public/backend/assets/css/cassie.css">
        <script src="<?= base_url(); ?>/public/plugins/sweetalert/sweetalert.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-5">
                    <div class="signin-sidebar-body">
                        <a href="#" class="sidebar-logo mg-b-40">
                            <span>Sistem Dashboard Biana</span>
                        </a>
                        <h5 >Selamat Datang!</h5>
                        <p>Silakan masuk dengan Akun anda.</p>
                        <form action="<?=base_url();?>/auth/signin" method="POST">
                            <?= csrf_field() ?>
                            <div class="signin-form">
                                <div class="form-group">
                                    <label>Usermane</label>
                                    <input type="text" name="email" class="form-control" placeholder="Entrikan Username Anda">
                                </div>
                                <div class="form-group">
                                    <label class="d-flex justify-content-between">
                                        <span>Password</span>
                                        <a href="" class="tx-13">Lupa kata sandi?</a>
                                    </label>
                                    <input type="password" name="password" class="form-control" placeholder="Entrikan password SSO Anda">
                                </div>
                                <div class="form-group d-flex mg-b-0">
                                    <button class="btn btn-brand-01 btn-uppercase flex-fill" type="submit">Masuk</button>
                                    <a href="#" class="btn btn-white btn-uppercase flex-fill mg-l-10">Registrasi</a>
                                </div>
                                <div class="divider-text mg-y-30">Or</div>
                                <a href="#" class="btn btn-danger btn-uppercase btn-block">Login with GMAIL</a>
                            </div>
                        </form>
                        <p class="mg-t-auto mg-b-0 tx-sm tx-color-03">Dikembangkan oleh 
                            <a href="">Kasbiystud.io</a>
                            <br>Rilis Versi 1.0
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<?php if(!empty(session()->getFlashdata('flash_info'))):?>
    <script>
        swal("Uupps.. Login Gagal!", "username dan password yang Anda masukkan salah", "error");
    </script>
<?php endif;?>