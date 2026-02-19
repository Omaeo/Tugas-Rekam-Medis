<?php
include "layout/user/header_user.php";

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puskes Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #1e4da1;
            --soft-blue: #89b4f5;
            --bg-light: #eef2ff;
            --white: #ffffff;
            --text-dark: #2d3748;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: var(--bg-light);
            color: var(--text-dark);
            overflow-x: hidden;
        }

        /* Background Ornaments */
        /* .bg-circle {
            position: fixed;
            border-radius: 50%;
            background: rgba(137, 180, 245, 0.3);
            z-index: -1;
            filter: blur(40px);
        } */

        /* Container Utama */
        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* --- Hero Section --- */
        .hero-wrapper {
            position: relative;
            width: 100%;
            min-height: 500px; /* Sesuaikan tinggi hero */
            background: #e0eaff;
            overflow: hidden; /* Penting agar lingkaran/gambar tidak tumpah keluar */
            display: flex;
            align-items: center;
        }

        /* Layer 1: Gambar Dokter (Paling Belakang) */
        .hero-image-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        .hero-image-bg img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Ini kuncinya: Gambar menutupi area tanpa penyet/zoom paksa */
            object-position: center bottom; /* Fokus gambar di tengah bawah */
            opacity: 0.9;
        }
        .hero-content-front {
            position: relative;
            z-index: 3;
            width: 100%;
        }
        /* search */
        .search-bar {
            display: flex;
            max-width: 450px;
            background: var(--white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        .search-bar input {
            flex: 1;
            border: none;
            padding: 15px 20px;
            outline: none;
            font-family: inherit;
        }

        .search-bar button {
            background: var(--primary-blue);
            color: white;
            border: none;
            padding: 0 30px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s;
        }

        .search-bar button:hover { background: #153a7a; }

        /* --- Grid Layanan --- */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
            margin-top: 40px;
        }

        .service-card {
            background: var(--white);
            padding: 25px;
            border-radius: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 10px 25px rgba(0,0,0,0.03);
            transition: transform 0.3s;
            position: relative;
            overflow: hidden;
            min-height: 120px;
            gap: 15px;
        }

        /* Efek Glow Saat Aktif */
        .service-card.active {
            box-shadow: 0 0 15px rgba(30, 77, 161, 0.5);
            border: 2px solid #1e4da1;
        }


        .service-card:hover { transform: translateY(-5px); }

        .service-info h3 { margin: 0; font-size: 1.5rem; }
        .service-info p { margin: 8px 0 0; font-size: 0.85rem; color: #718096; width: 180px; }
        .service-card img {
            width: 120px;
            height: 90px;
            object-fit: cover;
            border-radius: 12px;
        }


        /* Variasi Warna Card (Soft Gradient) */
        .card-blue { background: linear-gradient(to right, #ffffff, #e0f2fe); }
        .card-purple { background: linear-gradient(to right, #ffffff, #f3f0ff); }
        .card-green { background: linear-gradient(to right, #ffffff, #f0fff4); }

        /* --- Jadwal Dokter --- */
        .jadwal-section { margin-top: 50px; }
        .jadwal-section h2 { margin-bottom: 5px; }
        .jadwal-section p { color: #1e4da1; font-weight: 600; margin-bottom: 20px; }

        .tabs {
            display: flex;
            background: var(--white);
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 20px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        .tab-item {
            flex: 1;
            padding: 15px;
            text-align: center;
            cursor: pointer;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: 0.3s;
            border-right: 1px solid #edf2f7;
        }

        .tab-item.active { background: var(--primary-blue); color: white; }
        .tab-item:hover:not(.active) { background: #f7fafc; }

        .jadwal-card {
            background: var(--white);
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        }

        .date-header {
            font-weight: 700;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f7fafc;
        }

        .doctor-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #f7fafc;
        }

        .doctor-row:last-child { border-bottom: none; }

        .doc-profile { display: flex; align-items: center; gap: 15px; }
        .doc-icon { font-size: 2rem; color: #2d3748; }
        .doc-name { font-weight: 700; color: var(--primary-blue); margin: 0; }
        .doc-days { font-size: 0.85rem; color: #718096; margin: 0; }

        .time-badge {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            color: var(--primary-blue);
        }

        @media (max-width: 768px) {
            .services-grid { grid-template-columns: 1fr; }
            .tabs { flex-wrap: wrap; }
            .tab-item { border-bottom: 1px solid #edf2f7; }
        }
        
        
        /* Ornamen Lingkaran Persis SS */
        .bg-circle {
        position: absolute;
        border-radius: 50%;
        z-index: 2; 
        pointer-events: none;
        }

        /* Lingkaran Biru Tua Besar di Kiri Atas */
        .circle-1 { width: 350px; height: 350px; background: #5c7c9c; top: 100px; left: 10px; opacity: 0.5; }
        /* Lingkaran Ungu Kecil */
        .circle-2 { width: 120px; height: 120px; background: #d6bcfa; bottom: 30%; left: 20%; opacity: 0.6; }
        /* Lingkaran Biru Muda Transparan */
        .circle-3 { width: 220px; height: 220px; background: #bee3f8; top: 350px; left: 220px; opacity: 0.4; }
        /* Lingkaran Besar di Kanan Atas */
        .circle-4 { width: 200px; height: 200px; background: #2c5282; top: 250px; right: -50px; opacity: 0.4; }
        /* Lingkaran di Kanan Bawah (Dekat Jadwal) */
        .circle-5 {
            width: 300px;
            height: 300px;
            background: #4a5568;
            bottom: -150px;
            right: -100px;
            opacity: 0.4;
        }
        

        @media (max-width: 992px) {
            .hero-image { display: none; } /* Hilangkan gambar di layar kecil */
            .hero { text-align: center; }
            .search-bar { margin: 0 auto; }
        }
    </style>
</head>
<body>
        
        
        <div class="bg-circle circle-3"></div>
        <div class="hero-wrapper">
    <div class="hero-image-bg">
                <img src="assets/img/group1.png" alt="Hero Background">
            </div>
            <div class="bg-circle circle-5"></div>
            <div class="bg-circle circle-1"></div>
            <div class="bg-circle circle-2"></div>
            <div class="bg-circle circle-4"></div>

        <div class="container hero-content-front">
            <section class="w-full md:w-1/2">
                <h1 class="text-5xl font-bold leading-tight">
                    Selamat Datang di <br>
                    <span class="text-[#1e4da1]">Puskes</span>
                </h1>
                <p class="mt-4 text-gray-700 text-lg font-semibold">
                    Layanan Kesehatan Terpadu untuk Anda
                </p>
                 <!--
                <div class="search-bar mt-8">
                    <input type="text" placeholder="Cari Layanan..." class="outline-none">
                    <button class="hover:bg-[#153a7a] transition-colors">Cari</button>
                </div>
                -->   
            </section>
        </div>
    </div>

    <div class="container" id="poli">
        <section class="services-grid">
            <div class="service-card card-blue cursor-pointer" onclick="pilihPoli(this, 'umum')">
                <div class="service-info">
                    <h3>Poli Umum</h3>
                    <p>Pemeriksaan Kesehatan & Pengobatan</p>
                </div>
                <img src="assets/img/poli_umum.png" alt="Poli Umum">
            </div>
            
            <div class="service-card card-blue cursor-pointer" onclick="pilihPoli(this, 'lansia')">
                <div class="service-info">
                    <h3>Poli Lansia</h3>
                    <p>Pemeriksaan Kesehatan & Pengobatan</p>
                </div>
                <img src="assets/img/poli_lansia.png" alt="Poli Lansia">
            </div>

            <div class="service-card card-purple cursor-pointer" onclick="pilihPoli(this, 'anak')">
                <div class="service-info">
                    <h3>Poli Anak</h3>
                    <p>Pemeriksaan Kesehatan & Pengobatan</p>
                </div>
                <img src="assets/img/poli_anak.png" alt="Poli Anak">
            </div>

            <div class="service-card card-green cursor-pointer" onclick="pilihPoli(this, 'gigi')">
                <div class="service-info">
                    <h3>Poli Gigi</h3>
                    <p>Pemeriksaan Gigi & Pasang Behel</p>
                </div>
                <img src="assets/img/poli_gigi.png" alt="Poli Gigi">
            </div>
        </section>

        <hr class="border-t border-blue-100 mb-6">
        
            <div class="flex justify-center mt-6">
                <a id="btnAntrian"
                href="informasi.php"
                class="hidden w-full bg-[#1e4b8a] hover:bg-[#163a6d] text-white font-bold py-3 px-10 rounded-full shadow-md transition-all duration-300 flex justify-center items-center hover:shadow-lg active:scale-[0.98]">
                    Ambil Antrian
                </a>
            </div>

        <hr class="border-t border-blue-100 mt-6">

        <section class="jadwal-section">
            <div id="jadwal">
                <h2>Jadwal Pemeriksaan Dokter</h2>

                <div class="tabs flex gap-4 mb-8">
                    <div class="tab-item active cursor-pointer flex items-center gap-2 px-4 py-2 transition-all" onclick="switchTab(this)">
                        <i class="fa-solid fa-stethoscope"></i> <span>Poli Umum</span>
                    </div>
                    <div class="tab-item cursor-pointer flex items-center gap-2 px-4 py-2 transition-all" onclick="switchTab(this)">
                        <i class="fa-solid fa-person-cane"></i> <span>Poli Lansia</span>
                    </div>
                    <div class="tab-item cursor-pointer flex items-center gap-2 px-4 py-2 transition-all" onclick="switchTab(this)">
                        <i class="fa-solid fa-baby"></i> <span>Poli Anak</span>
                    </div>
                    <div class="tab-item cursor-pointer flex items-center gap-2 px-4 py-2 transition-all" onclick="switchTab(this)">
                        <i class="fa-solid fa-tooth"></i> <span>Poli Gigi</span>
                    </div>
                </div>

                <div class="jadwal-card">
                    <div class="date-header">Senin, 26 Januari 2026</div>
                    <div class="doctor-row">
                        <div class="doc-profile">
                            <i class="fas fa-calendar-check doc-icon"></i>
                            <div>
                                <p class="doc-name">Dr. Monica, Sp.M</p>
                                <p class="doc-days">Senin-Rabu</p>
                            </div>
                        </div>
                        <div class="time-badge"><i class="far fa-clock"></i> 08:00-12:00</div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <?php
    include "layout/user/footer_user.php";
    ?>

</body>
<script>
function switchTab(element) {
    const tabs = document.querySelectorAll('.tab-item');
    tabs.forEach(tab => tab.classList.remove('active'));
    element.classList.add('active');

    const namaPoli = element.innerText.trim(); // Contoh: "Poli Anak"
    const containerJadwal = document.querySelector('.jadwal-card');

    // Tambahkan efek loading biar keren
    containerJadwal.style.opacity = '0.5';

    // Panggil Backend
    fetch(`percobaan/get_jadwal.php?poli=${encodeURIComponent(namaPoli)}`)
        .then(response => response.text())
        .then(data => {
            // Masukkan "date header" (opsional, bisa dinamis juga)
            const dateHeader = `<div class="date-header">Jadwal Hari Ini</div>`;
            containerJadwal.innerHTML = dateHeader + data;
            containerJadwal.style.opacity = '1';
        })
        .catch(error => {
            console.error('Error:', error);
            containerJadwal.innerHTML = '<p>Gagal memuat jadwal.</p>';
        });
}

function pilihPoli(element, namaPoli) {
    const cards = document.querySelectorAll('.service-card');
    const btn = document.getElementById('btnAntrian');

    // Cek apakah card yang diklik sudah aktif
    const sudahAktif = element.classList.contains('active');

    // Hapus semua active dulu
    cards.forEach(card => card.classList.remove('active'));

    if (sudahAktif) {
        // Kalau tadi sudah aktif → berarti cancel
        btn.classList.add('hidden');
        btn.href = "#";
    } else {
        // Kalau belum aktif → aktifkan
        element.classList.add('active');

        btn.classList.remove('hidden');
        btn.href = "pilihan.php?poli=" + namaPoli;

        btn.scrollIntoView({ behavior: "smooth" });
    }
}

</script>
</html>