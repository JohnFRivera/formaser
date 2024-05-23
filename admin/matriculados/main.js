import { GetHost, SetTitle, SetModal } from '../../assets/js/globals.functions.js';
import { SetColumns, SetHeader, GetDefaultOpt, FillTable } from '../assets/js/globals.functions.admin.js';
SetTitle('Formaser | Matriculados');
SetHeader('header');
const Columns = [
  "Identificación",
  "Aprendiz",
  "Ficha",
  "Programa",
  "Estado"
];
$.ajax({
  url: `${GetHost()}/back/modulos/gestionar_matriculados.php`,
  dataType: 'json',
  contentType: 'application/json; charset=utf-8',
  method: 'GET',
  success: function (data) {
    console.log(data);
    let dataTable = document.getElementById('dataTable');
    SetColumns(dataTable, Columns);
    let matrizData = new Array();
    data.forEach(item => {
      matrizData.push([item.cedula, item.nombre, item.ficha, item.programa, item.estado]);
    });
    FillTable(dataTable, matrizData);
    new DataTable('#dataTable', GetDefaultOpt([]));
  }
})