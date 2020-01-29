<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();

		$this->load->helper('tanggal-indo');
		$this->load->model('');
	}

	public function index()
	{
		$data['title'] = 'User';

		$data['user'] = $this->db->get_where('user', [
			'email' => $this->session->userdata('email')
		])->row_array();

		$this->form_validation->set_rules('name', 'Nama', 'required', ['name' => 'Nama wajib diisi']);
		$this->form_validation->set_rules('address', 'Alamat', 'required', ['address' => 'Alamat wajib diisi']);
		$this->form_validation->set_rules('phone', 'Nomer Telpon', 'required', ['phone' => 'Nomer Telpon wajib diisi']);

		if ($this->form_validation->run() == false) {
			$this->load->view('Dashboard/User/index', $data);
		} else {
			$this->db->set([
				'name' => $this->input->post('name'),
				'address' => $this->input->post('address'),
				'phone' => $this->input->post('phone')
			]);
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('user');

			$this->session->set_flashdata(
				'flashmsg',
				'Data berhasil diperbarui.'
			);
			redirect('dashboard/user');
		}
	}

	public function updateimg()
	{
		$data['user'] = $this->db->get_where('user', [
			'email' => $this->session->userdata('email')
		])->row_array();

		$image = $_FILES['image']['name'];

		if ($image) {
			$config['allowed_types'] = 'jpeg|jpg|png';
			$config['max_size'] 	 = '1536';
			$config['encrypt_name']	 = TRUE;
			$config['upload_path'] 	 = './assets/img/profile/';
			$this->load->library('upload', $config);

			if ($this->upload->do_upload('image')) {
				unlink(FCPATH . 'assets/img/profile/' . $data['user']['img']);

				$imagename = $this->upload->data('file_name');
				$this->db->set('img', $imagename);
				$this->db->where('id', $_POST['id']);
				$this->db->update('user');

				$this->session->set_flashdata(
					'flashmsg',
					'Data berhasil diperbarui.'
				);
				redirect('dashboard/user');
			} else {
				echo $this->upload->display_errors();
			}
		}
	}

	public function temp()
	{
		if ($this->input->post('emailb') != '') {
			if ($this->input->post('password1') == '') {
				echo 'Berhasil merubah email';
			} else {
				if ($this->input->post('password2') == '') {
					echo 'Gagal memperbarui, ulangi password';
				} else {
					if ($this->input->post('password2') != $this->input->post('password1')) {
						echo 'Gagal memperbarui, password tidak sama';
					} else {
						echo 'Berhasil merubah email & password';
					}
				}
			}
		} else {
			if ($this->input->post('password1') != '') {
				if ($this->input->post('password2') == '') {
					echo 'Gagal memperbarui password, ulangi password';
				} else {
					if ($this->input->post('password2') != $this->input->post('password1')) {
						echo 'Gagal memperbarui password, password tidak sama';
					} else {
						echo 'Berhasil merubah password';
					}
				}
			} else {
				// -> user
			}
		}
	}

	public function updatemail()
	{
		$this->_chemail();
	}

	public function updatepass()
	{
		$data['title'] = 'User';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('cpassword', 'Password saat ini', 'trim|required|min_length[8]', [
			'required' => 'Silahkan isi field {field}',
			'min_length' => '{field} wajib memiliki 8 karakter atau lebih'
		]);
		$this->form_validation->set_rules('password1', 'Password Baru', 'trim|required|matches[password2]|differs[cpassword]|min_length[8]', [
			'required' => 'Silahkan isi field {field}',
			'matches' => '{field} dan Konfirmasi Password wajib sama!.',
			'differs' => '{field} harus berbeda dengan Password sebelumnya!',
			'min_length' => '{field} wajib memiliki 8 karakter atau lebih'
		]);
		$this->form_validation->set_rules('password2', 'Konfirmasi Password', 'trim|required|matches[password1]|min_length[8]', [
			'required' => 'Silahkan isi field {field}',
			'matches' => '{field} dan Password Baru wajib sama!.',
			'min_length' => '{field} wajib memiliki 8 karakter atau lebih'
		]);

		if ($this->form_validation->run() === false) {
			$this->load->view('dashboard/user/index', $data);
		} else {
			$id = $data['user']['id'];
			$cur = $this->input->post('cpassword');
			$new = $this->input->post('password1');
			$con = $this->input->post('password2');

			// Cek apakah new = user_password
			if (!password_verify($cur, $data['user']['password'])) {
				$this->session->set_flashdata(
					'flasherr',
					'Password yang anda masukkan salah!'
				);
				redirect('dashboard/user');
				// lolos
			} else {
				// cek apakah cur = new
				if ($cur == $new) {
					$this->session->set_flashdata(
						'flasherr',
						'Password baru harus berbeda dengan Password saat ini!.'
					);
					redirect('dashboard/user');
				} else {
					if ($new != $con) {
						$this->session->set_flashdata(
							'flasherr',
							'Password Baru dan Konfirmasi Password berbeda!'
						);
						redirect('dashboard/user');
					} else {
						$this->db->set('password', password_hash($new, PASSWORD_DEFAULT));
						$this->db->where('id', $id);
						$this->db->update('user');

						$this->session->set_flashdata(
							'flashmsg',
							'Password berhasil dirubah. Silahkan login kembali.'
						);
						$this->_relogin();
					}
				}
			}
		}
	}

	private function _chemail()
	{
		$data['title'] = 'User';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->form_validation->set_rules('emailb', 'Email', 'trim|valid_email', ['valid_email' => 'Periksa kembali format email anda.']);

		if ($this->form_validation->run() == false) {
			$this->load->view('dashboard/user/index', $data);
		} else {
			// Cek email apakah sama atau tidak
			if ($data['user']['email'] == $_POST['emailb']) {
				$this->session->set_flashdata(
					'flasherr',
					'Email yang anda masukkan sama.'
				);
				redirect('dashboard/user');
			} else {
				// Update email
				$this->db->set('email', htmlspecialchars($_POST['emailb'], ENT_QUOTES));
				$this->db->where('id', $_POST['id']);
				$this->db->update('user');

				$this->session->set_flashdata(
					'flashmsg',
					'Data berhasil diperbarui. Silahkan login kembali.'
				);
				$this->_relogin();
				/** ./update email */
			}
			/** ./cek email */
		}
	}

	private function _chpass()
	{
		$user = $this->db->get_where('user', ['id' => $_POST['id']])->row_array();

		$this->form_validation->set_rules('cpassword', 'trim|require|min_length[8]', [
			'require' => 'Silahkan isi field {field}',
			'min_length' => '{field} wajib memiliki 8 karakter atau lebih'
		]);
		$this->form_validation->set_rules('password1', 'Password Baru', 'trim|require|matches[password2]|differs[cpassword]|min_length[8]', [
			'require' => 'Silahkan isi field {field}',
			'matches' => '{field} dan Konfirmasi Password wajib sama!.',
			'differs' => 'Anda sudah pernah menggunakan password ini',
			'min_length' => '{field} wajib memiliki 8 karakter atau lebih'
		]);
		$this->form_validation->set_rules('password1', 'Password Baru', 'trim|require|matches[password1]|differs[cpassword]|min_length[8]', [
			'require' => 'Silahkan isi field {field}',
			'matches' => '{field} dan Password Baru wajib sama!.',
			'differs' => 'Anda sudah pernah menggunakan password ini',
			'min_length' => '{field} wajib memiliki 8 karakter atau lebih'
		]);

		if ($this->form_validation->run() == false) {
			redirect('dashboard/user');
		} else {
			$id = $_POST['id'];
			$cur = $_POST['cpassword'];
			$new = $_POST['password1'];
			$con = $_POST['password2'];

			// Cek apakah new = user_password
			if (!password_verify($cur, $user['password'])) {
				$this->session->set_flashdata(
					'flasherr',
					'Password yang anda masukkan salah!'
				);
				redirect('dashboard/user');
				// lolos
			} else {
				// cek apakah cur = new
				if ($cur == $new) {
					$this->session->set_flashdata(
						'flasherr',
						'Password baru harus berbeda dengan Password saat ini!.'
					);
					redirect('dashboard/user');
				} else {
					if ($new != $con) {
						$this->session->set_flashdata(
							'flasherr',
							'Password Baru dan Konfirmasi Password berbeda!'
						);
						redirect('dashboard/user');
					} else {
						$this->db->set('password', password_hash($new, PASSWORD_DEFAULT));
						$this->db->where('id', $id);
						$this->db->update('user');

						$this->session->set_flashdata(
							'flashmsg',
							'Password berhasil dirubah. Silahkan login kembali.'
						);
						$this->_relogin();
					}
				}
			}
		}
	}

	private function _relogin()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');

		redirect('login');
	}
}
