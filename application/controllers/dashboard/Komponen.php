<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Komponen extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		is_logged_in();
		$data['title'] = 'Komponen';

		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->db->select('k.id, km.manufacture, k.name, kk.name as kategori, k.desc, k.price, k.slug, k.date_added as ditambahkan, k.core, k.thread, k.base, k.boost, k.socket');
		$this->db->join('komponen_kategori kk', 'k.kategori = kk.id');
		$this->db->join('komponen_manufacture km', 'k.manufacture = km.id');
		$this->db->order_by('ditambahkan DESC');
		$data['kompo'] = $this->db->get('komponen k')->result_array();

		// var_dump($x);
		// die;

		$this->load->view('Dashboard/Komponen/index', $data);
	}

	public function tambah()
	{
		is_logged_in();
		$data['title'] = 'Tambah Komponen';

		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('nama', 'Nama Komponen', 'required', ['required' => '{field} wajib diisi']);
		$this->form_validation->set_rules('isi', 'Deskripsi', 'required', ['required' => '{field} wajib diisi']);
		$this->form_validation->set_rules('manuf', 'Manufaktur', 'required', ['required' => 'Silhakan pilih {field}']);
		$this->form_validation->set_rules('kate', 'Deskripsi', 'required', ['required' => 'Silhakan pilih {field}']);

		if ($this->form_validation->run() == false) {
			$this->load->view('Dashboard/Komponen/tambah', $data);
		} else {
			$image = $_FILES['image']['name'];

			if ($image) {
				$config['allowed_types'] = 'jpeg|jpg|png';
				$config['max_size'] 	 = '2048';
				$config['encrypt_name']	 = TRUE;
				$config['upload_path'] 	 = './assets/img/komponen/';
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
				$gambar = '';
			}
			if ($this->input->post('isi') == null || '') {
				$desc = htmlspecialchars($this->input->post('nama', true)) . '...';
			} else {
				$desc = $this->input->post('isi') == null || '';
			};
			$komponen = [
				'img' => $gambar,
				'name' => htmlspecialchars($this->input->post('nama', true)),
				'slug' => slug(htmlspecialchars($this->input->post('nama', true))),
				'price' => htmlspecialchars(str_replace('.', '', $this->input->post('harga', true))),
				'desc' => $desc,
				'kategori' => htmlspecialchars($this->input->post('kate', true)),
				'manufacture' => htmlspecialchars($this->input->post('manuf', true)),
				'socket' => htmlspecialchars($this->input->post('socket', true)),
				'core' => htmlspecialchars($this->input->post('core', true)),
				'thread' => htmlspecialchars($this->input->post('thread', true)),
				'base' => htmlspecialchars($this->input->post('base', true)),
				'boost' => htmlspecialchars($this->input->post('boost', true)),
				'referensi' => htmlspecialchars($this->input->post('ref', true)),
				'link1' => 'https://www.tokopedia.com/search?q=' . slug(htmlspecialchars($this->input->post('nama', true)), ' ', false),
				'link2' => 'https://www.bukalapak.com/products?search%5Bkeywords%5D=' . slug(htmlspecialchars($this->input->post('nama', true)), ' ', false),
				'link3' => 'https://shopee.co.id/search?keyword=' . slug(htmlspecialchars($this->input->post('nama', true)), ' ', false),
				'date_added' => time()
			];
			$this->db->insert('komponen', $komponen);

			logs('Tambah Komponen', htmlspecialchars($this->input->post('nama', true)));

			$this->session->set_flashdata(
				'flashmsg',
				'Komponen telah ditambahkan.'
			);
			redirect('dashboard/komponen');
		}
	}

	public function ubah($id)
	{
		is_logged_in();
		$data['title'] = 'Ubah Komponen';

		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['kompo'] = $this->db->get_where('komponen', ['id' => $id])->row_array();

		$this->form_validation->set_rules('nama', 'Nama Komponen', 'required', ['required' => '{field} wajib diisi']);
		$this->form_validation->set_rules('isi', 'Deskripsi', 'required', ['required' => '{field} wajib diisi']);
		$this->form_validation->set_rules('manuf', 'Manufaktur', 'required', ['required' => 'Silhakan pilih {field}']);
		$this->form_validation->set_rules('kate', 'Deskripsi', 'required', ['required' => 'Silhakan pilih {field}']);

		if ($this->form_validation->run() === false) {
			$this->load->view('Dashboard/Komponen/ubah', $data);
		} else {
			$image = $_FILES['image']['name'];

			if ($image) {
				$config['allowed_types'] = 'jpeg|jpg|png';
				$config['max_size'] 	 = '2048';
				$config['encrypt_name']	 = TRUE;
				$config['upload_path'] 	 = './assets/img/komponen/';
				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {
					$prevImg = $data['kompo']['gambar'];
					if ($prevImg != '' || null) {
						unlink(FCPATH . 'assets/img/komponen/' . $prevImg);
					}
					$this->db->set('img', $this->upload->data('file_name'));
				} else {
					$this->session->set_flashdata(
						'flasherr',
						$this->upload->display_errors()
					);
					redirect('dashboard/komponen');
				}
			}
			$this->db->set('name', htmlspecialchars($this->input->post('nama', true)));
			$this->db->set('slug', slug(htmlspecialchars($this->input->post('nama', true))));
			$this->db->set('price', htmlspecialchars(str_replace('.', '', $this->input->post('harga', true))));
			$this->db->set('desc', $this->input->post('isi'));
			$this->db->set('manufacture', htmlspecialchars($this->input->post('manuf', true)));
			$this->db->set('kategori', htmlspecialchars($this->input->post('kate', true)));
			$this->db->set('core', htmlspecialchars($this->input->post('core', true)));
			$this->db->set('thread', htmlspecialchars($this->input->post('thread', true)));
			$this->db->set('base', htmlspecialchars($this->input->post('base', true)));
			$this->db->set('boost', htmlspecialchars($this->input->post('boost', true)));
			$this->db->set('date_added', time());
			$this->db->where('id', $id);
			$this->db->update('komponen');

			logs('Update Komponen', htmlspecialchars($this->input->post('nama', true)));

			$this->session->set_flashdata(
				'flashmsg',
				'Komponen telah diupdate.'
			);
			redirect('dashboard/komponen');
		}
	}

	public function tampil($slug)
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		if ($slug == '' || null) {
			redirect('konsultasi');
		} else {
			$this->db->select('k.img, k.id, k.manufacture as kmanufid, km.manufacture, k.name, kk.name as kategori, k.desc, k.price, k.slug, k.date_added as ditambahkan, k.core, k.thread, k.base, k.boost, k.socket, k.referensi as ref, k.link1, k.link2, k.link3');
			$this->db->join('komponen_kategori kk', 'k.kategori = kk.id');
			$this->db->join('komponen_manufacture km', 'k.manufacture = km.id');
			$this->db->order_by('ditambahkan DESC');
			$data['kompo'] = $this->db->get_where('komponen k', ['slug' => $slug])->row_array();
			$data['title'] = $data['kompo']['name'];

			$this->load->view('Dashboard/Komponen/tampil', $data);
		}
	}

	public function hapus($id)
	{
		is_logged_in();
		$prevImg = $this->db->get_where('komponen', ['id' => $id])->row_array();
		logs('Hapus Komponen', $prevImg['name']);

		if ($prevImg['img'] != '' || null) {
			// menghapus file poster sesuai id
			unlink(FCPATH . 'assets/img/komponen/' . $prevImg['img']);
		}
		$this->db->delete('komponen', ['id' => $id]);
		$this->session->set_flashdata(
			'flashmsg',
			'Komponen berhasil dihapus'
		);
		redirect('dashboard/komponen');
	}

	public function redir()
	{
		if ($this->session->userdata('email')) {
			redirect('dashboard/komponen');
		} else {
			redirect('konsultasi');
		}
	}
}
