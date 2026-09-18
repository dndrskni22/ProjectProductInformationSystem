<?php
/**
 * Presentation Layer: Berkas Antarmuka Utama & Penggabung Komponen
 * 
 * Modul: Pemrograman Web - Pertemuan 2 (Slide 17)
 * Proyek: Mini Project 1 - Product Information System
 * Arsitektur: 3-Layer Modular (Data Layer, Processing Layer, Presentation Layer)
 */

require_once __DIR__ . '/products.php';
require_once __DIR__ . '/functions.php';

$totalNilaiAset = hitungTotalNilaiStok($products);
$ringkasanStats = hitungRingkasanStatistik($products);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Information System</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <header class="site-header">
        <div class="container header-inner">
            <div class="brand-wrapper">
                <div class="brand-monogram">PIS</div>
                <div class="brand-title">Product Information System</div>
            </div>
            <div class="header-meta">
                <span class="tag-badge">Pertemuan 2 (Slide 17)</span>
                <span class="tag-badge">PHP Native</span>
            </div>
        </div>
    </header>

    <main class="main-wrapper">
        <div class="container">
            <div class="page-lead">
                <h1>Dasbor Manajemen Komoditas Produk</h1>
                <p>Implementasi pemisahan Data Layer, Processing Layer, dan Presentation Layer sesuai spesifikasi silabus.</p>
            </div>

            <!-- Stats Grid -->
            <section class="stats-grid">
                <div class="stat-item">
                    <div class="stat-label">Total Nilai Aset Gudang</div>
                    <div class="stat-value"><?= formatRupiah($totalNilaiAset); ?></div>
                    <div class="stat-hint">Akumulasi seluruh unit fisik</div>
                </div>

                <div class="stat-item">
                    <div class="stat-label">Ragam Komoditas</div>
                    <div class="stat-value"><?= number_format($ringkasanStats['totalItem']); ?> <span style="font-size:13px; font-weight:500; color:var(--text-muted)">SKU</span></div>
                    <div class="stat-hint"><?= $ringkasanStats['totalKategori']; ?> kategori terdaftar</div>
                </div>

                <div class="stat-item">
                    <div class="stat-label">Total Unit Fisik</div>
                    <div class="stat-value"><?= number_format($ringkasanStats['totalUnit']); ?> <span style="font-size:13px; font-weight:500; color:var(--text-muted)">Unit</span></div>
                    <div class="stat-hint">Jumlah stok komoditas di gudang</div>
                </div>

                <div class="stat-item">
                    <div class="stat-label">Stok Kritis (&lt; 3)</div>
                    <div class="stat-value <?= ($ringkasanStats['totalKritis'] > 0) ? 'is-alert' : ''; ?>">
                        <?= number_format($ringkasanStats['totalKritis']); ?> <span style="font-size:13px; font-weight:500; color:var(--text-muted)">Item</span>
                    </div>
                    <div class="stat-hint">Perlu tindakan pengadaan ulang</div>
                </div>
            </section>

            <!-- Notice box jika ada stok kritis -->
            <?php if ($ringkasanStats['totalKritis'] > 0): ?>
                <div class="notice-box">
                    <div class="notice-text">
                        <strong>Perhatian:</strong>
                        <span>Ditemukan <?= $ringkasanStats['totalKritis']; ?> komoditas dengan kuantitas stok di bawah ambang batas (&lt; 3 unit). Baris ditandai dengan aksen merah pada tabel.</span>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Table Card -->
            <section class="data-card">
                <div class="toolbar">
                    <div class="toolbar-controls">
                        <div class="segmented-control" role="tablist">
                            <button type="button" class="segment-btn active" id="tabAll" onclick="setFilter('all')">
                                Semua Produk (<?= $ringkasanStats['totalItem']; ?>)
                            </button>
                            <button type="button" class="segment-btn" id="tabCritical" onclick="setFilter('critical')">
                                Stok Kritis (<?= $ringkasanStats['totalKritis']; ?>)
                            </button>
                        </div>

                        <input type="text" id="tableSearch" class="search-field" placeholder="Cari nama, ID, atau kategori..." onkeyup="handleSearch()">
                    </div>
                </div>

                <div class="table-wrapper">
                    <table class="product-table" id="inventoryTable">
                        <thead>
                            <tr>
                                <th style="width: 48px;">No</th>
                                <th style="width: 90px;">ID</th>
                                <th>Komoditas &amp; Spesifikasi</th>
                                <th style="width: 160px;">Kategori</th>
                                <th style="width: 130px; text-align: right;">Harga Satuan</th>
                                <th style="width: 100px; text-align: center;">Kuantitas</th>
                                <th style="width: 120px; text-align: center;">Status</th>
                                <th style="width: 140px; text-align: right;">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach ($products as $product): 
                                $statusInfo = cekStatusStok($product['stok']);
                                $subtotal = $product['harga'] * $product['stok'];
                            ?>
                                <tr class="<?= $statusInfo['rowClass']; ?>" data-critical="<?= $statusInfo['isKritis'] ? 'true' : 'false'; ?>">
                                    <td><?= $no++; ?></td>
                                    <td>
                                        <span class="col-id"><?= htmlspecialchars($product['id']); ?></span>
                                    </td>
                                    <td>
                                        <div class="item-info">
                                            <span class="item-name"><?= htmlspecialchars($product['nama']); ?></span>
                                            <span class="item-desc"><?= htmlspecialchars($product['deskripsi']); ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="category-pill"><?= htmlspecialchars($product['kategori']); ?></span>
                                    </td>
                                    <td class="num-cell">
                                        <?= formatRupiah($product['harga']); ?>
                                    </td>
                                    <td class="qty-cell <?= $statusInfo['isKritis'] ? 'is-critical' : ''; ?>">
                                        <?= number_format($product['stok']); ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <span class="status-badge <?= $statusInfo['badgeClass']; ?>">
                                            <?= htmlspecialchars($statusInfo['label']); ?>
                                        </span>
                                    </td>
                                    <td class="num-cell" style="font-weight: 600;">
                                        <?= formatRupiah($subtotal); ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" style="text-align: right; color: var(--text-muted);">
                                    Total Akumulasi Nilai Aset Gudang:
                                </td>
                                <td style="text-align: center;">
                                    <?= number_format($ringkasanStats['totalUnit']); ?> unit
                                </td>
                                <td></td>
                                <td class="num-cell" style="font-weight: 700;">
                                    <?= formatRupiah($totalNilaiAset); ?>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </section>

            <!-- Architecture Strip -->
            <div class="arch-strip">
                <span class="arch-strip-title">Struktur Arsitektur 3-Layer:</span>
                <div class="arch-strip-items">
                    <span class="arch-strip-item">Data Layer: <code>products.php</code></span>
                    <span class="arch-strip-item">Processing Layer: <code>functions.php</code></span>
                    <span class="arch-strip-item">Presentation Layer: <code>index.php</code></span>
                </div>
            </div>
        </div>
    </main>

    <footer class="site-footer">
        <div class="container footer-inner">
            <div>
                <strong>Product Information System</strong> &bull; Praktikum Pemrograman Web (Pertemuan 2, Slide 17)
            </div>
            <div>
                Pengembang: <strong>Adinda Riskiani</strong> &bull;
                <a href="https://github.com/dndrskni22/ProjectProductInformationSystem" target="_blank" rel="noopener">GitHub</a>
            </div>
        </div>
    </footer>

    <script>
        let currentFilter = 'all';

        function setFilter(mode) {
            currentFilter = mode;
            document.getElementById('tabAll').classList.toggle('active', mode === 'all');
            document.getElementById('tabCritical').classList.toggle('active', mode === 'critical');
            applyFilters();
        }

        function handleSearch() {
            applyFilters();
        }

        function applyFilters() {
            const query = document.getElementById('tableSearch').value.toLowerCase();
            const table = document.getElementById('inventoryTable');
            const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

            for (let i = 0; i < rows.length; i++) {
                const row = rows[i];
                const text = row.innerText.toLowerCase();
                const isCritical = row.getAttribute('data-critical') === 'true';

                const matchesFilter = (currentFilter === 'all') || (currentFilter === 'critical' && isCritical);
                const matchesQuery = text.includes(query);

                row.style.display = (matchesFilter && matchesQuery) ? '' : 'none';
            }
        }
    </script>
</body>
</html>
