<?php
defined('BASEPATH') or exit('No direct script access allowed');

$hasil = false;
$mulai = false;
$row = $this->db->order_by('id DESC')->limit(1)->get_where('tmp_data', ['konsul_id' => $this->session->userdata('konsul_id')])->row_array();
// var_dump($row);

if ($row) {
	$row = $this->db->select('r.next_pertanyaan as id, p.pertanyaan_content as pertanyaan')
		->join('pertanyaan p', 'r.next_pertanyaan = p.id')
		->get_where('rulesp r', ['r.jawaban_id' => $row['jawaban_id']])->row_array();
	if ($row) {
	}
} else {
	$mulai = true;
	$row = $this->db->select('id, pertanyaan_content as pertanyaan')->limit(1)->get('pertanyaan')->row_array();
}
$x = 'P' . sprintf("%02s", intval(substr($row['id'], 1)) + 1);
$next = $this->db->get_where('pertanyaan', ['id' => $x])->row_array();
$konsultasi = arrtostr($this->db->select('jawaban_id')->get_where('tmp_data', ['konsul_id' => $this->session->userdata('konsul_id')])->result_array());

// var_dump($x);
// var_dump($row);
// var_dump($next);
?>

<div class="col-md-10 col-sm-12 mx-auto">
	<div class="row">
		<div class="<?= !$mulai ? 'col-md-9 col-sm-12' : 'col-12'; ?>">
			<div class="card card-round">
				<div class="card-header wizard-cover text-white text-center align-items-center">
					<div style="flex: 0,0">
						<h2 class="wizard-title"><b><?= $this->config->item('site_name'); ?></b></h2>
						<small><?= $desc ?></small>
					</div>
				</div>
				<div class="card-body">
					<form action="<?= base_url('Home/') . ($next == '' ? 'proses' : 'step') ?>" method="POST">
						<h2 class="text-center mt-4"><?= $row['pertanyaan'] ?></h2>
						<div class="row text-center">
							<div class="col form-group">
								<?php $this->db->where('status', 1);
								$jawaban = $this->db->get_where('jawaban', ['pertanyaan_id' => $row['id']])->result_array() ?>
								<?php
								foreach ($jawaban as $j) : ?>
									<label class="imagecheck mb-4">
										<input type="hidden" name="pertanyaan_id" value="<?= $row['id'] ?>">
										<input name="jawaban" type="radio" value="<?= $j['id'] ?>" class="imagecheck-input pilihan">
										<figure class="imagecheck-figure m-1 d-flex">
											<img class="card-img" src="https://via.placeholder.com/200.png?text=&nbsp" alt="<?= str_replace(' ', ' ', $j['jawaban_content']) ?>">
											<div class="card-img-overlay" style="top: 34%">
												<h4 class="text-primary"><?= str_replace(' ', ' ', $j['jawaban_content']) ?></h4>
											</div>
										</figure>
									</label>
								<?php endforeach ?>
							</div>
						</div>
						<?php if (!$mulai) { ?>
							<a href="#" class="btn btn-black">Batal</a>
						<?php } ?>
						<div class="float-right">
							<button type="reset" id="reset" class="btn btn-info">Reset</button>
							<?php if ($next) { ?>
								<button type="submit" id="selanjutnya" class="btn btn-primary" disabled>Selanjutnya</button>
							<?php } else { ?>
								<button type="submit" id="finish" class="btn btn-danger" disabled>Finish</button>
							<?php } ?>
						</div>
					</form>
				</div>
			</div>
		</div>
		<?php if (!$mulai) { ?>
			<div class="col-md-3 col-sm-12">
				<div class="card" style="width: 100%;">
					<ul class="list-group list-group-flush">
						<li class="list-group-item active">History Pertanyaan</li>
						<?php $this->db->select('t.id, p.pertanyaan_content as pert, j.jawaban_content as jaw');
						$this->db->join('pertanyaan p', 't.pertanyaan_id = p.id');
						$this->db->join('jawaban j', 't.jawaban_id = j.id');
						$history = $this->db->get_where('tmp_data t', ['t.konsul_id' => $this->session->userdata('konsul_id')])->result_array();
						foreach ($history as $h) { ?>
							<li class="list-group-item d-flex justify-content-between align-items-center">
								<?= $h['pert'] ?>
								<span>
									<b><?= $h['jaw'] ?></b>
								</span>
							</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		<?php } ?>
	</div>
</div>