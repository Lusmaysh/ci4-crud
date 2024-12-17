<!-- index.php -->
<?= $this->extend('/template'); ?>
<?= $this->section('content');?>

<div class="container">
    <div class="row">
        <div class="col">
            <h3 class="text-center">Daftar Buku Bacaan</h3>
            <hr>
            <a href="/buku/tambah" class="btn btn-primary">Tambah Buku</a>
            
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success mt-3" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>

            <table class="table mt-3">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Sampul</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($buku as $b) :
                    ?>
                    <tr>
                        <th scope="row"><?= $i++ ?></th>
                        <td><img src="/img/<?= $b['sampul'];?>" alt="" width="75"></td>
                        <td><?= $b['judul'];?></td>
                        <td><a href="/buku/<?= $b['id_buku'];?>" class="btn btn-success">Detail</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
