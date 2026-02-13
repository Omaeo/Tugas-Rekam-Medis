<?php
// Contoh data dummy
$data_jadwal = [
    'Poli Umum' => [
        ['nama' => 'Dr. Monica, Sp.M', 'hari' => 'Senin-Rabu', 'jam' => '08:00-12:00'],
        ['nama' => 'Dr. Andi, Sp.PD', 'hari' => 'Kamis-Sabtu', 'jam' => '09:00-13:00']
    ],
    'Poli Anak' => [
        ['nama' => 'Dr. Rina, Sp.A', 'hari' => 'Senin-Jumat', 'jam' => '10:00-14:00']
    ],
    'Poli Gigi' => [
        ['nama' => 'Drg. Budi', 'hari' => 'Selasa & Kamis', 'jam' => '08:00-11:00']
    ],
    'Poli Lansia' => [
        ['nama' => 'Dr. Siti, Sp.OG', 'hari' => 'Rabu', 'jam' => '08:00-12:00']
    ]
];

$poli = $_GET['poli'] ?? 'Poli Umum';
$jadwal_terpilih = $data_jadwal[$poli] ?? [];

if (!empty($jadwal_terpilih)) {
    foreach ($jadwal_terpilih as $row) {
        echo '
        <div class="doctor-row">
            <div class="doc-profile">
                <i class="fas fa-calendar-check doc-icon"></i>
                <div>
                    <p class="doc-name">' . $row['nama'] . '</p>
                    <p class="doc-days">' . $row['hari'] . '</p>
                </div>
            </div>
            <div class="time-badge"><i class="far fa-clock"></i> ' . $row['jam'] . '</div>
        </div>';
    }
} else {
    echo '<p class="text-center text-gray-400">Jadwal tidak ditemukan.</p>';
}
?>