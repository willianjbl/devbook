function closeFeedMenu() {
    document.querySelectorAll('.more-menu').forEach(el =>{
        el.style.display = 'none';
    });

    document.removeEventListener('click', closeFeedMenu);
}

document.querySelectorAll('.feed-item-head-btn').forEach(el => {
    el.addEventListener('click', () => {
        closeFeedMenu();
        el.parentNode.querySelector('.more-menu').style.display = 'block';
        setTimeout(() => {
            document.addEventListener('click', closeFeedMenu);
        }, 500);
    });
});
