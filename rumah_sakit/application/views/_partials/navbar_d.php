<nav class="navbar navbar-expand-lg navbar-dark bg-primary" >
    <div class="container">
        <a class="navbar-brand font-weight-bold" href="<?php echo site_url('c_dokter/home_dokter'); ?>"><?php echo $this->session->userdata('status'); ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-expanded="false" aria-controls="navbarSupportedContent" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"> </span>
        </button>
        <div class="collapse navbar-collapse font-weight-bold" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item 
                    <?php 
                        $page = $this->uri->segment(2); 
                        if($page == 'get_absen_dokter'){ echo 'active'; }
                    ?>">
                    <a class="nav-link" href="<?php echo site_url('c_dokter/get_absen_dokter'); ?>"
                    >
                        Absensi Dokter
                    </a>
                </li>
                <li class="nav-item
                    <?php 
                        $page = $this->uri->segment(2); 
                        if($page == 'get_data_periksa'){ echo 'active'; }
                    ?>">
                    <a class="nav-link" href="<?php echo site_url('c_dokter/get_data_periksa'); ?>">
                        Data Periksa Pasien
                    </a>
                </li>
            </ul>
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle  text-white" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="fas fa-user-circle fa-fw  text-white"></i> <?php echo $this->session->userdata('nama'); ?>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item text-center" href="#" data-toggle="modal" data-target="#logoutModal">Logout  <i class="fas fa-sign-out-alt"></i></a>
                </div>
            </div>
        </div>
    </div>
</nav>
