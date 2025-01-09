<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-xl-3 col-lg-4 col-sm-6">
        <div class="icon-card mb-30">
            <div class="icon purple">
                <i class="lni lni-user-4"></i>
            </div>
            <div class="content">
                <h6 class="mb-10">Total Admin</h6>
                <h3 class="text-bold mb-10"><?= $total_admin; ?></h3>
            </div>
        </div>
        <!-- End Icon Card -->
    </div>
    <!-- End Col -->
    <div class="col-xl-3 col-lg-4 col-sm-6">
        <div class="icon-card mb-30">
            <div class="icon success">
                <i class="lni lni-user-multiple-4"></i>
            </div>
            <div class="content">
                <h6 class="mb-10">Total Pelanggan</h6>
                <h3 class="text-bold mb-10"><?= $total_pelanggan; ?></h3>
            </div>
        </div>
        <!-- End Icon Card -->
    </div>
    <!-- End Col -->
    <div class="col-xl-3 col-lg-4 col-sm-6">
        <div class="icon-card mb-30">
            <div class="icon orange">
                <i class="lni lni-basket-shopping-3"></i>
            </div>
            <div class="content">
                <h6 class="mb-10">Total Produk</h6>
                <h3 class="text-bold mb-10"><?= $total_produk; ?></h3>
            </div>
        </div>
        <!-- End Icon Card -->
    </div>
    <!-- End Col -->
    <div class="col-xl-3 col-lg-4 col-sm-6">
        <div class="icon-card mb-30">
            <div class="icon primary">
                <i class="lni lni-database-2"></i>
            </div>
            <div class="content">
                <h6 class="mb-10">Total Transaksi</h6>
                <h3 class="text-bold mb-10"><?= $total_transaksi; ?></h3>
            </div>
        </div>
        <!-- End Icon Card -->
    </div>
    <!-- End Col -->
</div>


<?= $this->endSection(); ?>