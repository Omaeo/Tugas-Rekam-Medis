<footer id="kontak" class="text-white pt-5" style="background-color: #0d1b2a;">
  <div class="container">

    <div class="row gy-4">

      <!-- Kontak Kami -->
      <div class="col-md-6 col-lg-4">
      </div>

    </div>

    <hr class="border-light my-4">

    <!-- Copyright -->
    <div class="text-center text-secondary pb-3">
      © 2026 Puskes — All Rights Reserved
    </div>

  </div>
</footer>

<script>
    const currentPath = window.location.pathname;
    const navLinks = document.querySelectorAll('.nav-links a');

    navLinks.forEach(link => {
        link.classList.remove('active');

        if (currentPath.includes(link.getAttribute('href'))) {
            link.classList.add('active');
        }
    });

    if (currentPath.endsWith('/') || currentPath.includes('home.php')) {
        const homeLink = document.querySelector('a[href="home.php"]');
        if (homeLink) homeLink.classList.add('active');
    }

    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');
        if (!navbar) return;

        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
</script>
