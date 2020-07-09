<!DOCTYPE html>
<html>
    <?php $this->load->view('_partials/head'); ?>
    <style>
        body
        {
            background: url('/rumah_sakit/assets/img/bg_img.jpg') no-repeat;
            background-size: cover;
            background-attachment: fixed;
        }

    </style>
	<?php
        $status_session = $this->session->userdata('status'); //ini fungsi untuk redirect halaman apabila sudah login

        if($status_session == 'Super Admin')
        { 
            redirect('c_super_admin/home_super_admin'); //controller/function
        }
        elseif($status_session == 'Admin')
        {
            redirect('c_admin/home_admin');
        }
        elseif($status_session == 'Dokter')
        {
            redirect('c_dokter/home_dokter');
        }
    ?>
	<body>
        <div class="container mt-4 pt-4">
            <div class="text-white bg-transparent">
                <div class="container">
                    <h1 class="text-center judul text-success"><strong>Selamat Datang di SIM RS. Isekai</strong></h1>
                </div>
            </div>
        </div>
        <div class="container mt-4">
            <div class="w-50 m-auto">
                <div class="card pb-3">
                    <div class="card-title text-center mt-3">
                        <h3 class="text-center mt-2">Silahkan Login</h3> 
                    </div>
                    <div class="card-body">
                    <?=$this->session->flashdata('notif')?>
                        <?php echo form_open('mycontroller/ceklogin') ?>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control py-3" placeholder="Username" name="username" required autofocus autocomplete='off'>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-key"></i>
                                    </span>
                                </div>
                                <input type="password" class="form-control py-3" placeholder="Password" name="password" required >
                            </div>
                            <button class="btn btn-success" name="login">Masuk! <i class="fas fa-sign-in-alt"></i></button>
                        <?php echo form_close()?>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->load->view('_partials/js') ?>
	</body>
</html>
