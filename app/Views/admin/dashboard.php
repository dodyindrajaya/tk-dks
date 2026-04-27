<?= $this->extend('layout/admin_template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-12">
            <h3>Selamat Datang, <?= session()->get('nama_lengkap') ?></h3>
            <p>Tahun Ajaran Aktif: <strong><?= $ta_aktif ?></strong></p>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Ringkasan Anggaran vs Realisasi DKS</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>TA</th>
                        <th>Deskripsi</th>
                        <th>Bulan Kegiatan</th>
                        <th>Jumlah Anggaran</th>
                        <th>Jumlah Realisasi</th>
                        <th>Selisih</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach($summary as $row): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['tahun_ajaran'] ?></td>
                        <td><?= $row['deskripsi'] ?></td>
                        <td><?= $row['bulan_kegiatan'] ?></td>
                        <td>Rp <?= number_format($row['jumlah_anggaran'], 0, ',', '.') ?></td>
                        <td>Rp <?= number_format($row['jumlah_realisasi'], 0, ',', '.') ?></td>
                        <td class="<?= ($row['jumlah_anggaran'] < $row['jumlah_realisasi']) ? 'text-danger' : 'text-success' ?>">
                            Rp <?= number_format($row['jumlah_anggaran'] - $row['jumlah_realisasi'], 0, ',', '.') ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>