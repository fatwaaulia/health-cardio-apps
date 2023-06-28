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
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" value="<?= $data['username'] ?>" id="username" disabled>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#ubah_password">
                                    <i class="fa-solid fa-lock me-2"></i>
                                    <span class="align-middle">Ubah Password</span>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <!--  -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>


<!-- Modal ubah password -->
<div class="modal fade" id="ubah_password" tabindex="-1" aria-labelledby="ubahPasswordLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ubahPasswordLabel">Ubah Password</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('settings/update/password') ?>" method="post">
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


<script>
let eye_oldpass = document.getElementById('eye_oldpass');
eye_oldpass.onclick = () => {
    let input_oldpass = document.getElementById('oldpass');
	if (input_oldpass.getAttribute('type') == 'password') {
		input_oldpass.type = 'text';
		eye_oldpass.src = "<?= base_url('assets/img/hide.png') ?>"
	} else {
		input_oldpass.type ='password';
		eye_oldpass.src = "<?= base_url('assets/img/show.png') ?>"
	}
};
let eye_password = document.getElementById('eye_password');
eye_password.onclick = () => {
    let input_password = document.getElementById('password');
	if (input_password.getAttribute('type') == 'password') {
		input_password.type = 'text';
		eye_password.src = "<?= base_url('assets/img/hide.png') ?>"
	} else {
		input_password.type ='password';
		eye_password.src = "<?= base_url('assets/img/show.png') ?>"
	}
};
let eye_passconf = document.getElementById('eye_passconf');
eye_passconf.onclick = () => {
    let input_passconf = document.getElementById('passconf');
	if (input_passconf.getAttribute('type') == 'password') {
		input_passconf.type = 'text';
		eye_passconf.src = "<?= base_url('assets/img/hide.png') ?>"
	} else {
		input_passconf.type ='password';
		eye_passconf.src = "<?= base_url('assets/img/show.png') ?>"
	}
};

// VALIDASI PASSWORD BARU
function changeOldPass() {
    let str_oldpass = $('#oldpass').val();
    let str_password = $('#password').val();
    let str_passconf = $('#passconf').val();
    if (str_oldpass) {
        if (str_password.length >= 8 && str_passconf.length >= 8) {
            if (str_passconf == str_password) {
                $('#simpan_password').prop( "disabled", false);
            }
        }
    } else {
        $('#simpan_password').prop( "disabled", true);
    }
}
function changePassword() {
    let str_oldpass = $('#oldpass').val();
    let str_password = $('#password').val();
    let str_passconf = $('#passconf').val();
    if (str_password.length < 8) {
        // kurang dari 8 karakter
        $('#password').addClass('is-invalid');
        $('#msg_password').html('minimal 8 karakter');
        $('#simpan_password').prop( "disabled", true);
    } else if (str_passconf != str_password) {
        // password dan passconf tidak sama
        $('#password').removeClass('is-invalid');
        $('#passconf').addClass('is-invalid');
        $('#msg_passconf').html('password tidak sama');
        $('#simpan_password').prop( "disabled", true);
    } else if (str_passconf == str_password) {
        // true
        $('#password').removeClass('is-invalid');
        $('#msg_password').html('');
        $('#passconf').removeClass('is-invalid');
        $('#msg_passconf').html('');
        if (str_oldpass) {
            $('#simpan_password').prop( "disabled", false);
        } else {
            $('#simpan_password').prop( "disabled", true);
        }
    }
}
function changePassconf() {
    let str_oldpass = $('#oldpass').val();
    let str_password = $('#password').val();
    let str_passconf = $('#passconf').val();
    if (str_passconf.length < 8) {
        // kurang dari 8 karakter
        $('#passconf').addClass('is-invalid');
        $('#msg_passconf').html('minimal 8 karakter');
        $('#simpan_password').prop( "disabled", true);
    } else if (str_passconf != str_password) {
        // password dan passconf tidak sama
        $('#passconf').addClass('is-invalid');
        $('#msg_passconf').html('password tidak sama');
        $('#simpan_password').prop( "disabled", true);
    } else if (str_passconf == str_password) {
        // true
        $('#password').removeClass('is-invalid');
        $('#msg_password').html('');
        $('#passconf').removeClass('is-invalid');
        $('#msg_passconf').html('');
        if (str_oldpass) {
            $('#simpan_password').prop( "disabled", false);
        } else {
            $('#simpan_password').prop( "disabled", true);
        }
    }
}
</script>
