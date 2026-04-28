<?= $this->extend('layout/admin_template') ?>
<?= $this->section('content') ?>
<div class="card shadow mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Edit Realisasi</h5>
        <a href="<?= base_url('realisasi') ?>" class="btn btn-secondary btn-sm">Kembali</a>
    </div>
    <div class="card-body">
        <form action="<?= base_url('realisasi/update/'.$header['id']) ?>" method="post">
            <div class="mb-3">
                <label>Pilih Anggaran Referensi</label>
                <select name="id_anggaran" class="form-control" required>
                    <?php foreach($anggaran_list as $a): ?>
                        <option value="<?= $a['id'] ?>" <?= $a['id'] == $header['id_anggaran'] ? 'selected' : '' ?>><?= esc($a['deskripsi']) ?> (Rp <?= number_format($a['total_anggaran'],0,',','.') ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label>Keterangan Realisasi</label>
                <input type="text" name="deskripsi" class="form-control" required value="<?= esc($header['deskripsi']) ?>">
            </div>
            <div class="mb-3">
                <label>Total Saat Ini</label>
                <input type="text" class="form-control" value="Rp <?= number_format($header['total_realisasi'], 0, ',', '.') ?>" readonly>
            </div>
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
