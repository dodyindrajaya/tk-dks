<?= $this->extend('layout/admin_template') ?>
<?= $this->section('content') ?>
<div class="card shadow mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Realisasi Penggunaan Dana</h5>
        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addReal">Input Realisasi Baru</button>
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>TA</th>
                    <th>Anggaran Reff</th>
                    <th>Ket. Realisasi</th>
                    <th>Total Realisasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($realisasi as $row): ?>
                <tr>
                    <td><?= $row['tahun_ajaran'] ?></td>
                    <td><?= $row['nama_anggaran'] ?></td>
                    <td><?= $row['deskripsi'] ?></td>
                    <td class="text-primary"><strong>Rp <?= number_format($row['total_realisasi'], 0, ',', '.') ?></strong></td>
                    <td>
                        <a href="<?= base_url('realisasi/edit/'.$row['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="<?= base_url('realisasi/delete/'.$row['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus realisasi ini? Semua rincian akan ikut terhapus.')">Hapus</a>
                        <a href="<?= base_url('realisasi/detail/'.$row['id']) ?>" class="btn btn-info btn-sm">Rincian</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="addReal" tabindex="-1">
    <div class="modal-dialog">
        <form action="<?= base_url('realisasi/save') ?>" method="post" class="modal-content">
            <div class="modal-header"><h5>Tambah Realisasi</h5></div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Pilih Kegiatan Anggaran</label>
                    <select name="id_anggaran" class="form-control" required>
                        <?php foreach($anggaran_list as $a): ?>
                            <option value="<?= $a['id'] ?>"><?= $a['deskripsi'] ?> (Rp <?= number_format($a['total_anggaran'],0,',','.') ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Keterangan Realisasi</label>
                    <input type="text" name="deskripsi" class="form-control" required placeholder="Contoh: Pembayaran Honor Juri">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>