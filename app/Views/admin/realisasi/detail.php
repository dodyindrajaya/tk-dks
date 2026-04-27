<?= $this->extend('layout/admin_template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 mb-3">
            <a href="<?= base_url('realisasi') ?>" class="btn btn-secondary btn-sm mb-3">← Kembali ke Daftar</a>
            <div class="card border-success">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h5 class="text-success">Realisasi: <?= $header['deskripsi'] ?></h5>
                            <p class="mb-0">Status: Pencatatan Pengeluaran DKS</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <h3>Total: Rp <?= number_format($header['total_realisasi'], 0, ',', '.') ?></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header bg-success text-white">Input Bukti Pengeluaran</div>
                <div class="card-body">
                    <form action="<?= base_url('realisasi/save_detail/'.$header['id']) ?>" method="post">
                        <div class="mb-3">
                            <label>Keterangan / Nama Barang</label>
                            <input type="text" name="keterangan" class="form-control" required placeholder="Contoh: Nota Toko ATK">
                        </div>
                        <div class="mb-3">
                            <label>Nilai Realisasi (Rp)</label>
                            <input type="number" name="nilai_realisasi" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Simpan Record</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header">Rincian Penggunaan Dana</div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Keterangan</th>
                                <th>Nilai (Rp)</th>
                                <th>Tanggal Input</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($details)): ?>
                                <tr><td colspan="5" class="text-center text-muted">Belum ada rincian realisasi.</td></tr>
                            <?php endif; ?>
                            
                            <?php $no=1; foreach($details as $d): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $d['keterangan'] ?></td>
                                <td><strong>Rp <?= number_format($d['nilai_realisasi'], 0, ',', '.') ?></strong></td>
                                <td><?= date('d/m/Y H:i', strtotime($d['tanggal_input'])) ?></td>
                                <td>
                                    <a href="<?= base_url('realisasi/delete_detail/'.$d['id'].'/'.$header['id']) ?>" 
                                       class="btn btn-danger btn-sm" 
                                       onclick="return confirm('Hapus record ini? Saldo header akan otomatis terupdate.')">
                                       Hapus
                                    </a>
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