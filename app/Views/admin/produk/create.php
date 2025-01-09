<?= $this->extend('Admin/layout.php') ?>

<?= $this->section('content') ?>

<div class="card col-md-6">
    <div class="card-body">
        <form method="post" action="<?= base_url('/admin/produk/store') ?>">
            <?= csrf_field() ?>
            <div class="input-style-1">
                <label>Kode Produk</label>
                <input type="text" name="kode_produk" placeholder="Kode Produk" class="form-control <?= $validation->hasError('kode_produk') ? 'is-invalid' : '' ?>" value="<?= set_value('kode_produk'); ?>" />
                <div class="invalid-feedback">
                    <?= $validation->getError('kode_produk'); ?>
                </div>
            </div>
            <div class="input-style-1">
                <label>Nama</label>
                <input type="text" name="nama_produk" placeholder="Nama" class="form-control <?= $validation->hasError('nama_produk') ? 'is-invalid' : '' ?>" value="<?= set_value('nama_produk'); ?>" />
                <div class="invalid-feedback">
                    <?= $validation->getError('nama_produk'); ?>
                </div>
            </div>
            <div class="input-style-1">
                <label>Harga</label>
                <input type="number" name="harga" placeholder="Harga" class="form-control <?= $validation->hasError('harga') ? 'is-invalid' : '' ?>" value="<?= set_value('harga'); ?>" />
                <div class="invalid-feedback">
                    <?= $validation->getError('harga'); ?>
                </div>
            </div>
            <div class="input-style-1">
                <label>Satuan</label>
                <input type="text" name="satuan" placeholder="Satuan" class="form-control <?= $validation->hasError('satuan') ? 'is-invalid' : '' ?>" value="<?= set_value('satuan'); ?>" />
                <div class="invalid-feedback">
                    <?= $validation->getError('satuan'); ?>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>