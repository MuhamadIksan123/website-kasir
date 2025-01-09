<?= $this->extend('Admin/layout.php') ?>

<?= $this->section('content') ?>

<div>
    <a class="btn btn-primary" href="<?= base_url('/admin/data_admin/create') ?>"><i class="lni lni-plus"></i>Tambah Data</a>
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data_admin as $key => $item): ?>
                <tr>
                    <td><?= $key + 1; ?></td>
                    <td><?= $item['nama']; ?></td>
                    <td><?= $item['role']; ?></td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
</div>

<?= $this->endSection(); ?>