const dtOption = {
    responsive: true,
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
    columnDefs: [
        { targets: 0, width: "13%", className: "text-start" },
        { targets: 1, width: "33%", className: "text-start" },
        { targets: 2, width: "13%", className: "text-start" },
        { targets: 3, width: "33%", className: "text-start" },
        { targets: 4, width: "8%", className: "text-center text-primary" }
    ],
    order: [[1, "asc"]],
    layout: {
        topStart: "buttons",
        top2Start: {
        pageLength: {
            lengthMenu: [10, 25, 50, 75, 100],
        },
        },
    },
    buttons: [
        {
        extend: "excel",
        className: "btn btn-success bg-opacity-50",
        text: `
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="mb-1 me-1" fill="currentColor" viewBox="0 0 16 16">
            <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V9H3V2a1 1 0 0 1 1-1h5.5zM3 12v-2h2v2zm0 1h2v2H4a1 1 0 0 1-1-1zm3 2v-2h3v2zm4 0v-2h3v1a1 1 0 0 1-1 1zm3-3h-3v-2h3zm-7 0v-2h3v2z"/>
        </svg>
        Exportar Excel
        `,
        },
        {
        extend: "pdf",
        className: "btn btn-danger",
        text: `
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="mb-1 me-1" fill="currentColor" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803q.43 0 .732-.173.305-.175.463-.474a1.4 1.4 0 0 0 .161-.677q0-.375-.158-.677a1.2 1.2 0 0 0-.46-.477q-.3-.18-.732-.179m.545 1.333a.8.8 0 0 1-.085.38.57.57 0 0 1-.238.241.8.8 0 0 1-.375.082H.788V12.48h.66q.327 0 .512.181.185.183.185.522m1.217-1.333v3.999h1.46q.602 0 .998-.237a1.45 1.45 0 0 0 .595-.689q.196-.45.196-1.084 0-.63-.196-1.075a1.43 1.43 0 0 0-.589-.68q-.396-.234-1.005-.234zm.791.645h.563q.371 0 .609.152a.9.9 0 0 1 .354.454q.118.302.118.753a2.3 2.3 0 0 1-.068.592 1.1 1.1 0 0 1-.196.422.8.8 0 0 1-.334.252 1.3 1.3 0 0 1-.483.082h-.563zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638z"/>
        </svg>
        Exportar PDF
        `,
        },
    ],
    };
new DataTable("table.table", dtOption);
/*
* TRAER DATA DE PHP
fetch(`${window.location.origin}/formaser/back/`)
  .then((response) => response.json())
  .then((data) => {}); 
*/