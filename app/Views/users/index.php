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
                <table class="table-default table-striped display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Role</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Username</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $key => $v) : ?>
                        <tr>
                            <td><?= $key+1 ?></td>
                            <td>
                                <?php
                                    $role = model('M_Role')->where('id', $v['id_role'])->first();
                                    echo $role['nama'];
                                ?>
                            </td>
                            <td>
                                <?php
                                if ($v['img']) {
                                    $img = base_url('assets/img/'.$name.'/'.$v['img']);
                                } else {
                                    $img = base_url('assets/img/user-default.png');
                                }
                                ?>
                                <img src="<?= $img ?>" class="wh-40 img-style rounded-circle" loading="lazy">
                            </td>
                            <td><?= $v['nama'] ?></td>
                            <td><?= $v['jenis_kelamin'] ?></td>
                            <td><?= $v['username'] ?></td>
                            <td>
                                <?php if ($v['id_role'] != 1) : ?>
                                <a href="<?= $route.'/edit/'.model('M_Env')->encode($v['id']) ?>">
                                    <i class="fa-regular fa-pen-to-square fa-lg me-2"></i>
                                </a>
                                <a data-bs-toggle="modal" data-bs-target="#hapus_data<?= model('M_Env')->encode($v['id']) ?>">
                                    <i class="fa-regular fa-trash-can fa-lg text-danger"></i>
                                </a>
                                <!-- Modal -->
                                <div class="modal fade" id="hapus_data<?= model('M_Env')->encode($v['id']) ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Hapus Pengguna</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <table>
                                                    <tr>
                                                        <td class="fw-500">Nama</td>
                                                        <td class="fw-500"> : &nbsp;</td>
                                                        <td> <?= $v['nama'] ?> </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Username</td>
                                                        <td> : &nbsp;</td>
                                                        <td> <?= $v['username'] ?> </td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <form action="<?= $route.'/delete/'.model('M_Env')->encode($v['id']) ?>" method="post">
                                                    <?= csrf_field(); ?>
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</section>
