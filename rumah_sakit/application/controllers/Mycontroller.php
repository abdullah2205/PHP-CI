<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mycontroller extends CI_Controller 
{
	public function index() //fungsi untuk menampilkan halaman view_login.php
	{
		$this->load->view('view_login');
	}

	public function ceklogin() //fungsi untuk mengecek login user
	{
		if(isset($_POST['login']))
		{
			$user = $this->input->post('username', true);
			$pass = $this->input->post('password', true);
			$cek = $this->m_super_admin->proseslogin($user, $pass);
			
			$hasil = count( (array) $cek);
			if($hasil > 0)
			{
				$pelogin = $this->db->get_where('users', array('username' => $user, 'password' => $pass))->row();
				
				if($pelogin->tingkat == 'super admin')
				{
					$data_sa=['nama' => 'Kuuhaku', 'status' => 'Super Admin']; //sa = Super Admin
					$this->session->set_userdata($data_sa);
					redirect('c_super_admin/home_super_admin');
				}
				elseif($pelogin->tingkat == 'admin')
				{
					$data_a=['nama' => 'Fatkhur', 'status' => 'Admin']; //a = Admin
					$this->session->set_userdata($data_a);
					redirect('c_admin/home_admin');
				}
				elseif($pelogin->tingkat == 'dokter')
				{
					$data_d=['nama' => 'Tika', 'status' => 'Dokter']; //d = Dokter
					$this->session->set_userdata($data_d);
					redirect('c_dokter/home_dokter');
				}
			}			
			else
			{
				$this->session->set_flashdata(
					'notif','<div class="alert alert-danger" role="alert"> Login Gagal!
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span></button></div>'
				);
				redirect('mycontroller');
			}
		}
	}

	public function logout() //fungsi untuk melakukan logout
	{
		$this->session->sess_destroy();
		redirect('mycontroller');
	}
}
