import { GetHost, SetTitle, GetLoading, SetModal, SetError } from '../../assets/js/globals.functions.js';
import { SetHeader } from '../assets/js/globals.functions.admin.js';
SetTitle('Formaser | Usuarios');
SetHeader('header');
let btnAgregar = document.getElementById('btnAgregar');
btnAgregar.addEventListener('click', () => {
    if (document.querySelector('form').reportValidity()) {
        btnAgregar.innerHTML = GetLoading();
        let formData = new FormData(document.querySelector('form'));
        let obj = new Object;
        formData.forEach((value, key) => {
            obj[key] = value;
        });
        console.log(obj);
        $.ajax({
            data: obj,
            url: `${GetHost()}/back/modulos/registro.php`,
            method: 'POST',
            success: function (data) {
                let datos = JSON.parse(data);
                if (datos.error == undefined) {
                    SetModal(`
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5 text-danger" id="staticBackdropLabel">¡Felicitaciones!</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Usuario agregado correctamente.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Aceptar</button>
                        </div>
                        </div>
                    </div>
                    `);
                    const modal = new bootstrap.Modal("#staticBackdrop");
                    modal.show();
                    document.getElementById('identificacion').value = '';
                    document.getElementById('nombre').value = '';
                    document.getElementById('apellido').value = '';
                    document.getElementById('correo').value = '';
                    document.getElementById('password').value = '';
                } else {
                    SetError('lblErr', datos.error[0].Des);
                }
                btnAgregar.innerHTML = 'Agregar';
            },
            error: function (err) {
                console.error(err);
                btnAgregar.innerHTML = 'Agregar';
            }
        });
    };
});