<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();

		$this->load->model('mainMenu_model', 'mainMenu');
		$this->load->model('subMenu_model', 'subMenu');
	}

	// BEGIN MENU FUNCTION
	public function index()
	{
		// title and headings purpose
		$data['title'] = $this->config->item('site_name');
		$data['title2'] = 'Menu';
		$data['title3'] = 'Menu Management';

		// user data for session
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['mainMenu'] = $this->mainMenu->getMenu();

		$this->form_validation->set_rules('menu', 'Menu', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('dashboard/parts/header', $data);
			$this->load->view('dashboard/parts/sidebar', $data);
			$this->load->view('dashboard/parts/navbar', $data);
			$this->load->view('dashboard/menu/index', $data);
			$this->load->view('dashboard/parts/modal');
			$this->load->view('dashboard/parts/javascript');
			$this->load->view('dashboard/menu/js');
			$this->load->view('dashboard/parts/footer');
		} else {
			var_dump($_POST);
			die;
			$this->db->insert(
				'user_menu',
				[
					'menu' => $this->input->post('menu'),
					'icon' => $this->input->post('menuicon'),
					'is_active' => $this->input->post('is_active')
				]
			);
			$this->session->set_flashdata(
				'notif',
				'<div class="alert alert-success alert-dismissible fade show" role="alert">
							Menu added!
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>'
			);
			redirect('dashboard/menu');
		}
	}

	public function getMenu()
	{
		// send data to ajax with json type
		echo json_encode($this->db->get_where('user_menu', ['id' => $_POST['id']])->result_array());
	}

	public function editMenu()
	{
		// title and headings purpose
		$data['title'] = $this->config->item('site_name');
		$data['title2'] = 'Menu';
		$data['title3'] = 'Menu Management';

		// user data for session
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['mainMenu'] = $this->mainMenu->getMenu();

		$this->form_validation->set_rules('menu', 'Menu', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('dashboard/parts/header', $data);
			$this->load->view('dashboard/parts/sidebar', $data);
			$this->load->view('dashboard/parts/navbar', $data);
			$this->load->view('dashboard/menu/index', $data);
			$this->load->view('dashboard/parts/modal');
			$this->load->view('dashboard/parts/javascript');
			$this->load->view('dashboard/menu/js');
			$this->load->view('dashboard/parts/footer');
		} else {
			// var_dump($_POST);
			// die;
			$this->db->set('menu', $_POST['menu']);
			if (!empty($_POST['is_active'])) {
				$this->db->set('is_active', $_POST['is_active']);
			} else {
				$this->db->set('is_active', 0);
			}
			$this->db->where('id', $_POST['idmenu']);
			$this->db->update('user_menu');

			// var_dump($_POST['idmenu']);
			// var_dump($_POST['menu']);
			// die;

			$this->session->set_flashdata(
				'notif',
				'<div class="alert alert-success alert-dismissible fade show" role="alert">
						Menu updated!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>'
			);
			redirect('dashboard/menu');
		}
	}

	public function delete($id)
	{
		$this->db->delete('user_menu', array('id' => $id));
		$this->session->set_flashdata(
			'notif',
			'<div class="alert alert-success alert-dismissible fade show" role="alert">
						Menu deleted!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>'
		);
		redirect('dashboard/menu');
	}
	// END MENU FUNCTION

	// SUBMENU FUNCTION BEGIN

	public function subMenu()
	{
		$data['title'] = $this->config->item('site_name');
		$data['title2'] = 'Menu';
		$data['title3'] = 'Sub Menu Management';
		$data['user'] = $this->db->get_where('user', [
			'email' => $this->session->userdata('email')
		])->row_array();

		$data['subMenu'] = $this->subMenu->getSubMenu();
		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->form_validation->set_rules('submenutitle', 'Title', 'required');
		$this->form_validation->set_rules('menu_id', 'Menu', 'required');
		$this->form_validation->set_rules('submenuurl', 'URL', 'required');
		$this->form_validation->set_rules('submenuicon', 'Icon', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('dashboard/parts/header', $data);
			$this->load->view('dashboard/parts/sidebar', $data);
			$this->load->view('dashboard/parts/navbar', $data);
			$this->load->view('dashboard/menu/submenu', $data);
			$this->load->view('dashboard/parts/modal');
			$this->load->view('dashboard/parts/javascript');
			$this->load->view('dashboard/menu/js');
			$this->load->view('dashboard/parts/footer');
		} else {
			$data = [
				'title' => $this->input->post('submenutitle'),
				'menu_id' => $this->input->post('menu_id'),
				'url' => $this->input->post('submenuurl'),
				'icon' => $this->input->post('submenuicon'),
				'is_active' => $this->input->post('is_active')
			];
			$this->db->insert('user_sub_menu', $data);
			$this->session->set_flashdata(
				'notif',
				'<div class="alert alert-success alert-dismissible fade show" role="alert">
					New Submenu added!
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>'
			);
			redirect('dashboard/menu/submenu');
		}
	}

	public function getSubMenu()
	{
		echo json_encode($this->subMenu->getSubMenubyID($_POST['id']));
	}

	public function editSubMenu()
	{
		$data['title'] = $this->config->item('site_name');
		$data['title2'] = 'Menu';
		$data['title3'] = 'Sub Menu Management';
		$data['user'] = $this->db->get_where('user', [
			'email' => $this->session->userdata('email')
		])->row_array();

		$data['subMenu'] = $this->subMenu->getSubMenu();
		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->form_validation->set_rules('submenutitle', 'Title', 'required');
		$this->form_validation->set_rules('menu_id', 'Menu', 'required');
		$this->form_validation->set_rules('submenuurl', 'URL', 'required');
		$this->form_validation->set_rules('submenuicon', 'Icon', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('dashboard/parts/header', $data);
			$this->load->view('dashboard/parts/sidebar', $data);
			$this->load->view('dashboard/parts/navbar', $data);
			$this->load->view('dashboard/menu/submenu', $data);
			$this->load->view('dashboard/parts/modal');
			$this->load->view('dashboard/parts/javascript');
			$this->load->view('dashboard/menu/js');
			$this->load->view('dashboard/parts/footer');
		} else {
			$newsubmenu = [
				'title' => $this->input->post('submenutitle'),
				'menu_id' => $_POST['menu_id'],
				'url' => $_POST['submenuurl'],
				'icon' => $_POST['submenuicon'],
				'is_active' => $_POST['is_active']
			];
			$this->db->where('id', $this->input->post('idsubmenu'));
			$this->db->update('user_sub_menu', $newsubmenu);

			// var_dump($_POST['idmenu']);
			// var_dump($newsubmenu);
			// die;

			$this->session->set_flashdata(
				'notif',
				'<div class="alert alert-success alert-dismissible fade show" role="alert">
						Menu updated!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>'
			);
			redirect('dashboard/menu/submenu');
		}
	}

	public function remove($id)
	{
		$this->db->delete('user_sub_menu', array('id' => $id));
		$this->session->set_flashdata(
			'notif',
			'<div class="alert alert-success alert-dismissible fade show" role="alert">
						Sub Menu removed!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>'
		);
		redirect('dashboard/menu/submenu');
	}

	public function test()
	{
		$data['title'] = $this->config->item('site_name');
		$data['title2'] = 'Menu';
		$data['title3'] = 'Test';
		$data['user'] = $this->db->get_where('user', [
			'email' => $this->session->userdata('email')
		])->row_array();

		$this->load->view('dashboard/parts/header', $data);
		$this->load->view('dashboard/parts/sidebar', $data);
		$this->load->view('dashboard/parts/navbar', $data);
		$this->load->view('dashboard/menu/test', $data);
		$this->load->view('dashboard/parts/modal');
		$this->load->view('dashboard/parts/javascript');
		$this->load->view('dashboard/menu/js');
		$this->load->view('dashboard/parts/footer');
	}
}
