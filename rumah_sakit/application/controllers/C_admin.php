<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_admin extends CI_Controller 
{
	public function home_admin() //fungsi untuk menampilkan halaman home__admin.php
	{
		$this->load->view('Admin/home_admin');
	}

	// START CRUD ABSEN PEGAWAI --------------------------------------------------------------------------
	public function get_absen_pegawai() 
	{
		$data = array(
			'values' => $this->m_admin->getAbsenPegawai(),
			'values2' => $this->m_admin->getPegawai(),
		);
		$this->load->view('Admin/view_absen_pegawai', $data);
	}
	
	public function insert_absen_pegawai()
	{
		if(isset($_POST['tambahAbsenPegawai']))
		{
			$absenpegawai = array(
				'tgl' => $this->input->post('tgl'),
				'id_pegawai' => $this->input->post('id_pegawai')
			);

			$this->m_admin->insertAbsenPegawai($absenpegawai);
			$this->pesan_tambah();
			redirect('c_admin/get_absen_pegawai');
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

			$this->m_admin->updateAbsenPegawai($absenpegawai);
			$this->pesan_ubah();
			redirect('c_admin/get_absen_pegawai');
		}
	}

	public function delete_absen_pegawai($id_ap=null) //ok
	{
		if ($this->m_admin->deleteAbsenPegawai($id_ap))
		{
			$this->pesan_hapus();
			redirect('c_admin/get_absen_pegawai');
		}
	}
	// END CRUD ABSEN PEGAWAI --------------------------------------------------------------------------

	// START CRUD PASIEN --------------------------------------------------------------------------
	public function get_data_pasien()
	{
		$data = array(
			'values' => $this->m_admin->getPasien(),
			'values2' => $this->m_admin->getPoli(),
		);
		$this->load->view('Admin/view_data_pasien', $data);
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

			$this->m_admin->insertPasien($pasien);
			$this->pesan_tambah();
			redirect('c_admin/get_data_pasien');
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

			$this->m_admin->updatePasien($pasien);
			$this->pesan_ubah();
			redirect('c_admin/get_data_pasien');
		}
	}

	public function delete_data_pasien($id_pasien=null)
    {
        if ($this->m_admin->deletePasien($id_pasien))
        {
			$this->pesan_hapus();
			redirect('c_admin/get_data_pasien');
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
	
	// START CRUD DAFTAR POLI --------------------------------------------------------------------------
	public function get_daftar_poli() 
	{
		$data = array(
			'values' => $this->m_admin->getDaftarPoli(),
			'values2' => $this->m_admin->getPasien(),
			'values3' => $this->m_admin->getPoli(),
		);
		$data["values"] = $this->m_admin->getDaftarPoli();
		$this->load->view('Admin/view_daftar_poli', $data);
	}
	
	public function insert_daftar_poli()
	{
		if(isset($_POST['tambahDaftarPoli']))
		{
			$daftarpoli = array(
				'tgl' => $this->input->post('tgl'),
				'id_pasien' => $this->input->post('id_pasien'),
				'id_poli' => $this->input->post('id_poli')
			);

			$this->m_admin->insertDaftarPoli($daftarpoli);
			$this->pesan_tambah();
			redirect('c_admin/get_daftar_poli');
		}
	}

	public function update_daftar_poli()
	{
		if(isset($_POST['ubahDaftarPoli']))
		{
			$daftarpoli = array(
				'id_daftar'  => $this->input->post('id_daftar'),
				'tgl' => $this->input->post('tgl'),
				'id_pasien' => $this->input->post('id_pasien'),
				'id_poli' => $this->input->post('id_poli')
			);

			$this->m_admin->updateDaftarPoli($daftarpoli);
			$this->pesan_ubah();
			redirect('c_admin/get_daftar_poli');
		}
	}

	public function delete_daftar_poli($id_daftar=null) //ok
	{
		if ($this->m_admin->deleteDaftarPoli($id_daftar))
		{
			$this->pesan_hapus();
			redirect('c_admin/get_daftar_poli');
		}
	}
	// END CRUD DAFTAR POLI --------------------------------------------------------------------------

	// START CRUD PASIEN DATANG --------------------------------------------------------------------------
	public function get_pasien_datang() 
	{
		$data = array(
			'values' => $this->m_admin->getPasienDatang(),
			'values2' => $this->m_admin->getPasien()
		);
		$this->load->view('Admin/view_pasien_datang', $data);
	}
	
	public function insert_pasien_datang()
	{
		if(isset($_POST['tambahPasienDatang']))
		{
			$pasiendatang = array(
				'tgl' => $this->input->post('tgl'),
				'id_pasien' => $this->input->post('id_pasien')
			);

			$this->m_admin->insertPasienDatang($pasiendatang);
			$this->pesan_tambah();
			redirect('c_admin/get_pasien_datang');
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

			$this->m_admin->updatePasienDatang($pasiendatang);
			$this->pesan_ubah();
			redirect('c_admin/get_pasien_datang');
		}
	}

	public function delete_pasien_datang($id_pd=null) //ok
	{
		if ($this->m_admin->deletePasienDatang($id_pd))
		{
			$this->pesan_hapus();
			redirect('c_admin/get_pasien_datang');
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
