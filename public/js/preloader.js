window.onload = function() {
    // Mengecek apakah preloader sudah pernah ditampilkan dalam sesi ini
    if (!sessionStorage.getItem('preloaderDisplayed')) {
        // Jika belum pernah ditampilkan dalam sesi ini, tampilkan preloader
        setTimeout(function() {
            var loader = document.querySelector('.preloader-container');
            loader.classList.add("active_new");

            // Menyimpan status preloader di sessionStorage
            sessionStorage.setItem('preloaderDisplayed', 'true');
        }, 2000);

        const spans = document.querySelectorAll('.preloader-text span');
        spans.forEach((span, index) => {
            setTimeout(() => {
                span.style.opacity = '1';
                span.style.animation = 'expandWidth 10s forwards, fadeOut 5s forwards';
            }, index * 200);
        });
    } else {
        // Jika preloader sudah pernah ditampilkan dalam sesi ini, langsung sembunyikan
        var loader = document.querySelector('.preloader-container');
        if (loader) {
            loader.style.display = 'none';
        }
    }
};
