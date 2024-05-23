import {
  GetHost,
  CreateCss,
  CreateScript,
  SetFooter
} from "../../../assets/js/globals.functions.js";
CreateCss(`${GetHost()}/admin/assets/css/style.css`);
//header
const SetHeader = (id) => {
  document.getElementById(id).innerHTML = `
  <nav class="navbar navbar-expand-lg bg-body px-5 shadow">
      <div class="container-fluid">
          <img class="img-fluid me-4" src="${GetHost()}/assets/img/sena-logo.png" alt="sena_logo">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
              <ul class="navbar-nav gap-3">
                  <li class="nav-item">
                      <a class="nav-link fs-4 fw-semibold d-flex align-items-center" aria-current="page" href="${GetHost()}/admin/subir_archivos/pre-inscritos.php">
                          <i class="bi bi-cloud-arrow-up-fill fs-3 me-2"></i>
                          Subir Archivos
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link fs-4 fw-semibold d-flex align-items-center" href="${GetHost()}/admin/usuarios/">
                          <i class="bi bi-people-fill fs-3 me-2"></i>
                          Usuarios
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link fs-4 fw-semibold d-flex align-items-center" href="${GetHost()}/admin/pre-inscripciones/">
                          <i class="bi bi-person-fill-down fs-3 me-2"></i>
                          Pre-Inscripciones
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link fs-4 fw-semibold d-flex align-items-center" href="${GetHost()}/admin/inscripciones/">
                          <i class="bi bi-person-fill-up fs-3 me-2"></i>
                          Inscripciones
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link fs-4 fw-semibold d-flex align-items-center" href="${GetHost()}/admin/matriculados/">
                          <i class="bi bi-person-fill-check fs-3 me-2"></i>
                          Matriculados
                      </a>
                  </li>
              </ul>
          </div>
      </div>
  </nav>
  `;
  let navLinks = document.querySelectorAll('.nav-link.fs-4');
  navLinks.forEach(navLink => {
    if (navLink.innerText == document.title.replace("Formaser | ", "")) {
      navLink.classList.add("active");
    }
  });
};
//table
const SetColumns = (dataTable, arrayColumns) => {
  let row = document.createElement('tr');
  arrayColumns.forEach(Column => {
    let col = document.createElement('td');
    col.textContent = Column;
    row.appendChild(col);
  });
  dataTable.firstElementChild.appendChild(row);
};
const FillTable = (dataTable, dataMatriz) => {
  dataMatriz.forEach(Row => {
    let row = document.createElement('tr');
    Row.forEach(Col => {
      let col = document.createElement('td');
      col.textContent = Col;
      row.appendChild(col);
    });
    dataTable.lastElementChild.appendChild(row);
  });
};
const GetDefaultOpt = (columnsDefs) => {
  return {
    responsive: true,
    language: {
      "decimal": "",
      "emptyTable": "No hay datos disponibles en la tabla",
      "info": "Mostrando _START_ a _END_ de _TOTAL_ usuarios",
      "infoEmpty": "Mostrando 0 a 0 de 0 usuarios",
      "infoFiltered": "(filtrado de _MAX_ usuarios totales)",
      "infoPostFix": "",
      "thousands": ",",
      "lengthMenu": "Mostrar _MENU_ usuarios",
      "loadingRecords": "Cargando...",
      "processing": "",
      "search": "Buscar:",
      "zeroRecords": "No se encontraron registros coincidentes",
      "paginate": {
        "first": "Primero",
        "last": "Ultimo",
        "next": "Siguiente",
        "previous": "Anterior"
      },
      "aria": {
        "orderable": "Ordenar por esta columna",
        "orderableReverse": "Ordenar esta columna en orden inverso"
      }
    },
    columnDefs: columnsDefs,
    layout: {
      top2Start: 'buttons'
    },
    buttons: [
      {
        extend: 'excel',
        text: `
            <i class="bi bi-file-earmark-spreadsheet"></i>
            Excel
            `,
        className: 'btn-success'
      },
      {
        extend: 'pdf',
        text: `
            <i class="bi bi-filetype-pdf"></i>
            PDF
            `,
        className: 'btn-danger'
      }
    ],
    order: [[0, "asc"]]
  };
};
SetFooter('footer');
CreateScript(`${GetHost()}/assets/js/bootstrap.bundle.min.js`);
export {
  SetHeader,
  SetColumns,
  FillTable,
  GetDefaultOpt
};