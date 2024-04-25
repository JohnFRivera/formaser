document.getElementById("btnSubirInscritos").addEventListener("click", () => {
  let mensajeError = document.getElementById("mensajeError");
  let tblInscritosAgregados = document.getElementById("tblInscritosAgregados");
  let tblInscritosNoAgregados = document.getElementById(
    "tblInscritosNoAgregados"
  );
  var inputFile = document.getElementById("inpArchivoInscritos");
  const file = inputFile.files[0]; // Obtener el primer archivo seleccionado
  console.log(file);
  if (file != undefined) {
    // Crear un objeto FormData y agregar el archivo a él
    let formData = new FormData();
    formData.append("archivotExcel", file);
    // Enviar el formulario usando Fetch
    fetch(
      `${window.location.origin}/formaser/back/modulos/segundoFormato.php`,
      {
        method: "POST",
        body: formData,
      }
    )
      .then((response) => response.json())
      .then((data) => {
        if (data.error == undefined) {
          // aca voy a verificar si hay denegados y si hay recorrer los denegados para poner en la tabla
          console.log(data);
          if (data.updateDenegado != undefined) {
            // aca voy a colocar los titulos de la tabla denegados
            // -----
            data.updateDenegado.forEach((subArray) => {
              console.log(subArray[0].cedula);
              let descri = `
              <tr>
                <td>${subArray[0].cedula}</td>
                <td>${subArray[0].nombre}</td>
                <td>${subArray[0].codigoFicha}</td>
                <td>${subArray[0].estado}</td>
                <td>${subArray[0].descripcion}</td>
              </tr>`;
              tblInscritosNoAgregados.innerHTML += descri;
            });
          }
          // -------
          // aca voy a verificar los que fueron actualizados con exito y los que fueron actualizados se mostraran en la tabla
          if (data.updateExito != undefined) {
            // -----
            data.updateExito.forEach((subArray) => {
              console.log(subArray[0].cedula);

              let descri = `
              <tr>
                <td>${subArray[0].cedula}</td>
                <td>${subArray[0].nombre} </td>
                <td>${subArray[0].codigoFicha}</td>
                <td>${subArray[0].estado}</td>
                <td>${subArray[0].descripcion}</td>
              </tr>`;
              tblInscritosAgregados.innerHTML += descri;
            });
          }
        } else {
          let aler = `
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Hubo un error!</strong>${data.error[0].descripcion}.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>`;
          mensajeError.innerHTML = aler;
        }
        // ------
      });
  } else {
    // aca si no a cargado el archivo le envio un Alerta
    let aler = `
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Hubo un error!</strong> No has subido ningun Archivo.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>`;
    mensajeError.innerHTML = aler;
  }
});
