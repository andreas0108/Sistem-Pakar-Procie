<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->library('pagination');
		$this->load->model('');
	}

	public function index()
	{
		$data['title'] = 'Blog';

		$data['user'] = $this->db->get_where('user', [
			'email' => $this->session->userdata('email')
		])->row_array();

		$config['base_url'] = base_url() . 'blog/';
		$config['total_rows'] = $this->db->where('status', 1)->from("article")->count_all_results();
		$config['per_page'] = 5;

		$config['first_link']		= '<<';
		$config['last_link']		= '>>';
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

		$this->db->limit($config['per_page'], $data['start']);
		$this->db->order_by('tgl_buat', 'DESC');
		$data['blogpost'] = $this->db->get_where('article', 'status = 1')->result_array();

		$this->load->view('Blog/index', $data);
	}

	public function read($slug)
	{
		$this->db->select('article.judul, article.isi , user.name, article.tgl_buat, article.slug, article.gambar ');
		$this->db->join('user', 'user.id = article.penulis_id');
		$x = $this->db->get_where('article', ['slug' => $slug])->row_array();

		$data['arti'] = $x;

		$data['user'] = $this->db->get_where('user', [
			'email' => $this->session->userdata('email')
		])->row_array();

		$data['title'] = $x['judul'];
		$this->load->view('Blog/read', $data);
	}
}
