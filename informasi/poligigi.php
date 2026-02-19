<?php include "../layout/user/header_user.php"; ?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Poli Gigi</title>

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
        <h1 class="text-3xl font-bold text-blue-900">POLI GIGI</h1>
        <p class="text-gray-700 font-semibold">Layanan Kesehatan Gigi</p>

        <div class="hidden md:block absolute right-0 top-0 w-56 h-40 overflow-hidden rounded-xl shadow-lg">
            <img src="../assets/img/poli_gigi.png" 
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
                    <li>Pemeriksaan kesehatan gigi dan mulut</li>
                    <li>Pemeriksaan gigi berlubang</li>
                    <li>Pemeriksaan gusi berdarah dan bengkak</li>
                    <li>Pemeriksaan plak dan karang gigi</li>
                    <li>Pemeriksaan nyeri gigi dan mulut</li>
                    <li>Pemeriksaan infeksi gigi dan gusi</li>
                </ul>

                <hr class="my-6">

                <div class="section-title mb-4 bg-pink-500">Tindakan & Pengobatan</div>
                <ul class="list-disc pl-5 text-gray-700 space-y-2 text-sm">
                    <li>Pembersihan karang gigi (scaling)</li>
                    <li>Penambalan gigi berlubang</li>
                    <li>Pencabutan gigi (sesuai indikasi)</li>
                    <li>Pemberian obat nyeri dan infeksi gigi</li>
                    <li>Penanganan radang gusi ringan</li>
                    <li>Edukasi perawatan gigi dan mulut</li>
                </ul>
            </div>

            <!-- TENAGA MEDIS -->
            <div class="glass-card p-6 bg-gradient-to-r from-teal-100 to-teal-200">
                <h3 class="font-semibold text-blue-900 mb-2">Tenaga Medis</h3>
                <ul class="list-disc pl-5 text-gray-700 text-sm">
                    <li>Dokter Gigi</li>
                    <li>Perawat / Asisten Dokter Gigi</li>
                </ul>
            </div>

            <!-- DESKRIPSI -->
            <div class="glass-card p-6">
                <p class="text-gray-700 text-sm">
                    <strong>Poli Gigi</strong> melayani pemeriksaan, perawatan, dan konsultasi 
                    kesehatan gigi dan mulut untuk semua usia, mulai dari pencegahan 
                    hingga pengobatan gangguan gigi dan gusi.
                </p>
            </div>

        </div>

        <!-- RIGHT -->
        <div class="space-y-6">

            <!-- ALAT -->
            <div class="glass-card p-6">
                <div class="section-title mb-4">Alat Yang Digunakan</div>
                <ul class="list-disc pl-5 text-gray-700 space-y-2 text-sm">
                    <li>Dental unit</li>
                    <li>Kaca mulut dan sonde</li>
                    <li>Alat scaling (manual / ultrasonic)</li>
                    <li>Bor gigi</li>
                    <li>Lampu pemeriksaan gigi</li>
                    <li>Alat sterilisasi medis</li>
                </ul>
            </div>

            <!-- KONSULTASI -->
            <div class="glass-card p-6 bg-blue-100">
                <div class="section-title mb-4 bg-blue-500">Konsultasi</div>
                <ul class="list-disc pl-5 text-gray-700 space-y-2 text-sm">
                    <li>Konsultasi kesehatan gigi dan mulut</li>
                    <li>Konsultasi nyeri gigi</li>
                    <li>Edukasi cara menyikat gigi yang benar</li>
                    <li>Konsultasi pencegahan gigi berlubang</li>
                    <li>Konsultasi tindak lanjut perawatan gigi</li>
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
