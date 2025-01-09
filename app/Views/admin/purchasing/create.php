<?= $this->extend('Admin/layout.php') ?>

<?= $this->section('content') ?>

<div class="card col-md-6">
    <div class="card-body">
        <form method="post" action="<?= base_url('/admin/purchasing/store') ?>">
            <?= csrf_field() ?>
            <div class="input-style-1">
                <label>Nama</label>
                <input type="text" name="nama" placeholder="Nama" class="form-control <?= $validation->hasError('nama') ? 'is-invalid' : '' ?>" value="<?= set_value('nama'); ?>" />
                <div class="invalid-feedback">
                    <?= $validation->getError('nama'); ?>
                </div>
            </div>
            <div class="input-style-1">
                <label>Perusahaan</label>
                <select name="id_perusahaan" class="form-select <?= $validation->hasError('id_perusahaan') ? 'is-invalid' : '' ?>">
                    <option value="">-- Pilih Perusahaan --</option>
                    <?php foreach ($perusahaan as $item): ?>
                        <option value="<?= $item['id']; ?>" <?= set_select('id_perusahaan', $item['id']); ?>><?= $item['nama']; ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">
                    <?= $validation->getError('id_perusahaan'); ?>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>