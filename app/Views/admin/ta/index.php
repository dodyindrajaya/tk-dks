<?= $this->extend('layout/admin_template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header">Tambah Tahun Ajaran</div>
                <div class="card-body">
                    <form action="<?= base_url('ta/save') ?>" method="post">
                        <div class="mb-3">
                            <label>Tahun Ajaran</label>
                            <input type="text" name="tahun_ajaran" class="form-control" placeholder="Contoh: 2025/2026" required>
                        </div>
                        <div class="mb-3">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Nonaktif</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header">Daftar Tahun Ajaran</div>
                <div class="card-body">
                   <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tahun Ajaran</th>
                            <th>Status</th>
                            <th>Aksi</th> </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach($ta as $row): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['tahun_ajaran'] ?></td>
                            <td><span class="badge bg-<?= $row['status'] == 'aktif' ? 'success' : 'secondary' ?>"><?= $row['status'] ?></span></td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['id'] ?>">Edit</button>
                                <a href="<?= base_url('ta/delete/'.$row['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                            </td>
                        </tr>

                        <div class="modal fade" id="editModal<?= $row['id'] ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="<?= base_url('ta/update/'.$row['id']) ?>" method="post">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Tahun Ajaran</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label>Tahun Ajaran</label>
                                                <input type="text" name="tahun_ajaran" class="form-control" value="<?= $row['tahun_ajaran'] ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label>Status</label>
                                                <select name="status" class="form-control">
                                                    <option value="aktif" <?= $row['status'] == 'aktif' ? 'selected' : '' ?>>Aktif</option>
                                                    <option value="nonaktif" <?= $row['status'] == 'nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>