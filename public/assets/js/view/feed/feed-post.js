let feedInput = document.querySelector('.feed-new-input');
let feedSubmit = document.querySelector('.feed-new-send');
let feedForm = document.querySelector('#feed-new-form');
let feedPicture = document.querySelector('.feed-new-picture');
let pictureForm = document.querySelector('.feed-new-picture input#post-picture');

feedSubmit.addEventListener('click', obj => {
    let value = feedInput.innerText.trim();

    if (value) {
        feedForm.querySelector('input[name="body"]').value = value;
        feedForm.submit();
    }
});

document.querySelector('.feed-new-input-placeholder').addEventListener('click', obj => {
    obj.target.style.display = 'none';
    feedInput.style.display = 'block';
    feedInput.focus();
    feedInput.innerText = '';
});

feedInput.addEventListener('blur', obj => {
    let value = obj.target.innerText.trim();
    if (!value) {
        obj.target.style.display = 'none';
        document.querySelector('.feed-new-input-placeholder').style.display = 'block';
    }
});

feedPicture.addEventListener('click', e => {
    pictureForm.click();
});

pictureForm.addEventListener('change', async e => {
    let picture = pictureForm.files[0];
    let formData = new FormData();
    
    formData.append('picture', picture);

    let req = await fetch(BASE + '/ajax/upload', {
        method: 'POST',
        body: formData
    });

    let json = await req.json();

    if (json.error) {
        console.log(json.message);
    }

    location.reload();
});
