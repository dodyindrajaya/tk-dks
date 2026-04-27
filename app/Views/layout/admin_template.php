<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Aplikasi DKS TK' ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body { display: flex; min-height: 100vh; overflow-x: hidden; }
        #sidebar { min-width: 250px; max-width: 250px; background: #343a40; color: white; transition: all 0.3s; }
        #sidebar .nav-link { color: rgba(255,255,255,.75); }
        #sidebar .nav-link:hover { color: white; background: rgba(255,255,255,.1); }
        #sidebar .nav-link.active { color: white; background: #0d6efd; }
        .content { flex: 1; padding: 20px; background: #f8f9fa; }
    </style>
</head>
<body>

<nav id="sidebar" class="d-flex flex-column p-3">
    <h4>DKS System</h4>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
    <li class="nav-item">
        <a href="<?= base_url('dashboard') ?>" class="nav-link active">Dashboard</a>
    </li>
    <li><hr></li>
    <span class="text-secondary small">Master Data</span>
    <li><a href="<?= base_url('siswa') ?>" class="nav-link">Data Siswa</a></li>
    <li><a href="<?= base_url('ta') ?>" class="nav-link">Tahun Ajaran</a></li>
    
    <li><hr></li>
    <span class="text-secondary small">Transaksi DKS</span>
    <li><a href="<?= base_url('anggaran') ?>" class="nav-link">Data Anggaran</a></li>
    <li><a href="<?= base_url('realisasi') ?>" class="nav-link">Data Realisasi</a></li>
    <li><a href="<?= base_url('laporan') ?>" class="nav-link text-warning">Laporan (PDF/XLS)</a></li>
    
</ul> 
    <hr>
    <a href="<?= base_url('logout') ?>" class="btn btn-danger btn-sm">Logout</a>
</nav>

<main class="content">
    <?= $this->renderSection('content') ?>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>