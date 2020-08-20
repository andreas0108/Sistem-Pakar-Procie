<?php
defined('BASEPATH') or exit('No direct script access allowed');

class History_model extends CI_Model
{
    // History 
    public function History_List()
    {
        $this->db->select('h.id, h.konsul_id, h.user_name, h.email, k.name as hasil, h.tanggal');
        $this->db->join('komponen k', 'h.hasil = k.id');
        $this->db->order_by('tanggal', 'DESC');

        return $this->db->get('history h')->result_array();
    }

    // Statistic
    // AMD
    public function amd_stats()
    {
        $this->db->select('count(hasil) as jumlah')
            ->group_by('Month(tanggal), Year(tanggal)')
            ->limit(12);
        return $this->db->get_where('history', ['manufacture' => 1])->result_array();
    }

    public function amd_data()
    {
        // get last year date for sort
        $ly = intval(gmdate('Ymd0000', time() - 31597200));

        $this->db->select('h.manufacture, h.hasil, k.id, k.name, count(hasil) as jumlah')
            ->join('komponen k', 'h.hasil = k.id')->group_by('h.hasil')->order_by('jumlah DESC')
            ->where('h.manufacture', 1)->where("h.konsul_id >='$ly'");

        return $this->db->get('history h')->result_array();
    }

    // Intel
    public function intel_stats()
    {
        $this->db->select('count(hasil) as jumlah')
            ->group_by('Month(tanggal), Year(tanggal)')
            ->limit(12);
        return $this->db->get_where('history', ['manufacture' => 2])->result_array();
    }

    public function intel_data()
    {
        // get last year date for sort
        $ly = intval(gmdate('Ymd0000', time() - 31597200));

        $this->db->select('h.manufacture, h.hasil, k.id, k.name, count(hasil) as jumlah')
            ->join('komponen k', 'h.hasil = k.id')->group_by('h.hasil')->order_by('jumlah DESC')
            ->where('h.manufacture', 2)->where("h.konsul_id >='$ly'");

        return $this->db->get('history h')->result_array();
    }

    // Label
    public function statistic_label()
    {
        $this->db->select('DATE_FORMAT(tanggal, "%M %Y") as tanggal')
            ->group_by('Month(tanggal), Year(tanggal)')
            ->limit(12);

        return $this->db->get('history')->result_array();
    }
}
