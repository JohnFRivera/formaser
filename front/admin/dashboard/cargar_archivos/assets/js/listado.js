new DataTable("#tblPreInscrito", {
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

new DataTable("#tblInscrito", {
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

new DataTable("#tblMatriculado", {
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
