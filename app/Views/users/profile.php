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
                    <form action="<?= base_url($route.'/update') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <div class="wh-150 position-relative">
                                    <?php
                                    if ($data['img']) {
                                        $img = base_url('assets/img/'.$name.'/'.$data['img']);
                                    } else {
                                        $img = base_url('assets/img/user-default.png');
                                    }
                                    ?>
                                        <img src="<?= $img ?>" class="w-100 h-100 img-style rounded-circle <?= validation_show_error('img') ? 'border border-danger' : '' ?>" id="frame">
                                        <div class="position-absolute" style="bottom:0px;right:0px">
                                            <button class="btn btn-secondary rounded-circle" style="padding:8px 10px" type="button" data-bs-toggle="modal" data-bs-target="#option">
                                                <i class="fa-solid fa-pen fa-lg"></i>
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="option" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <div data-bs-dismiss="modal">
                                                                <input type="file" class="form-control" name="img" accept="image/*" onchange="preview()">
                                                            </div>
                                                            <?php if ($data['img']) : ?>
                                                            <div class="mt-3">
                                                                <a href="#" class="text-secondary" data-bs-toggle="modal" data-bs-target="#deleteImage">
                                                                    <i class="fa-solid fa-trash-can fa-lg"></i>
                                                                    Hapus
                                                                </a>
                                                            </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="<?= validation_show_error('img') ? "is-invalid" : '' ?>">
                                    </span>
                                    <div class="invalid-feedback">
                                        <?= str_replace('img,', 'gambar ', validation_show_error('img')) ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control <?= validation_show_error('nama') ? "is-invalid" : '' ?>" id="nama" name="nama" value="<?= old('nama')??$data['nama'] ?>" placeholder="Masukkan nama Anda">
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('nama') ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                    <select class="form-select <?= validation_show_error('jenis_kelamin') ? "is-invalid" : '' ?>" id="jenis_kelamin" name="jenis_kelamin">
                                        <option value="">~Pilih</option>
                                        <?php
                                        $jenis_kelamin = ['Laki-laki', 'Perempuan'];
                                        foreach ($jenis_kelamin as $v) : 
                                            if (old('jenis_kelamin')) {
                                                if (old('jenis_kelamin') == $v) {
                                                    $selected = 'selected';
                                                } else {
                                                    $selected = '';
                                                }
                                            } else {
                                                if ($data['jenis_kelamin'] == $v) {
                                                    $selected = 'selected';
                                                } else {
                                                    $selected = '';
                                                }
                                            }
                                        ?>
                                        <option value="<?= $v ?>" <?= $selected ?> ><?= $v ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('jenis_kelamin') ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="usia" class="form-label">Usia</label>
                                    <input type="number" class="form-control <?= validation_show_error('usia') ? "is-invalid" : '' ?>" id="usia" name="usia" value="<?= old('usia')??$data['usia'] ?>" placeholder="Masukkan usia Anda">
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('usia') ?>
                                    </div>
                                </div>
                            </div>
                            <?php if($data['id_role'] == 3) : ?>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="riwayat_diabetes" class="form-label">Riwayat Diabetes Mellitus</label>
                                    <select class="form-select <?= validation_show_error('riwayat_diabetes') ? "is-invalid" : '' ?>" id="riwayat_diabetes" name="riwayat_diabetes">
                                        <option value="">~Pilih</option>
                                        <?php
                                        $riwayat_diabetes = ['Ya', 'Tidak'];
                                        foreach ($riwayat_diabetes as $v) : 
                                            if (old('riwayat_diabetes')) {
                                                if (old('riwayat_diabetes') == $v) {
                                                    $selected = 'selected';
                                                } else {
                                                    $selected = '';
                                                }
                                            } else {
                                                if ($data['riwayat_diabetes'] == $v) {
                                                    $selected = 'selected';
                                                } else {
                                                    $selected = '';
                                                }
                                            }
                                        ?>
                                        <option value="<?= $v ?>" <?= $selected ?> ><?= $v ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('riwayat_diabetes') ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="riwayat_diabetes" class="form-label">Riwayat Konsumsi Alkohol</label>
                                    <select class="form-select <?= validation_show_error('riwayat_alkohol') ? "is-invalid" : '' ?>" id="riwayat_alkohol" name="riwayat_alkohol">
                                        <option value="">~Pilih</option>
                                        <?php
                                        $riwayat_alkohol = ['Ya', 'Tidak'];
                                        foreach ($riwayat_alkohol as $v) : 
                                            if (old('riwayat_alkohol')) {
                                                if (old('riwayat_alkohol') == $v) {
                                                    $selected = 'selected';
                                                } else {
                                                    $selected = '';
                                                }
                                            } else {
                                                if ($data['riwayat_alkohol'] == $v) {
                                                    $selected = 'selected';
                                                } else {
                                                    $selected = '';
                                                }
                                            }
                                        ?>
                                        <option value="<?= $v ?>" <?= $selected ?> ><?= $v ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('riwayat_alkohol') ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="riwayat_merokok" class="form-label">Riwayat Merokok</label>
                                    <select class="form-select <?= validation_show_error('riwayat_merokok') ? "is-invalid" : '' ?>" id="riwayat_merokok" name="riwayat_merokok">
                                        <option value="">~Pilih</option>
                                        <?php
                                        $riwayat_merokok = ['Tidak pernah', 'Mantan perokok', 'Perokok'];
                                        foreach ($riwayat_merokok as $v) : 
                                            if (old('riwayat_merokok')) {
                                                if (old('riwayat_merokok') == $v) {
                                                    $selected = 'selected';
                                                } else {
                                                    $selected = '';
                                                }
                                            } else {
                                                if ($data['riwayat_merokok'] == $v) {
                                                    $selected = 'selected';
                                                } else {
                                                    $selected = '';
                                                }
                                            }
                                        ?>
                                        <option value="<?= $v ?>" <?= $selected ?> ><?= $v ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('riwayat_merokok') ?>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

<!-- Modal hapus foto profil -->
<div class="modal fade" id="deleteImage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Hapus foto profil?</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <form action="<?= base_url('profile/delete/image') ?>" method="post">
                <?= csrf_field(); ?>
                <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
        </div>
        </div>
    </div>
</div>

<!-- Modal ubah password -->
<div class="modal fade" id="ubah_password" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url().'/profile/update/password' ?>" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                        <div class="mb-3">
                            <label for="oldpass" class="form-label">Password Saat Ini</label>
                            <div class="position-relative">
                                <input onkeyup="changeOldPass()" type="password" class="form-control" name="oldpass" value="<?= old('oldpass') ?>" id="oldpass" placeholder="Password saat ini">
                                <img src="<?= base_url('assets/img/show.png') ?>" class="position-absolute" id="eye_oldpass" style="width:20px;right:12px;top:8px;">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password Baru</label>
                            <div class="mb-2 position-relative">
                                <input onkeyup="changePassword()" type="password" class="form-control" name="password" value="<?= old('password') ?>" id="password" placeholder="Password baru">
                                <div class="invalid-feedback">
                                    <span id="msg_password"></span>
                                </div>
                                <img src="<?= base_url('assets/img/show.png') ?>" class="position-absolute" id="eye_password" style="width:20px;right:12px;top:8px;">
                            </div>
                            <div class="position-relative">
                                <input onkeyup="changePassconf()" type="password" class="form-control" name="passconf" value="<?= old('passconf') ?>" id="passconf" placeholder="Confirm password">
                                <div class="invalid-feedback">
                                    <span id="msg_passconf"></span>
                                </div>
                                <img src="<?= base_url('assets/img/show.png') ?>" class="position-absolute" id="eye_passconf" style="width:20px;right:12px;top:8px;">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="simpan_password" disabled>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?= base_url().'/assets/js/dselect.js' ?>"></script>    
<script>
dselect(document.querySelector('#jenis_kelamin'));
dselect(document.querySelector('#riwayat_diabetes'));
dselect(document.querySelector('#riwayat_alkohol'));
dselect(document.querySelector('#riwayat_merokok'));
</script>