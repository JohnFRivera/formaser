import { GetHost, SetTitle, SetModal } from '../../assets/js/globals.functions.js';
import { SetColumns, SetHeader, GetDefaultOpt, FillTable } from '../assets/js/globals.functions.admin.js';
SetTitle('Formaser | Pre-Inscripciones');
SetHeader('header');
const Columns = [
  "Tipo",
  "Identificación",
  "Ficha",
  "Población",
  "Empresa"
];
$.ajax({
  url: `${GetHost()}/back/modulos/gestionar_preinscritos.php`,
  dataType: 'json',
  contentType: 'application/json; charset=utf-8',
  method: 'GET',
  success: function (data) {
    console.log(data);
    let dataTable = document.getElementById('dataTable');
    SetColumns(dataTable, Columns);
    let matrizData = new Array();
    data.forEach(item => {
      matrizData.push([item.tipo, item.cedula, item.ficha, item.poblacion, item.empresa]);
    });
    FillTable(dataTable, matrizData);
    new DataTable('#dataTable', GetDefaultOpt([]));
  }
})
