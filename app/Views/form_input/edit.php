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
                                <div class="mb-3">
                                    <div class="w-lg-50 position-relative">
                                    <?php
                                    if ($data['img']) {
                                        $img = base_url('assets/img/'.$name.'/'.$data['img']);
                                    } else {
                                        $img = base_url('assets/img/default.png');
                                    }
                                    ?>
                                        <img src="<?= $img ?>" class="w-100 h-100 img-style <?= validation_show_error('img') ? 'border border-danger' : '' ?>" id="frame">
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
                                    </div>
                                    <span class="<?= validation_show_error('img') ? 'is-invalid' : '' ?>">
                                    </span>
                                    <div class="invalid-feedback">
                                        <?= str_replace('img,', 'gambar ', validation_show_error('img')) ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control <?= validation_show_error('nama') ? 'is-invalid' : '' ?>" id="nama" name="nama" value="<?= old('nama')??$data['nama'] ?>" placeholder="Masukkan nama">
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('nama') ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea class="form-control <?= validation_show_error('deskripsi') ? 'is-invalid' : '' ?>" id="deskripsi" name="deskripsi" rows="3" placeholder="Masukkan deskripsi"><?= old('deskripsi')??$data['deskripsi'] ?></textarea>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('deskripsi') ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="konten" class="form-label">Konten</label>
                                    <textarea type="text" class="form-control summernote <?= validation_show_error('konten') ? 'is-invalid' : '' ?>" name="konten" id="konten" rows="10"><?= old('konten')??$data['konten'] ?></textarea>
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
                                            if (old('select')) {
                                                if (old('select') == $v) {
                                                    $selected = 'selected';
                                                } else {
                                                    $selected = '';
                                                }
                                            } else {
                                                if ($data['select'] == $v) {
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
                                        <?= validation_show_error('select') ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="select_search" class="form-label">Select Search</label>
                                    <select class="form-select <?= validation_show_error('select_search') ? 'is-invalid' : '' ?>" id="select_search" name="select_search" data-dselect-clearable="true">
                                        <option value="">~Pilih</option>
                                        <?php
                                        $select_search = ['Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan', 'Sepuluh'];
                                        foreach ($select_search as $v) : 
                                            if (old('select_search')) {
                                                if (old('select_search') == $v) {
                                                    $selected = 'selected';
                                                } else {
                                                    $selected = '';
                                                }
                                            } else {
                                                if ($data['select_search'] == $v) {
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
                                        <?= validation_show_error('select_search') ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="select_multiple" class="form-label">Select Multiple</label>
                                    <select class="form-select <?= validation_show_error('select_multiple') ? 'is-invalid' : '' ?>" id="select_multiple" name="select_multiple[]" multiple>
                                        <option value="">~Pilih</option>
                                        <?php
                                        $json = (array)json_decode($data['select_multiple'], true);
                                        $multiple = ['Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan', 'Sepuluh'];
                                        foreach ($multiple as $v) : 
                                            $selected = '';
                                            if (old('select_multiple')) {
                                                if (in_array($v, old('select_multiple'))) {
                                                    $selected = 'selected';
                                                }
                                            } else {
                                                if (!validation_show_error('select_multiple')) {
                                                    if (in_array($v, $json)) {
                                                        $selected = 'selected';
                                                    }
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
                                    $json_checkbox = (array)json_decode($data['checkbox'], true);
                                    $checkbox = ['checkbox 1', 'checkbox 2', 'checkbox 3'];
                                    foreach($checkbox as $v) : 
                                        $checked = '';
                                        if (old('checkbox')) {
                                            if (in_array($v, old('checkbox'))) {
                                                $checked = 'checked';
                                            }
                                        } else {
                                            if (!validation_show_error('checkbox')) {
                                                if (in_array($v, $json_checkbox)) {
                                                    $checked = 'checked';
                                                }
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
                                        if (old('radio')) {
                                            if (old('radio') == $v) {
                                                $checked = 'checked';
                                            } else {
                                                $checked = '';
                                            }
                                        } else {
                                            if ($data['radio'] == $v) {
                                                $checked = 'checked';
                                            } else {
                                                $checked = '';
                                            }
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
                        <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

<!-- Modal hapus gambar -->
<div class="modal fade" id="deleteImage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Hapus gambar?</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <form action="<?= base_url($route.'/delete-image/'.model('M_Env')->encode($data['id'])) ?>" method="post">
                <?= csrf_field(); ?>
                <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
        </div>
        </div>
    </div>
</div>

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