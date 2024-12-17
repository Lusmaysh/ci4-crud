<!-- tambah.php -->
<?= $this->extend('/template'); ?>
<?= $this->section('content');?>

<div class="container">
    <div class="col">
        <h3 class="text-center">Form Tambah Buku</h3>
        <hr>
        <!-- menampilkan validasi -->
        <form action="/buku/simpan" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="row mb-3">
                <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control <?= isset($validation['judul']) ? 'is-invalid' : '' ?>" id="judul" name="judul" autofocus value="<?= old('judul');?>">
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
                    <input type="text" class="form-control <?= isset($validation['pengarang']) ? 'is-invalid' : '' ?>" id="pengarang" name="pengarang" value="<?= old('pengarang');?>">
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
                    <input type="text" class="form-control <?= isset($validation['penerbit']) ? 'is-invalid' : '' ?>" id="penerbit" name="penerbit" value="<?= old('penerbit');?>">
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
                    <input type="text" class="form-control <?= isset($validation['tahun_terbit']) ? 'is-invalid' : '' ?>" id="tahun_terbit" name="tahun_terbit" value="<?= old('tahun_terbit');?>">
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
                        <input type="hidden" id="sampulFileName" name="sampulFileName" value="<?= old('sampulFileName', session()->get('sampulSementara')); ?>">
                        <?php if (isset($validation['sampul'])) : ?>
                            <div id="sampulFeedback" class="invalid-feedback">
                                <?= $validation['sampul'] ?>
                            </div>
                        <?php endif; ?>
                        <label class="custom-file-label" id="fileLabel" for="sampul"><?= session()->get('sampulSementara') ? session()->get('sampulSementara') : 'Pilih File Gambar...'; ?></label>
                    </div>
                </div>
            </div>

            <script>
                document.getElementById('sampul').addEventListener('change', function(e) {
                    var fileName = e.target.files[0].name;
                    var fileLabel = document.getElementById('fileLabel');
                    fileLabel.textContent = fileName; // Menampilkan nama file di label
                    document.getElementById('sampulFileName').value = fileName; // Menyimpan nama file di hidden input
                });

                // Set the file label to the old file name if validation fails
                window.onload = function() {
                    var oldFileName = document.getElementById('sampulFileName').value;
                    if (oldFileName) {
                        document.getElementById('fileLabel').textContent = oldFileName; // Menampilkan nama file yang sudah dipilih sebelumnya
                    }
                };
            </script>

            <button type="submit" class="btn btn-primary">Simpan Data</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>