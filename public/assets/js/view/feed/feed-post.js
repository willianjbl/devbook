let feedInput = document.querySelector('.feed-new-input');
let feedSubmit = document.querySelector('.feed-new-send');
let feedForm = document.querySelector('#feed-new-form');

feedSubmit.addEventListener('click', (obj) => {
    let value = feedInput.innerText.trim();

    if (value) {
        feedForm.querySelector('input[name="body"]').value = value;
        feedForm.submit();
    }
});
