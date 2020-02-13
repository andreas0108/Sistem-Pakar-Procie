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
		$ID = generateID(gmdate('Ymd', time() + (7 * 3600)), 'konsul_id', 'tmp_data', 8);

		$prefix = gmdate('Ymd', (time() + (7 * 3600)));
		var_dump(generateID($prefix, 'konsul_id', 'tmp_data', 8));
		var_dump($this->session->userdata('konsul_id'));
	}

	public function array()
	{
		$this->load->view('test/array');
	}
}
