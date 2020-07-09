<?php
defined('BASEPATH') or exit('No direct script access allowed');

use \Firebase\JWT\JWT;

class Article extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}

	public function index()
	{
		$data['title'] = 'Daftar Artikel';

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

		$this->load->view('Dashboard/Article/index', $data);
	}

	public function tambah()
	{
		$data['title'] = 'Tambah Artikel';

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
			$this->load->view('Dashboard/Article/tambah', $data);
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
			redirect('Dashboard/Article');
		}
	}

	public function ubah($id)
	{
		$data['title'] = 'Ubah Artikel';

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
			redirect('Dashboard/Article');
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
		redirect('Dashboard/Article');
	}

	public function hapus_semua()
	{
		logs('Hapus Semua Artikel', null);
		$this->db->truncate('article');
		$this->session->set_flashdata(
			'flashmsg',
			'Semua Artikel berhasil dihapus'
		);
		redirect('Dashboard/Article');
	}

	public function redir()
	{
		redirect('Dashboard/Article');
	}

	public function jwten()
	{
		// TinyMCE JWT Key
		$privateKey = <<<EOD
-----BEGIN PRIVATE KEY-----
MIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQDJkXFclY/qu2vb
W1FYvj3iokRKg0p3dUQxeBb/EUS7+hHA0ijP18llJwr6PHz+gTsMKpy5Oko9KefW
lbaw+PKxJ/N7hZBhv9xk8PhQngQnwiUNrxqmdO4eYLtQAFuMTz62x9dcSh/27FzH
S4+2qNf4EffX/sUpPpFZy1enuY4HRC7s1QQRYoFSs8+5ZL1KahtSEz4Cg2dRf45n
HfDdWMLtUihglbsU4NXYbVBIGJKH7U/pr+GNbSoQbvJAcS4ZV5OcwAp3i/RiW0gM
fEYxRQRCicJUGC90v2yLSlUseQuwXGUrukDw+KExJgJjGI6upNJLyqOAOid7PA0v
/OebJMorAgMBAAECggEAQtu1SEprpCZqjiXqA4+Go2fDUxvdVWZWKjp1FkG6FMfL
n7OVyer/aEfdAkeSBjEDTvPLbD0DZupBdhHOuUC57z0bK/uPenzTM8Ah/UuMgUuK
UtGj+1aJrRXUy6Jyu0WFvcbnjjsgAx0/YPOVRbcXe7cqCED/UMDqIWirOHz5uTqy
9q4sY7qxE0toPYX09JxkQ1wAxXI9fDxJwW8tQpxeESJjMgXtDJrk/YsE8UtCjBPV
LYNDzyBJPtNL68lKb//5Y5PwzzLV9yxs0/ChAJs5nw2skmlV3mkssGxKmZMFRH8O
OLJu3RSiLZTANbCJf2Xm03kRlFgIuCHhaMumdSyPkQKBgQD8U6F7ZwWARp6dLvbr
Su4x/Zmcxn/c+VjgPW4Re4b613eZYCKF90xwGHo5af8MMaZuVRtfa1RChoxcmhdN
lmCSMOvaa91g7s/rLOsKy6hd7bcMJ3ltgZXYDlLG2MrzheFmPM7icq8pF2GlAOn7
r+uy6iXV/w7J5rNmQFvNuebRJwKBgQDMgKU8eNFxFw2MUI5vlf8v0+UaBZgOWsSm
416hHCE9/6lIB/NG/Hbp4NRq1MUuuhFCXkjjDNPdlgg8xU8uYwufL5x0yLlrmWPL
GR0+rgkQAunMVj1ioghndYlEiUSi/ozFIvbeRnjF0uJr0QO9jnO1ZjbeEcRm4bv0
15ewR/IZXQKBgHqZm/WcqeSY64qN/jV3E+NASDoPjKLumItj7a4a6gvJU3g3aK7U
6NPyYLiy0tS27xneyk0Dlk44l8yKplXxgfymPoLDNC5b+rRW/+Ef8S+qR+1k5LAb
bZYr53Zscbf/TfRiCVenx4ncrXoBxq6e3JPzBu1CX4okSPievrxn3kmzAoGAT57W
tpCjmtBK6hKDIlbYIBrz3AnJhe05G3Dy6u800hq0IeNWiJDLC4wJp/5nNyYiiiCD
aEMaSe+cDW0Uww60+6lh1OZBqu7xt6VziW/g/2bi+Derdrd3ZjCQ3SpEmuFYlXhj
fW8anorYtPmP50GLM1k0i4mHWjcRIua9nFimndECgYBEE7o93DYUo9IysDwhu7Yo
osCVEJ3E6C8cwXg30SHJMe6PvVwoB3suVlDpA6u7hU+ukf+p+d5H821a5+uWwAj3
BoqN6IY0Uaio9vjSr7PHIyD8ZYeBQjIlQvLaiXAzl+PU+xFpjPH91qefT9DmfxQ+
ScxuGelfuN1KpmIZoIEuGw==
-----END PRIVATE KEY-----
EOD;

		$payload = array(
			"sub" => "1228479",         // Unique user id string
			"name" => "Andreas Ardi",   // Full name of user
			"exp" => time() + 60 * 10   // 10 minutes expiration
		);

		// $jwt = JWT::encode($payload, $privateKey, 'RS256');
		// echo "Encoded : \n" . print_r($jwt, true);

		if ($this->session->userdata('email')) {
			try {
				$token = JWT::encode($payload, $privateKey, 'RS256');
				http_response_code(200);
				header('Content-Type: application/json');
				echo json_encode(array("token" => $token));
			} catch (Exception $e) {
				http_response_code(500);
				header('Content-Type: application/json');
				echo $e->getMessage();
			}
		} else {
			echo "<title>404</title>";
			echo "ERROR 404 : File Not Found";
		}
	}
}
