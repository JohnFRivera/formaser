import { GetHost, SetTitle, SetModal } from '../../assets/js/globals.functions.js';
import { SetColumns, SetHeader, GetDefaultOpt, FillTable } from '../assets/js/globals.functions.admin.js';
SetTitle('Formaser | Usuarios');
SetHeader('header');
const Columns = [
    "Identificación",
    "Nombre",
    "Apellido",
    "Correo"
];
$.ajax({
    url: `${GetHost()}/back/modulos/usuarios.php`,
    dataType: 'json',
    contentType: 'application/json; charset=utf-8',
    method: 'GET',
    success: function (data) {
        let dataTable = document.getElementById('dataTable');
        SetColumns(dataTable, Columns);
        let matrizData = new Array();
        data.forEach(item => {
            matrizData.push([item.id, item.Nombre, item.Apellido, item.Correo]);
        });
        FillTable(dataTable, matrizData);
        new DataTable('#dataTable', GetDefaultOpt([]));
    }
})