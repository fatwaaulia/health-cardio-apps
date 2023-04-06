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
                    <form action="<?= base_url($route.'/update/'.model('M_Env')->encode($data['id'])) ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-6">
                                        <?php
                                        $id_role_user = session()->get('user')['id_role'];
                                        if ($data['risiko'] == 'Risiko rendah') {
                                            $color_risiko = 'text-success';
                                        } elseif ($data['risiko'] == 'Risiko sedang') {
                                            $color_risiko = 'text-warning';
                                        } elseif ($data['risiko'] == 'Risiko tinggi') {
                                            $color_risiko = 'text-danger';
                                        }
                                        ?>
                                        <div class="<?= $color_risiko ?>">
                                            <a data-bs-toggle="modal" data-bs-target="#modalRisiko">
                                                <?= $data['risiko'] ?>
                                                <i class="fa-solid fa-circle-info"></i>
                                                <?= $id_role_user == 1 ? '<span class="text-secondary">(total skor: '. $data['total_skor'] .')</span>' : '' ?>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-6 text-end">
                                        <div style="color:#000"><?= date('d M Y H:i:s', strtotime($data['created_at'])) ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                            <!--  -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <hr>
                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <?php $nama_pasien = model('M_Users')->where('id',$data['id_user'])->first()['nama'] ?>
                                    <input type="text" class="form-control" value="<?= $nama_pasien ?>" disabled>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Jenis Kelamin</label> <?= $id_role_user == 1 ? '<span class="text-secondary float-end">(skor: '. $data['skor_jenis_kelamin'] .')</span>' : '' ?>
                                    <input type="text" class="form-control" value="<?= $data['jenis_kelamin'] ?>" disabled>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Usia</label><span class="text-secondary"> (tahun)</span> <?= $id_role_user == 1 ? '<span class="text-secondary float-end">(skor: '. $data['skor_usia'] .')</span>' : '' ?>
                                    <input type="number" class="form-control" value="<?= $data['usia'] ?>" disabled>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Riwayat Merokok</label> <?= $id_role_user == 1 ? '<span class="text-secondary float-end">(skor: '. $data['skor_riwayat_merokok'] .')</span>' : '' ?>
                                    <input type="text" class="form-control" value="<?= $data['riwayat_merokok'] ?>" disabled>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Riwayat Alkohol</label>
                                    <input type="text" class="form-control" value="<?= $data['riwayat_alkohol'] ?>" disabled>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Riwayat Diabetes</label> <?= $id_role_user == 1 ? '<span class="text-secondary float-end">(skor: '. $data['skor_riwayat_diabetes'] .')</span>' : '' ?>
                                    <input type="text" class="form-control" value="<?= $data['riwayat_diabetes'] ?>" disabled>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <hr>
                                <div class="mb-3">
                                    <label for="tinggi_badan" class="form-label">Tinggi Badan</label><span class="text-secondary"> (cm)</span>
                                    <input type="number" class="form-control" value="<?= $data['tinggi_badan'] ?>" disabled>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Berat Badan</label><span class="text-secondary"> (kg)</span>
                                    <input type="number" class="form-control" value="<?= $data['berat_badan'] ?>" disabled>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Hasil BMI :</label>
                                    <span style="color:#000"><?= $data['indeks_massa_tubuh'] ?></span> <span class="text-secondary"> kg/m2</span> <?= $id_role_user == 1 ? '<span class="text-secondary float-end">(skor: '. $data['skor_indeks_massa_tubuh'] .')</span>' : '' ?>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="form-label">Tekanan Darah</label> <span class="text-secondary"> (mmHg)</span> <?= $id_role_user == 1 ? '<span class="text-secondary float-end">(skor: '. $data['skor_tekanan_darah'] .')</span>' : '' ?>
                                    <input type="text" class="form-control" value="<?= $data['tekanan_darah'] ?>" disabled>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Denyut Jantung</label><span class="text-secondary"> (/menit)</span>
                                    <input type="number" class="form-control" value="<?= $data['denyut_jantung'] ?>" disabled>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Aktivitas Fisik Mingguan</label> <?= $id_role_user == 1 ? '<span class="text-secondary float-end">(skor: '. $data['skor_aktivitas_fisik'] .')</span>' : '' ?>
                                    <a>
                                        <span data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-circle-info"></i></span>
                                    </a>
                                    <select class="form-select" disabled>
                                        <option><?= $data['aktivitas_fisik'] ?></option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('aktivitas_fisik') ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Catatan</label>
                                    <textarea class="form-control <?= validation_show_error('deskripsi') ? 'is-invalid' : '' ?>" id="deskripsi" name="deskripsi" rows="3" placeholder="Tulis catatan"><?= old('deskripsi')??$data['deskripsi'] ?></textarea>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('deskripsi') ?>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3 me-2">Simpan Catatan</button>
                                <a href="<?= $route ?>">
                                    <button type="button" class="btn btn-secondary mt-3">Kembali</button>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

<!-- Modal risiko -->
<div class="modal fade" id="modalRisiko" tabindex="-1" aria-labelledby="modalRisikoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalRisikoLabel">Keterangan</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <?php
        if ($data['risiko'] == 'Risiko rendah') {
            $detail_risiko = 'Risiko rendah (risiko kardiovaskuler < 10%)';
        } elseif ($data['risiko'] == 'Risiko sedang') {
            $detail_risiko = 'Risiko sedang (risiko kardiovaskuler 10-20%)';
        } elseif ($data['risiko'] == 'Risiko tinggi') {
            $detail_risiko = 'Risiko tinggi (risiko kardiovaskuler > 20%)';
        }
        ?>
        <p><?= $detail_risiko ?></p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
        </div>
    </div>
</div>

<!-- Modal aktivitas fisik -->
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