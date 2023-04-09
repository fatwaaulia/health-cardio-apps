<section>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h5 class="my-4"><?= isset($title) ? $title : '' ?></h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card p-3">
                <table class="table-default table-striped display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tanggal Pemeriksaan</th>
                            <?php if (session()->get('user')['id_role'] == 1) : ?>
                            <th>Nama Pasien</th>
                            <?php endif; ?>
                            <th>Risiko</th>
                            <th>Jenis Kelamin</th>
                            <th>Usia</th>
                            <th>Tinggi Badan</th>
                            <th>Berat Badan</th>
                            <th>Index Massa Tubuh</th>
                            <th>Tekanan Darah</th>
                            <th>Denyut Jantung</th>
                            <th>Riwayat Merokok</th>
                            <th>Riwayat Alkohol</th>
                            <th>Riwayat Diabetes</th>
                            <th>Aktifitas Fisik</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $key => $v) : ?>
                        <tr>
                            <td><?= $key+1 ?></td>
                            <td><?= date('d M Y H:i:s', strtotime($v['created_at'])) ?></td>
                            <?php if (session()->get('user')['id_role'] == 1) : ?>
                            <td>
                                <?php
                                $pasien = model('M_Users')->where('id', $v['id_user'])->first();
                                echo $pasien['nama'];
                                ?>
                            </td>
                            <?php endif; ?>
                            <td>
                            <?php
                            $id_user_session = session()->get('user')['id_role'];
                            if ($v['risiko'] == 'Risiko rendah') {
                                $color_risiko = 'text-success';
                            } elseif ($v['risiko'] == 'Risiko sedang') {
                                $color_risiko = 'text-warning';
                            } elseif ($v['risiko'] == 'Risiko tinggi') {
                                $color_risiko = 'text-danger';
                            }
                            ?>
                                <a href="<?= $route.'/edit/'.model('M_Env')->encode($v['id']) ?>">
                                    <div class="<?= $color_risiko ?>">
                                        <?= $v['risiko'] ?> <i class="fa-solid fa-circle-info"></i>
                                    </div>  
                                </a>
                            </td>
                            <td><?= $v['jenis_kelamin'] ?></td>
                            <td><?= $v['usia'] ?></td>
                            <td><?= $v['tinggi_badan'] ?></td>
                            <td><?= $v['berat_badan'] ?></td>
                            <td><?= $v['indeks_massa_tubuh'] ?></td>
                            <td><?= $v['tekanan_darah'] ?></td>
                            <td><?= $v['denyut_jantung'] ?></td>
                            <td><?= $v['riwayat_merokok'] ?></td>
                            <td><?= $v['riwayat_alkohol'] ?></td>
                            <td><?= $v['riwayat_diabetes'] ?></td>
                            <td><?= $v['aktivitas_fisik'] ?></td>
                            <td>
                                <a href="<?= $route.'/edit/'.model('M_Env')->encode($v['id']) ?>">
                                    <i class="fa-regular fa-pen-to-square fa-lg me-2"></i>
                                </a>
                                <a data-bs-toggle="modal" data-bs-target="#hapus_data<?= model('M_Env')->encode($v['id']) ?>">
                                    <i class="fa-regular fa-trash-can fa-lg text-danger"></i>
                                </a>
                                <!-- Modal -->
                                <div class="modal fade" id="hapus_data<?= model('M_Env')->encode($v['id']) ?>" tabindex="-1" aria-labelledby="hapusDataLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="hapusDataLabel">Hapus <?= str_replace('Data ','',$title) ?></h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <table>
                                                    <tr>
                                                        <td class="fw-500">Tanggal Pemeriksaan</td>
                                                        <td class="fw-500"> :&nbsp;</td>
                                                        <td> <?= date('d M Y H:i:s', strtotime($v['created_at'])) ?> </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-500">Nama</td>
                                                        <td class="fw-500"> :&nbsp;</td>
                                                        <td> <?= model('M_Users')->where('id',$v['id_user'])->first()['nama'] ?> </td>
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