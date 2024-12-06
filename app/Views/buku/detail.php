<!-- detail.php  -->
<?= $this->extend('/template'); ?>
<?= $this->section('content');?>

<div class="container">
    <div class="row">
        <div class="col">
            <h3>Detail Buku</h3>
            <div class="card mb-3" style="max-width: 65vw;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="/img/<?= $buku['sampul'];?>" class="img-fluid rounded-start">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $buku['judul'];?></h5>
                            <p class="card-text"><b>Pengarang: <?= $buku['pengarang'];?></b></p>
                            <p class="card-text"><b>Penerbit: <?= $buku['penerbit'];?></b></p>
                            <p class="card-text"><b>Tahun Terbit: <?= $buku['tahun_terbit'];?></b></p>
                            
                            <a href="/buku/ubah/<?= $buku['id_buku']; ?>" class="btn btn-warning">Ubah</a>
                            
                            <form action="/buku/<?= $buku['id_buku']; ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin mau hapus data ini?')">Hapus</button>
                            </form>
                            
                            <br></br>
                            <p class="card-text">
                                <small class="text-muted">
                                    <a href="/buku">Kembali</a>
                                </small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
