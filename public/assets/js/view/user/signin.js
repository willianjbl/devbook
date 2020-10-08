document.querySelectorAll('.flash').forEach(el => {
    el.addEventListener('click', (e) => {
        el.style.display = 'none';
    });
});
