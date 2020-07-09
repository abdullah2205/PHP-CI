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
							<h2>Halaman Data Pegawai</h2>
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
                                    <th>Nama Pegawai</th>
                                    <th>Alamat Pegawai</th>
                                    <th>Foto Pegawai</th>
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
                                        <?php echo $value->nama_pegawai ?>
                                    </td>
                                    <td>
                                        <?php echo $value->alamat_pegawai ?>
                                    </td>
                                    <td>
                                        <img src="<?php echo base_url('upload/foto_pegawai/'.$value->foto_pegawai) ?>" width="85" height="85" />
                                    </td>
                                    <td width="180">
                                        <a  data-id="<?= $value->id_pegawai;?>" data-nama="<?= $value->nama_pegawai;?>" data-alamat="<?= $value->alamat_pegawai;?>"
                                        href="#" class="btn btn-small btn-ubah">
                                            <i class="fa fa-edit"></i>
                                            Edit 
                                        </a>
                                        <a onclick="deleteConfirm('<?php echo site_url('c_super_admin/delete_data_pegawai/'.$value->id_pegawai) ?>')"
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
                var id_pegawai = $(this).data('id');
                var nama_pegawai = $(this).data('nama');
                var alamat_pegawai = $(this).data('alamat');
                // Set data to Form Edit
                $('.id_pegawai').val(id_pegawai);
                $('.nama_pegawai').val(nama_pegawai);
                $('.alamat_pegawai').val(alamat_pegawai);
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
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pegawai</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">x</span>
                        </button>
                    </div>
                    <?php echo form_open_multipart('c_super_admin/insert_data_pegawai') ?>
                        <div class="modal-body">
                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <input type="hidden" class="form-control" name="id_pegawai">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-12">
                                    <label class="control-label">Nama Pegawai</label>
                                        <input type="text" class="form-control" name="nama_pegawai" placeholder="Tuliskan Nama Pegawai" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-12">
                                    <label class="control-label">Alamat Pegawai</label>
                                        <input type="text" class="form-control" name="alamat_pegawai" placeholder="Tuliskan Alamat Pegawai" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-12">
                                    <label class="control-label">Foto Pegawai</label>
                                        <input type="file" class="form-control" name="foto_pegawai" required>
                                    </div>
                                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"> Batal</button>
                                <button class="btn btn-info" type="submit" name="tambahPegawai"> Simpan</button>
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
                        <h5 class="modal-title" id="exampleModalLabel">Ubah Data Pegawai</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">x</span>
                        </button>
                    </div>
                    <?php echo form_open_multipart('c_super_admin/update_data_pegawai') ?>
                        <div class="modal-body">
                                <div class="form-group">
                                    <div class="col-lg-12">
                                    <label class="control-label">Id Pegawai</label>
                                        <input type="number" class="form-control id_pegawai" name="id_pegawai" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-12">
                                    <label class="control-label">Nama Pegawai</label>
                                        <input type="text" class="form-control nama_pegawai" name="nama_pegawai" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-12">
                                    <label class="control-label">Alamat Pegawai</label>
                                        <input type="text" class="form-control alamat_pegawai" name="alamat_pegawai" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-12">
                                    <label class="control-label">Foto Pegawai</label>
                                        <input type="file" class="form-control " name="foto_pegawai" >
                                    </div>
                                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"> Batal</button>
                                <button class="btn btn-info" type="submit" name="ubahPegawai"> Simpan</button>
                            </div>
                        <?php echo form_close()?>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Modal Ubah -->
	</body>
</html>
