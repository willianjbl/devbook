function setActiveTab(tab) {
    document.querySelectorAll('.tab-item').forEach(function(e){
        if(e.getAttribute('data-for') == tab) {
            e.classList.add('active');
        } else {
            e.classList.remove('active');
        }
    });
}

function showTab() {
    if(document.querySelector('.tab-item.active')) {
        let activeTab = document.querySelector('.tab-item.active').getAttribute('data-for');
        document.querySelectorAll('.tab-body').forEach(function(e){
            if(e.getAttribute('data-item') == activeTab) {
                e.style.display = 'block';
            } else {
                e.style.display = 'none';
            }
        });
    }
}

if(document.querySelector('.tab-item')) {
    showTab();
    document.querySelectorAll('.tab-item').forEach(function(e){
        e.addEventListener('click', function(r) {
            setActiveTab( r.target.getAttribute('data-for') );
            showTab();
        });
    });
}

if (document.querySelector('.like-btn')) {
    document.querySelectorAll('.like-btn').forEach(item => {
        item.addEventListener('click', e => {
            let id = item.closest('.feed-item').getAttribute('data-id');
            let count = parseInt(item.innerText);

            if (item.classList.contains('on') === false) {
                item.classList.add('on');
                item.innerText = ++count;
            } else {
                item.classList.remove('on');
                item.innerText = --count;
            }

            fetch(BASE + '/ajax/like/' + id);
        });
    });
}

if (document.querySelector('.fic-item-field')) {
    document.querySelectorAll('.fic-item-field').forEach(item => {
        item.addEventListener('keyup', async e => {
            if (e.keyCode === 13) {
                let commentCounterElement = item.closest('.feed-item').querySelector('.msg-btn');
                let commentCounter = parseInt(commentCounterElement.innerText);
                let id = item.closest('.feed-item').getAttribute('data-id');
                let txt = item.value;
                item.value = '';

                let data = new FormData();
                data.append('id', id);
                data.append('txt', txt);

                let req = await fetch(BASE + '/ajax/comment', {
                    method: 'POST',
                    body: data
                });

                let json = await req.json();

                if (!json.error) {
                    let html = '<div class="fic-item row m-height-10 m-width-20">';
                    html += '<div class="fic-item-photo">';
                    html += '<a href="' + BASE + json.data.link + '"><img src="' + BASE + json.data.avatar + '" /></a>';
                    html += '</div>';
                    html += '<div class="fic-item-info">';
                    html += '<a href="' + BASE + json.data.link + '">' + json.data.name + '</a>';
                    html += json.data.body;
                    html += '</div>';
                    html += '</div>';

                    commentCounterElement.innerText = ++commentCounter;
                    item.closest('.feed-item').querySelector('.feed-item-comments-area').innerHTML += html;
                }
            }
        });
    });
}
