<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sikar_model extends CI_Model
{
	public function setsqlmode($mode, $replace_by = '')
	{
		$this->db->query("SET SESSION sql_mode=(SELECT REPLACE(@@sql_mode,'" . $mode . "', '" . $replace_by . "')) ");
	}

	// User Data
	public function data_user()
	{
		return $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
	}

	public function setUserdata()
	{
		$uname = $this->input->post('username');
		$umail = $this->input->post('usermail');
		$id = generateUniqueString();

		return $this->session->set_userdata(['konsul_id' => $id, 'uname' => $uname, 'umail' => $umail]);
	}

	// Form Sistem Pakar
	public function getTmpData()
	{
		return $this->db->order_by('id DESC')->limit(1)
			->get_where('tmp_data', ['konsul_id' => $this->session->userdata('konsul_id')])->row_array();
	}

	public function getData($tmpdata)
	{
		return $this->db->select('r.next_pertanyaan as id, p.pertanyaan_content as pertanyaan')
			->join('pertanyaan p', 'r.next_pertanyaan = p.id')
			->get_where('rulesp r', ['r.jawaban_id' => $tmpdata])->row_array();
	}

	public function getSinglePertanyaan()
	{
		return $this->db->select('id, pertanyaan_content as pertanyaan')->limit(1)
			->get('pertanyaan')->row_array();
	}

	public function getListJawaban($ID)
	{
		return $this->db->where('status', 1)->get_where('jawaban', ['pertanyaan_id' => $ID])->result_array();
	}

	public function getHistory()
	{
		return $this->db->select('t.id, p.pertanyaan_content as pert, j.jawaban_content as jaw')
			->join('pertanyaan p', 't.pertanyaan_id = p.id')
			->join('jawaban j', 't.jawaban_id = j.id')
			->get_where('tmp_data t', ['t.konsul_id' => $this->session->userdata('konsul_id')])->result_array();
	}

	// Keperluan Sistem Pakar
	public function step_data()
	{
		return $this->db->insert('tmp_data', [
			'konsul_id' => $this->session->userdata('konsul_id'),
			'pertanyaan_id' => $this->input->post('pertanyaan_id'),
			'jawaban_id' => $this->input->post('jawaban')
		]);
	}

	public function get_konsul_data_byID($usid)
	{
		// return $this->db->query('SELECT jawaban_id FROM tmp_data WHERE konsul_id = "' . $usid . '"')->result_array();
		$query = $this->db->select('jawaban_id')->get_where('tmp_data', 'konsul_id = "' . $usid . '"')->result_array();

		return ['data' => "'" . arrtostr($query, "','") . "'", 'jumlah' => count($query)];
	}

	public function proses_data($konsul, $jumlah_data)
	{
		return $this->db->select('rules.komponen_id, komponen.name, komponen.manufacture')
			->join('komponen', 'rules.komponen_id = komponen.id')
			->where("jawaban_id IN (" . $konsul . ")")
			->group_by('komponen_id')
			->having('COUNT(DISTINCT jawaban_id) = ', $jumlah_data)
			->get('rules')->result_array();
	}

	public function merge_data($data)
	{
		return array_merge($this->db->select('k.img, k.id, k.manufacture as kmanufid, km.manufacture, k.name, kk.name as kategori, k.desc, k.price, k.slug, k.date_added as ditambahkan, k.core, k.thread, k.base, k.boost, k.socket, k.referensi as ref, k.link1, k.link2, k.link3')
			->join('komponen_kategori kk', 'k.kategori = kk.id')
			->join('komponen_manufacture km', 'k.manufacture = km.id')
			->get_where('komponen k', ['k.id' => $data])->row_array());
	}

	public function delete_temp_konsul($konsul_id)
	{
		return $this->db->delete('tmp_data', ['konsul_id' => $konsul_id]);
	}

	// Data Dashboard 
	public function jsonCountHasil()
	{
		$x = 'SELECT COUNT(hasil) AS jumlah 
				FROM history 
			GROUP BY DATE_FORMAT(tanggal, "%Y-%m-%d") 
			ORDER BY DATE_FORMAT(tanggal, "%Y-%m-%d") DESC
			LIMIT 5;';
		return $this->db->query($x)->result_array();
	}

	public function jsonlabelHasil()
	{
		$x = 'SELECT LEFT(konsul_id,8) AS tanggal
				FROM history 
			GROUP BY DATE_FORMAT(tanggal, "%Y-%m-%d") 
			ORDER BY tanggal DESC
			LIMIT 5;';

		return $this->db->query($x)->result_array();
	}
}
