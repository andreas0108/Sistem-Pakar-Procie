<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Feedback extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        is_logged_in();
        $data['title'] = 'Feedback';

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // Published list
        $this->db->order_by('id', 'DESC');
        $data['feed'] = $this->db->get('feedback')->result_array();

        $this->load->view('Dashboard/feed', $data);
    }

    public function kirim()
    {
        $this->form_validation->set_rules('name', 'Nama', 'required', ['required' => 'Silahkan isi {field} anda terlebih dahulu']);
        $this->form_validation->set_rules('email', 'Email', 'required', ['required' => 'Silahkan isi {field} anda terlebih dahulu']);
        $this->form_validation->set_rules('isi', 'Feedback', 'required', ['required' => 'Silahkan masukan {field} anda']);

        if ($this->form_validation->run() == false) {
            if ($this->input->post('url')) {
                redirect($this->input->post('url'));
            } else {
                redirect('konsultasi');
            }
        } else {
            $this->db->insert('feedback', [
                'id' => generateDateID('feedback'),
                'nama' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'isi' => htmlspecialchars($this->input->post('isi', true))
            ]);

            logs('Feedback Baru dari ' . htmlspecialchars($this->input->post('name', true)));

            $this->session->set_flashdata(
                'flashmsg',
                'Feedback berhasil dikirim. Terima Kasih telah menggunakan aplikasi ini.'
            );
            if ($this->input->post('url')) {
                redirect($this->input->post('url'));
            } else {
                redirect('konsultasi');
            }
        }
    }

    public function hapus($id)
    {
        is_logged_in();
        $this->db->delete('feedback', ['id' => $id]);
        $this->session->set_flashdata(
            'flashmsg',
            'Feedback berhasil dihapus'
        );
        redirect('dashboard/feedback');
    }
}
