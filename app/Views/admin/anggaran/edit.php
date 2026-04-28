<?= $this->extend('layout/admin_template') ?>
<?= $this->section('content') ?>
<div class="card shadow mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Edit Anggaran</h5>
        <a href="<?= base_url('anggaran') ?>" class="btn btn-secondary btn-sm">Kembali</a>
    </div>
    <div class="card-body">
        <form action="<?= base_url('anggaran/update/'.$header['id']) ?>" method="post">
            <div class="mb-3">
                <label>Tahun Ajaran</label>
                <select name="id_ta" class="form-control" required>
                    <?php foreach($ta_list as $t): ?>
                        <option value="<?= $t['id'] ?>" <?= $t['id'] == $header['id_ta'] ? 'selected' : '' ?>><?= $t['tahun_ajaran'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label>Deskripsi Kegiatan</label>
                <input type="text" name="deskripsi" class="form-control" required value="<?= esc($header['deskripsi']) ?>">
            </div>
            <div class="mb-3">
                <label>Bulan Kegiatan</label>
                <input type="text" name="bulan_kegiatan" class="form-control" value="<?= esc($header['bulan_kegiatan']) ?>">
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
