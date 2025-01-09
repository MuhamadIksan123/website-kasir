<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<div class="card col-md-6">
    <div class="card-body">
        <form method="post" action="<?= base_url('/admin/purchasing/update/' . $purchasing['id']) ?>">
            <?= csrf_field() ?>
            <div class="input-style-1">
                <label>Nama</label>
                <input type="text" name="nama" placeholder="Nama" class="form-control <?= $validation->hasError('nama') ? 'is-invalid' : '' ?>" value="<?= $purchasing['nama']; ?>" />
                <div class="invalid-feedback">
                    <?= $validation->getError('nama'); ?>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>