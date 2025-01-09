<?php
// Extend dari layout utama
?>
<?= $this->extend('Admin/layout.php') ?>

<?= $this->section('content') ?>

<style>
    .product-row {
        margin-bottom: 10px;
        display: flex;
        align-items: center;
    }

    .product-row select {
        margin-right: 5px;
        flex: 2;
    }

    .product-row input[name="quantity[]"] {
        flex: 1;
    }

    .product-row button {
        margin-left: 10px;
    }
</style>

<div class="card col-md-6">
    <div class="card-body">
        <form method="post" action="<?= base_url('/admin/transaksi/store') ?>">
            <?= csrf_field() ?>

            <!-- Input No Faktur -->
            <div class="input-style-1">
                <label>No Faktur</label>
                <input type="text" name="no_faktur" placeholder="No Faktur" class="form-control <?= $validation->hasError('no_faktur') ? 'is-invalid' : '' ?>" value="<?= set_value('no_faktur'); ?>" />
                <div class="invalid-feedback">
                    <?= $validation->getError('no_faktur'); ?>
                </div>
            </div>

            <!-- Input Tanggal Transaksi -->
            <div class="input-style-1">
                <label>Tanggal Transaksi</label>
                <input type="date" name="tgl_transaksi" class="form-control <?= $validation->hasError('tgl_transaksi') ? 'is-invalid' : '' ?>" value="<?= set_value('tgl_transaksi'); ?>" />
                <div class="invalid-feedback">
                    <?= $validation->getError('tgl_transaksi'); ?>
                </div>
            </div>

            <!-- Input Pelanggan -->
            <div class="input-style-1">
                <label>Pelanggan</label>
                <select name="id_pelanggan" class="form-select <?= $validation->hasError('id_pelanggan') ? 'is-invalid' : '' ?>">
                    <option value="">-- Pilih Pelanggan --</option>
                    <?php foreach ($pelanggan as $item): ?>
                        <option value="<?= $item['id']; ?>" <?= set_select('id_pelanggan', $item['id']); ?>><?= $item['nama']; ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">
                    <?= $validation->getError('id_pelanggan'); ?>
                </div>
            </div>

            <!-- Input Purchasing -->
            <div class="input-style-1">
                <label>Purchasing</label>
                <select name="id_purchasing" class="form-select <?= $validation->hasError('id_purchasing') ? 'is-invalid' : '' ?>">
                    <option value="">-- Pilih Purchasing --</option>
                    <?php foreach ($purchasing as $item): ?>
                        <option value="<?= $item['id']; ?>" <?= set_select('id_purchasing', $item['id']); ?>><?= $item['nama']; ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">
                    <?= $validation->getError('id_purchasing'); ?>
                </div>
            </div>

            <div id="product-container">
                <!-- Baris Produk Pertama -->
                <input type="hidden" name="product_old[]">
                <div class="product-row">
                    <select name="product_name[]" class="form-select" required>
                        <option value="">-- Pilih Produk --</option>
                        <?php foreach ($produk as $item): ?>
                            <option value="<?= $item['kode_produk']; ?>"><?= $item['nama_produk']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="number" name="quantity[]" placeholder="Quantity" class="form-control" min="1" required>
                    <button type="button" class="btn btn-danger remove-btn" style="display: none;">Remove</button>
                </div>
            </div>

            <button type="button" id="add-row" class="btn btn-success mt-2">Add Product</button>


            <!-- Tombol Submit -->
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const productContainer = document.getElementById('product-container');
        const addRowButton = document.getElementById('add-row');

        // Fungsi untuk memperbarui nilai product_old[] berdasarkan product_name[]
        function updateProductOldValues() {
            const productNames = Array.from(productContainer.querySelectorAll('select[name="product_name[]"]')).map(select => select.value);
            const productOldInputs = productContainer.querySelectorAll('input[name="product_old[]"]');

            productOldInputs.forEach((input, index) => {
                input.value = productNames[index] || ''; // Menyesuaikan nilai product_old dengan nilai product_name
            });
        }

        // Tambahkan baris produk baru
        addRowButton.addEventListener('click', function() {
            const newRow = document.createElement('div');
            newRow.classList.add('product-row');
            newRow.innerHTML = `
            <select name="product_name[]" class="form-select" required>
                <option value="">-- Pilih Produk --</option>
                <?php foreach ($produk as $item): ?>
                    <option value="<?= $item['kode_produk']; ?>"><?= $item['nama_produk']; ?></option>
                <?php endforeach; ?>
            </select>
            <input type="number" name="quantity[]" placeholder="Quantity" class="form-control" min="1" required>
            <input type="hidden" name="product_old[]"> <!-- Hidden input untuk product_old -->
            <button type="button" class="btn btn-danger remove-btn">Remove</button>
        `;
            productContainer.appendChild(newRow);

            // Perbarui tombol hapus untuk semua baris
            updateRemoveButtons();
            updateProductOptions();

            // Tambahkan event listener untuk perubahan pada product_name dan quantity
            addChangeListeners(newRow);
        });

        // Hapus baris produk
        productContainer.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-btn')) {
                e.target.parentElement.remove();
                updateRemoveButtons();
                updateProductOptions();
                updateProductOldValues(); // Update setelah menghapus baris
            }
        });

        // Perbarui visibilitas tombol hapus
        function updateRemoveButtons() {
            const rows = productContainer.querySelectorAll('.product-row');
            rows.forEach(row => {
                const removeButton = row.querySelector('.remove-btn');
                removeButton.style.display = rows.length > 1 ? 'inline-block' : 'none';
            });
        }

        // Perbarui opsi produk yang tersedia
        function updateProductOptions() {
            const selectedProducts = Array.from(productContainer.querySelectorAll('select[name="product_name[]"]')).map(select => select.value);
            const productSelects = productContainer.querySelectorAll('select[name="product_name[]"]');

            productSelects.forEach(select => {
                Array.from(select.options).forEach(option => {
                    // Enable semua opsi terlebih dahulu
                    option.disabled = false;

                    // Nonaktifkan produk yang sudah dipilih
                    if (selectedProducts.includes(option.value) && option.value !== "") {
                        option.disabled = true;
                    }
                });
            });
        }

        // Menambahkan event listener untuk setiap baris produk baru
        function addChangeListeners(row) {
            const productNameSelect = row.querySelector('select[name="product_name[]"]');
            const quantityInput = row.querySelector('input[name="quantity[]"]');

            // Event listener untuk perubahan pada product_name
            productNameSelect.addEventListener('change', function() {
                updateProductOldValues(); // Update product_old[] setiap kali product_name[] berubah
                console.log('Product Name changed:', getAllProductNames());
            });

            // Event listener untuk perubahan pada quantity
            quantityInput.addEventListener('change', function() {
                console.log('Quantity changed:', this.value);
            });
        }

        // Ambil semua product_name[] dan log ke konsol dalam format array
        function getAllProductNames() {
            const productNames = Array.from(productContainer.querySelectorAll('select[name="product_name[]"]'))
                .map(select => select.value)
                .filter(value => value); // Menyaring nilai kosong (jika ada)
            console.log('Selected Product Names:', productNames);
            return productNames;
        }

        // Pemeriksaan awal untuk tombol hapus dan opsi produk
        updateRemoveButtons();
        updateProductOptions();
        updateProductOldValues(); // Update initial values for product_old

        // Menambahkan event listener untuk baris pertama (jika ada) setelah halaman dimuat
        const firstRow = productContainer.querySelector('.product-row');
        if (firstRow) {
            addChangeListeners(firstRow);
        }
    });
</script>



<?= $this->endSection(); ?>