<?php
/**
 * Processing Layer: Berkas Logika Bisnis & Pengolahan Data
 * 
 * Modul: Pemrograman Web - Pertemuan 2 (Mini Project 1: Product Information System)
 * Komponen: Processing Layer
 * 
 * Deskripsi:
 * Mengolah data produk mentah menjadi informasi terstruktur melalui:
 * - hitungTotalNilaiStok(): Menghitung total nilai finansial inventaris gudang
 * - cekStatusStok(): Logika conditional klasifikasi kondisi stok (< 3 = Kritis)
 * - formatRupiah(): Standarisasi format presentasi mata uang Indonesia
 * - hitungRingkasanStatistik(): Agregasi metrik analitik gudang
 */

/**
 * Mengalkulasi total nilai aset gudang dari seluruh produk yang tersedia.
 * Rumus: Total = Σ (harga * stok)
 *
 * @param array $products Daftar produk dari Data Layer
 * @return float|int Total akumulasi nilai aset
 */
function hitungTotalNilaiStok(array $products)
{
    $total = 0;
    foreach ($products as $product) {
        $harga = isset($product['harga']) ? (float)$product['harga'] : 0;
        $stok  = isset($product['stok'])  ? (int)$product['stok']   : 0;
        $total += ($harga * $stok);
    }
    return $total;
}

/**
 * Format angka numerik ke representasi mata uang Rupiah Indonesia (IDR).
 * Contoh: 18500000 -> "Rp 18.500.000"
 *
 * @param float|int $nominal Nilai angka yang akan diformat
 * @return string Teks mata uang Rupiah
 */
function formatRupiah(float|int $nominal): string
{
    return 'Rp ' . number_format($nominal, 0, ',', '.');
}

/**
 * Logika conditional untuk mengevaluasi status ketersediaan stok
 * dan menentukan kelas styling baris tabel serta lencana (badge).
 * 
 * Aturan Bisnis Sesuai Spesifikasi:
 * - Stok < 3 : Kritis (Memerlukan penyorotan visual khusus pada baris tabel)
 * - 3 <= Stok <= 7 : Menipis / Perlu Diwaspadai
 * - Stok > 7 : Aman / Ketersediaan Normal
 *
 * @param int $stok Jumlah kuantitas stok produk
 * @return array Array asosiatif berisi informasi status, badgeClass, rowClass, isKritis, dan pesan deskriptif
 */
function cekStatusStok(int $stok): array
{
    if ($stok <= 0) {
        return [
            'status'     => 'Habis',
            'label'      => 'Habis (0)',
            'badgeClass' => 'badge-danger',
            'rowClass'   => 'row-critical',
            'isKritis'   => true
        ];
    } elseif ($stok < 3) {
        return [
            'status'     => 'Kritis',
            'label'      => 'Kritis (< 3)',
            'badgeClass' => 'badge-danger',
            'rowClass'   => 'row-critical',
            'isKritis'   => true
        ];
    } elseif ($stok <= 7) {
        return [
            'status'     => 'Menipis',
            'label'      => 'Menipis (3-7)',
            'badgeClass' => 'badge-warning',
            'rowClass'   => 'row-warning',
            'isKritis'   => false
        ];
    } else {
        return [
            'status'     => 'Aman',
            'label'      => 'Aman (> 7)',
            'badgeClass' => 'badge-success',
            'rowClass'   => 'row-normal',
            'isKritis'   => false
        ];
    }
}

/**
 * Menghitung agregasi statistik data gudang untuk kartu indikator (KPI).
 *
 * @param array $products Daftar produk dari Data Layer
 * @return array Ringkasan metrik (total produk, unit fisik, nilai aset, jumlah produk kritis)
 */
function hitungRingkasanStatistik(array $products): array
{
    $totalItem = count($products);
    $totalUnit = 0;
    $totalKritis = 0;
    $kategoriList = [];

    foreach ($products as $product) {
        $stok = isset($product['stok']) ? (int)$product['stok'] : 0;
        $totalUnit += $stok;

        if ($stok < 3) {
            $totalKritis++;
        }

        if (!empty($product['kategori'])) {
            $kategoriList[$product['kategori']] = true;
        }
    }

    return [
        'totalItem'       => $totalItem,
        'totalUnit'       => $totalUnit,
        'totalKritis'     => $totalKritis,
        'totalKategori'   => count($kategoriList),
        'totalNilaiAset'  => hitungTotalNilaiStok($products),
    ];
}
