<!-- ubah.php -->
<?= $this->extend('/template'); ?>
<?= $this->section('content');?>

<div class="container">
    <div class="col">
        <h3 class="text-center">Form Ubah Data Buku</h3>
        <hr>
        
        <form action="/buku/update/<?= $buku['id_buku']; ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="row mb-3">
                <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control <?= isset($validation['judul']) ? 'is-invalid' : '' ?>" id="judul" name="judul" autofocus value="<?= old('judul') ?? $buku['judul'];?>">
                    <?php if (isset($validation['judul'])) : ?>
                        <div id="judulFeedback" class="invalid-feedback">
                            <?= $validation['judul'] ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>  
            <div class="row mb-3">
                <label for="pengarang" class="col-sm-2 col-form-label">Pengarang</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control <?= isset($validation['pengarang']) ? 'is-invalid' : '' ?>" id="pengarang" name="pengarang" value="<?= old('pengarang') ?? $buku['pengarang'];?>">
                    <?php if (isset($validation['pengarang'])) : ?>
                        <div id="pengarangFeedback" class="invalid-feedback">
                            <?= $validation['pengarang'] ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row mb-3">
                <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control <?= isset($validation['penerbit']) ? 'is-invalid' : '' ?>" id="penerbit" name="penerbit" value="<?= old('penerbit') ?? $buku['penerbit'];?>">
                    <?php if (isset($validation['penerbit'])) : ?>
                        <div id="penerbitFeedback" class="invalid-feedback">
                            <?= $validation['penerbit'] ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row mb-3">
                <label for="tahun_terbit" class="col-sm-2 col-form-label">Tahun Terbit</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control <?= isset($validation['tahun_terbit']) ? 'is-invalid' : '' ?>" id="tahun_terbit" name="tahun_terbit" value="<?= old('tahun_terbit') ?? $buku['tahun_terbit'];?>">
                    <?php if (isset($validation['tahun_terbit'])) : ?>
                        <div id="tahun_terbitFeedback" class="invalid-feedback">
                            <?= $validation['tahun_terbit'] ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row mb-3">
                <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
                <div class="col-sm-6">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input <?= isset($validation['sampul']) ? 'is-invalid' : '' ?>" id="sampul" name="sampul">
                        <?php if (isset($validation['sampul'])) : ?>
                            <div id="sampulFeedback" class="invalid-feedback">
                                <?= $validation['sampul'] ?>
                            </div>
                        <?php endif; ?>
                        <label class="custom-file-label" id="fileLabel" for="sampul">
                            <?= old('sampul') ?? $buku['sampul'];?>
                        </label>
                    </div>
                </div>
            </div>

            <script>
                document.getElementById('sampul').addEventListener('change', function(e) {
                    var fileName = e.target.files[0].name;
                    var fileLabel = document.getElementById('fileLabel');
                    fileLabel.textContent = fileName; // Menampilkan nama file di label
                });
            </script>
            <button type="submit" class="btn btn-primary">Ubah Data</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>