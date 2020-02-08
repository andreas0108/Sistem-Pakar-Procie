<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Test extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$du = array('Dummy User', 'Testing', 'Testing User', 'Dummy');
		$de = array('user@@email.com', 'Testing@email.com', 'Testing.User@email.com', 'Dummy@email.com');

		$data['x'] = $du[rand(0, 3)];
		$data['y'] = $de[rand(0, 3)];

		echo $du[rand(0, 3)] . '<br>';
		echo $de[rand(0, 3)] . '<br>';
		var_dump($data);
		die;
	}

	public function array()
	{
		$this->load->view('test/array');
	}
}
