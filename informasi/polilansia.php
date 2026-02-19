<?php include "../layout/user/header_user.php"; ?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Poli Lansia</title>

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
body{
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(to bottom, #cdeeee, #a8d5d5);
}

.glass-card{
    background: rgba(255,255,255,0.85);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
}

.section-title{
    background:#2563eb;
    color:white;
    padding:8px 16px;
    border-radius:12px 12px 0 0;
    font-weight:600;
}
</style>
</head>
<body>

<div class="max-w-6xl mx-auto py-10 px-6">

    <!-- HEADER -->
    <div class="relative mb-10">
        <h1 class="text-3xl font-bold text-blue-900">POLI LANSIA</h1>
        <p class="text-gray-700 font-semibold">Layanan Kesehatan Lansia</p>

        <div class="hidden md:block absolute right-0 top-0 w-56 h-40 overflow-hidden rounded-xl shadow-lg">
            <img src="../assets/img/poli_lansia.png" 
                 class="w-full h-full object-cover">
        </div>
    </div>

    <!-- CONTENT GRID -->
    <div class="grid md:grid-cols-3 gap-6">

        <!-- LEFT -->
        <div class="md:col-span-2 space-y-6">

            <!-- LAYANAN PEMERIKSAAN -->
            <div class="glass-card p-6">
                <div class="section-title mb-4">Layanan Pemeriksaan</div>
                <ul class="list-disc pl-5 text-gray-700 space-y-2 text-sm">
                    <li>Pemeriksaan kesehatan rutin lansia</li>
                    <li>Pemeriksaan tekanan darah</li>
                    <li>Pemeriksaan gula darah</li>
                    <li>Pemeriksaan kolesterol</li>
                    <li>Pemeriksaan keluhan sendi dan otot</li>
                    <li>Pemeriksaan gangguan keseimbangan</li>
                </ul>

                <hr class="my-6">

                <div class="section-title mb-4 bg-pink-500">Tindakan & Pengobatan</div>
                <ul class="list-disc pl-5 text-gray-700 space-y-2 text-sm">
                    <li>Pemberian obat sesuai diagnosis</li>
                    <li>Penanganan hipertensi ringan</li>
                    <li>Penanganan diabetes terkontrol</li>
                    <li>Penanganan nyeri sendi ringan</li>
                    <li>Terapi dan edukasi gaya hidup sehat</li>
                    <li>Rujukan ke fasilitas lanjutan jika diperlukan</li>
                </ul>
            </div>

            <!-- TENAGA MEDIS -->
            <div class="glass-card p-6 bg-gradient-to-r from-teal-100 to-teal-200">
                <h3 class="font-semibold text-blue-900 mb-2">Tenaga Medis</h3>
                <ul class="list-disc pl-5 text-gray-700 text-sm">
                    <li>Dokter Umum</li>
                    <li>Perawat Terlatih Perawatan Lansia</li>
                </ul>
            </div>

            <!-- DESKRIPSI -->
            <div class="glass-card p-6">
                <p class="text-gray-700 text-sm">
                    <strong>Poli Lansia</strong> memberikan pelayanan kesehatan terpadu 
                    untuk pasien usia lanjut, mulai dari pemeriksaan rutin, 
                    pengobatan penyakit kronis ringan, hingga konsultasi 
                    gaya hidup sehat untuk meningkatkan kualitas hidup lansia.
                </p>
            </div>

        </div>

        <!-- RIGHT -->
        <div class="space-y-6">

            <!-- ALAT -->
            <div class="glass-card p-6">
                <div class="section-title mb-4">Alat Yang Digunakan</div>
                <ul class="list-disc pl-5 text-gray-700 space-y-2 text-sm">
                    <li>Tensimeter digital / manual</li>
                    <li>Alat cek gula darah</li>
                    <li>Alat cek kolesterol</li>
                    <li>Timbangan & pengukur tinggi badan</li>
                    <li>Stetoskop</li>
                    <li>Alat pemeriksaan medis dasar</li>
                </ul>
            </div>

            <!-- KONSULTASI -->
            <div class="glass-card p-6 bg-blue-100">
                <div class="section-title mb-4 bg-blue-500">Konsultasi</div>
                <ul class="list-disc pl-5 text-gray-700 space-y-2 text-sm">
                    <li>Konsultasi kesehatan lansia</li>
                    <li>Konsultasi penyakit kronis ringan</li>
                    <li>Edukasi pola makan sehat</li>
                    <li>Edukasi aktivitas fisik sesuai usia</li>
                    <li>Konsultasi tindak lanjut pengobatan</li>
                </ul>
            </div>

            <!-- Tombol Kembali -->
            <button onclick="history.back()" 
                class="inline-flex items-center gap-2 bg-white/70 backdrop-blur-md 
                       hover:bg-white text-blue-900 font-medium 
                       px-5 py-2 rounded-xl shadow-md 
                       transition duration-300 hover:scale-105">
                ← Kembali
            </button>

        </div>
    </div>

</div>

</body>
</html>

<?php include "../layout/user/footer_user.php"; ?>
