const toggleButtons = document.querySelectorAll('.toggle-button');
        
        toggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                const fileSetting = this.nextElementSibling; // Mengambil elemen file_setting setelah tombol
                if (fileSetting.style.display === 'none' || fileSetting.style.display === '') {
                    fileSetting.style.display = 'block'; // Menampilkan elemen
                    fileSetting.style.opacity = 0; // Mulai dari transparan
                    setTimeout(() => { fileSetting.style.opacity = 1; }, 10); // Animasi
                } else {
                    fileSetting.style.opacity = 0; // Mulai dari transparan
                    setTimeout(() => { fileSetting.style.display = 'none'; }, 300); // Sembunyikan setelah animasi
                }
            });
        });