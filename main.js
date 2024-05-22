import { GetHost, SetTitle, CreateCss, CreateScript, SetFooter, SetError, GetLoading } from './assets/js/globals.functions.js';
SetTitle('Formaser | Iniciar Sesión');
CreateCss(`${GetHost()}/assets/css/styles.css`);
document.getElementById('showPass').addEventListener('click', (ev)=>{
    let pass = document.getElementById('password');
    let icon = '';
    if (pass.type == 'password') {
        pass.type = 'text';
        icon = `<i class="bi bi-eye-slash fs-4"></i>`;
    } else {
        pass.type = 'password';
        icon = `<i class="bi bi-eye fs-4"></i>`;
    };
    switch (ev.target.tagName) {
        case 'BUTTON':
            ev.target.innerHTML = icon;
            break;
        case 'I':
            ev.target.parentNode.innerHTML = icon;
            break;
    };
});
let btnEntrar = document.getElementById('btnEntrar');
btnEntrar.addEventListener('click', ()=>{
    btnEntrar.innerHTML = GetLoading();
    let form = document.querySelector('form');
    if (form.reportValidity()) {
        let formData = new FormData(form);
        fetch(`${GetHost()}/back/controller/login/login.php`, {
            method: 'post',
            body: formData
        }).then(response => response.json())
        .then(data => {
            if (data.Code == '200') {
                window.location.href = GetHost() + data.Route;
            } else {
                SetError('lblErr', data.Error);
            }
        }).catch(err => {
            SetError('lblErr', err);
        })
    } else {
        SetError('lblErr', 'Verifica los campos');
    };
    btnEntrar.innerHTML = `
    <i class="bi bi-box-arrow-in-right"></i>
    Entrar
    `;
});
SetFooter('footer');