<?php include "../layout/user/header_user.php"; 

?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Poli Umum</title>

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">



<style>
body{
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(to bottom, #e9efff, #dcd6f7);
}

.glass-card{
    background: rgba(255,255,255,0.8);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
}

.section-title{
    background:#3b82f6;
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
        <h1 class="text-3xl font-bold text-blue-900">POLI UMUM</h1>
        <p class="text-gray-600 font-semibold">Layanan Kesehatan Umum</p>
        <div class="hidden md:block absolute right-0 top-0 w-90 h-40 overflow-hidden rounded-xl shadow-lg">
            <img src="../assets/img/poli_umum.png" class="w-48 rounded-xl shadow-lg">
        </div>

    </div>

    <!-- CONTENT GRID -->
    <div class="grid md:grid-cols-3 gap-6">

        <!-- LEFT SIDE -->
        <div class="md:col-span-2 space-y-6">

            <!-- LAYANAN PEMERIKSAAN -->
            <div class="glass-card p-6">
                <div class="section-title mb-4">Layanan Pemeriksaan</div>
                <ul class="list-disc pl-5 text-gray-700 space-y-2 text-sm">
                    <li>Pemeriksaan kesehatan umum</li>
                    <li>Pemeriksaan tekanan darah</li>
                    <li>Pemeriksaan suhu tubuh dan denyut nadi</li>
                    <li>Pemeriksaan keluhan demam, batuk, pilek</li>
                    <li>Pemeriksaan sakit kepala, pusing, dan lemas</li>
                    <li>Penanganan gangguan pencernaan ringan</li>
                    <li>Pemeriksaan luka ringan dan infeksi ringan</li>
                </ul>

                <hr class="my-6">

                <div class="section-title mb-4 bg-pink-500">Tindakan & Pengobatan</div>
                <ul class="list-disc pl-5 text-gray-700 space-y-2 text-sm">
                    <li>Pemberian obat sesuai diagnosis dokter</li>
                    <li>Penanganan penyakit ringan dan penyegahan</li>
                    <li>Perawatan luka ringan</li>
                    <li>Pemberian obat penurun demam dan nyeri</li>
                    <li>Pemberian vitamin dan suplemen bila diperlukan</li>
                    <li>Edukasi pola hidup sehat</li>
                </ul>
            </div>

            <!-- TENAGA MEDIS -->
            <div class="glass-card p-6 bg-gradient-to-r from-purple-100 to-purple-200">
                <h3 class="font-semibold text-blue-900 mb-2">Tenaga Medis</h3>
                <ul class="list-disc pl-5 text-gray-700 text-sm">
                    <li>Dokter Umum</li>
                    <li>Perawat Poli Umum</li>
                </ul>
            </div>

            <!-- DESKRIPSI -->
            <div class="glass-card p-6">
                <p class="text-gray-700 text-sm">
                    <strong>Poli Umum</strong> melayani pemeriksaan, pengobatan, dan konsultasi kesehatan umum untuk semua usia,
                    mulai dari keluhan ringan hingga tindak lanjut pengobatan.
                </p>
            </div>

        </div>

        <!-- RIGHT SIDE -->
        <div class="space-y-6">

            <!-- ALAT -->
            <div class="glass-card p-6">
                <div class="section-title mb-4">Alat Yang Digunakan</div>
                <ul class="list-disc pl-5 text-gray-700 space-y-2 text-sm">
                    <li>Tensimeter (alat ukur tekanan darah)</li>
                    <li>Termometer</li>
                    <li>Stetoskop</li>
                    <li>Alat pemeriksaan dasar medis</li>
                    <li>Alat P3K dan perawatan luka</li>
                </ul>
            </div>

            <!-- KONSULTASI -->
            <div class="glass-card p-6 bg-blue-100">
                <div class="section-title mb-4 bg-blue-500">Konsultasi</div>
                <ul class="list-disc pl-5 text-gray-700 space-y-2 text-sm">
                    <li>Konsultasi kesehatan umum</li>
                    <li>Konsultasi keluhan harian</li>
                    <li>Edukasi pencegahan penyakit</li>
                    <li>Konsultasi pola hidup sehat</li>
                    <li>Konsultasi tindak lanjut pengobatan</li>
                </ul>
            </div>

            <a href="../informasi/informasi.php" 
            class="mb-6 inline-flex items-center gap-2 bg-white/70 backdrop-blur-md 
                    hover:bg-white text-blue-900 font-medium 
                    px-5 py-2 rounded-xl shadow-md 
                    transition duration-300 hover:scale-105">

                ← Kembali
            </a>


        </div>
    </div>

</div>

</body>
</html>

<?php
include "../layout/user/footer_user.php";
?>
