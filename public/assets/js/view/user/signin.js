function closeFlashComment(el) {
    el.style.display = 'none';
}

document.querySelectorAll('.flash-box').forEach(el => {
    if (el.style.display === 'block') {
        el.addEventListener('click', () => {
            closeFlashComment(el);
        });
        setTimeout(() => {
            closeFlashComment(el);
        }, 3500);
    }
});
