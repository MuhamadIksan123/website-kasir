<?= $this->extend('Admin/layout.php') ?>

<?= $this->section('content') ?>

<div>
    <a class="btn btn-primary" href="<?= base_url('/admin/transaksi/create') ?>"><i class="lni lni-plus"></i>Tambah Data</a>
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>No</th>
                <th>No Faktur
                <th>Tgl Transaksi</th>
                <th>Pelanggan</th>
                <th>Purchasing</th>
                <th>Admin</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transaksi as $key => $item): ?>
                <tr>
                    <td><?= $key + 1; ?></td>
                    <td><?= $item['no_faktur']; ?></td>
                    <td><?= $item['tgl_transaksi']; ?></td>
                    <td><?= $item['nama_pelanggan']; ?></td>
                    <td><?= $item['nama_purchasing']; ?></td>
                    <td><?= $item['nama_admin']; ?></td>
                    <td>
                        <a class="badge bg-primary me-1" href="<?= base_url('/admin/transaksi/detail/' .  $item['id_transaksi']) ?>">Detail</a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
</div>

<?= $this->endSection(); ?>