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
                    <button class="btn mt-3" style="background-color:#ffc3ae">
                        <div class="row">
                            <div class="col-2">
                                <img src="<?= base_url('assets/img/heart.png') ?>" class="wh-50">
                            </div>
                            <div class="col-10 my-auto">
                                <label class="fw-600 float-start">Edukasi Penyakit</label>
                            </div>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>