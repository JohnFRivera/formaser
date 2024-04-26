//* INPUT FILE
let inputFile = document.querySelector('input[type="file"]');
let arraySizes = ["Bytes", "KB", "MB", "GB"];
const SetInpFileContent = () => {
  var whileIndex = true;
  var fileSize = inputFile.files[0].size;
  var sizesIndex = 0;
  //? CALCULAR TAMAÑO
  while (whileIndex) {
    if (fileSize > 1000) {
      sizesIndex++;
      fileSize = fileSize / 1024;
    } else {
      whileIndex = false;
    }
  }
  //? PINTAR
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
  <div class="d-flex justify-content-center border-top py-2">
    <p class="small opacity-50 text-start text-truncate mb-0">
        <b>Nombre:</b> ${inputFile.files[0].name}<br>
        <b>Tamaño:</b> ${fileSize.toFixed()} ${arraySizes[sizesIndex]}
    </p>
  </div>
  <div class="row mb-1">
    <div class="col">
      <button class="btn btn-verde px-4" type="button" id="btnSubir">Subir</button>
    </div>
  </div>
  `;
};
//* BTN SUBIR
const SetColumns = (thead, arrayColumns) => {
  var tableHead = document.getElementById(thead);
  let row = document.createElement("tr");
  arrayColumns.forEach((Column) => {
    var col = document.createElement("th");
    col.textContent = Column;
    row.appendChild(col);
  });
  tableHead.append(row);
};
const CreateTableAgregados = () => {
  document.getElementById("sectionTables").innerHTML += `
  <div class="row pt-2 mb-4">
      <div class="col">
          <div class="border rounded-4 p-3 shadow">
              <h2
                  class="d-flex align-items-center justify-content-center text-success opacity-75 fw-bold mb-0">
                  Añadidos
                  <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                      fill="currentColor" class="ms-2" viewBox="0 0 16 16">
                      <path
                          d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                      <path
                          d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4" />
                  </svg>
              </h2>
              <div class="table-responsive mb-2">
                  <table id="dtAgregados"
                      class="table table-hover table-striped" style="width:100%">
                      <thead class="fs-5" id="theadAgregados"></thead>
                      <tbody id="tbodyAgregados"></tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>
  `;
};
const CreateTableDenegados = () => {
  document.getElementById("sectionTables").innerHTML += `
  <div class="row mb-2">
      <div class="col">
          <div class="bg-danger bg-opacity-25 border border-secondary-subtle rounded-4 p-3 shadow">
              <h2
                  class="d-flex align-items-center justify-content-center text-danger opacity-75 fw-bold mb-0">
                  Denegados
                  <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                      fill="currentColor" class="ms-2" viewBox="0 0 16 16">
                      <path
                          d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4" />
                      <path
                          d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m-.646-4.854.646.647.646-.647a.5.5 0 0 1 .708.708l-.647.646.647.646a.5.5 0 0 1-.708.708l-.646-.647-.646.647a.5.5 0 0 1-.708-.708l.647-.646-.647-.646a.5.5 0 0 1 .708-.708" />

                  </svg>
              </h2>
              <div class="table-responsive mb-2">
                  <table id="dtDenegados"
                      class="table table-light table-hover table-striped" style="width:100%">
                      <thead class="fs-5" id="theadDenegados"></thead>
                      <tbody id="tbodyDenegados">
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>
  `;
};

export { SetInpFileContent, SetColumns, CreateTableAgregados, CreateTableDenegados };