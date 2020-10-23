IMask(
    document.getElementById('birthdate'), {
        mask : '00/00/0000'
    }
);

function dispararAlerta(body, status) {
    let box = document.querySelector('.flash-box');
    let flash = box.querySelector('.flash');

    flash.classList.forEach(item => {
        if (item.includes('flash-')) {
            flash.classList.remove(item);
        }
    });

    box.style.display = 'block';
    flash.classList.add(`flash-${status}`);
    flash.innerText = body;
    
    setTimeout(() => {
        closeFlashComment(box);
    }, 3500);
}

function closeFlashComment(el) {
    el.style.display = 'none';
}

let el = document.querySelector('.flash-box');
if (el && el.style.display === 'block') {
    el.addEventListener('click', () => {
        closeFlashComment(el);
    });
    setTimeout(() => {
        closeFlashComment(el);
    }, 3500);
}

function verificarCampoSenha() {
    let senha = document.querySelector('input[name="password"]');
    let reSenha = document.querySelector('input[name="repassword"]');

    if (senha.value !== reSenha.value) {
        senha.value = '';
        reSenha.value = '';
        senha.focus();
        dispararAlerta('As senhas não coincidem!', 'warning');
    }
}

document.querySelector('input[name="repassword"]').addEventListener('blur', verificarCampoSenha);
