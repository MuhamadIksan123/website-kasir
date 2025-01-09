<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<div class="container border border-secondary p-4" id="exportArea">
    <div class="row mb-4">
        <div class="col-md-6">
            <h3 class="fw-bold">PT. Bhinneka Sangkuriang Transport</h3>
            <p>Jl. Gedebage Selatan No.121A,<br>
                Cisaranten Kidul, Kec. Gedebage,<br>
                Kota Bandung, Jawa Barat 40552</p>
        </div>
        <div class="col-md-6 text-end">
            <p>Kepada Yth :</p>
            <h3 class="fw-bold"><?= $transaksi[0]['nama_pelanggan']; ?></h3>
            <p><?= $transaksi[0]['alamat_pelanggan']; ?> <br> Up: <?= $transaksi[0]['nama_admin']; ?> </p>
        </div>
    </div>
    <div class="mb-4">
        <p>No. Faktur : <?= $transaksi[0]['no_faktur']; ?></p>
    </div>
    <table class="table table-bordered">
        <thead class="table-secondary text-center align-middle">
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Satuan</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody class="text-center align-middle">
            <?php foreach ($transaksi as $key => $item) : ?>
                <tr>
                    <td class="text-center"><?= $item['kode_produk']; ?></td>
                    <td class="text-center"><?= $item['nama_produk']; ?></td>
                    <td class="text-center"><?= $item['satuan']; ?></td>
                    <td class="text-center"><?= $item['total_produk']; ?></td>
                    <td class="text-center">Rp <?= number_format($item['harga'], 0, ',', '.'); ?></td>
                    <td class="text-center">Rp <?= number_format($item['total_harga'], 0, ',', '.'); ?></td>
                </tr>
            <?php endforeach; ?>
            <tr class="table-light fw-bold">
                <td class="text-center" colspan="3">TOTAL</td>
                <td class="text-center">
                    <?= array_sum(array_column($transaksi, 'total_produk')); ?>
                </td>
                <td class="text-center">
                    Rp <?= number_format(array_sum(array_column($transaksi, 'harga')), 0, ',', '.'); ?>
                </td>
                <td class="text-center">
                    Rp <?= number_format(array_sum(array_column($transaksi, 'total_harga')), 0, ',', '.'); ?>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="row mt-4">
        <div class="col-md-6">
            <p>Purchasing</p>
            <p class="mt-5"><?= $transaksi[0]['nama_purchasing']; ?> </p>
        </div>
        <div class="col-md-6 text-end">
            <p>Cirebon, <?= date('d F Y', strtotime($transaksi[0]['tgl_transaksi'])) ?></p>
            <p class="mt-5"><?= $transaksi[0]['nama_admin']; ?></p>
        </div>
    </div>
</div>
<button id="btnExportPdf" class="btn btn-primary mt-3">Export to PDF</button>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('btnExportPdf').addEventListener('click', function() {
            var element = document.getElementById('exportArea');

            var opt = {
                margin: [0.2, 0.2, 0.2, 0.2], // Margin kecil
                filename: 'detail_transaksi.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2.5 // Skala lebih besar untuk resolusi baik
                },
                jsPDF: {
                    unit: 'in',
                    format: 'a4', // Format A4
                    orientation: 'portrait' // Tetap portrait
                }
            };

            html2pdf().set(opt).from(element).save();
        });
    });
</script>



<?= $this->endSection(); ?>