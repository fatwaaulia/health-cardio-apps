<section>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h5 class="my-4"><?= isset($title) ? $title : '' ?></h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="<?= $route.'/create' ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="tinggi_badan" class="form-label">Tinggi Badan</label><span class="text-secondary"> (cm)</span>
                                    <input type="number" class="form-control <?= validation_show_error('tinggi_badan') ? "is-invalid" : '' ?>" id="tinggi_badan" name="tinggi_badan" value="<?= old('tinggi_badan') ?>" placeholder="cth. 160">
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('tinggi_badan') ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="berat_badan" class="form-label">Berat Badan</label><span class="text-secondary"> (kg)</span>
                                    <input type="number" class="form-control <?= validation_show_error('berat_badan') ? "is-invalid" : '' ?>" id="berat_badan" name="berat_badan" value="<?= old('berat_badan') ?>" placeholder="cth. 50">
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('berat_badan') ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Hasil BMI :</label>
                                    <span id="element_indeks_massa_tubuh" style="color:#000"></span> <span class="text-secondary"> kg/m2</span>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="tekanan_darah_hh" class="form-label">Tekanan Darah</label> <span class="text-secondary"> (mmHg)</span>
                                    <div class="input-group">
                                        <input type="number" class="form-control <?= validation_show_error('tekanan_darah_mm') ? "is-invalid" : '' ?>" id="tekanan_darah_mm" name="tekanan_darah_mm" value="<?= old('tekanan_darah_mm') ?>" placeholder="cth. 120">
                                        <span class="input-group-text">/</span>
                                        <input type="number" class="form-control <?= validation_show_error('tekanan_darah_hg') ? "is-invalid" : '' ?>" name="tekanan_darah_hg" value="<?= old('tekanan_darah_hg') ?>" placeholder="cth. 80">
                                    </div>
                                    <div class="invalid-message">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="<?= validation_show_error('tekanan_darah_mm') ? "is-invalid" : '' ?>"></div>
                                                <span class="invalid-feedback">
                                                    <?= validation_show_error('tekanan_darah_mm') ?>
                                                </span>
                                            </div>
                                            <div class="col-1"></div>
                                            <div class="col-5">
                                                <div class="<?= validation_show_error('tekanan_darah_hg') ? "is-invalid" : '' ?>"></div>
                                                <span class="invalid-feedback ms-1">
                                                    <?= validation_show_error('tekanan_darah_hg') ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="denyut_jantung" class="form-label">Denyut Jantung</label><span class="text-secondary"> (/menit)</span>
                                    <input type="number" class="form-control <?= validation_show_error('denyut_jantung') ? "is-invalid" : '' ?>" id="denyut_jantung" name="denyut_jantung" value="<?= old('denyut_jantung') ?>" placeholder="cth. 70">
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('denyut_jantung') ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="aktivitas_fisik" class="form-label">Aktivitas Fisik Mingguan</label> 
                                    <a>
                                        <span data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-circle-info"></i></span>
                                    </a>
                                    <select class="form-select <?= validation_show_error('aktivitas_fisik') ? "is-invalid" : '' ?>" id="aktivitas_fisik" name="aktivitas_fisik">
                                        <option value="">~Pilih</option>
                                        <?php
                                        $aktivitas_fisik = ['Tidak ada', 'Ringan', 'Sedang', 'Berat'];
                                        foreach ($aktivitas_fisik as $v) : 
                                            if (old('aktivitas_fisik') == $v) {
                                                $selected = 'selected';
                                            } else {
                                                $selected = '';
                                            }
                                        ?>
                                        <option value="<?= $v ?>" <?= $selected ?> ><?= $v ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('aktivitas_fisik') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <!--  -->
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Analisis</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

<script>
let tinggi_badan = document.getElementById('tinggi_badan');
let berat_badan = document.getElementById('berat_badan');
let element_indeks_massa_tubuh = document.getElementById('element_indeks_massa_tubuh');
[tinggi_badan, berat_badan].forEach(element => {
    element.addEventListener("input", () => {
        const tinggi_badan_m2 = ((tinggi_badan.value*0.01) * (tinggi_badan.value*0.01)).toFixed(2);
        const berat_badan_kg = (berat_badan.value*1).toFixed(2);
        const indeks_massa_tubuh = berat_badan_kg / tinggi_badan_m2;
        if (indeks_massa_tubuh === Infinity || isNaN(indeks_massa_tubuh)) {
            element_indeks_massa_tubuh.innerHTML = '';
        } else {
            element_indeks_massa_tubuh.innerHTML = indeks_massa_tubuh.toFixed(2);
        }
    });
});
</script>

<!-- Dselect -->
<link rel="stylesheet" href="<?= base_url('assets/css/dselect.css') ?>">
<script src="<?= base_url('assets/js/dselect.js') ?>"></script>
<script>
    dselect(document.querySelector('#aktivitas_fisik'));
</script>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Keterangan</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p>Untuk menilai Aktifitas Fisik mingguan dapat digunakan kriteria:</p>
            <ol type="a">
                <li><b>Tidak ada aktivitas</b></li>
                <li><b>Ringan:</b>
                    <ol>
                        <li>Berolah raga keringat tidak keluar / tidak berkeringat</li>
                        <li>Nafas tidak meningkat</li>
                        <li>Denyut jantung tidak meningkat</li>
                    </ol>
                </li>
                <li><b>Sedang:</b>
                    <ol>
                        <li>Berolah raga/ beraktifitas keluar keringat</li>
                        <li>Frekuensi nafas meningkat</li>
                        <li>Frekuensi denyut jantung meningkat (60-85 % berdasarkan usia). Contoh jalan kaki 6 km/jam.</li>
                    </ol>
                </li>
                <li><b>Berat:</b>
                    <ol>
                        <li>Berolah raga hingga keringat bercucuran</li>
                        <li>Nafas sangat cepat</li>
                        <li>Denyut jantung cepat (> 85 % berdasarkan umur). Contoh jogging, berlari, sepak bola, berenang.</li>
                    </ol>
                </li>
            </ol>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
        </div>
    </div>
</div>