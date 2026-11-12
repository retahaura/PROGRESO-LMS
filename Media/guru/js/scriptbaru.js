const sidebar = document.querySelector('.sidebar');
const toggleBtn = document.getElementById('toggleBtn');
const mainContent = document.querySelector('.main-content');
// const logoIcon = document.getElementById('logoIcon'); // penting!

toggleBtn.addEventListener('click', () => {
  sidebar.classList.toggle('collapsed');

  if (sidebar.classList.contains('collapsed')) {
    logoIcon.classList.remove('fa-code');
    logoIcon.classList.add('fa-bars');
  } else {
    logoIcon.classList.remove('fa-bars');
    logoIcon.classList.add('fa-code');
  }
});

