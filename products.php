<?php
/**
 * Data Layer: Berkas Sumber Data Komoditas Produk
 * 
 * Modul: Pemrograman Web - Pertemuan 2 (Mini Project 1: Product Information System)
 * Komponen: Data Layer
 * 
 * Deskripsi:
 * Menyimpan data komoditas produk dalam bentuk array multidimensi (multidimensional array)
 * yang memuat atribut: id, nama, kategori, harga, stok, dan deskripsi.
 */

$products = [
    [
        'id'        => 'PRD-001',
        'nama'      => 'Laptop Asus ZenBook 14 OLED',
        'kategori'  => 'Komputer & Laptop',
        'harga'     => 18500000,
        'stok'      => 4,
        'deskripsi' => 'Laptop ultra-thin dengan layar 2.8K 90Hz OLED, Intel Core Ultra 7, dan baterai tahan 15 jam.'
    ],
    [
        'id'        => 'PRD-002',
        'nama'      => 'Mouse Wireless Logitech MX Master 3S',
        'kategori'  => 'Aksesoris PC',
        'harga'     => 1499000,
        'stok'      => 1, // Kritis (< 3)
        'deskripsi' => 'Mouse ergonomis presisi tinggi dengan sensor 8000 DPI Quiet Clicks dan scrolling MagSpeed.'
    ],
    [
        'id'        => 'PRD-003',
        'nama'      => 'Keyboard Mekanikal Keychron K2 V2',
        'kategori'  => 'Aksesoris PC',
        'harga'     => 1250000,
        'stok'      => 8,
        'deskripsi' => 'Keyboard wireless mechanical 75% layout dengan Gateron G Pro Switch dan RGB backlight.'
    ],
    [
        'id'        => 'PRD-004',
        'nama'      => 'Monitor Dell UltraSharp 27" 4K (U2723QE)',
        'kategori'  => 'Monitor & Display',
        'harga'     => 8750000,
        'stok'      => 2, // Kritis (< 3)
        'deskripsi' => 'Monitor profesional IPS Black technology dengan 100% sRGB, 98% DCI-P3, dan koneksi USB-C Hub 90W.'
    ],
    [
        'id'        => 'PRD-005',
        'nama'      => 'Headphone ANC Sony WH-1000XM5',
        'kategori'  => 'Audio & Hiburan',
        'harga'     => 4499000,
        'stok'      => 5,
        'deskripsi' => 'Headphone premium peredam bising terbaik dengan dua prosesor V1/QN1 dan 8 mikrofon beamforming.'
    ],
    [
        'id'        => 'PRD-006',
        'nama'      => 'SSD Eksternal Samsung T7 Shield 1TB',
        'kategori'  => 'Penyimpanan Data',
        'harga'     => 1890000,
        'stok'      => 12,
        'deskripsi' => 'Portable NVMe SSD berkecepatan transfer hingga 1050 MB/s dengan proteksi tahan air & debu IP65.'
    ],
    [
        'id'        => 'PRD-007',
        'nama'      => 'Webcam Logitech Brio 4K Pro',
        'kategori'  => 'Aksesoris PC',
        'harga'     => 2650000,
        'stok'      => 2, // Kritis (< 3)
        'deskripsi' => 'Webcam ultra HD 4K dengan sensor HDR RightLight 3 dan dukungan otentikasi Windows Hello wajah.'
    ],
    [
        'id'        => 'PRD-008',
        'nama'      => 'Kursi Ergonomis ErgoPlus Elite Pro',
        'kategori'  => 'Perabot Kantor',
        'harga'     => 3400000,
        'stok'      => 7,
        'deskripsi' => 'Kursi kerja ergonomis dengan penopang lumbal adaptif 3D, sandaran kepala dinamis, dan jaring mesh breathable.'
    ],
    [
        'id'        => 'PRD-009',
        'nama'      => 'Docking Station Anker PowerExpand 13-in-1',
        'kategori'  => 'Aksesoris PC',
        'harga'     => 2100000,
        'stok'      => 0, // Kritis (< 3 / Habis)
        'deskripsi' => 'USB-C Docking Station multi-port dengan dual HDMI, DisplayPort, Ethernet Gigabit, dan pengisian daya 85W.'
    ],
    [
        'id'        => 'PRD-010',
        'nama'      => 'Smart LED Desk Lamp Xiaomi Pro',
        'kategori'  => 'Pencahayaan & Aksesoris',
        'harga'     => 699000,
        'stok'      => 15,
        'deskripsi' => 'Lampu meja pintar fleksibel dengan pengaturan suhu warna luas (2700K - 4800K) dan sertifikasi bebas flicker.'
    ]
];
