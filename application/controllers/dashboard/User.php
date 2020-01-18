<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();

		$this->load->model('Article_model', 'Artimo');
		$this->load->helper('tanggal-indo');
	}

	public function index()
	{
		$data['title'] = $this->config->item('site_name');
		$data['title2'] = 'User';
		$data['title3'] = 'Profile Page';
		$data['user'] = $this->db->get_where('user', [
			'email' => $this->session->userdata('email')
		])->row_array();

		$sessid = $this->session->userdata('id');

		$data['jum_article'] = $this->db->where('penulis_id', $sessid)->from("content_article")->count_all_results();

		$this->load->library('pagination');
		// $this->load->library('u');

		$config['base_url'] = base_url() . 'dashboard/user';
		$config['total_rows'] = $this->db->where('penulis_id', $sessid)->from("content_article")->count_all_results();
		$config['per_page'] = 3;

		$config['first_link']		= '<-';
		$config['last_link']		= '->';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';

		if ($this->uri->segment('3') == '') {
			$data['start'] = 0;
		} else {
			$data['start'] = $this->uri->segment('3') + 1;
		}

		$this->pagination->initialize($config);

		// $data['lA'] = $this->Artimo->getListArticleByID($sessid);
		$data['lA'] = $this->Artimo->getListArticleByIDLimited($sessid, $config['per_page'], $data['start']);

		$this->load->view('dashboard/parts/header', $data);
		$this->load->view('dashboard/parts/sidebar', $data);
		$this->load->view('dashboard/parts/navbar', $data);
		$this->load->view('dashboard/user/index', $data);
		$this->load->view('dashboard/parts/modal');
		$this->load->view('dashboard/parts/javascript');
		$this->load->view('dashboard/parts/footer');
	}

	public function edit()
	{
		$data['title'] = $this->config->item('site_name');
		$data['title2'] = 'User';
		$data['title3'] = 'Edit Profile';
		$data['user'] = $this->db->get_where('user', [
			'email' => $this->session->userdata('email')
		])->row_array();

		$this->form_validation->set_rules('name', 'Full Name', 'required|trim');
		$this->form_validation->set_rules('phone', 'Phone Number', 'required|trim');
		$this->form_validation->set_rules('address', 'Address', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('dashboard/parts/header', $data);
			$this->load->view('dashboard/parts/sidebar', $data);
			$this->load->view('dashboard/parts/navbar', $data);
			$this->load->view('dashboard/user/edit', $data);
			$this->load->view('dashboard/parts/modal');
			$this->load->view('dashboard/parts/javascript');
			$this->load->view('dashboard/parts/footer');
		} else {
			// check if img is already to upload
			$upload_img = $_FILES['image']['name'];

			if ($upload_img) {
				$config['allowed_types'] = 'jpeg|jpg|png';
				$config['max_size'] 	 = '4096';
				$config['encrypt_name']	 = TRUE;
				$config['upload_path'] 	 = './assets/img/profile/';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {

					// remove previous img / old image 
					$prevImg = $data['user']['img'];
					if ($prevImg != 'default.png') {
						unlink(FCPATH . 'assets/img/profile/' . $prevImg);
					}

					$newImg = $this->upload->data('file_name');
					$this->db->set('img', $newImg);
				} else {
					echo $this->upload->display_errors();
				}
			}

			$email = htmlspecialchars($this->input->post('email'), ENT_QUOTES);
			$name = htmlspecialchars($this->input->post('name'), ENT_QUOTES);
			$phone = htmlspecialchars($this->input->post('phone'), ENT_QUOTES);
			$address = htmlspecialchars($this->input->post('address'), ENT_QUOTES);

			if ($phone == null && $address == null) {
				$this->db->set('name', $name);
				$this->db->where('email', $email);
				$this->db->update('user');

				$this->session->set_flashdata(
					'profiledit',
					'<div class="alert alert-success alert-dismissible fade show" role="alert">
						Data saved.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>'
				);
				redirect('dashboard/user');
			} elseif ($phone != null) {
				$this->db->set('name', $name);
				$this->db->set('phone_number', $phone);
				$this->db->where('email', $email);
				$this->db->update('user');

				$this->session->set_flashdata(
					'profiledit',
					'<div class="alert alert-success alert-dismissible fade show" role="alert">
						Data saved.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>'
				);
				redirect('dashboard/user');
			} elseif ($address != null) {
				$this->db->set('name', $name);
				$this->db->set('address', $address);
				$this->db->where('email', $email);
				$this->db->update('user');

				$this->session->set_flashdata(
					'profiledit',
					'<div class="alert alert-success alert-dismissible fade show" role="alert">
						Data saved.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>'
				);
				redirect('dashboard/user');
			} else {
				$this->db->set('name', $name);
				$this->db->set('phone_number', $phone);
				$this->db->set('address', $address);
				$this->db->where('email', $email);
				$this->db->update('user');

				$this->session->set_flashdata(
					'profiledit',
					'<div class="alert alert-success alert-dismissible fade show" role="alert">
						Data saved.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>'
				);
				redirect('dashboard/user');
			}
		}
	}

	public function changePassword()
	{
		$data['title'] = $this->config->item('site_name');
		$data['title2'] = 'User';
		$data['title3'] = 'Change Password';
		$data['user'] = $this->db->get_where('user', [
			'email' => $this->session->userdata('email')
		])->row_array();

		$data['jum_article'] = $this->db->where('penulis_id', $this->session->userdata('id'))->from("content_article")->count_all_results();

		$this->form_validation->set_rules('currentPassword', 'Current Password', 'required|trim');
		$this->form_validation->set_rules('newPassword1', 'New Password', 'required|trim|min_length[8]|matches[newPassword2]');
		$this->form_validation->set_rules('newPassword2', 'Confirm Password', 'required|trim|min_length[8]|matches[newPassword1]');

		if ($this->form_validation->run() == false) {
			$this->load->view('dashboard/parts/header', $data);
			$this->load->view('dashboard/parts/sidebar', $data);
			$this->load->view('dashboard/parts/navbar', $data);
			$this->load->view('dashboard/user/changepassword', $data);
			$this->load->view('dashboard/parts/modal');
			$this->load->view('dashboard/parts/javascript');
			$this->load->view('dashboard/parts/footer');
		} else {
			$email = $this->session->userdata('email');
			$curPass = $this->input->post('currentPassword');
			$newPass = $this->input->post('newPassword1');

			# verify if current password isn't the user password
			if (!password_verify($curPass, $data['user']['password'])) {
				$this->session->set_flashdata(
					'changepass',
					'<div class="alert alert-warning alert-dismissible fade show" role="alert">
						Password missmatch.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>'
				);
				redirect('dashboard/user/changepassword');
			} else {
				# verify if current password & new password same
				if ($curPass == $newPass) {
					$this->session->set_flashdata(
						'changepass',
						'<div class="alert alert-warning alert-dismissible fade show" role="alert">
							New Password must different from current password.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>'
					);
					redirect('user/changepassword');
				} else {
					$phash = password_hash($newPass, PASSWORD_DEFAULT);

					$this->db->set('password', $phash);
					$this->db->where('email', $email);
					$this->db->update('user');

					$this->session->set_flashdata(
						'changepass',
						'<div class="alert alert-success alert-dismissible fade show" role="alert">
							Password changed.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>'
					);
					redirect('dashboard/user/changepassword');
				}
			}
		}
	}

	public function getUser()
	{
		echo json_encode($this->db->get_where('user', ['id' => $_POST['id']])->result_array());
	}
}
