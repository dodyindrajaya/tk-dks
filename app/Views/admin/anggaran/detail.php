<?= $this->extend('layout/admin_template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 mb-3">
            <a href="<?= base_url('anggaran') ?>" class="btn btn-secondary btn-sm mb-3">← Kembali ke Daftar</a>
            <div class="card bg-light">
                <div class="card-body">
                    <h5><?= $header['deskripsi'] ?></h5>
                    <p class="mb-0">Bulan: <?= $header['bulan_kegiatan'] ?> | <strong>Total Anggaran: Rp <?= number_format($header['total_anggaran'], 0, ',', '.') ?></strong></p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header">Tambah Item Anggaran</div>
                <div class="card-body">
                    <form action="<?= base_url('anggaran/save_detail/'.$header['id']) ?>" method="post">
                        <div class="mb-3">
                            <label>Nama Item / Keperluan</label>
                            <input type="text" name="nama_item" class="form-control" required placeholder="Contoh: Konsumsi">
                        </div>
                        <div class="mb-3">
                            <label>Jumlah (Qty)</label>
                            <input type="number" name="jumlah_satuan" class="form-control" required id="qty">
                        </div>
                        <div class="mb-3">
                            <label>Harga Satuan</label>
                            <input type="number" name="harga_satuan" class="form-control" required id="harga">
                        </div>
                        <button type="submit" class="btn btn-success w-100">Tambah Item</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header">Rincian Item</div>
                <div class="card-body">
                    <table class="table table-bordered table-sm">
                        <thead class="table-dark">
                            <tr>
                                <th>Item</th>
                                <th>Qty</th>
                                <th>Harga</th>
                                <th>Subtotal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($details as $d): ?>
                            <tr>
                                <td><?= $d['nama_item'] ?></td>
                                <td><?= $d['jumlah_satuan'] ?></td>
                                <td>Rp <?= number_format($d['harga_satuan'], 0, ',', '.') ?></td>
                                <td>Rp <?= number_format($d['subtotal'], 0, ',', '.') ?></td>
                                <td>
                                    <a href="<?= base_url('anggaran/delete_detail/'.$d['id'].'/'.$header['id']) ?>" class="text-danger" onclick="return confirm('Hapus item ini?')">Hapus</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>