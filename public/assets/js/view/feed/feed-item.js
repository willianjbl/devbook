function showMenu(el) {
    el.parentNode.querySelector('.more-menu').style.display = 'block';
}

function closeMenu() {
    document.querySelectorAll('.more-menu').forEach(el => {
        el.style.display = 'none';
    });
}

document.querySelectorAll('.feed-item-head-btn img').forEach(el => {
    el.addEventListener('click', () => {
        closeMenu();
        showMenu(el);
        document.addEventListener('click', () => {
            closeMenu();
        });
    });
});
