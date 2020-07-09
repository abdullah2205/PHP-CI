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
							<h2>Halaman Kebutuhan Dan Solusi Pasien</h2>
						</div>
					</div>
				</div>
			</div>
        </header>
        <div class="container my-4">
            <?=$this->session->flashdata('notif') // sama dengan <?php echo ...... ?>
                <!-- DataTables -->
            <div class="card mb-3">
                <div class="card-header">
                    <a data-toggle="modal" data-target="#tambah-data"  class="btn btn-small text-info" href="#!"><i class="fas fa-plus"></i> Tambah</a>
                </div>
                <div class="card-body">
                    <div class="align-self-center table-responsive">
                        <table class="table table-hover table-bordered text-gray-800" id="dataTable" width="100%" cellspacing="0" >
                            <thead class="bg-info">
                                <tr class="text-center">
                                    <th>No.</th>
                                    <th>Nama Dokter</th>
                                    <th>Nama Pasien</th>
                                    <th>Kebutuhan</th>
                                    <th>Solusi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                            <?php $no=1; foreach ($values as $value): ?>
                                <tr>
                                    <td>
                                        <?php echo $no; ?>
                                    </td>
                                    <td>
                                        <?php echo $value->nama_dokter ?>
                                    </td>
                                    <td>
                                        <?php echo $value->nama_pasien ?>
                                    </td>
                                    <td>
                                        <?php echo $value->kebutuhan ?>
                                    </td>
                                    <td>
                                        <?php echo $value->solusi ?>
                                    </td>
                                    <td width="180">
                                        <a  data-id="<?= $value->id_periksa;?>" data-dokter="<?= $value->id_dokter;?>" data-pasien="<?= $value->id_pasien;?>"
                                            data-kebutuhan="<?= $value->kebutuhan;?>" data-solusi="<?= $value->solusi;?>"
                                        href="#" class="btn btn-small btn-ubah">
                                            <i class="fa fa-edit"></i>
                                            Edit 
                                        </a>
                                        <a onclick="deleteConfirm('<?php echo site_url('c_dokter/delete_data_periksa/'.$value->id_periksa) ?>')"
                                            href="#" class="btn btn-small text-danger">
                                            <i class="fas fa-trash"></i>
                                            Hapus
                                        </a>
                                    </td>
                                </tr>
                                <?php $no++; endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->load->view('_partials/modal.php'); ?>
        <?php $this->load->view('_partials/footer'); ?>
        <?php $this->load->view('_partials/js') ?>
        <script>
            function deleteConfirm(url)
            {
                $('#btn-delete').attr('href', url);
                $('#deleteModal').modal();
            }
        </script>
        <script>
            $(document).ready(function () {
                $(document).on('click', '.btn-ubah', function () {
                // get data from button edit
                var id_periksa = $(this).data('id');
                var id_dokter = $(this).data('dokter');
                var id_pasien = $(this).data('pasien');
                var kebutuhan = $(this).data('kebutuhan');
                var solusi = $(this).data('solusi');
                // Set data to Form Edit
                $('.id_periksa').val(id_periksa);
                $('.id_dokter').val(id_dokter);
                $('.id_pasien').val(id_pasien);
                $('.kebutuhan').val(kebutuhan);
                $('.solusi').val(solusi);
                // Call Modal 
                $('#ubah-data').modal('show');
                });
            });
        </script>
        <!-- Modal Tambah -->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="tambah-data" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Periksa</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">x</span>
                        </button>
                    </div>
                    <?php echo form_open_multipart('c_dokter/insert_data_periksa') ?>
                        <div class="modal-body">
                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <input type="hidden" class="form-control" name="id_periksa" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <label class="control-label">Nama Dokter</label>
                                        <select class="form-control" name="id_dokter" required>
                                            <option value="">Pilih Nama Dokter</option>
                                            <?php foreach ($values2 as $value2): ?>
                                                <?php echo "<option value=".$value2->id_dokter.">".$value2->nama_dokter."</option>"?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <label class="control-label">Nama Pasien</label>
                                        <select class="form-control" name="id_pasien" required>
                                            <option value="">Pilih Nama Pasien</option>
                                            <?php foreach ($values3 as $value3): ?>
                                                <?php echo "<option value=".$value3->id_pasien.">".$value3->nama_pasien."</option>"?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-12">
                                    <label class="control-label">Kebutuhan</label>
                                        <input type="text" class="form-control" name="kebutuhan" placeholder="Tuliskan Kebutuhan Pasien" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-12">
                                    <label class="control-label">Solusi</label>
                                        <input type="text" class="form-control" name="solusi" placeholder="Tuliskan Solusi Pasien" required autocomplete="off">
                                    </div>
                                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"> Batal</button>
                                <button class="btn btn-info" type="submit" name="tambahDataPeriksa"> Simpan</button>
                            </div>
                        <?php echo form_close()?>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Modal Tambah -->
        <!-- Modal Ubah -->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="ubah-data" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah Data Periksa</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">x</span>
                        </button>
                    </div>
                    <?php echo form_open_multipart('c_dokter/update_data_periksa') ?>
                        <div class="modal-body">
                                <div class="form-group">
                                    <div class="col-lg-12">
                                    <label class="control-label">Id Periksa</label>
                                        <input type="number" class="form-control id_periksa" name="id_periksa" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <label class="control-label">Nama Dokter</label>
                                        <select class="form-control id_dokter" name="id_dokter" required>
                                            <option value="">Pilih Nama Dokter</option>
                                            <?php foreach ($values2 as $value2): ?>
                                                <?php echo "<option value=".$value2->id_dokter.">".$value2->nama_dokter."</option>"?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <label class="control-label">Nama Pasien</label>
                                        <select class="form-control id_pasien" name="id_pasien" required>
                                            <option value="">Pilih Nama Pasien</option>
                                            <?php foreach ($values3 as $value3): ?>
                                                <?php echo "<option value=".$value3->id_pasien.">".$value3->nama_pasien."</option>"?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-12">
                                    <label class="control-label">Kebutuhan</label>
                                        <input type="text" class="form-control kebutuhan" name="kebutuhan" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-12">
                                    <label class="control-label">Solusi</label>
                                        <input type="text" class="form-control solusi" name="solusi" autocomplete="off">
                                    </div>
                                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"> Batal</button>
                                <button class="btn btn-info" type="submit" name="ubahDataPeriksa"> Simpan</button>
                            </div>
                        <?php echo form_close()?>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Modal Ubah -->
	</body>
</html>
