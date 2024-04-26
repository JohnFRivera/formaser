import { SetInpFileContent, CreateTableAgregados, CreateTableDenegados, SetColumns } from './main.js';

const Columns = [
  'Identificación',
  'Nombre',
  'Ficha',
  'Estado',
  'Descripción'
];
const dtOption = {
  response: true,
  language: {
    entries: {
      _: "Aprendices",
      1: "Aprendices",
    },
    emptyTable: "No hay ningún dato",
    info: "_START_ a _END_ de _TOTAL_ _ENTRIES_",
    infoEmpty: "0 Aprendices",
  },
  lengthMenu: [10, 20, 30, 40],
  columnDefs: [{ orderable: false, targets: 4 }],
  order: [[1, "asc"]],
};

document.querySelector('input[type="file"]').addEventListener('input', () => {
  SetInpFileContent();
  let btnSubir = document.getElementById("btnSubir");
  btnSubir.addEventListener('click', () => {
    btnSubir.innerHTML = `
    <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
    <span role="status">Cargando...</span>
    `;
    const file = document.querySelector('input[type="file"]').files[0]; //? Obtener el primer archivo seleccionado
    console.log(file);
    if (file != undefined) {
      // Se crea un objeto FormData y le agrega archivo
      let formData = new FormData();
      formData.append("archivotExcel", file);
      // Se envía el formulario usando Fetch
      fetch(`${window.location.origin}/formaser/back/modulos/segundoFormato.php`, {
        method: "POST",
        body: formData,
      })
        .then((response) => response.json())
        .then((data) => {
          document.getElementById(`inpFileContent`).innerHTML = `
          <div class="fs-5 py-3">
              <svg xmlns="http://www.w3.org/2000/svg" width="16"
                  height="16" fill="currentColor" class="mb-1 me-1"
                  viewBox="0 0 16 16">
                  <path
                      d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                  <path
                      d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708z" />
              </svg>
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
            document.getElementById("lblError").innerHTML = `
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>Hubo un error!</strong> No has subido ningun Archivo.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>`;
          } else {
            /*
             *  SE AGREGAN LOS USUARIOS REGISTRADOS
             */
            if (data.updateExito != undefined) {
              console.log(data.updateExito);
              // Se crea la tabla
              CreateTableAgregados();
              SetColumns('theadAgregados', Columns);
              // Se agregan las filas
              var tbodyAgregados = document.getElementById("tbodyAgregados");
              tbodyAgregados.innerHTML = ""; //? SE VACÍA LA TABLA ANTES DE AGREGAR
              data.updateExito.forEach((subArray) => {
                console.log(subArray[0].cedula);
                tbodyAgregados.innerHTML += `
                <tr>
                  <td>${subArray[0].cedula}</td>
                  <td>${subArray[0].nombre} </td>
                  <td>${subArray[0].codigoFicha}</td>
                  <td>${subArray[0].estado}</td>
                  <td>${subArray[0].descripcion}</td>
                </tr>
                `;
              });
              new DataTable("#dtAgregados", dtOption);
            };
            /*
             !  SE AGREGAN LOS USUARIOS DENEGADOS
             */
            if (data.updateDenegado != undefined) {
              console.log(data.updateDenegado);
              // Se crea la tabla
              CreateTableDenegados();
              SetColumns('theadDenegados', Columns);
              // Se agregan las filas
              var tbodyDenegados = document.getElementById("tbodyDenegados");
              tbodyDenegados.innerHTML = ""; //? SE VACÍA LA TABLA ANTES DE AGREGAR
              data.updateDenegado.forEach((subArray) => {
                console.log(subArray[0].cedula);
                tbodyDenegados.innerHTML += `
                <tr>
                  <td>${subArray[0].cedula}</td>
                  <td>${subArray[0].nombre}</td>
                  <td>${subArray[0].codigoFicha}</td>
                  <td>${subArray[0].estado}</td>
                  <td>${subArray[0].descripcion}</td>
                </tr>
                `;
              });
              new DataTable("#dtDenegados", dtOption);
            };
          };
        })
        .catch((error) => {
          console.log("Error:", error);
        });
    };
  });
});