import {
  SetInpFileContent,
  CreateAgregadosSection,
  CreateDenegadosSection
} from "./main.js";
import { GetHost, SetError, GetLoading, SetModal, CreateScript } from '../../../assets/js/globals.functions.js';
import { SetColumns, GetDefaultOpt, FillTable } from '../../assets/js/globals.functions.admin.js';
const Columns = [
  "Tipo",
  "Identificación",
  "Ficha",
  "Código Empresa",
  "Descripción",
];
document.getElementById('inputFile').addEventListener("change", () => {
  SetInpFileContent();
  let btnSubir = document.getElementById("btnSubir");
  btnSubir.addEventListener("click", () => {
    btnSubir.innerHTML = GetLoading();
    const file = document.getElementById('inputFile').files[0]; //? Obtener el primer archivo seleccionado
    if (file != undefined) {
      // Se crea un objeto FormData y le agrega archivo
      let formData = new FormData();
      formData.append("archivotExcel", file);
      // Se envía el formulario usando Fetch
      fetch(`${GetHost()}/back/modulos/leerExcel.php`, {
        method: "POST",
        body: formData,
      })
        .then((response) => response.json())
        .then((data) => {
          document.getElementById(`inpFileContent`).innerHTML = `
          <div class="fs-5 py-3">
              <i class="bi bi-upload me-2"></i>
              Seleccionar Archivo
          </div>
          `;
          document.getElementById("sectionTables").innerHTML = `
          <hr>
          <!--TABLA-->
          `;
          // Verifico primero si en el JSON hay un Objeto llamdos "error" si lo hay es porque hubo un error y no se puede ejecutar
          if (data.error != undefined) {
            console.log(data.error);
            /*
             ! MENSAJE DE ERROR POR SI OCURRE UN FALLO CON EL ARCHIVO
             */
            SetError('lblErr', data.error[0].descripcion);
          } else {
            /*
             *  SE AGREGAN LOS USUARIOS REGISTRADOS
             */
            if (data.registrado != undefined) {
              console.log(data.registrado);
              // Se crea la tabla
              CreateAgregadosSection();
              let dtAgregados = document.getElementById('dtAgregados');
              SetColumns(dtAgregados, Columns);
              // Se agregan las filas
              let matrizAgregados = new Array();
              data.registrado.forEach((element) => {
                matrizAgregados.push([element.tipoDocumento, element.cedula, element.numeroFicha, element.codigoEmpresa, element.razones]);
              });
              FillTable(dtAgregados, matrizAgregados);
              new DataTable('#dtAgregados', GetDefaultOpt([]));
            }
            /*
             !  SE AGREGAN LOS USUARIOS DENEGADOS
             */
            if (data.no_aceptados != undefined) {
              console.log(data.no_aceptados);
              // Se crea la tabla
              CreateDenegadosSection();
              let dtDenegados = document.getElementById('dtDenegados');
              SetColumns(dtDenegados, Columns);
              // Se agregan las filas
              let matrizDenegados = new Array();
              data.no_aceptados.forEach((element) => {
                matrizDenegados.push([element.tipoDocumento, element.cedula, element.numeroFicha, element.codigoEmpresa, element.razones]);
              });
              FillTable(dtDenegados, matrizDenegados);
              new DataTable('#dtDenegados', GetDefaultOpt([]));
            }
          }
        })
        .catch((err) => {
          document.getElementById(`inpFileContent`).innerHTML = `
          <div class="fs-5 py-3">
              <i class="bi bi-upload me-2"></i>
              Seleccionar Archivo
          </div>
          `;
          SetModal(`
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5 text-danger" id="staticBackdropLabel">Formato Incorrecto</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <b>Los parametros no coinciden</b>, por favor <b>verifica el archivo</b> que subiste<br>${err}
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btnReload">Aceptar</button>
              </div>
            </div>
          </div>
          `);
          document.getElementById('btnReload').addEventListener('click', () => {
            window.location.reload();
          });
          const modal = new bootstrap.Modal('#staticBackdrop');
          modal.show();
        });
    }
  });
});