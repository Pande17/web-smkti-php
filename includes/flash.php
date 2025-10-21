<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// support kedua key agar backward-compatible
$flash = $_SESSION['flash_message'] ?? ($_SESSION['message'] ?? null);

if ($flash) {
    // output markup popup (menggunakan class CSS yang sudah ada di style.css)
    echo '<div id="notification" class="popup-container" aria-live="polite" role="status">
            <div class="popup-notification">
                <div class="success-icon"><i class="fas fa-check"></i></div>
                <div class="popup-message">'.htmlspecialchars($flash).'</div>
            </div>
          </div>';
    // js show & auto-hide
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            var notification = document.getElementById('notification');
            if (!notification) return;
            notification.classList.add('show');
            setTimeout(function() {
                notification.classList.remove('show');
                setTimeout(function(){ if(notification.parentNode) notification.parentNode.removeChild(notification); }, 300);
            }, 3000);
        });
    </script>";
    unset($_SESSION['flash_message'], $_SESSION['message']);
}
?>