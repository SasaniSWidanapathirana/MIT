// Toggle profile dropdown and close when clicking outside or pressing Escape
(function() {
  document.addEventListener('DOMContentLoaded', function() {
    const dropdown = document.querySelector('.profile-dropdown');
    if (!dropdown) return;

    const btn = dropdown.querySelector('.profile-btn');
    const menu = dropdown.querySelector('.dropdown-menu');

    // Toggle on button click
    btn.addEventListener('click', function(e) {
      e.stopPropagation();
      dropdown.classList.toggle('active');
    });

    // Clicks inside the menu should not close immediately
    if (menu) {
      menu.addEventListener('click', function(e) {
        e.stopPropagation();
      });
    }

    // Close when clicking outside
    document.addEventListener('click', function() {
      dropdown.classList.remove('active');
    });

    // Close on Escape
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape' || e.key === 'Esc') {
        dropdown.classList.remove('active');
      }
    });
  });
})();
