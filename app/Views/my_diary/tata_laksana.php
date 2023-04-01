<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h5 class="my-4 fw-500"><?= isset($title) ? $title : '' ?></h5>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
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
                </div>
            </div>
        </div>
    </div>
</section>