<nav class="navbar navbar-expand-lg navbar-dark bg-primary" >
    <div class="container">
        <a class="navbar-brand font-weight-bold" href="<?php echo site_url('c_super_admin/home_super_admin'); ?>"><?php echo $this->session->userdata('status'); ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-expanded="false" aria-controls="navbarSupportedContent" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"> </span>
        </button>
        <div class="collapse navbar-collapse font-weight-bold" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">            
                <li class="nav-item dropdown
                    <?php 
                        $page = $this->uri->segment(2); 
                        if($page == 'get_data_dokter'){ echo 'active'; } 
                        elseif($page == 'get_data_pegawai'){ echo 'active'; } 
                        elseif($page == 'get_data_pasien'){ echo 'active'; } 
                    ?>">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                        Main Data
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?php echo site_url('c_super_admin/get_data_dokter'); ?>">Data Dokter</a>
                        <a class="dropdown-item" href="<?php echo site_url('c_super_admin/get_data_pegawai'); ?>">Data Pegawai</a>
                        <a class="dropdown-item" href="<?php echo site_url('c_super_admin/get_data_pasien'); ?>">Data Pasien</a>
                    </div>
                </li>
                <li class="nav-item  dropdown 
                    <?php 
                        $page = $this->uri->segment(2); 
                        if($page == 'get_data_poli'){ echo 'active'; } 
                        elseif($page == 'get_data_obat'){ echo 'active'; } 
                    ?>">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                        Other Data
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?php echo site_url('c_super_admin/get_data_obat'); ?>">Data Obat</a>
                        <a class="dropdown-item" href="<?php echo site_url('c_super_admin/get_data_poli'); ?>">Data Poli</a>
                    </div>
                </li>
                <li class="nav-item  dropdown
                    <?php 
                        $page = $this->uri->segment(2); 
                        if($page == 'get_absen_dokter'){ echo 'active'; } 
                        elseif($page == 'get_absen_pegawai'){ echo 'active'; } 
                        elseif($page == 'get_pasien_datang'){ echo 'active'; } 
                    ?>">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                        Laporan
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?php echo site_url('c_super_admin/get_absen_dokter'); ?>">Rekap Absen Dokter</a>
                        <a class="dropdown-item" href="<?php echo site_url('c_super_admin/get_absen_pegawai'); ?>" >Rekap Absen Pegawai</a>
                        <a class="dropdown-item" href="<?php echo site_url('c_super_admin/get_pasien_datang'); ?>" >Laporan Pasien Datang</a>
                    </div>
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
