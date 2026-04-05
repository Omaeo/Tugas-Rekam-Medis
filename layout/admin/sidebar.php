<style>
    .sidebar {
        width: 260px;
        height: 100vh;
        background: linear-gradient(180deg, #6c8cff, #4cafef);
        color: white;
        padding: 30px 20px;
        display: flex;
        flex-direction: column;
        position: fixed; /* Supaya sidebar tetap diam saat konten di-scroll */
        left: 0;
        top: 0;
        transition: all 0.3s ease;
    }

    .logo {
        font-size: 24px;
        font-weight: 800;
        margin-bottom: 40px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .menu {
        list-style: none;
        flex: 1;
    }

    .menu li {
        padding: 14px 18px;
        margin-bottom: 10px;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        align-items: center;
        gap: 15px;
        opacity: 0.8;
    }

    /* Efek Hover: Bergeser sedikit ke kanan dan lebih terang */
    .menu li:hover {
        background: rgba(255, 255, 255, 0.2);
        opacity: 1;
        transform: translateX(8px);
    }

    /* Menu Aktif */
    .menu li.active {
        background: #ffffff;
        color: #6c8cff;
        font-weight: 600;
        opacity: 1;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .menu i {
        width: 20px;
        text-align: center;
        font-size: 18px;
    }

    /* Box Profil di Bawah */
    .profile-box {
        background: rgba(255,255,255,0.15);
        padding: 20px;
        border-radius: 16px;
        text-align: center;
        backdrop-filter: blur(5px);
        border: 1px solid rgba(255,255,255,0.1);
    }

    .profile-box i {
        font-size: 40px;
        margin-bottom: 10px;
        display: block;
    }

    .logout-btn {
        margin-top: 15px;
        background: #ff5e7e;
        color: white;
        padding: 10px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        display: block;
        transition: 0.3s;
    }

    .logout-btn:hover {
        background: #ff3b61;
        transform: scale(1.05);
    }
</style>

<aside class="sidebar">
    <div class="logo">
        <i class="fa-solid fa-house-medical"></i>
        <span>Puskes</span>
    </div>

        <ul class="menu" id="sidebarMenu">
         <a href="../admin/home_admin.php" class="menu-link">
        <li class="menu-item active">
        <i class="fa-solid fa-chart-line"></i>
        <span>Dashboard</span>
        </li>
        </a>


        <li class="menu-item" onclick="pindahMenu(this)">
            <i class="fa-solid fa-hospital"></i>
            <span>Poliklinik</span>
        </li>

        <a href="../admin/data_pasien.php" class="menu-link">
        <li class="menu-item">
        <i class="fa-solid fa-hospital-user"></i>
        <span>Data Pasien</span>
        </li>
        </a>

        <a href="../admin/data_dokter.php" class="menu-link">
        <li class="menu-item" onclick="pindahMenu(this)">
            <i class="fa-solid fa-stethoscope"></i>
            <span>Dokter</span>
            </a>
        </li>
        
    </ul>

    <div class="profile-box">
        <i class="fa-solid fa-circle-user"></i>
        <p style="font-size: 14px; margin-bottom: 5px;">Admin Sistem</p>
        <a href="/Tugas-Rekam-Medis/account/logout.php" class="logout-btn">Logout</a>
    </div>
</aside>

<script>
function pindahMenu(elemen) {
    // 1. Cari semua menu yang punya class 'menu-item'
    const semuaMenu = document.querySelectorAll('.menu-item');

    // 2. Hapus class 'active' dari semua menu agar tidak double
    semuaMenu.forEach(menu => {
        menu.classList.remove('active');
    });

    // 3. Tambahkan class 'active' ke menu yang barusan diklik
    elemen.classList.add('active');

    // 4. (Opsional) Update judul di Navbar jika ada
    const judulNavbar = document.getElementById('title'); // Pastikan h2 di navbar punya id="title"
    if (judulNavbar) {
        judulNavbar.innerText = elemen.querySelector('span').innerText;
    }
}
</script>