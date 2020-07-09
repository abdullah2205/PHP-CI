<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_dokter extends CI_Controller 
{
	public function home_dokter() //fungsi untuk menampilkan halaman home__admin.php
	{
		$this->load->view('Dokter/home_dokter');
	}

	// START CRUD ABSEN DOKTER --------------------------------------------------------------------------
	public function get_absen_dokter()
	{
		$data = array(
			'values' => $this->m_dokter->getAbsenDokter(),
			'values2' => $this->m_dokter->getDokter()
		);
		
		$this->load->view('Dokter/view_absen_dokter', $data);
	}
	
	public function insert_absen_dokter()
	{
		if(isset($_POST['tambahAbsenDokter']))
		{
			$absendokter = array(
				'tgl' => $this->input->post('tgl'),
				'id_dokter' => $this->input->post('id_dokter')
			);

			$this->m_dokter->insertAbsenDokter($absendokter);
			$this->pesan_tambah();
			redirect('c_dokter/get_absen_dokter');
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

			$this->m_dokter->updateAbsenDokter($absendokter);
			$this->pesan_ubah();
			redirect('c_dokter/get_absen_dokter');
		}
	}

	public function delete_absen_dokter($id_ad=null) 
    {
        if ($this->m_dokter->deleteAbsenDokter($id_ad))
        {
			$this->pesan_hapus();
			redirect('c_dokter/get_absen_dokter');
        }
	}
	// END CRUD ABSEN DOKTER --------------------------------------------------------------------------

	// START CRUD PERIKSA --------------------------------------------------------------------------
	public function get_data_periksa()
	{
		$data = array(
			'values' => $this->m_dokter->getPeriksa(),
			'values2' => $this->m_dokter->getDokter(),
			'values3' => $this->m_dokter->getPasien()
		);
		$this->load->view('Dokter/view_data_periksa', $data);
	}
	
	public function insert_data_periksa()
	{
		if(isset($_POST['tambahDataPeriksa']))
		{
			$dataperiksa = array(
				'id_dokter' => $this->input->post('id_dokter'),
				'id_pasien' => $this->input->post('id_pasien'),
				'kebutuhan' => $this->input->post('kebutuhan'),
				'solusi' => $this->input->post('solusi')
			);

			$this->m_dokter->insertPeriksa($dataperiksa);
			$this->pesan_tambah();
			redirect('c_dokter/get_data_periksa');
		}
	}

	public function update_data_periksa()
	{
		if(isset($_POST['ubahDataPeriksa']))
		{
			$dataperiksa = array(
				'id_periksa'  => $this->input->post('id_periksa'),
				'id_dokter' => $this->input->post('id_dokter'),
				'id_pasien' => $this->input->post('id_pasien'),
				'kebutuhan' => $this->input->post('kebutuhan'),
				'solusi' => $this->input->post('solusi')
			);

			$this->m_dokter->updatePeriksa($dataperiksa);
			$this->pesan_ubah();
			redirect('c_dokter/get_data_periksa');
		}
	}

	public function delete_data_periksa($id_periksa=null) 
	{
		if ($this->m_dokter->deleteDataPeriksa($id_periksa))
		{
			$this->pesan_hapus();
			redirect('c_dokter/get_data_periksa');
		}
	}
	// END CRUD PERIKSA --------------------------------------------------------------------------


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
