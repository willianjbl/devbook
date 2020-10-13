IMask(
    document.getElementById('birthdate'), {
        mask : '00/00/0000'
    }
);

function verificarCampoSenha() {
    let senha = document.querySelector('input[name="password"]');
    let reSenha = document.querySelector('input[name="repassword"]');

    if (senha.value !== reSenha.value) {
        reSenha.value = '';
        alert('as senhas não coincidem.');
    }
}

document.querySelector('input[name="repassword"]').addEventListener('blur', verificarCampoSenha);
