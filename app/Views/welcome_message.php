<?= $this->extend('layout.php') ?>

<?= $this->section('content') ?>
<style>
    .parent-clock {
        display: grid;
        grid-template-columns: auto auto auto auto auto;
        font-size: 35px;
        font-weight: bold;
        justify-content: center;
    }

    #map {
        height: 400px;
        width: 100%;
    }
</style>

<div class="row">
</div>

<script>
</script>

<?= $this->endSection(); ?>