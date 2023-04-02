<style>
.btn-tata-laksana {
    background-color: #FFC3AE!important;
    border-color: #FFC3AE!important;
}
.btn-tata-laksana:hover {
    background-color: #FFC3AE!important;
    border-color: #FFC3AE!important;
}
.btn-tata-laksana:focus {
    background-color: #ffbec7!important;
    border-color: #ffbec7!important;
}
</style>

<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h5 class="my-4 fw-500"><?= isset($title) ? $title : '' ?></h5>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="card p-3">
                    <a href="<?= str_replace('_','-',$name).'/edit/'.model('M_Env')->encode($data['id']) ?>">
                        <?php
                        if ($data['risiko'] == 'Risiko rendah') {
                            $btn_risiko = 'btn-success';
                        } elseif ($data['risiko'] == 'Risiko sedang') {
                            $btn_risiko = 'btn-warning';
                        } elseif ($data['risiko'] == 'Risiko tinggi') {
                            $btn_risiko = 'btn-danger';
                        }
                        ?>
                        <button class="btn <?= $btn_risiko ?>"><?= $data['risiko'] ?></button>
                    </a>
                    <button class="btn btn-tata-laksana mt-3" onclick="edukasiPenyakit()">
                        <div class="row">
                            <div class="col-3">
                                <img src="<?= base_url('assets/img/heart.png') ?>" class="wh-50">
                            </div>
                            <div class="col-9 my-auto text-start">
                                <label class="fw-600">Edukasi Penyakit</label>
                            </div>
                        </div>
                    </button>
                    <button class="btn btn-tata-laksana mt-3" onclick="edukasiTataLaksana()">
                        <div class="row">
                            <div class="col-3">
                                <img src="<?= base_url('assets/img/health-care.png') ?>" class="wh-50">
                            </div>
                            <div class="col-9 my-auto text-start">
                                <label class="fw-600">Edukasi Tata Laksana</label>
                            </div>
                        </div>
                    </button>
                    <button class="btn btn-tata-laksana mt-3">
                        <div class="row">
                            <div class="col-3">
                                <img src="<?= base_url('assets/img/group.png') ?>" class="wh-50">
                            </div>
                            <div class="col-9 my-auto text-start">
                                <label class="fw-600">Support Group</label>
                            </div>
                        </div>
                    </button>
                    <button class="btn btn-tata-laksana mt-3">
                        <div class="row">
                            <div class="col-3">
                                <img src="<?= base_url('assets/img/sugar-blood-level.png') ?>" class="wh-50">
                            </div>
                            <div class="col-9 my-auto text-start">
                                <label class="fw-600">Cek Gula Darah & Kolesterol di Puskesmas</label>
                            </div>
                        </div>
                    </button>
                    <button class="btn btn-tata-laksana mt-3">
                        <div class="row">
                            <div class="col-3">
                                <img src="<?= base_url('assets/img/cardio-screening.png') ?>" class="wh-50">
                            </div>
                            <div class="col-9 my-auto text-start">
                                <label class="fw-600">Screening Lengkap di Rumah Sakit</label>
                            </div>
                        </div>
                    </button>
                    <button class="btn btn-tata-laksana mt-3">
                        <div class="row">
                            <div class="col-3">
                                <img src="<?= base_url('assets/img/doctor.png') ?>" class="wh-50">
                            </div>
                            <div class="col-9 my-auto text-start">
                                <label class="fw-600">Konsultasi Dokter Spesialis Jantung</label>
                            </div>
                        </div>
                    </button>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card p-3" id="details">
                    <!--  -->
                </div>
            </div>
        </div>
    </div>
</section>

<script>
let details = document.getElementById('details');
const edukasiPenyakit = () => {
    details.innerHTML = '<label class="fw-600 mb-2">Edukasi Penyakit</label><span>Edukasi penyakit kardiovaskular mencakup definisi, prevalensi, faktor risiko,tanda dan gejala, serta komplikasi penyakit.</span>';
}
const edukasiTataLaksana = () => {
    details.innerHTML = '<label class="fw-600 mb-2">Edukasi Tata Laksana</label><span>Sedangkan edukasi tata laksana penyakit kardiovaskular berupa edukasi modifikasi perilaku seperti manajemen diet, aktifitas fisik, pengurangan konsumsi alkohol, berhenti merokok, istirahat cukup, mengelola stres, dan melakukan monitoring kesehatan secara rutin.</span>';
}
</script>