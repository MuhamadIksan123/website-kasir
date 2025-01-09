<?= $this->extend('Admin/layout.php') ?>

<?= $this->section('content') ?>

<div>
    <a class="btn btn-primary" href="<?= base_url('/admin/pelanggan/create') ?>"><i class="lni lni-plus"></i>Tambah Data</a>
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pelanggan as $key => $item): ?>
                <tr>
                    <td><?= $key + 1; ?></td>
                    <td><?= $item['nama']; ?></td>
                    <td><?= $item['alamat']; ?></td>
                    <td>
                        <a class="badge bg-warning me-1" href="<?= base_url('/admin/pelanggan/edit/' .  $item['id']) ?>">Edit</a>
                        <a class="badge bg-danger tombol-hapus" href="<?= base_url('/admin/pelanggan/destroy/' .  $item['id']) ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
</div>

<?= $this->endSection(); ?>