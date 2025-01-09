<?= $this->extend('Admin/layout.php') ?>

<?= $this->section('content') ?>

<div>
    <a class="btn btn-primary" href="<?= base_url('/admin/produk/create') ?>"><i class="lni lni-plus"></i>Tambah Data</a>
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Produk</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Satuan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produk as $key => $item): ?>
                <tr>
                    <td><?= $key + 1; ?></td>
                    <td><?= $item['kode_produk']; ?></td>
                    <td><?= $item['nama_produk']; ?></td>
                    <td>Rp <?= number_format($item['harga'], 0, ',', '.'); ?></td>
                    <td><?= $item['satuan']; ?></td>
                    <td>
                        <a class="badge bg-warning me-1" href="<?= base_url('/admin/produk/edit/' .  $item['kode_produk']) ?>">Edit</a>
                        <a class="badge bg-danger tombol-hapus" href="<?= base_url('/admin/produk/destroy/' .  $item['kode_produk']) ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
</div>

<?= $this->endSection(); ?>