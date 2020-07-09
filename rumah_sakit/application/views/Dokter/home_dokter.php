<?php 
    $status_session = $this->session->userdata('status');
    if($status_session != 'Dokter')
    {
        redirect('mycontroller');
    }
?>

<!DOCTYPE html>
<html>
    <?php $this->load->view('_partials/head'); ?>
	<body>
        <?php $page="main_data";?>
        <?php $this->load->view('_partials/navbar_d'); ?>
        <header>
			<div class="jumbotron jumbotron-fluid text-white bg-secondary mb-2 mt-2">
				<div class="container">
					<div class="row">
						<div class="col">
							<h1>SELAMAT DATANG!</h1>
							<p class="lead">Anda sedang berada di Halaman Dokter.</p>
						</div>
					</div>
				</div>
			</div>
        </header>
        <?php $this->load->view('_partials/modal.php'); ?>
        <?php $this->load->view('_partials/footer'); ?>
        <?php $this->load->view('_partials/js') ?>
	</body>
</html>