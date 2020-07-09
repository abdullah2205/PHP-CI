<?php 
    $status_session = $this->session->userdata('status');
    if($status_session != 'Super Admin')
    {
        redirect('mycontroller');
    }
?>

<!DOCTYPE html>
<html>
    <?php $this->load->view('_partials/head'); ?>
	<body>
        <?php $page="main_data";?>
        <?php $this->load->view('_partials/navbar_sa'); ?>
        <header>
			<div class="jumbotron jumbotron-fluid text-white bg-secondary mb-2 mt-2">
				<div class="container">
					<div class="row">
						<div class="col">
							<h2>Halaman Data Pasien</h2>
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
                                    <th>Nama Pasien</th>
                                    <th>Alamat Pasien</th>
                                    <th>Foto Pasien</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                            <?php $no=1; foreach ($values as $value): ?>
                                <tr>
                                    <td>
                                        <?php echo $no ?>
                                    </td>
                                    <td>
                                        <?php echo $value->nama_pasien ?>
                                    </td>
                                    <td>
                                        <?php echo $value->alamat_pasien ?>
                                    </td>
                                    <td>
                                        <img src="<?php echo base_url('upload/foto_pasien/'.$value->foto_pasien) ?>" width="85" height="85" />
                                    </td>
                                    <td width="180">
                                        <a  data-id="<?= $value->id_pasien;?>" data-nama="<?= $value->nama_pasien;?>" data-alamat="<?= $value->alamat_pasien;?>"
                                        href="#" class="btn btn-small btn-ubah">
                                            <i class="fa fa-edit"></i>
                                            Edit 
                                        </a>
                                        <a onclick="deleteConfirm('<?php echo site_url('c_super_admin/delete_data_pasien/'.$value->id_pasien) ?>')"
                                            href="#" class="btn btn-small text-danger">
                                            <i class="fas fa-trash"></i>
                                            Hapus
                                        </a>
                                    </td>
                                </tr>
                                <?php $no++; endforeach;?>
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
                var id_pasien = $(this).data('id');
                var nama_pasien = $(this).data('nama');
                var alamat_pasien = $(this).data('alamat');
                // Set data to Form Edit
                $('.id_pasien').val(id_pasien);
                $('.nama_pasien').val(nama_pasien);
                $('.alamat_pasien').val(alamat_pasien);
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
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pasien</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">x</span>
                        </button>
                    </div>
                    <?php echo form_open_multipart('c_super_admin/insert_data_pasien') ?>
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <input type="hidden" class="form-control" name="id_pasien">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-12">
                                <label class="control-label">Nama Pasien</label>
                                    <input type="text" class="form-control" name="nama_pasien" placeholder="Tuliskan Nama Pasien" required autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-12">
                                <label class="control-label">Alamat Pasien</label>
                                    <input type="text" class="form-control" name="alamat_pasien" placeholder="Tuliskan Alamat Pasien" required autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-12">
                                <label class="control-label">Foto Pasien</label>
                                    <input type="file" class="form-control" name="foto_pasien" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"> Batal</button>
                                <button class="btn btn-info" type="submit" name="tambahPasien"> Simpan</button>
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
                        <h5 class="modal-title" id="exampleModalLabel">Ubah Data Pasien</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">x</span>
                        </button>
                    </div>
                    <?php echo form_open_multipart('c_super_admin/update_data_pasien') ?>
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="col-lg-12">
                                <label class="control-label">Id Pasien</label>
                                    <input type="number" class="form-control id_pasien" name="id_pasien" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-12">
                                <label class="control-label">Nama Pasien</label>
                                    <input type="text" class="form-control nama_pasien" name="nama_pasien" required autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-12">
                                <label class="control-label">Alamat Pasien</label>
                                    <input type="text" class="form-control alamat_pasien" name="alamat_pasien" required autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-12">
                                <label class="control-label">Foto Pasien</label>
                                    <input type="file" class="form-control " name="foto_pasien">
                                </div>
                            </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"> Batal</button>
                            <button class="btn btn-info" type="submit" name="ubahPasien"> Simpan</button>
                        </div>
                        <?php echo form_close()?>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Modal Ubah -->
	</body>
</html>
