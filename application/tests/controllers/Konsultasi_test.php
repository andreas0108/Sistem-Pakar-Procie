<?php

/**
 * Part of ci-phpunit-test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class Konsultasi_test extends TestCase
{
    public function setUp(): void
    {
        $this->resetInstance();
        $this->CI->load->library('session');
        $this->CI->load->database();
        $this->CI->load->helper('sikar_helper');
        $this->CI->load->model('Sikar_model', 'Simo');
        $this->db = $this->CI->db;
        $this->sess = $this->CI->session;
        $this->Simo = $this->CI->Simo;
    }

    public function test_index()
    {
        $this->request('GET', 'Home/konsultasi');
        $this->assertResponseCode(200);
        $this->assertNotEquals('Error', $this->request('GET', 'Home/Konsultasi'));
    }

    public function test_konsultasi()
    {
        $this->request('POST', 'Home/konsultasi', ['username' => 'Andreas Ardi', 'usermail' => 'andreas.ardi1@gmail.com']);

        $act = ['uname' => $this->sess->userdata('uname'), 'umail' => $this->sess->userdata('umail')];
        $exp = ['uname' => 'Andreas Ardi', 'umail' => 'andreas.ardi1@gmail.com'];
        $this->assertNotEmpty($act);
        $this->assertIsArray($act);
        $this->assertEquals($exp, $act);
    }

    public function test_data_pertanyaan()
    {
        $act = $this->Simo->getSinglePertanyaan();
        $exp = ['id' => 'P01', 'pertanyaan' => 'Apakah Anda Pernah Merakit PC ?'];
        $this->assertNotEmpty($act);
        $this->assertIsArray($act);
        $this->assertEquals($exp, $act);
    }

    public function test_list_jawaban()
    {
        $act = $this->Simo->getListJawaban('P01');
        $act = $act[0];
        $exp = ['0' => ['id' => 'P01J01', 'jawaban_content' => 'Pernah', 'status' => '1', 'pertanyaan_id' => 'P01']];
        $this->assertNotEmpty($act);
        $this->assertIsArray($act);
        $this->assertContainsEquals($act, $exp);
    }

    public function test_step()
    {
        $this->request('POST', 'Home/konsultasi', ['username' => 'Andreas Ardi', 'usermail' => 'andreas.ardi1@gmail.com']);
        $konsul_id = $this->sess->userdata('konsul_id');

        $this->request('POST', 'Home/step', ['konsul_id' => $konsul_id, 'pertanyaan_id' => 'P01', 'jawaban' => 'P01J01']);

        $act = $this->Simo->getTmpData();
        $this->assertNotEmpty($act);

        $act = $act['jawaban_id'];
        $exp = 'P01J01';
        $this->Simo->delete_temp_konsul($konsul_id);

        $this->assertRedirect('konsultasi');
        $this->assertResponseCode(302);
        $this->assertEquals($exp, $act);
    }

    public function test_proses()
    {
        $this->request('POST', 'Home/konsultasi', ['username' => 'Andreas Ardi', 'usermail' => 'andreas.ardi1@gmail.com']);
        $konsul_id = $this->sess->userdata('konsul_id');
        $data = [
            ['konsul_id' => $konsul_id, 'pertanyaan_id' => 'P01', 'jawaban' => 'P01J01'],
            ['konsul_id' => $konsul_id, 'pertanyaan_id' => 'P02', 'jawaban' => 'P02J01'],
            ['konsul_id' => $konsul_id, 'pertanyaan_id' => 'P03', 'jawaban' => 'P03J01']
        ];

        for ($i = 0; $i < 3; $i++) {
            $this->request('POST', 'Home/step', $data[$i]);
        }

        $this->request('POST', 'Home/proses', ['konsul_id' => $konsul_id, 'pertanyaan_id' => 'P04', 'jawaban' => 'P04J01']);

        $act = $this->sess->tempdata('hasil');
        $this->assertNotEmpty($act);
        $this->assertIsArray($act);

        $act = ['name' => $act[0]['name']];
        $exp = ['name' => 'AMD Ryzen 3 3100'];

        $this->assertRedirect('konsultasi/hasil');
        $this->assertResponseCode(302);
        $this->assertEquals($exp, $act);
    }
}
