<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Article extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}

	public function index()
	{
		$data['title'] = 'Article';

		$data['user'] = $this->db->get_where('user', [
			'email' => $this->session->userdata('email')
		])->row_array();

		// Published list
		$this->db->select('article.*, user.name as penulis');
		$this->db->join('user', 'article.penulis_id = user.id');
		$this->db->order_by('article.tgl_buat', 'DESC');
		$data['artip'] = $this->db->get_where('article', ['article.status' => 1])->result_array();

		// Draft list
		$this->db->select('article.*, user.name as penulis');
		$this->db->join('user', 'article.penulis_id = user.id');
		$this->db->order_by('article.tgl_buat', 'DESC');
		$data['artid'] = $this->db->get_where('article', ['article.status' => 0])->result_array();

		$this->load->view('dashboard/article/index', $data);
	}

	public function tambah()
	{
		$data['title'] = 'Tambah Article';

		$data['user'] = $this->db->get_where('user', [
			'email' => $this->session->userdata('email')
		])->row_array();

		$this->form_validation->set_rules('title', 'Judul', 'required', [
			'required' => '{field} wajib diisi'
		]);

		$this->form_validation->set_rules('isi', 'Konten', 'required', [
			'required' => '{field} wajib diisi'
		]);

		if ($this->form_validation->run() == false) {
			$this->load->view('dashboard/article/tambah', $data);
		} else {
			$image = $_FILES['image']['name'];

			if ($image) {
				$config['allowed_types'] = 'jpeg|jpg|png';
				$config['max_size'] 	 = '1536';
				$config['encrypt_name']	 = TRUE;
				$config['upload_path'] 	 = './assets/img/article/poster/';
				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {
					$gambar = $this->upload->data('file_name');
				} else {
					$this->session->set_flashdata(
						'flasherr',
						$this->upload->display_errors()
					);
				}
			} else {
				$gambar = 'default.svg';
			}
			$this->db->insert('article', [
				'judul' => htmlspecialchars($this->input->post('title', true)),
				'slug' => htmlspecialchars(slug($this->input->post('title', true))),
				'gambar' => $gambar,
				'isi' => $this->input->post('isi'),
				'status' => htmlspecialchars($this->input->post('status', true)),
				'penulis_id' => htmlspecialchars($this->input->post('penulis_id', true)),
				'tags' => htmlspecialchars($this->input->post('tags', true)),
				'tgl_buat' => time()
			]);
			logs('Tambah Artikel', htmlspecialchars($this->input->post('title', true)));
			$this->session->set_flashdata(
				'flashmsg',
				'Artikel telah ditambahkan.'
			);
			redirect('dashboard/article');
		}
	}

	public function ubah($id)
	{
		$data['title'] = 'Ubah Article';

		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		// get data artikel
		$this->db->select('article.*, user.name as penulis');
		$this->db->join('user', 'article.penulis_id = user.id');
		$data['arti'] = $this->db->get_where('article', ['article.id' => $id])->row_array();

		$this->form_validation->set_rules('title', 'Judul', 'required', [
			'required' => '{field} wajib diisi'
		]);

		$this->form_validation->set_rules('isi', 'Konten', 'required', [
			'required' => '{field} wajib diisi'
		]);

		if ($this->form_validation->run() === false) {
			$this->load->view('Dashboard/Article/ubah', $data);
		} else {

			$image = $_FILES['image']['name'];

			if ($image) {
				$config['allowed_types'] = 'jpeg|jpg|png';
				$config['max_size'] 	 = '1536';
				$config['encrypt_name']	 = TRUE;
				$config['upload_path'] 	 = './assets/img/article/poster/';
				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {
					$prevImg = $data['arti']['gambar'];
					if ($prevImg != '' || null) {
						unlink(FCPATH . 'assets/article/poster/' . $prevImg);
					}
					$this->db->set('gambar', $this->upload->data('file_name'));
				} else {
					$this->session->set_flashdata(
						'flasherr',
						$this->upload->display_errors()
					);
				}
			}

			$this->db->set('judul', htmlspecialchars($this->input->post('title', true)));
			$this->db->set('slug', htmlspecialchars(slug($this->input->post('title', true))));
			$this->db->set('isi', $this->input->post('isi'));
			$this->db->set('status', htmlspecialchars($this->input->post('status', true)));
			$this->db->set('penulis_id', htmlspecialchars($this->input->post('penulis_id', true)));
			$this->db->set('tags', htmlspecialchars($this->input->post('tags', true)));
			$this->db->where('id', htmlspecialchars($this->input->post('id', true)));
			$this->db->update('article');

			logs('Update Artikel', htmlspecialchars($this->input->post('title', true)));

			$this->session->set_flashdata(
				'flashmsg',
				'Artikel berhasil dirubah.'
			);
			redirect('dashboard/article');
		}
	}

	// TinyMCE Image Upload
	function tinymce_upload()
	{
		$config['upload_path'] = './assets/img/article/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		// $config['encrypt_name']	 = TRUE;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('file')) {
			$this->output->set_header('HTTP/1.0 500 Server Error');
			exit;
		} else {
			$file = $this->upload->data();
			$this->output
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode(['location' => base_url() . 'assets/img/article/' . $file['file_name']]))
				->_display();
			exit;
		}
	}

	//Upload image summernote
	function upload_imga()
	{
		if (isset($_FILES["image"]["name"])) {
			$config['upload_path'] = './assets/img/article/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['encrypt_name']	 = TRUE;

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('image')) {
				$data = $this->upload->data();
				//Compress Image
				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/img/article/' . $data['file_name'];
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = TRUE;
				$config['quality'] = '100%';
				$config['new_image'] = './assets/img/article/' . $data['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				echo base_url() . 'assets/img/article/' . $data['file_name'];
			} else {
				$this->upload->display_errors();
				return FALSE;
			}
		}
	}
	//Delete image summernote
	function delete_imga()
	{
		$src = $this->input->post('src');
		$file_name = str_replace(base_url(), '', $src);
		if (unlink($file_name)) {
			echo 'File Delete Successfully';
		}
	}

	public function hapus($id)
	{
		$prevImg = $this->db->get_where('article', ['id' => $id])->row_array();
		logs('Hapus Artikel', $prevImg['judul']);

		if ($prevImg != '' || null) {
			// menghapus file poster sesuai id
			unlink(FCPATH . 'assets/img/article/poster/' . $prevImg['gambar']);
		}
		$this->db->delete('article', array('id' => $id));
		$this->session->set_flashdata(
			'flashmsg',
			'Artikel berhasil dihapus'
		);
		redirect('dashboard/article');
	}

	public function hapus_semua()
	{
		logs('Hapus Semua Artikel', null);
		$this->db->truncate('article');
		$this->session->set_flashdata(
			'flashmsg',
			'Semua Artikel berhasil dihapus'
		);
		redirect('dashboard/article');
	}

	public function redir()
	{
		redirect('dashboard/article');
	}
}
