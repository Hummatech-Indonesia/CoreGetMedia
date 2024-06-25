<style>
    .notification-container {
      width: 600px;
      background-color: #FFFFFF;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      position: fixed;
      padding-top: 20px;
      left: 50px;
      top: 300px;
      overflow: visible; /* Ensure the overflow is visible to show the triangle */
    }

    .triangle {
      position: absolute;
      top: 20px; /* Adjust this value to align the triangle vertically */
      left: -10px; /* Adjust this value to position the triangle */
      width: 0;
      height: 0;
      z-index: 1;
    }

    .triangle::after {
      content: "";
      position: absolute;
      top: 38px;
      left: -40px;
      width: 0;
      height: 0;
      border-top: 40px solid transparent;
      border-bottom: 40px solid transparent;
      border-right: 50px solid #FFFFFF;
      filter: drop-shadow(-5px 0 5px rgba(0, 0, 0, 0.1));
      z-index: -1;
    }

    .notification-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 12px;
      border-bottom: 1px solid #f0f0f0;
      border-top-left-radius: 8px;
      border-top-right-radius: 8px;
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      z-index: 2;
    }

    .notification-item {
      display: flex;
      align-items: center;
      padding: 12px;
      border-bottom: 1px solid #f0f0f0;
      position: relative;
    }

    .notification-item:not(:first-child) {
      margin-top: 48px;
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
    <div class="triangle"></div> <!-- Add the triangle div here -->
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
