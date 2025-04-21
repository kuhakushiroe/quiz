<nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="auto">
    <div class="container">
        <a class="navbar-brand" href="/">E-QUESTION</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">BANK SOAL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">UJIAN</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">HISTORI</a>
                </li>
            </ul>
            <div class="d-flex">
                <a href="{{ route('logout') }}" class="btn btn-danger btn-sm">
                    <i class='bi bi-box-arrow-left'></i> Logout
                </a>

                <!-- Tombol untuk mengubah tema -->
                <button id="theme-toggle" class="btn btn-outline-secondary btn-sm ms-2">
                    <i id="theme-icon" class="bi bi-brightness-high"></i> <!-- Ikon Matahari (terang) -->
                </button>
            </div>
        </div>
    </div>
</nav>

<script>
    // Memastikan tema diset berdasarkan localStorage saat halaman dimuat
    const navbar = document.querySelector('.navbar');
    const savedTheme = localStorage.getItem('theme');
    const themeIcon = document.getElementById('theme-icon'); // Ikon tema (bulan/matahari)

    if (savedTheme) {
        navbar.setAttribute('data-bs-theme', savedTheme);
        if (savedTheme === 'dark') {
            themeIcon.classList.remove('bi-brightness-high'); // Hapus ikon matahari
            themeIcon.classList.add('bi-moon'); // Tambah ikon bulan
        }
    }

    // Mendapatkan tombol untuk mengubah tema
    const themeToggleButton = document.getElementById('theme-toggle');

    // Menambahkan event listener untuk tombol
    themeToggleButton.addEventListener('click', function() {
        const currentTheme = navbar.getAttribute('data-bs-theme');

        // Mengubah tema dan menyimpan preferensi di localStorage
        if (currentTheme === 'dark') {
            navbar.setAttribute('data-bs-theme', 'light');
            localStorage.setItem('theme', 'light');

            // Ubah ikon ke matahari
            themeIcon.classList.remove('bi-moon');
            themeIcon.classList.add('bi-brightness-high');
        } else {
            navbar.setAttribute('data-bs-theme', 'dark');
            localStorage.setItem('theme', 'dark');

            // Ubah ikon ke bulan
            themeIcon.classList.remove('bi-brightness-high');
            themeIcon.classList.add('bi-moon');
        }
    });
</script>
