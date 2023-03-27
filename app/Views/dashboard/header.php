<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="description" content="">
    <link rel="shortcut icon" href="<?= base_url() . '/favicon.png' ?>" type="image/x-icon">

    <title><?= isset($title) ? $title .' | '. model('M_Env')->webName() : model('M_Env')->webName() ?></title>

    <!-- BOOTSTRAP 5 CSS -->
    <link rel="stylesheet" href="<?= base_url().'/assets/css/bootstrap.min.css' ?>">

    <!-- ADMINKIT CSS -->
    <link rel="stylesheet" href="<?= base_url().'/assets/adminkit/' ?>css/app.css">

    <!-- MY STYLE -->
    <link rel="stylesheet" href="<?=base_url().'/assets/css/'?>style.css">
    <link rel="stylesheet" href="<?=base_url().'/assets/css/'?>dashboard.css">

    <!-- JQUERY -->
    <script src="<?= base_url().'/assets/js/jquery.min.js' ?>"></script>

    <!-- DATATABLES -->
    <link rel="stylesheet" href="<?= base_url().'/assets/datatables/css/jquery.dataTables.min.css' ?>">
    <link rel="stylesheet" href="<?= base_url().'/assets/datatables/css/dataTables.dateTime.min.css' ?>">
    <link rel="stylesheet" href="<?= base_url().'/assets/datatables/css/buttons.dataTables.min.css' ?>">

    <!-- SWEETALERT 2 -->
    <script src="<?=base_url().'/assets/js/sweetalert2.js' ?>"></script>

    <!-- DSELECT -->
    <link rel="stylesheet" href="<?= base_url().'/assets/css/dselect.css' ?>">
</head>

<body>
    <!-- loader -->
    <div class="loader-bg position-absolute top-50 start-50 translate-middle">
        <div class="loader-p"></div>
    </div>
    <script>
    setTimeout(() => {
        $('.loader-bg').fadeToggle();
    });
    </script>
    <!-- Akhir Loader -->

    <!-- Pesan -->
    <?= session()->getFlashdata('message') ?>
    <?php if(session()->getFlashdata('error')) : ?>
        <script>
            Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: '<?= session()->getFlashdata('error') ?>',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            })
        </script>
    <?php endif; ?>
    <!-- Akhir Pesan -->

    <!-- Sidebar -->
    <?= $sidebar ?? '' ?>
        <main class="content">
            <div class="container-fluid p-0">
                <?= $content ?? view('errors/e404') ?>
            </div>
        </main>
    <?php 
    if(isset($sidebar)) :
        echo '</div>
        </div>';
    endif;
     ?>
    <!-- Akhir Sidebar -->

    <!-- ADMINKIT JS -->
    <script src="<?= base_url().'/assets/adminkit/' ?>js/app.js"></script>

    <!-- BOOTSTRAP 5 JS -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script> -->

    <!-- MY SCRIPT -->
    <script src="<?=base_url().'/assets/js/script.js' ?>"></script>
    
    <!-- DATATABLES -->
    <script src="<?= base_url().'/assets/datatables/js/jquery.dataTables.min.js' ?>"></script>
    <script src="<?= base_url().'/assets/datatables/js/dataTables.buttons.min.js' ?>"></script>
    <script src="<?= base_url().'/assets/datatables/js/jszip.min.js' ?>"></script>
    <script src="<?= base_url().'/assets/datatables/js/buttons.html5.min.js' ?>"></script>
    <script src="<?= base_url().'/assets/datatables/js/buttons.colVis.min.js' ?>"></script>
    <script>
    $(document).ready(function() {
        $('.table-default').DataTable({
            "scrollX": true,
            "columnDefs": [{
                    "searchable": false,
                    "targets": [0],
                }
            ],
        });
        $('.table-excel').DataTable({
            "scrollX": true,
            "columnDefs": [{
                    "searchable": false,
                    "targets": [0],
                }
            ],
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                'colvis',
            ],
        });
    });
    </script>

    <!-- DSELECT -->
    <script src="<?= base_url().'/assets/js/dselect.js' ?>"></script>
    <script>
    dselect(document.querySelector('#select'));
    dselect(document.querySelector('#select_multiple'));
    dselect(document.querySelector('#select_search'), {
        search: true,
    });
    </script>
</body>
</html>
