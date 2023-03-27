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
                                    <div class="w-lg-50 position-relative">
                                        <img src="<?= base_url('assets/img/default.png') ?>" class="w-100 h-100 img-style <?= validation_show_error('img') ? 'border border-danger' : '' ?>" id="frame">
                                        <div class="position-absolute" style="bottom:0px;right:0px">
                                            <button class="btn btn-secondary rounded-circle" style="padding:10px" type="button" data-bs-toggle="modal" data-bs-target="#option">
                                                <i class="fa-solid fa-camera fa-xl"></i>
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="option" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <div data-bs-dismiss="modal">
                                                                <input type="file" class="form-control" name="img" accept="image/*" onchange="preview()">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="<?= validation_show_error('img') ? 'is-invalid' : '' ?>">
                                    </span>
                                    <div class="invalid-feedback">
                                        <?= str_replace('img,', 'gambar ', validation_show_error('img')) ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control <?= validation_show_error('nama') ? 'is-invalid' : '' ?>" id="nama" name="nama" value="<?= old('nama') ?>" placeholder="Masukkan nama">
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('nama') ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea class="form-control <?= validation_show_error('deskripsi') ? 'is-invalid' : '' ?>" id="deskripsi" name="deskripsi" rows="3" placeholder="Masukkan deskripsi"><?= old('deskripsi') ?></textarea>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('deskripsi') ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="konten" class="form-label">Konten</label>
                                    <textarea type="text" class="form-control summernote <?= validation_show_error('konten') ? 'is-invalid' : '' ?>" name="konten" id="konten" rows="10"><?= old('konten') ?></textarea>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('konten') ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="select" class="form-label">Select</label>
                                    <select class="form-select <?= validation_show_error('select') ? 'is-invalid' : '' ?>" id="select" name="select" data-dselect-clearable="true">
                                        <option value="">~Pilih</option>
                                        <?php
                                        $select = ['Laki-laki', 'Perempuan'];
                                        foreach ($select as $v) : 
                                            if (old('select') == $v) {
                                                $selected = 'selected';
                                            } else {
                                                $selected = '';
                                            }
                                        ?>
                                        <option value="<?= $v ?>" <?= $selected ?> ><?= $v ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('select') ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="select_search" class="form-label">Select Search</label>
                                    <select class="form-select <?= validation_show_error('select_search') ? 'is-invalid' : '' ?>" id="select_search" name="select_search" data-dselect-clearable="true">
                                        <option value="">~Pilih</option>
                                        <?php
                                        $search = ['Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan', 'Sepuluh'];
                                        foreach ($search as $v) :
                                            if (old('select_search') == $v) {
                                                $selected = 'selected';
                                            } else {
                                                $selected = '';
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
                                    <label for="select_multiple" class="form-label">Select Multiple</label>
                                    <select class="form-select <?= validation_show_error('select_multiple') ? 'is-invalid' : '' ?>" id="select_multiple" name="select_multiple[]" multiple>
                                        <option value="">~Pilih</option>
                                        <?php
                                        $multiple = ['Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan', 'Sepuluh'];
                                        foreach ($multiple as $v) :
                                            $selected = '';
                                            if (old('select_multiple')) {
                                                if (in_array($v, old('select_multiple'))) {
                                                    $selected = 'selected';
                                                }
                                            }
                                        ?>
                                        <option value="<?= $v ?>" <?= $selected ?> ><?= $v ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('select_multiple') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="checkbox" class="form-label">Checkbox</label>
                                    <?php 
                                    $checkbox = ['checkbox 1', 'checkbox 2', 'checkbox 3'];
                                    foreach($checkbox as $v) :
                                        $checked = '';
                                        if (old('checkbox')) {
                                            if (in_array($v, old('checkbox'))) {
                                                $checked = 'checked';
                                            }
                                        } 
                                    ?>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="<?= $v ?>" name="checkbox[]" value="<?= $v ?>" <?= $checked ?>>
                                        <label class="form-check-label" for="<?= $v ?>">
                                            <?= $v ?>
                                        </label>
                                    </div>
                                    <?php endforeach; ?>
                                    <div class="<?= validation_show_error('checkbox') ? 'is-invalid' : '' ?>"></div>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('checkbox') ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="radio" class="form-label">Radio</label>
                                    <?php 
                                    $radio = ['radio 1', 'radio 2', 'radio 3'];
                                    foreach($radio as $v) :
                                        if (old('radio') == $v) {
                                            $checked = 'checked';
                                        } else {
                                            $checked = '';
                                        }
                                    ?>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="<?= $v ?>" name="radio" value="<?= $v ?>" <?= $checked ?>>
                                        <label class="form-check-label" for="<?= $v ?>">
                                            <?= $v ?>
                                        </label>
                                    </div>
                                    <?php endforeach; ?>
                                    <div class="<?= validation_show_error('radio') ? 'is-invalid' : '' ?>"></div>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('radio') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Tambahkan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

<!-- include summernote css/js -->
<link href="<?= base_url() . '/assets/summernote/summernote-lite.min.css' ?>" rel="stylesheet">
<script src="<?= base_url() . '/assets/summernote/summernote-lite.min.js' ?>"></script>
<script src="<?= base_url() . '/assets/summernote/lang/summernote-id-ID.js' ?>"></script>
<style>
.note-modal-footer {
    height: 45px;
    padding: 0px 30px;
}
</style>
<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            placeholder: '',
            lang: 'id-ID', // default: 'en-US'
            tabsize: 2,
            height: 300,
            toolbar: [
                ['font', ['bold', 'underline']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link']],
            ]
        });
    });
</script>