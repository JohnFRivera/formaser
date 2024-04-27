new DataTable("#dataTable", {
  response: true,
  language: {
    entries: {
      _: "Aprendices",
      1: "Aprendices",
    },
    emptyTable: "No hay ningún dato.",
    info: "Mostrar _START_ a _END_ de _TOTAL_ _ENTRIES_",
    infoEmpty: "Mostrar 0 a 0 de 0 Aprendices",
  },
  lengthMenu: [10, 20, 30, 40],
  columnDefs: [{ orderable: false, targets: 4 }],
  order: [[1, "asc"]],
});
fetch(`${window.location.origin}/formaser/back/`)
  .then((response) => response.json())
  .then((data) => {});
