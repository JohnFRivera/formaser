document.title += ' | Gestiones'

const dtOption = {
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
    columnDefs: [
        { target: 0, className: 'text-start' }
    ],
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
            Excel
            `,
            className: 'btn-danger'
        }
    ],
    order: [[0, "asc"]]
};
new DataTable('#dataTable', dtOption);

fetch(`${window.location.origin}/formaser/back/usuarios.php`)
.then((response) => response.json())
.then((data) => {

}); 