<style>
    .notification-container {
      width: 600px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
      position: fixed;
      padding-top: 20px;
      left: 50px; /* Penyesuaian posisi */
      top: 400px; /* Penyesuaian posisi */
    }

    .notification-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 12px;
      border-bottom: 1px solid #f0f0f0;
      border-top-left-radius: 8px;
      border-top-right-radius: 8px;
      position: absolute; /* Menempatkan header secara absolut */
      top: 0; /* Memposisikan header di bagian atas */
      left: 0; /* Memposisikan header di bagian kiri */
      right: 0; /* Membuat header memenuhi lebar container */
      z-index: 2; /* Menetapkan z-index header lebih tinggi */
    }

    .notification-item {
      display: flex;
      align-items: center;
      padding: 12px;
      border-bottom: 1px solid #f0f0f0;
      position: relative;
    }

    .notification-item:not(:first-child) {
      margin-top: 48px; /* Menambahkan jarak atas antar item notifikasi */
    }

    .close-button {
      border: none;
      background: none;
    }

    .notification-footer {
      padding: 12px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 1px solid #f0f0f0;
      border-bottom-left-radius: 8px;
      border-bottom-right-radius: 8px;
    }

    .notification-footer a {
      color: #007bff;
      text-decoration: none;
    }

    .notification-footer a:hover {
      text-decoration: underline;
    }
    </style>

    <div class="notification-container ms-5">
        <div class="notification-header">
            <h7>3 Berita Terbaru</h7>
            <button class="close-button" id="close">
                X
            </button>
        </div>
        <div class="notification-item ms-3">
            <div class="profile-image">
                <img src="{{ asset('user/dist/images/profile/user-1.jpg') }}" class="mb-2" alt="Image" width="100" height="100" style="min-width: 40px;border-radius: 50%;object-fit:cover;min-height: 40px;">
            </div>
            <div class="notification-content ms-4">
                <h5>gak usah sok luluran buku berumamo</h5>
                <p>15 min. ago</p>
            </div>
        </div>
        <div class="notification-footer">
            <h7>2 Berita Terbaru</h7>
            <a href="#">Lihat Selengkapnya ></a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var notificationContainer = document.querySelector('.notification-container');
            var closeButton = document.querySelector('.close-button');

            closeButton.addEventListener('click', function() {
                notificationContainer.style.display = 'none';
            });
        });
    </script>
