<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		// $this->load->library('Nativesession', 'nativesession');
	}

	public function index()
	{
		// check if in the session already have userdata
		if ($this->session->userdata('email')) {
			redirect(base_url());
		}

		// set the form validation
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Login';

			$this->load->view('auth/login', $data);
		} else {
			// var_dump($_POST);
			// die;
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			$user = $this->db->get_where('user', ['email' => $email])->row_array();

			// if user already registered
			if ($user) {
				// cek password
				// true
				if (password_verify($password, $user['password'])) {
					$data = [
						'email' => $user['email'],
						'umail' => $user['email'],
						'id' => $user['id'],
						'name' => $user['name']
					];
					$this->session->set_userdata($data);

					$this->db->set('status', '1');
					$this->db->where('id', $user['id']);
					$this->db->update('user');

					redirect(base_url());
				} else {
					// false
					$this->session->set_flashdata(
						'flasherr',
						'<strong>Password yang anda masukkan salah!</strong> Priksa kembali.'
					);
					redirect('auth');
				}
			} else {
				// jika salah
				$this->session->set_flashdata(
					'flasherr',
					'<strong>Email tidak diketemukan.</strong> Priksa kembali.'
				);
				redirect('login');
			}
		}
	}

	public function changePassword()
	{
		if (!$this->session->userdata('reset_email')) {
			redirect('login');
		}

		$this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[8]|matches[password2]');
		$this->form_validation->set_rules('password2', 'Confirm Password', 'trim|required|min_length[8]|matches[password1]');

		if ($this->form_validation->run() === false) {
			$data['title'] = 'CI-App | Change Password';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/change-password');
			$this->load->view('templates/auth_footer');
		} else {
			$key = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
			$mail = $this->session->userdata('reset_email');

			$this->db->set('password', $key);
			$this->db->where('email', $mail);
			$this->db->update('user');

			$this->session->unset_userdata('reset_email');
			$this->db->delete('user_token', ['email' => $mail]);

			$this->session->set_flashdata(
				'flashmsg',
				'<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Password changed! </strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>'
			);
			redirect('login');
		}
	}

	public function logout()
	{
		$this->db->set('status', '0');
		$this->db->where('id', $this->session->userdata('id'));
		$this->db->update('user');

		$this->session->unset_userdata('umail');
		$this->session->unset_userdata('email');

		$this->session->set_flashdata(
			'flashmsg',
			'Anda telah logout dari aplikasi ini.'
		);
		redirect(base_url());
	}

	public function blocked()
	{
		$data['title'] = '403 : Access Forbidden';
		$data['title2'] = '';

		$this->load->view('dashboard/parts/auth_header', $data);
		$this->load->view('dashboard/auth/blocked');
		// $this->load->view('dashboard/parts/auth_footer');
	}
}
