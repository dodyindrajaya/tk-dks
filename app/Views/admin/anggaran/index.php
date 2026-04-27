<?= $this->extend('layout/admin_template') ?>
<?= $this->section('content') ?>
<div class="card shadow mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Anggaran DKS</h5>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addModal">Tambah Anggaran Baru</button>
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>TA</th>
                    <th>Deskripsi Kegiatan</th>
                    <th>Bulan</th>
                    <th>Total Anggaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($anggaran as $row): ?>
                <tr>
                    <td><?= $row['tahun_ajaran'] ?></td>
                    <td><?= $row['deskripsi'] ?></td>
                    <td><?= $row['bulan_kegiatan'] ?></td>
                    <td><strong>Rp <?= number_format($row['total_anggaran'], 0, ',', '.') ?></strong></td>
                    <td>
                        <a href="<?= base_url('anggaran/detail/'.$row['id']) ?>" class="btn btn-info btn-sm">Kelola Detail Item</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="<?= base_url('anggaran/save') ?>" method="post" class="modal-content">
            <div class="modal-header"><h5>Tambah Judul Anggaran</h5></div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Tahun Ajaran</label>
                    <select name="id_ta" class="form-control" required>
                        <?php foreach($ta_list as $t): ?>
                            <option value="<?= $t['id'] ?>"><?= $t['tahun_ajaran'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Deskripsi Kegiatan</label>
                    <input type="text" name="deskripsi" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Bulan Kegiatan</label>
                    <input type="text" name="bulan_kegiatan" class="form-control" placeholder="Contoh: Januari">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>