<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}

	// Admin Side //
	public function index()
	{
		$data['title'] = $this->config->item('site_name');
		$data['title2'] = 'Home';
		$data['title3'] = 'Dashboard';
		$data['user'] = $this->db->get_where('user', [
			'email' => $this->session->userdata('email')
		])->row_array();

		$this->load->view('dashboard/parts/header', $data);
		$this->load->view('dashboard/parts/sidebar', $data);
		$this->load->view('dashboard/parts/navbar', $data);
		$this->load->view('dashboard/index', $data);
		$this->load->view('dashboard/parts/modal');
		$this->load->view('dashboard/parts/javascript');
		$this->load->view('dashboard/parts/footer');
	}

	// End Admin //

	// Role Side //
	public function role()
	{
		$data['title'] = $this->config->item('site_name');
		$data['title2'] = 'Home';
		$data['title3'] = 'User Management';
		$data['title4'] = 'Role';
		$data['user'] = $this->db->get_where('user', [
			'email' => $this->session->userdata('email')
		])->row_array();

		$data['role'] = $this->db->get('user_role')->result_array();

		$this->form_validation->set_rules('role', 'Role', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('dashboard/parts/header', $data);
			$this->load->view('dashboard/parts/sidebar', $data);
			$this->load->view('dashboard/parts/navbar', $data);
			$this->load->view('dashboard/role', $data);
			$this->load->view('dashboard/parts/modal');
			$this->load->view('dashboard/parts/javascript');
			$this->load->view('dashboard/parts/footer');
		} else {
			$data = ['role' => $this->input->post('role')];
			$this->db->insert('user_role', $data);
			$this->session->set_flashdata(
				'notif',
				'<div class="alert alert-success alert-dismissible fade show" role="alert">
                            New Role added!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>'
			);
			redirect('admin/role');
		}
	}

	public function delete($id)
	{
		$this->db->delete('user_role', array('id' => $id));
		$this->session->set_flashdata(
			'notif',
			'<div class="alert alert-success alert-dismissible fade show" role="alert">
						Role removed!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>'
		);
		redirect('admin/role');
	}

	public function roleconfig($role_id)
	{
		$data['title'] = $this->config->item('site_name');
		$data['title2'] = 'Home';
		$data['title3'] = 'User Management';
		$data['title4'] = 'Role';
		$data['user'] = $this->db->get_where('user', [
			'email' => $this->session->userdata('email')
		])->row_array();

		$data['role'] = $this->db->get_where('user_role', [
			'id' => $role_id
		])->row_array();

		$this->db->where('id !=', 1);
		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->load->view('dashboard/parts/header', $data);
		$this->load->view('dashboard/parts/sidebar', $data);
		$this->load->view('dashboard/parts/navbar', $data);
		$this->load->view('dashboard/role-config', $data);
		$this->load->view('dashboard/parts/modal');
		$this->load->view('dashboard/parts/javascript');
		$this->load->view('dashboard/parts/footer');
	}

	public function chaccess()
	{
		$menu_id = $this->input->post('menuID');
		$role_id = $this->input->post('roleID');

		$data = [
			'role_id' => $role_id,
			'menu_id' => $menu_id
		];

		$result = $this->db->get_where('user_access_menu', $data);
		if ($result->num_rows() < 1) {
			$this->db->insert('user_access_menu', $data);
			$this->session->set_flashdata(
				'notif',
				'<div class="alert alert-success alert-dismissible fade show" role="alert">
							Role Changed!
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>'
			);
		} else {
			$this->db->delete('user_access_menu', $data);
			$this->session->set_flashdata(
				'notif',
				'<div class="alert alert-danger alert-dismissible fade show" role="alert">
							Role Changed!
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>'
			);
		}
	}

	// End Role //

	// User Manager //
	public function userman()
	{
		$data['title'] = $this->config->item('site_name');
		$data['title2'] = 'Home';
		$data['title3'] = 'User Management';
		$data['user'] = $this->db->get_where('user', [
			'email' => $this->session->userdata('email')
		])->row_array();
		$this->load->model('admin_model');

		$data['userman'] = $this->admin_model->getUser();
		$data['userRole'] = $this->db->get('user_role')->result_array();
		// var_dump($data['userman']);
		// die;

		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
			'is_unique' => 'Email already registered !'
		]);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
			'matches' => 'Password missmatch !',
			'min_length' => 'Password too short !'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
		// default view / failed to regist
		if ($this->form_validation->run() == false) {
			$this->load->view('dashboard/parts/header', $data);
			$this->load->view('dashboard/parts/sidebar', $data);
			$this->load->view('dashboard/parts/navbar', $data);
			$this->load->view('dashboard/userman', $data);
			$this->load->view('dashboard/parts/modal');
			$this->load->view('dashboard/parts/javascript');
			$this->load->view('dashboard/js');
			$this->load->view('dashboard/parts/footer');
		} else {
			// registration succes, the data set to be save in database
			$data = [
				'name' => htmlspecialchars($this->input->post('name', true)),
				'email' => htmlspecialchars($this->input->post('email', true)),
				'img' => 'default.png',
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id' => $this->input->post('role_id'),
				'date_created' => time()
			];

			$this->db->insert('user', $data);
			// var_dump($data);
			// die;

			$this->session->set_flashdata(
				'notif',
				'<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Registration Complete.</strong> Please login.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>'
			);
			redirect('dashboard/home/userman');
		}
	}

	public function deleteUser($id)
	{
		$this->db->delete('user', array('id' => $id));
		$this->session->set_flashdata(
			'notif',
			'<div class="alert alert-success alert-dismissible fade show" role="alert">
						User removed!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>'
		);
		redirect('dashboard/home/userman');
	}

	// End User Manager //

	public function settings()
	{
		$data['title'] = $this->config->item('site_name');
		$data['title2'] = 'Home';
		$data['title3'] = 'Site Settings';
		$data['user'] = $this->db->get_where('user', [
			'email' => $this->session->userdata('email')
		])->row_array();

		$this->load->view('dashboard/parts/header', $data);
		$this->load->view('dashboard/parts/sidebar', $data);
		$this->load->view('dashboard/parts/navbar', $data);
		$this->load->view('dashboard/default', $data);
		$this->load->view('dashboard/parts/modal');
		$this->load->view('dashboard/parts/javascript');
		$this->load->view('dashboard/js');
		$this->load->view('dashboard/parts/footer');
	}
}
