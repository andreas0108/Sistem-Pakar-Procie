<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('homeBlog_model', 'hB');
		$this->load->helper('tanggal-indo');
		$this->load->helper('limitword');
	}

	public function index()
	{
		$data['appname'] = 'PROCIE';
		$data['title'] = ' | BLOG';

		$this->load->library('pagination');

		$config['base_url'] = base_url() . 'blog/';
		$config['total_rows'] = $this->db->where('status', 1)->from("content_article")->count_all_results();
		$config['per_page'] = 5;

		$config['first_link']		= '<<';
		$config['last_link']		= '>>';
		// $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		// $config['full_tag_close']   = '</ul></nav></div>';
		$config['full_tag_open']    = '<div class="pagging text-center mx-auto"><nav><ul class="pagination justify-content-center">';
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

		if ($this->uri->segment('2') == '') {
			$data['start'] = 0;
		} else {
			$data['start'] = $this->uri->segment('2') + 1;
		}

		$this->pagination->initialize($config);

		$data['liBo'] = $this->hB->listAllBlogLimited($config['per_page'], $data['start']);
		// var_dump($data['liBo']);
		// die;

		$this->load->view('home/parts/header', $data);
		$this->load->view('home/parts/navbar', $data);
		$this->load->view('home/blog/index', $data);
		$this->load->view('home/parts/footer', $data);
	}

	public function read($slug)
	{
		$data['appname'] = 'PROCIE';

		$tmp = $this->hB->getArticleBySlug($slug);
		$data['title'] = ' | ' . $tmp[0]['judul'];
		$data['arti'] = $tmp[0];

		// var_dump($data['title']);
		// die;

		$this->load->view('home/parts/header', $data);
		$this->load->view('home/parts/navbar', $data);
		$this->load->view('home/blog/read', $data);
		$this->load->view('home/parts/footer', $data);
	}

	// controller search
}
