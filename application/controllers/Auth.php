<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
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

			$this->load->view('Auth/login', $data);
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
						'konsul_id' => generateID('tmp_data', 'konsul_id', gmdate('Ymd', time() + (7 * 3600)), 8),
						'id' => $user['id'],
						'name' => $user['name']
					];
					$this->session->set_userdata($data);

					logs($user['name'] . ' Login');

					if ($this->session->userdata('redir_url')) {
						redirect($this->session->userdata('redir_url'));
					} else {
						redirect(base_url());
					}
				} else {
					// false
					$this->session->set_flashdata(
						'flasherr',
						'<strong>Password yang anda masukkan salah!</strong> Priksa kembali.'
					);
					redirect('Auth');
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

	public function logout()
	{
		logs($this->session->userdata['name'] . ' Logout');

		$this->session->unset_userdata('konsul_id');
		$this->session->unset_userdata('umail');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('name');

		$this->session->set_flashdata(
			'flashmsg',
			'Anda telah logout dari aplikasi ini.'
		);
		redirect(base_url());
	}
}
