<?= $this->extend('Admin/layout.php') ?>

<?= $this->section('content') ?>

<div>
    <a class="btn btn-primary" href="<?= base_url('/admin/purchasing/create') ?>"><i class="lni lni-plus"></i>Tambah Data</a>
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Perusahaan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($purchasing as $key => $item): ?>
                <tr>
                    <td><?= $key + 1; ?></td>
                    <td><?= $item['nama']; ?></td>
                    <td><?= $item['nama_perusahaan']; ?></td>
                    <td>
                        <a class="badge bg-warning me-1" href="<?= base_url('/admin/purchasing/edit/' .  $item['id']) ?>">Edit</a>
                        <a class="badge bg-danger tombol-hapus" href="<?= base_url('/admin/purchasing/destroy/' .  $item['id']) ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
</div>

<?= $this->endSection(); ?>