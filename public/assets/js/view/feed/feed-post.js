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

document.querySelector('.feed-new-input-placeholder').addEventListener('click', function(obj){
    obj.target.style.display = 'none';
    feedInput.style.display = 'block';
    feedInput.focus();
    feedInput.innerText = '';
});

feedInput.addEventListener('blur', function(obj) {
    let value = obj.target.innerText.trim();
    if(value == '') {
        obj.target.style.display = 'none';
        document.querySelector('.feed-new-input-placeholder').style.display = 'block';
    }
});
