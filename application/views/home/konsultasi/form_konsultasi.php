<?php
defined('BASEPATH') or exit('No direct script access allowed');

$mulai = false;
$tmpdata = $this->Simo->getTmpData();

if ($tmpdata) {
	// jika sudah ada data di tmp_data
	$data = $this->Simo->getData($tmpdata['jawaban_id']);
} else {
	// jika belum ada, dimulai dari sini
	$mulai = true;
	$data = $this->Simo->getSinglePertanyaan();
}

// fungsi untuk cek pertanyaan berikutnya apakah terdaftar di database atau tidak
$x = 'P' . sprintf("%02s", intval(substr($data['id'], 2)) + 1);
$next = $this->db->get_where('pertanyaan', ['id' => $x])->row_array();
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
						<h2 class="text-center mt-4"><?= $data['pertanyaan'] ?></h2>
						<div class="row text-center">
							<div class="col form-group">
								<?php
								foreach ($this->Simo->getListJawaban($data['id']) as $j) : ?>
									<label class="imagecheck mb-4">
										<input type="hidden" name="pertanyaan_id" value="<?= $data['id'] ?>">
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
							<a href="<?= base_url('konsultasi/cancel') ?>" id="cancel" class="btn btn-black">Batal</a>
						<?php } ?>
						<div class="float-right">
							<button type="reset" id="reset" class="btn btn-info">Reset</button>
							<?php if ($next != null || '') { ?>
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
						<li class="list-group-item active">History Jawaban</li>
						<?php $history = $this->Simo->getHistory();
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