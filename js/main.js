// main.js — SPK Prioritas Tugas

// Auto-dismiss alerts setelah 4 detik
document.querySelectorAll('.alert').forEach(alert => {
    setTimeout(() => {
        alert.style.transition = 'opacity 0.5s';
        alert.style.opacity = '0';
        setTimeout(() => alert.remove(), 500);
    }, 4000);
});

// Set datetime-local minimum = sekarang (mencegah input deadline yang sudah lewat)
const deadlineInput = document.querySelector('input[type="datetime-local"]');
if (deadlineInput && !deadlineInput.value) {
    const now = new Date();
    now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
    deadlineInput.min = now.toISOString().slice(0, 16);
}
