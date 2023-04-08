<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h5 class="my-4 fw-500"><?= isset($title) ? $title : '' ?></h5>
        </div>
    </div>
    <?php
    $screening = model('M_Screening')->where('id_user', session()->get('user')['id'])->orderBy('id','DESC')->first();
    if ($screening['risiko'] == 'Risiko rendah') {
    $backcolor_risiko = '#d4edda';
    $color_risiko = 'text-success';
    } elseif ($screening['risiko'] == 'Risiko sedang') {
    $color_risiko = 'text-warning';
    $backcolor_risiko = '#fef0db';
    } elseif ($screening['risiko'] == 'Risiko tinggi') {
    $color_risiko = 'text-danger';
    $backcolor_risiko = '#ffb2b2';
    }
    ?>
    <div class="row">
        <div class="col-xxl-3 col-lg-4 col-md-6">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="<?= $color_risiko ?>">
                            <span class="fw-semibold d-block"><?= $screening['risiko'] ?></span>
                            <span class="mt-2"> <?= date('d M Y', strtotime($screening['created_at'])) ?> </span>
                        </div>
                        <div class="">
                            <div class="rounded-circle" style="background-color:<?= $backcolor_risiko ?>;padding:15px 17px 13px 17px">
                                <i class="fa-solid fa-square-poll-vertical <?= $color_risiko ?>" style="font-size:25px"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>