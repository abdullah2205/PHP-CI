<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_super_admin extends CI_Controller 
{
	public function home_super_admin() //fungsi untuk menampilkan halaman home_super_admin.php
	{
		$this->load->view('SuperAdmin/home_super_admin');
	}

	// START CRUD DOKTER --------------------------------------------------------------------------
	public function get_data_dokter() //read dokter
	{
		$data["values"] = $this->m_super_admin->getDokter();
		$this->load->view('SuperAdmin/view_data_dokter', $data);
	}

	public function insert_data_dokter() //create dokter
	{
		if(isset($_POST['tambahDokter']))
		{
			$dokter = array(
				'nama_dokter' => $this->input->post('nama_dokter'),
				'bidang_dokter' => $this->input->post('bidang_dokter'),
				'foto_dokter' => $this->uploadFotoDokter()
			);

			$this->m_super_admin->insertDokter($dokter);
			$this->pesan_tambah();
			redirect('c_super_admin/get_data_dokter');
		}
	}

	public function update_data_dokter() //update dokter
	{
		if(isset($_POST['ubahDokter']))
		{
			$dokter = array(
				'id_dokter'  => $this->input->post('id_dokter'),
				'nama_dokter' => $this->input->post('nama_dokter'),
				'bidang_dokter' => $this->input->post('bidang_dokter'),
				'foto_dokter' => $this->uploadFotoDokter()
			);

			$this->m_super_admin->updateDokter($dokter);
			$this->pesan_ubah();
			redirect('c_super_admin/get_data_dokter');
		}
	}

	public function delete_data_dokter($id_dokter=null) //delete dokter
    {
        if ($this->m_super_admin->deleteDokter($id_dokter))
        {
			$this->pesan_hapus();
			redirect('c_super_admin/get_data_dokter');
        }
	}

	public function uploadFotoDokter()
    {
        $config['upload_path']          = './upload/foto_dokter/';
        $config['allowed_types']        = 'jpeg|jpg|png';
        $config['overwrite']			= true;
        $config['max_size']             = 2048; //2 MB
        $config['file_name']            = $_FILES['foto_dokter']['name'];

        $this->load->library('upload', $config);

		if ($this->upload->do_upload('foto_dokter')) 
		{
			return $config['file_name'];
			//echo $this->upload->display_errors();
        }
		return "no_image";
    }
	// END CRUD DOKTER --------------------------------------------------------------------------

	// START CRUD PEGAWAI --------------------------------------------------------------------------
	public function get_data_pegawai()
	{
		$data["values"] = $this->m_super_admin->getPegawai();
		$this->load->view('SuperAdmin/view_data_pegawai', $data);
	}
	
	public function insert_data_pegawai()
	{
		if(isset($_POST['tambahPegawai']))
		{
			$pegawai = array(
				'nama_pegawai' => $this->input->post('nama_pegawai'),
				'alamat_pegawai' => $this->input->post('alamat_pegawai'),
				'foto_pegawai' => $this->uploadFotoPegawai()
			);

			$this->m_super_admin->insertPegawai($pegawai);
			$this->pesan_tambah();
			redirect('c_super_admin/get_data_pegawai');
		}
	}

	public function update_data_pegawai()
	{
		if(isset($_POST['ubahPegawai']))
		{
			$pegawai = array(
				'id_pegawai'  => $this->input->post('id_pegawai'),
				'nama_pegawai' => $this->input->post('nama_pegawai'),
				'alamat_pegawai' => $this->input->post('alamat_pegawai'),
				'foto_pegawai' => $this->uploadFotoPegawai()
			);

			$this->m_super_admin->updatePegawai($pegawai);
			$this->pesan_ubah();
			redirect('c_super_admin/get_data_pegawai');
		}
	}

	public function delete_data_pegawai($id_pegawai=null)
    {
        if ($this->m_super_admin->deletePegawai($id_pegawai))
        {
			$this->pesan_hapus();
			redirect('c_super_admin/get_data_pegawai');
        }
	}

	public function uploadFotoPegawai()
    {
        $config['upload_path']          = './upload/foto_pegawai/';
        $config['allowed_types']        = 'jpeg|jpg|png';
        $config['overwrite']			= true;
        $config['max_size']             = 2048; //2 MB
        $config['file_name']            = $_FILES['foto_pegawai']['name'];

        $this->load->library('upload', $config);

		if ($this->upload->do_upload('foto_pegawai')) 
		{
			return $config['file_name'];
        }
		return "no_image";
    }
	// END CRUD PEGAWAI --------------------------------------------------------------------------

	// START CRUD PASIEN --------------------------------------------------------------------------
	public function get_data_pasien()
	{
		$data = array(
			'values' => $this->m_super_admin->getPasien()
		);
		$this->load->view('SuperAdmin/view_data_pasien', $data);
	}
	
	public function insert_data_pasien()
	{
		if(isset($_POST['tambahPasien']))
		{
			$pasien = array(
				'nama_pasien' => $this->input->post('nama_pasien'),
				'alamat_pasien' => $this->input->post('alamat_pasien'),
				'foto_pasien' => $this->uploadFotoPasien()
			);

			$this->m_super_admin->insertPasien($pasien);
			$this->pesan_tambah();
			redirect('c_super_admin/get_data_pasien');
		}
	}

	public function update_data_pasien()
	{
		if(isset($_POST['ubahPasien']))
		{
			$pasien = array(
				'id_pasien'  => $this->input->post('id_pasien'),
				'nama_pasien' => $this->input->post('nama_pasien'),
				'alamat_pasien' => $this->input->post('alamat_pasien'),
				'foto_pasien' => $this->uploadFotoPasien()
			);

			$this->m_super_admin->updatePasien($pasien);
			$this->pesan_ubah();
			redirect('c_super_admin/get_data_pasien');
		}
	}

	public function delete_data_pasien($id_pasien=null)
    {
        if ($this->m_super_admin->deletePasien($id_pasien))
        {
			$this->pesan_hapus();
			redirect('c_super_admin/get_data_pasien');
        }
	}

	public function uploadFotoPasien()
    {
        $config['upload_path']          = './upload/foto_pasien/';
        $config['allowed_types']        = 'jpeg|jpg|png';
        $config['overwrite']			= true;
        $config['max_size']             = 2048; //2 MB
        $config['file_name']            = $_FILES['foto_pasien']['name'];

        $this->load->library('upload', $config);

		if ($this->upload->do_upload('foto_pasien')) 
		{
			return $config['file_name'];
        }
		return "no_image";
    }
	// END CRUD PASIEN --------------------------------------------------------------------------

	// START CRUD POLI --------------------------------------------------------------------------
	public function get_data_poli()
	{
		$data = array(
			'values' => $this->m_super_admin->getPoli(),
			'values2' => $this->m_super_admin->getDokter()
		);
		$this->load->view('SuperAdmin/view_data_poli', $data);
	}
	
	public function insert_data_poli()
	{
		if(isset($_POST['tambahPoli']))
		{
			$poli = array(
				'nama_poli' => $this->input->post('nama_poli'),
				'id_dokter' => $this->input->post('id_dokter')
			);

			$this->m_super_admin->insertPoli($poli);
			$this->pesan_tambah();
			redirect('c_super_admin/get_data_poli');
		}
	}

	public function update_data_poli()
	{
		if(isset($_POST['ubahPoli']))
		{
			$poli = array(
				'id_poli'  => $this->input->post('id_poli'),
				'nama_poli' => $this->input->post('nama_poli'),
				'id_dokter' => $this->input->post('id_dokter')
			);

			$this->m_super_admin->updatePoli($poli);
			$this->pesan_ubah();
			redirect('c_super_admin/get_data_poli');
		}
	}

	public function delete_data_poli($id_poli=null)
    {
        if ($this->m_super_admin->deletePoli($id_poli))
        {
			$this->pesan_hapus();
			redirect('c_super_admin/get_data_poli');
        }
	}
	// END CRUD POLI --------------------------------------------------------------------------

	// START CRUD OBAT --------------------------------------------------------------------------
	public function get_data_obat()
	{
		$data = array(
			'values' => $this->m_super_admin->getObat(),
			'values2' => $this->m_super_admin->getPoli(),
		);
		$this->load->view('SuperAdmin/view_data_obat', $data);
	}
	
	public function insert_data_obat()
	{
		if(isset($_POST['tambahObat']))
		{
			$obat = array(
				'nama_obat' => $this->input->post('nama_obat'),
				'jenis_obat' => $this->input->post('jenis_obat'),
				'id_poli' => $this->input->post('id_poli')
			);

			$this->m_super_admin->insertObat($obat);
			$this->pesan_tambah();
			redirect('c_super_admin/get_data_obat');
		}
	}

	public function update_data_obat()
	{
		if(isset($_POST['ubahObat']))
		{
			$obat = array(
				'id_obat'  => $this->input->post('id_obat'),
				'nama_obat' => $this->input->post('nama_obat'),
				'jenis_obat' => $this->input->post('jenis_obat'),
				'id_poli' => $this->input->post('id_poli')
			);

			$this->m_super_admin->updateObat($obat);
			$this->pesan_ubah();
			redirect('c_super_admin/get_data_obat');
		}
	}

	public function delete_data_obat($id_obat=null)
    {
        if ($this->m_super_admin->deleteObat($id_obat))
        {
			$this->pesan_hapus();
			redirect('c_super_admin/get_data_obat');
        }
	}
	// END CRUD OBAT --------------------------------------------------------------------------

	// START CRUD ABSEN DOKTER --------------------------------------------------------------------------
	public function get_absen_dokter()
	{
		$data["values"] = $this->m_super_admin->getAbsenDokter();
		$this->load->view('SuperAdmin/view_absen_dokter', $data);
	}
	
	public function insert_absen_dokter()
	{
		if(isset($_POST['tambahAbsenDokter']))
		{
			$absendokter = array(
				'tgl' => $this->input->post('tgl'),
				'id_dokter' => $this->input->post('id_dokter')
			);

			$this->m_super_admin->insertAbsenDokter($absendokter);
			$this->pesan_tambah();
			redirect('c_super_admin/get_absen_dokter');
		}
	}

	public function update_absen_dokter()
	{
		if(isset($_POST['ubahAbsenDokter']))
		{
			$absendokter = array(
				'id_ad'  => $this->input->post('id_ad'),
				'tgl' => $this->input->post('tgl'),
				'id_dokter' => $this->input->post('id_dokter')
			);

			$this->m_super_admin->updateAbsenDokter($absendokter);
			$this->pesan_ubah();
			redirect('c_super_admin/get_absen_dokter');
		}
	}

	public function delete_absen_dokter($id_ad=null) 
    {
        if ($this->m_super_admin->deleteAbsenDokter($id_ad))
        {
			$this->pesan_hapus();
			redirect('c_super_admin/get_absen_dokter');
        }
	}
	// END CRUD ABSEN DOKTER --------------------------------------------------------------------------

	// START CRUD ABSEN PEGAWAI --------------------------------------------------------------------------
	public function get_absen_pegawai() 
	{
		$data["values"] = $this->m_super_admin->getAbsenPegawai();
		$this->load->view('SuperAdmin/view_absen_pegawai', $data);
	}
	
	public function insert_absen_pegawai()
	{
		if(isset($_POST['tambahAbsenPegawai']))
		{
			$absenpegawai = array(
				'tgl' => $this->input->post('tgl'),
				'id_pegawai' => $this->input->post('id_pegawai')
			);

			$this->m_super_admin->insertAbsenPegawai($absenpegawai);
			$this->pesan_tambah();
			redirect('c_super_admin/get_absen_pegawai');
		}
	}

	public function update_absen_pegawai()
	{
		if(isset($_POST['ubahAbsenPegawai']))
		{
			$absenpegawai = array(
				'id_ap'  => $this->input->post('id_ap'),
				'tgl' => $this->input->post('tgl'),
				'id_pegawai' => $this->input->post('id_pegawai')
			);

			$this->m_super_admin->updateAbsenPegawai($absenpegawai);
			$this->pesan_ubah();
			redirect('c_super_admin/get_absen_pegawai');
		}
	}

	public function delete_absen_pegawai($id_ap=null) //ok
    {
        if ($this->m_super_admin->deleteAbsenPegawai($id_ap))
        {
			$this->pesan_hapus();
			redirect('c_super_admin/get_absen_pegawai');
        }
	}
	// END CRUD ABSEN PEGAWAI --------------------------------------------------------------------------
	
	// START CRUD PASIEN DATANG --------------------------------------------------------------------------
	public function get_pasien_datang() 
	{
		$data["values"] = $this->m_super_admin->getPasienDatang();
		$this->load->view('SuperAdmin/view_pasien_datang', $data);
	}
	
	public function insert_pasien_datang()
	{
		if(isset($_POST['tambahPasienDatang']))
		{
			$pasiendatang = array(
				'tgl' => $this->input->post('tgl'),
				'id_pasien' => $this->input->post('id_pasien')
			);

			$this->m_super_admin->insertPasienDatang($pasiendatang);
			$this->pesan_tambah();
			redirect('c_super_admin/get_pasien_datang');
		}
	}

	public function update_pasien_datang()
	{
		if(isset($_POST['ubahPasienDatang']))
		{
			$pasiendatang = array(
				'id_pd'  => $this->input->post('id_pd'),
				'tgl' => $this->input->post('tgl'),
				'id_pasien' => $this->input->post('id_pasien')
			);

			$this->m_super_admin->updatePasienDatang($pasiendatang);
			$this->pesan_ubah();
			redirect('c_super_admin/get_pasien_datang');
		}
	}

	public function delete_pasien_datang($id_pd=null) //ok
	{
		if ($this->m_super_admin->deletePasienDatang($id_pd))
		{
			$this->pesan_hapus();
			redirect('c_super_admin/get_pasien_datang');
		}
	}
	// END CRUD PASIEN DATANG --------------------------------------------------------------------------


	// NOTIFICATION
	private function pesan_tambah()
	{
		$this->session->set_flashdata(
			'notif','<div class="alert alert-success" role="alert"> Data Berhasil ditambahkan!
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span></button></div>'
		);
	}

	private function pesan_ubah()
	{
		$this->session->set_flashdata(
			'notif','<div class="alert alert-info" role="alert"> Data Berhasil diubah!
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span></button></div>'
		);
	}

	private function pesan_hapus()
	{
		$this->session->set_flashdata(
			'notif','<div class="alert alert-danger" role="alert"> Data Berhasil dihapus!
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span></button></div>'
		);
	}
	// END NOTIFICATION
}
