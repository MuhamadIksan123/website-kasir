<?= $this->extend('Admin/layout.php') ?>

<?= $this->section('content') ?>

<div class="card col-md-6">
    <div class="card-body">
        <form method="post" action="<?= base_url('/admin/pelanggan/store') ?>">
            <?= csrf_field() ?>
            <div class="input-style-1">
                <label>Nama</label>
                <input type="text" name="nama" placeholder="Nama" class="form-control <?= $validation->hasError('nama') ? 'is-invalid' : '' ?>" value="<?= set_value('nama'); ?>" />
                <div class="invalid-feedback">
                    <?= $validation->getError('nama'); ?>
                </div>
            </div>
            <div class="input-style-1">
                <label>Alamat</label>
                <textarea name="alamat" placeholder="Alamat" cols="30" rows="5" class="form-control <?= $validation->hasError('alamat') ? 'is-invalid' : '' ?>"></textarea>
                <div class="invalid-feedback">
                    <?= $validation->getError('alamat'); ?>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>