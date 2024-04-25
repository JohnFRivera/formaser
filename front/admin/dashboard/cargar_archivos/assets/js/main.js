new DataTable("#dataTableAgregados", {
  language: {
    entries: {
      _: "Archivos",
      1: "Archivo",
    },
    info: "Mostrar _START_ a _END_ de _TOTAL_ _ENTRIES_",
  },
  lengthMenu: [5, 10, 20, 30],
  columnDefs: [{ orderable: false, targets: 3 }],
  order: [[1, "asc"]],
});
new DataTable("#dataTableNoAgregados", {
  language: {
    entries: {
      _: "Archivos",
      1: "Archivo",
    },
    info: "Mostrar _START_ a _END_ de _TOTAL_ _ENTRIES_",
  },
  lengthMenu: [5, 10, 20, 30],
  columnDefs: [{ orderable: false, targets: 3 }],
  order: [[1, "asc"]],
});

let inputFile = document.querySelector('input[type="file"]');
let arraySizes = ["Bytes", "KB", "MB", "GB"];

inputFile.addEventListener("input", () => {
  var whileIndex = true;
  var fileSize = inputFile.files[0].size;
  var sizesIndex = 0;
  while (whileIndex) {
    if (fileSize > 1000) {
      sizesIndex++;
      fileSize = fileSize / 1024;
    } else {
      whileIndex = false;
    }
  }
  document.getElementById(`fileInfo`).innerHTML = `
  <b class="fw-semibold fs-6">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="mb-1" viewBox="0 0 16 16">
      <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1m-1 4v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 11.293V7.5a.5.5 0 0 1 1 0"/>
    </svg>
    ${inputFile.files[0].name}
  </b>
  <br>
  ${fileSize.toFixed()} ${arraySizes[sizesIndex]}
        `;
  document.querySelector(`label.btn.btn-azul`).classList.add("active");
  document.querySelector(`input.btn.btn-verde`).disabled = false;
});
