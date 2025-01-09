<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<div class="card col-md-6">
    <div class="card-body">
        <form method="post" action="<?= base_url('/admin/data_admin/update/' . $data_admin['id']) ?>">
            <?= csrf_field() ?>
            <div class="input-style-1">
                <label>Nama</label>
                <input type="text" name="nama" placeholder="Nama" class="form-control <?= $validation->hasError('nama') ? 'is-invalid' : '' ?>" value="<?= $data_admin['nama'] ?>" />
                <div class="invalid-feedback">
                    <?= $validation->getError('nama'); ?>
                </div>
            </div>
            <div class="input-style-1">
                <label>Username</label>
                <input type="text" name="username" placeholder="Username" class="form-control <?= $validation->hasError('username') ? 'is-invalid' : '' ?>" value="<?= $data_admin['username'] ?>" />
                <div class="invalid-feedback">
                    <?= $validation->getError('username'); ?>
                </div>
            </div>
            <div class="input-style-1">
                <label>Password</label>
                <input type="hidden" name="password_lama" value="<?= $data_admin['password'] ?>">
                <input type="password" name="password" placeholder="Password" class="form-control <?= $validation->hasError('password') ? 'is-invalid' : '' ?>" />
                <div class="invalid-feedback">
                    <?= $validation->getError('password'); ?>
                </div>
            </div>
            <div class="input-style-1">
                <label>Konfirmasi Password</label>
                <input type="password" name="konfirmasi_password" placeholder="Konfirmasi Password" class="form-control <?= $validation->hasError('konfirmasi_password') ? 'is-invalid' : '' ?>" />
                <div class="invalid-feedback">
                    <?= $validation->getError('konfirmasi_password'); ?>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>