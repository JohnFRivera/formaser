let primerFormato = document.getElementById("primerFormato");
let mensajeError = document.getElementById("mensajeError");
primerFormato.addEventListener("click", () => {
  let mensajeError1 = document.getElementById("mensajeError1");
  let mensajeError2 = document.getElementById("mensajeError2");
  let tituloTabla1 = document.getElementById("tituloTabla1");
  let tituloTabla2 = document.getElementById("tituloTabla2");
  let titulosTheadTabla1 = document.getElementById("titulosTheadTabla1");
  let contenidoTabla1 = document.getElementById("contenidoTabla1");
  let titulosTheadTabla2 = document.getElementById("titulosTheadTabla2");
  let contenidoTabla2 = document.getElementById("contenidoTabla2");

  const fileInput = document.getElementById("primerArchivo");
  const file = fileInput.files[0]; // Obtener el primer archivo seleccionado
  console.log(file);

  if (file != undefined) {
    // Crear un objeto FormData y agregar el archivo a él
    let formData = new FormData();
    formData.append("archivotExcel", file);

    // Enviar el formulario usando Fetch
    fetch(
      "http://localhost/proyectosCamilo/leer%20archivo%20excel/modulos/leerExcel.php",
      {
        method: "POST",
        body: formData,
      }
    )
      .then((response) => response.json())
      .then((data) => {
        // verifico primero si en el JSON hay un Objeto llamdos "error" si lo hay es porque hubo un error y no se puede ejecutar

        if (data.error != undefined) {
          console.log(data.error);

          // aca si no a cragado el archivo le envio un Alerta

          let alerta = `  <div class="alert alert-warning alert-dismissible fade show" role="alert">
 <strong>Hubo un error!</strong> ${data.error[0].descripcion}.
 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>`;
          mensajeError.innerHTML = alerta;
        } else {
          // aca ya comparo los otros objetos

          tituloTabla1.innerHTML = `<h2> Datos Agregados </h2>`;
          tituloTabla2.innerHTML = `<h2> Datos No Agregados </h2>`;

          if (data.registrado != undefined) {
            console.log(data.registrado);
            // aca voy agregarlos a la tabla registrados
            titulosTheadTabla1.innerHTML = `<tr> <th>Cedula</th> <th>Numero Ficha</th> <th>Codigo Empresa</th> <th>Descripcion</th> </tr>`;
            data.registrado.forEach((element) => {
              let descrip = `<tr><td>${element.tipoDocumento}: ${element.cedula} </td> <td> ${element.numeroFicha}</td>  <td>${element.codigoEmpresa} </td>  <td>${element.razones} </td></tr>`;

              contenidoTabla1.innerHTML += descrip;
            });

            // -------------------------
          } else {
            mensajeError1.innerHTML = `<div class="alert alert-secondary" role="alert">
  No hay datos Por mostrar
</div>`;
          }
          if (data.no_aceptados != undefined) {
            console.log(data.no_aceptados);
            // aca voy agregar a la tabla los que no se registraron
            titulosTheadTabla2.innerHTML = `<tr> <th>Cedula</th> <th>Numero Ficha</th> <th>Codigo Empresa</th> <th>Descripcion</th> </tr>`;
            data.no_aceptados.forEach((element) => {
              let descrip = `<tr><td>${element.tipoDocumento}: ${element.cedula} </td> <td> ${element.numeroFicha}</td>  <td>${element.codigoEmpresa} </td>  <td>${element.razones} </td></tr>`;

              contenidoTabla2.innerHTML += descrip;
            });

            // -------------------------
          } else {
            mensajeError2.innerHTML = `<div class="alert alert-secondary" role="alert">
  No hay datos Por mostrar
</div>`;
          }

          // -------------------------------
        }
      })
      .catch((error) => {
        console.log("Error:", error);
      });
  } else {
    // aca si no a cragado el archivo le envio un Alerta

    let alerta = `  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Hubo un error!</strong> No has subido ningun Archivo.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>`;
    mensajeError.innerHTML = alerta;
  }
});

/*   
  // Enviar el formulario usando AJAX
  $.ajax({
    data: formData,
    url: "leerExcel.php",
    type: "POST",
    processData: false, // Importante: desactivar la procesamiento de datos para que jQuery no convierta el objeto FormData en una cadena
    contentType: false, // Importante: desactivar el tipo de contenido para que jQuery configure el encabezado correctamente
  }).done(function (res) {
    var datos = JSON.parse(res);
    console.log(datos[0]);
  }); */

// aca voy hacer el codigo para enviar el segundo formato
let btnEnviarSegundoFormato = document.getElementById(
  "btnEnviarSegundoFormato"
);
let segundoFormato = document.getElementById("segundoFormato");
let mensajeErrorSegundoFormato = document.getElementById(
  "mensajeErrorSegundoFormato"
);

// variables de los tablas donde se va mostrar el segundo formato
let titulosExitoTablaFormato2 = document.getElementById(
  "titulosExitoTablaFormato2"
);
let titulosDenegadoTablaFormato2 = document.getElementById(
  "titulosDenegadoTablaFormato2"
);
let contenidoExitoTablaFormato2 = document.getElementById(
  "contenidoExitoTablaFormato2"
);
let contenidoDenegadoTablaFormato2 = document.getElementById(
  "contenidoDenegadoTablaFormato2"
);

let tituloTablaExitoFormato2 = document.querySelector(
  ".tituloTablaExitoFormato2"
);
let tituloTablaDenegadoFormato2 = document.querySelector(
  ".tituloTablaDenegadoFormato2"
);

// ---
btnEnviarSegundoFormato.addEventListener("click", () => {
  const file = segundoFormato.files[0]; // Obtener el primer archivo seleccionado
  console.log(file);
  if (file != undefined) {
    // Crear un objeto FormData y agregar el archivo a él
    let formData = new FormData();
    formData.append("archivotExcel", file);

    // Enviar el formulario usando Fetch
    fetch(
      "http://localhost/proyectosCamilo/leer%20archivo%20excel/modulos/segundoFormato.php",
      {
        method: "POST",
        body: formData,
      }
    )
      .then((response) => response.json())
      .then((data) => {
        if (data.error == undefined) {
          // aca voy a poner los titulos
          tituloTablaExitoFormato2.innerHTML = `<h2>Actualizado con exito</h2>`;
          tituloTablaDenegadoFormato2.innerHTML = `<h2>Denegado</h2>`;
          // -----

          // aca voy a verificar si hay denegados y si hay recorrer los denegados para poner en la tabla
          console.log(data);
          if (data.updateDenegado != undefined) {
            // aca voy a colocar los titulos de la tabla denegados
            titulosDenegadoTablaFormato2.innerHTML = `<tr> <th>Cedula</th><th>Nombre</th> <th>Ficha </th> <th>Estado </th> <th>Descripcion </th> </tr>`;
            // -----
            data.updateDenegado.forEach((subArray) => {
              console.log(subArray[0].cedula);

              let descri = `<tr> <td>${subArray[0].cedula} </td> <td>${subArray[0].nombre} </td> <td>${subArray[0].codigoFicha} </td> <td>${subArray[0].estado} </td> <td>${subArray[0].descripcion} </td> </tr>`;
              contenidoDenegadoTablaFormato2.innerHTML += descri;
            });
          } else {
            // aca mando un mensaje de que no hubo datos para mostrar
            let alerta = `  <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>Todo en orden!</strong> No hay aprendices denegados.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>`;
            tituloTablaDenegadoFormato2.innerHTML = alerta;
          }

          // -------
          // aca voy a verificar los que fueron actualizados con exito y los que fueron actualizados se mostraran en la tabla

          if (data.updateExito != undefined) {
            // aca voy a colocar los titulos de la tabla denegados
            titulosExitoTablaFormato2.innerHTML = `<tr> <th>Cedula</th><th>Nombre</th> <th>Ficha </th> <th>Estado </th> <th>Descripcion </th> </tr>`;
            // -----
            data.updateExito.forEach((subArray) => {
              console.log(subArray[0].cedula);

              let descri = `<tr> <td>${subArray[0].cedula} </td> <td>${subArray[0].nombre} </td> <td>${subArray[0].codigoFicha} </td> <td>${subArray[0].estado} </td> <td>${subArray[0].descripcion} </td> </tr>`;
              contenidoExitoTablaFormato2.innerHTML += descri;
            });
          } else {
            // aca mando un mensaje de que no hubo datos para mostrar
            let alerta = `  <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>Atencion!</strong> Ningun Aprendiz fue Preinscrito.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>`;
            tituloTablaExitoFormato2.innerHTML = alerta;
          }
        } else {
          let aler = `  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Hubo un error!</strong>${data.error[0].descripcion}.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>`;
          mensajeErrorSegundoFormato.innerHTML = aler;
        }

        // ------
      });
  } else {
    // aca si no a cargado el archivo le envio un Alerta

    let aler = `  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Hubo un error!</strong> No has subido ningun Archivo.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>`;
    mensajeErrorSegundoFormato.innerHTML = aler;
  }
});

// --------------------------------------------

// aca voy hacer el evento que se ejecutara para el tercer formato

let btnEnviarTercerFormato = document.getElementById("btnEnviarTercerFormato");
let TercerFormato = document.getElementById("TercerFormato");
let mensajeErrorTercerFormato = document.getElementById(
  "mensajeErrorTercerFormato"
);

// variables de los tablas donde se va mostrar el segundo formato
let titulosExitoTablaFormato3 = document.getElementById(
  "titulosExitoTablaFormato3"
);
let titulosDenegadoTablaFormato3 = document.getElementById(
  "titulosDenegadoTablaFormato3"
);
let contenidoExitoTablaFormato3 = document.getElementById(
  "contenidoExitoTablaFormato3"
);
let contenidoDenegadoTablaFormato3 = document.getElementById(
  "contenidoDenegadoTablaFormato3"
);

let tituloTablaExitoFormato3 = document.querySelector(
  ".tituloTablaExitoFormato3"
);
let tituloTablaDenegadoFormato3 = document.querySelector(
  ".tituloTablaDenegadoFormato3"
);

// ---
btnEnviarTercerFormato.addEventListener("click", () => {
  const file = TercerFormato.files[0]; // Obtener el primer archivo seleccionado
  console.log(file);
  if (file != undefined) {
    // Crear un objeto FormData y agregar el archivo a él
    let formData = new FormData();
    formData.append("archivotExcel", file);

    // Enviar el formulario usando Fetch
    fetch(
      "http://localhost/proyectosCamilo/leer%20archivo%20excel/modulos/tercerFormato.php",
      {
        method: "POST",
        body: formData,
      }
    )
      .then((response) => response.json())
      .then((data) => {
        // aca voy a poner los titulos
        tituloTablaExitoFormato3.innerHTML = `<h2>Actualizado con exito</h2>`;
        tituloTablaDenegadoFormato3.innerHTML = `<h2>Denegado</h2>`;
        // -----

        // aca voy a verificar si hay denegados y si hay recorrer los denegados para poner en la tabla
        console.log(data.updateExito);
        if (data.updateDenegado != undefined) {
          // aca voy a colocar los titulos de la tabla denegados
          titulosDenegadoTablaFormato3.innerHTML = `<tr> <th>Cedula</th><th>Nombre</th> <th>Ficha </th> <th>Estado </th> <th>Descripcion </th> </tr>`;
          // -----
          data.updateDenegado.forEach((subArray) => {
            console.log(subArray[0].cedula);

            let descri = `<tr> <td>${subArray[0].cedula} </td> <td>${subArray[0].nombre} </td> <td>${subArray[0].codigoFicha} </td> <td>${subArray[0].estado} </td> <td>${subArray[0].descripcion} </td> </tr>`;
            contenidoDenegadoTablaFormato3.innerHTML += descri;
          });
        } else {
          // aca mando un mensaje de que no hubo datos para mostrar
          let alerta = `  <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>Todo en orden!</strong> No hay aprendices denegados.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>`;
          tituloTablaDenegadoFormato3.innerHTML = alerta;
        }

        // -------
        // aca voy a verificar los que fueron actualizados con exito y los que fueron actualizados se mostraran en la tabla

        if (data.updateExito != undefined) {
          // aca voy a colocar los titulos de la tabla denegados
          titulosExitoTablaFormato3.innerHTML = `<tr> <th>Cedula</th><th>Nombre</th> <th>Ficha </th> <th>Estado </th> <th>Descripcion </th> </tr>`;
          // -----
          data.updateExito.forEach((subArray) => {
            console.log(subArray[0].cedula);

            let descri = `<tr> <td>${subArray[0].cedula} </td> <td>${subArray[0].nombre} </td> <td>${subArray[0].codigoFicha} </td> <td>${subArray[0].estado} </td> <td>${subArray[0].descripcion} </td> </tr>`;
            contenidoExitoTablaFormato3.innerHTML += descri;
          });
        } else {
          // aca mando un mensaje de que no hubo datos para mostrar
          let alerta = `  <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>Atencion!</strong> Ningun Aprendiz fue Preinscrito.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>`;
          tituloTablaExitoFormato3.innerHTML = alerta;
        }

        // ------
      });
  } else {
    // aca si no a cargado el archivo le envio un Alerta

    let aler = `  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Hubo un error!</strong> No has subido ningun Archivo.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>`;
    mensajeErrorTercerFormato.innerHTML = aler;
  }
});
//-----------------------
