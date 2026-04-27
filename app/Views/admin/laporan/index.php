<?= $this->extend('layout/admin_template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Laporan Monitoring DKS</h6>
            <div class="btn-group">
                <button type="button" class="btn btn-danger btn-sm" onclick="window.print()">Cetak PDF</button>
                <button type="button" class="btn btn-success btn-sm" id="btnExport">Ekspor Excel</button>
            </div>
        </div>
        <div class="card-body">
            <form action="" method="get" class="row g-3 mb-4">
                <div class="col-md-4">
                    <select name="id_ta" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="">-- Semua Tahun Ajaran --</option>
                        <?php foreach($ta_list as $t): ?>
                            <option value="<?= $t['id'] ?>" <?= $id_ta == $t['id'] ? 'selected' : '' ?>><?= $t['tahun_ajaran'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered" id="tableLaporan">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Kegiatan / Anggaran</th>
                            <th>Nilai Anggaran (A)</th>
                            <th>Nilai Realisasi (B)</th>
                            <th>Selisih (A-B)</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; $tAng=0; $tReal=0; foreach($laporan as $l): 
                            $tAng += $l['total_anggaran'];
                            $tReal += $l['total_realisasi'];
                            $selisih = $l['total_anggaran'] - $l['total_realisasi'];
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $l['deskripsi'] ?></td>
                            <td class="text-end">Rp <?= number_format($l['total_anggaran'],0,',','.') ?></td>
                            <td class="text-end">Rp <?= number_format($l['total_realisasi'],0,',','.') ?></td>
                            <td class="text-end <?= $selisih < 0 ? 'text-danger' : 'text-success' ?>">
                                Rp <?= number_format($selisih,0,',','.') ?>
                            </td>
                            <td>
                                <?php if($l['total_realisasi'] == 0): ?>
                                    <span class="badge bg-warning">Belum Realisasi</span>
                                <?php elseif($selisih < 0): ?>
                                    <span class="badge bg-danger">Over Budget</span>
                                <?php else: ?>
                                    <span class="badge bg-success">Sesuai</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot class="table-light font-weight-bold">
                        <tr>
                            <td colspan="2" class="text-center">TOTAL KESELURUHAN</td>
                            <td class="text-end"><strong>Rp <?= number_format($tAng,0,',','.') ?></strong></td>
                            <td class="text-end"><strong>Rp <?= number_format($tReal,0,',','.') ?></strong></td>
                            <td class="text-end"><strong>Rp <?= number_format($tAng - $tReal,0,',','.') ?></strong></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('btnExport').addEventListener('click', function() {
    let table = document.getElementById('tableLaporan');
    let html = table.outerHTML;
    window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
});
</script>
<?= $this->endSection() ?>