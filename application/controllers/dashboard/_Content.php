<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Content extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->helper('tanggal-indo');
        $this->load->model('Article_model', 'ArtiMo');
    }

    // Article Side
    public function index()
    {
        $data['title'] = 'CI-App';
        $data['title2'] = 'Content';
        $data['title3'] = 'Article';

        // user data for session
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();

        $data['listArticle'] = $this->ArtiMo->getArticle();

        $this->load->view('dashboard/parts/header', $data);
        $this->load->view('dashboard/parts/sidebar', $data);
        $this->load->view('dashboard/parts/navbar', $data);
        $this->load->view('dashboard/content/article/index', $data);
        $this->load->view('dashboard/parts/modal');
        $this->load->view('dashboard/parts/javascript');
        $this->load->view('dashboard/menu/js');
        $this->load->view('dashboard/parts/footer');
    }

    public function add()
    {
        $data['title'] = 'CI-App';
        $data['title2'] = 'Content';
        $data['title3'] = 'Article';

        // user data for session
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('title', 'Judul', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/parts/header', $data);
            $this->load->view('dashboard/parts/sidebar', $data);
            $this->load->view('dashboard/parts/navbar', $data);
            $this->load->view('dashboard/content/article/add', $data);
            $this->load->view('dashboard/parts/modal');
            $this->load->view('dashboard/content/article/javascript');
            $this->load->view('dashboard/content/article/js');
            $this->load->view('dashboard/parts/footer');
        } else {
            // add
            $config['upload_path']   = './assets/img/article/poster/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|jfif';
            $config['encrypt_name']     = TRUE;

            $this->load->library('upload', $config);

            if (!empty($_FILES['poster']['name'])) {
                if ($this->upload->do_upload('poster')) {
                    $img = $this->upload->data['file_name'];
                    $data = [
                        'judul' => htmlspecialchars($this->input->post('title', true)),
                        'slug' => htmlspecialchars(slug($this->input->post('title', true))),
                        'gambar' => $this->upload->data('file_name'),
                        'isi' => $this->input->post('article-sum'),
                        'video' => htmlspecialchars($this->input->post('youtube_id', true)),
                        'status' => htmlspecialchars($this->input->post('status', true)),
                        'penulis_id' => htmlspecialchars($this->input->post('penulis_id', true))
                    ];
                    var_dump($data);
                    die;

                    $this->db->insert('content_article', $data);

                    $this->session->set_flashdata(
                        'n_article',
                        '<div class="alert alert-success alert-dismissible fade show" role="alert">
						Artikel berhasil ditambahkan.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>'
                    );
                    redirect('dashboard/content/');
                } else {
                    echo $this->upload->display_errors();
                }
            } else {
                $data = [
                    'judul' => htmlspecialchars($this->input->post('title', true)),
                    'slug' => htmlspecialchars(slug($this->input->post('title', true))),
                    'gambar' => null,
                    'isi' => $this->input->post('article-sum'),
                    'video' => htmlspecialchars($this->input->post('youtube_id', true)),
                    'status' => htmlspecialchars($this->input->post('status', true)),
                    'penulis_id' => htmlspecialchars($this->input->post('penulis_id', true))
                ];
                // var_dump($data);
                // die;

                $this->db->insert('content_article', $data);

                $this->session->set_flashdata(
                    'n_article',
                    '<div class="alert alert-success alert-dismissible fade show" role="alert">
					Artikel berhasil ditambahkan.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>'
                );
                redirect('dashboard/content/');
            }
        }
    }

    public function edita($id)
    {
        $data['title'] = 'CI-App';
        $data['title2'] = 'Content';
        $data['title3'] = 'Article';

        // user data for session
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['lA'] = $this->ArtiMo->getSingleArticleByID($id);

        // var_dump($data['lA']);
        // die;

        $this->form_validation->set_rules('title', 'Judul', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/parts/header', $data);
            $this->load->view('dashboard/parts/sidebar', $data);
            $this->load->view('dashboard/parts/navbar', $data);
            $this->load->view('dashboard/content/article/edit', $data);
            $this->load->view('dashboard/parts/modal');
            $this->load->view('dashboard/content/article/javascript');
            $this->load->view('dashboard/content/article/js');
            $this->load->view('dashboard/parts/footer');
        } else {
            //edit
            $config['upload_path']   = './assets/img/article/poster/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|jfif';
            $config['encrypt_name']     = TRUE;

            $this->load->library('upload', $config);

            if (!empty($_FILES['poster']['name'])) {
                if ($this->upload->do_upload('poster')) {
                    $prevImg = $data['lA']['gambar'];

                    // hapus poster sebelumnya jika ada
                    if ($prevImg != '' || null) {
                        unlink(FCPATH . 'assets/article/poster/' . $prevImg);
                    }

                    $gambar = $this->upload->data('file_name');
                    $judul = htmlspecialchars($this->input->post('title', true));
                    $slug = htmlspecialchars(slug($this->input->post('title', true)));
                    $isi = $this->input->post('article-sum');
                    $video = htmlspecialchars($this->input->post('youtube_id', true));
                    $status = htmlspecialchars($this->input->post('status', true));
                    $editor_id = htmlspecialchars($this->input->post('editor_id', true));

                    // var_dump($_POST);
                    // var_dump($this->upload->data());
                    // die;

                    $this->db->set('judul', $judul);
                    $this->db->set('slug', $slug);
                    $this->db->set('isi', $isi);
                    $this->db->set('gambar', $gambar);
                    $this->db->set('video', $video);
                    $this->db->set('status', $status);
                    $this->db->set('editor_id', $editor_id);
                    $this->db->where('id', $id);
                    $this->db->update('content_article');

                    $this->session->set_flashdata(
                        'n_article',
                        '<div class="alert alert-success alert-dismissible fade show" role="alert">
						Artikel berhasil dirubah.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>'
                    );
                    redirect('dashboard/content/');
                } else {
                    // echo $this->upload->display_errors();
                    $this->session->set_flashdata(
                        'n_article',
                        '<div class="alert alert-danger alert-dismissible fade show">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<h5><i class="icon fas fa-info"></i> Informasi</h5>
							Gagal merubah artikel.
						</div>'
                    );
                    redirect('dashboard/content/');
                }
            } else {
                $gambar = null;
                $judul = htmlspecialchars($this->input->post('title', true));
                $slug = htmlspecialchars(slug($this->input->post('title', true)));
                $isi = $this->input->post('article-sum');
                $video = htmlspecialchars($this->input->post('youtube_id', true));
                $status = htmlspecialchars($this->input->post('status', true));
                $editor_id = htmlspecialchars($this->input->post('editor_id', true));

                // var_dump($_POST);
                // var_dump($this->upload->data());
                // die;

                $this->db->set('judul', $judul);
                $this->db->set('slug', $slug);
                $this->db->set('isi', $isi);
                $this->db->set('gambar', $gambar);
                $this->db->set('video', $video);
                $this->db->set('status', $status);
                $this->db->set('editor_id', $editor_id);
                $this->db->where('id', $id);
                $this->db->update('content_article');

                $this->session->set_flashdata(
                    'n_article',
                    '<div class="alert alert-success alert-dismissible fade show" role="alert">
						Artikel berhasil dirubah.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>'
                );
                redirect('dashboard/content/');
            }
        }

        // $judul = htmlspecialchars($this->input->post('title', true));
        // $slug = htmlspecialchars(slug($this->input->post('title', true)));
        // $isi = $this->input->post('article-sum');
        // $video = htmlspecialchars($this->input->post('youtube_id', true));
        // $status = htmlspecialchars($this->input->post('status', true));

        // $upload_img = $_FILES['poster']['name'][0];

        // if ($upload_img) {
        // 	$config['upload_path']   = './assets/img/article/poster/';
        // 	$config['allowed_types'] = 'gif|jpg|jpeg|png|jfif';
        // 	$config['encrypt_name']	 = TRUE;

        // 	$this->load->library('upload', $config);

        // 	if (!$this->upload->do_upload('poster')) {
        // 		echo $this->upload->display_errors();
        // 	} else {
        // 		// remove previous img / old image 
        // 		$prevImg = $data['lA']['gambar'];
        // 		unlink(FCPATH . 'assets/img/article/poster/' . $prevImg['gambar']);
        // 		$newImg = $this->upload->data('file_name');
        // 		$this->db->set('gambar', $newImg);
        // 	}
        // }

        // $this->db->set('judul', $judul);
        // $this->db->set('slug', $slug);
        // $this->db->set('isi', $isi);
        // $this->db->set('video', $video);
        // $this->db->set('status', $status);
        // $this->db->where('id', $id);
        // $this->db->update('content_article');

        // $this->session->set_flashdata(
        // 	'n_article',
        // 	'<div class="alert alert-success alert-dismissible fade show" role="alert">
        // 						Artikel berhasil ditambahkan.
        // 						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        // 						  <span aria-hidden="true">&times;</span>
        // 						</button>
        // 					  </div>'
        // );
        // redirect('dashboard/content/');
    }

    public function deletea($id)
    {
        $prevImg = $this->db->get_where('content_article', ['id' => $id])->row_array();

        if ($prevImg != '' || null) {
            // menghapus file poster sesuai id
            unlink(FCPATH . 'assets/img/article/poster/' . $prevImg['gambar']);

            $this->db->delete('content_article', array('id' => $id));
            $this->session->set_flashdata(
                'n_article',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
							Artikel berhasil dihapus
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>'
            );
            redirect('dashboard/content/');
        }
    }

    //Upload image summernote
    function upload_imga()
    {
        if (isset($_FILES["image"]["name"])) {
            $config['upload_path'] = './assets/img/article/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['encrypt_name']     = TRUE;

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

    // Article Side End
    // Event Side
    public function event()
    {
        $data['title'] = 'CI-App';
        $data['title2'] = 'Content';
        $data['title3'] = 'Event';

        // user data for session
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['lE'] = $this->db->get('content_event')->result_array();

        // var_dump($data['lE']);
        // die;

        $this->load->view('dashboard/parts/header', $data);
        $this->load->view('dashboard/parts/sidebar', $data);
        $this->load->view('dashboard/parts/navbar', $data);
        $this->load->view('dashboard/content/event/index', $data);
        $this->load->view('dashboard/parts/modal');
        $this->load->view('dashboard/parts/javascript');
        $this->load->view('dashboard/menu/js');
        $this->load->view('dashboard/parts/footer');
    }

    // Event Side End
    // Renungan Side
    public function renungan()
    {
        $data['title'] = 'CI-App';
        $data['title2'] = 'Content';
        $data['title3'] = 'Renungan';

        // user data for session
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('dashboard/parts/header', $data);
        $this->load->view('dashboard/parts/sidebar', $data);
        $this->load->view('dashboard/parts/navbar', $data);
        $this->load->view('dashboard/content/renungan/index', $data);
        $this->load->view('dashboard/parts/modal');
        $this->load->view('dashboard/parts/javascript');
        $this->load->view('dashboard/menu/js');
        $this->load->view('dashboard/parts/footer');
    }

    // Renungan Side End
    public function page()
    {
        $data['title'] = 'CI-App';
        $data['title2'] = 'Content';
        $data['title3'] = 'Page';

        // user data for session
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('dashboard/parts/header', $data);
        $this->load->view('dashboard/parts/sidebar', $data);
        $this->load->view('dashboard/parts/navbar', $data);
        $this->load->view('dashboard/content/pages/index', $data);
        $this->load->view('dashboard/parts/modal');
        $this->load->view('dashboard/parts/javascript');
        $this->load->view('dashboard/menu/js');
        $this->load->view('dashboard/parts/footer');
    }
}
