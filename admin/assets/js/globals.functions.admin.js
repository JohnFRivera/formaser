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
                      <a class="nav-link fs-4 fw-semibold d-flex align-items-center" aria-current="page" href="${GetHost()}/admin/subir_archivos/pre-inscritos.html">
                          <i class="bi bi-cloud-arrow-up-fill fs-3 me-2"></i>
                          Subir Archivos
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link fs-4 fw-semibold d-flex align-items-center" href="${GetHost()}/admin/consultas/pre-inscritos.html">
                          <i class="bi bi-table fs-3 me-2"></i>
                          Consultas
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link fs-4 fw-semibold d-flex align-items-center" href="${GetHost()}/admin/usuarios/">
                          <i class="bi bi-people-fill fs-3 me-2"></i>
                          Usuarios
                      </a>
                  </li>
              </ul>
          </div>
      </div>
  </nav>
  `;
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
  let row = document.createElement('tr');
  dataMatriz.forEach(Row => {
    Row.forEach(Col => {
      let col = document.createElement('td');
      col.textContent = Col;
      row.appendChild(col);
    });
  });
  dataTable.lastElementChild.appendChild(row);
};
const CreateDataTable = (id) => {
  new DataTable(id, {

  });
};
SetFooter('footer');
CreateScript(`${GetHost()}/assets/js/bootstrap.bundle.min.js`);
export {
  SetHeader,
  SetColumns,
  FillTable,
  CreateDataTable
};