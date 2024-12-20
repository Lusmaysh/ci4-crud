<?= $this->extend('template'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h3 class="text-center">Daftar Anggota</h3>
            <hr>
            <table class="table mt-2">
                <thead>
                    <tr> 
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">alamat</th>
                        <th scope="col">Nomor Telpon</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- <p><?= $currentPage?></p> -->
                    <?php 
                    $i = 1 + ($dataShow * ($currentPage - 1));
                    foreach ($anggota as $a):
                        ?>
                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <td><b><?= $a['nama']; ?></b></td> 
                                <td><b><?= $a['alamat']; ?></b></td> 
                                <td><b><?= $a['hp']; ?></b></td>  
                                <td><a href="#" class="btn btn-primary">Edit</a></td>
                                <td><a href="#" class="btn btn-primary">Hapus</a></td>
                            </tr>
                        <?php endforeach; ?>
                </tbody>
            </table>
            <?= $pager->links('anggota','anggota_pagination') ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>      