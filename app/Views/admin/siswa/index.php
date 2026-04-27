<?= $this->extend('layout/admin_template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center bg-white">
            <h5 class="mb-0 text-primary">Master Data Siswa</h5>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addSiswa">
                <i class="fas fa-plus"></i> Tambah Siswa
            </button>
        </div>
        <div class="card-body">
            <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Tahun Ajaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($siswa)): ?>
                            <tr><td colspan="5" class="text-center text-muted">Belum ada data siswa.</td></tr>
                        <?php endif; ?>

                        <?php foreach($siswa as $row): ?>
                        <tr>
                            <td><?= $row['nis'] ?></td>
                            <td><?= $row['nama_siswa'] ?></td>
                            <td><?= $row['kelas'] ?></td>
                            <td><?= $row['tahun_ajaran'] ?></td>
                            <td>
                                <a href="<?= base_url('siswa/delete/'.$row['id']) ?>" 
                                   class="btn btn-danger btn-sm" 
                                   onclick="return confirm('Apakah Anda yakin ingin menghapus siswa ini?')">
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

<div class="modal fade" id="addSiswa" tabindex="-1">
    <div class="modal-dialog">
        <form action="<?= base_url('siswa/save') ?>" method="post" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Tambah Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>NIS</label>
                    <input type="text" name="nis" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama_siswa" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Kelas</label>
                    <input type="text" name="kelas" class="form-control" placeholder="Contoh: TK B-1" required>
                </div>
                <div class="mb-3">
                    <label>Tahun Ajaran Masuk</label>
                    <select name="id_ta" class="form-select" required>
                        <option value="">-- Pilih TA --</option>
                        <?php foreach($ta_list as $t): ?>
                            <option value="<?= $t['id'] ?>"><?= $t['tahun_ajaran'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>