document.getElementById("btnSubirInscritos").addEventListener("click", () => {
  let mensajeError = document.getElementById("mensajeError");
  let tblInscritosAgregados = document.getElementById("tblInscritosAgregados");
  let tblInscritosNoAgregados = document.getElementById(
    "tblInscritosNoAgregados"
  );
  const fileInput = document.getElementById("inpArchivoInscritos");
  const file = fileInput.files[0]; // Obtener el primer archivo seleccionado
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
        console.log(data);
        // verifico primero si en el JSON hay un Objeto llamdos "error" si lo hay es porque hubo un error y no se puede ejecutar
        if (data.error != undefined) {
          console.log(data.error);
          // aca si no a cragado el archivo le envio un Alerta
          let alerta = `
                      <div class="alert alert-warning alert-dismissible fade show" role="alert">
                          <strong>Hubo un error!</strong> ${data.error[0].descripcion}.
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>`;
          mensajeError.innerHTML = alerta;
        } else {
          if (data.updateExito != undefined) {
            console.log(data.registrado);
            // aca voy agregarlos a la tabla registrados
            data.updateDenegado.forEach((subArray) => {
              console.log(subArray[0].cedula);

              let descri = `<tr> <td>${subArray[0].cedula} </td> <td>${subArray[0].nombre} </td> <td>${subArray[0].codigoFicha} </td> <td>${subArray[0].estado} </td> <td>${subArray[0].descripcion} </td> </tr>`;
              tblInscritosAgregados.innerHTML += descri;
            });
            // -------------------------
          }
          if (data.updateDenegado != undefined) {
            console.log(data.no_aceptados);
            // aca voy agregar a la tabla los que no se registraron
            data.updateDenegado.forEach((element) => {
              let descrip = `
                              <tr>
                                  <td>${element.cedula}</td>
                                  <td>${element.codigoFicha}</td>
                                  <td>${element.codigoEmpresa}</td>
                                  <td>${element.descripcion}</td>
                              </tr>
                              `;

              tblInscritosNoAgregados.innerHTML += descrip;
            });
            // -------------------------
          }
          // -------------------------------
        }
      })
      .catch((error) => {
        console.log("Error:", error);
      });
  }
});
