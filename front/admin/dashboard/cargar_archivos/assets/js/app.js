//* FORMATO 1
document
  .getElementById("btnSubirPreinscritos")
  .addEventListener("click", () => {
    let mensajeError = document.getElementById("mensajeError");
    let tblPreinscritosAgregados = document.getElementById(
      "tblPreinscritosAgregados"
    );
    let tblPreinscritosNoAgregados = document.getElementById(
      "tblPreinscritosNoAgregados"
    );
    const fileInput = document.getElementById("inpArchivoPreinscrito");
    const file = fileInput.files[0]; // Obtener el primer archivo seleccionado
    console.log(file);

    if (file != undefined) {
      // Crear un objeto FormData y agregar el archivo a él
      let formData = new FormData();
      formData.append("archivotExcel", file);
      // Enviar el formulario usando Fetch
      fetch(`${window.location.origin}/back/modulos/leerExcel.php`, {
        method: "POST",
        body: formData,
      })
        .then((response) => response.json())
        .then((data) => {
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
            if (data.registrado != undefined) {
              console.log(data.registrado);
              // aca voy agregarlos a la tabla registrados
              data.registrado.forEach((element) => {
                let descrip = `
                            <tr>
                                <td>${element.tipoDocumento}: ${element.cedula}</td>
                                <td>${element.numeroFicha}</td>
                                <td>${element.codigoEmpresa}</td>
                                <td>${element.razones}</td>
                            </tr>
                            `;
                tblPreinscritosAgregados.innerHTML += descrip;
              });
              // -------------------------
            }
            if (data.no_aceptados != undefined) {
              console.log(data.no_aceptados);
              // aca voy agregar a la tabla los que no se registraron
              data.no_aceptados.forEach((element) => {
                let descrip = `
                            <tr>
                                <td>${element.tipoDocumento}: ${element.cedula}</td>
                                <td>${element.numeroFicha}</td>
                                <td>${element.codigoEmpresa}</td>
                                <td>${element.razones}</td>
                            </tr>
                            `;

                tblPreinscritosNoAgregados.innerHTML += descrip;
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

//* FORMATO 2
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
    fetch(`${window.location.origin}/back/modulos/leerExcel.php`, {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
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
          if (data.registrado != undefined) {
            console.log(data.registrado);
            // aca voy agregarlos a la tabla registrados
            data.registrado.forEach((element) => {
              let descrip = `
                            <tr>
                                <td>${element.tipoDocumento}: ${element.cedula}</td>
                                <td>${element.numeroFicha}</td>
                                <td>${element.codigoEmpresa}</td>
                                <td>${element.razones}</td>
                            </tr>
                            `;
              tblInscritosAgregados.innerHTML += descrip;
            });
            // -------------------------
          }
          if (data.no_aceptados != undefined) {
            console.log(data.no_aceptados);
            // aca voy agregar a la tabla los que no se registraron
            data.no_aceptados.forEach((element) => {
              let descrip = `
                            <tr>
                                <td>${element.tipoDocumento}: ${element.cedula}</td>
                                <td>${element.numeroFicha}</td>
                                <td>${element.codigoEmpresa}</td>
                                <td>${element.razones}</td>
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

//* FORMATO 2
document
  .getElementById("btnSubirMatriculados")
  .addEventListener("click", () => {
    let mensajeError = document.getElementById("mensajeError");
    let tblMatriculadosAgregados = document.getElementById(
      "tblMatriculadosAgregados"
    );
    let tblMatriculadosNoAgregados = document.getElementById(
      "tblMatriculadosNoAgregados"
    );
    const fileInput = document.getElementById("inpArchivoMatriculados");
    const file = fileInput.files[0]; // Obtener el primer archivo seleccionado
    console.log(file);

    if (file != undefined) {
      // Crear un objeto FormData y agregar el archivo a él
      let formData = new FormData();
      formData.append("archivotExcel", file);
      // Enviar el formulario usando Fetch
      fetch(`${window.location.origin}/back/modulos/leerExcel.php`, {
        method: "POST",
        body: formData,
      })
        .then((response) => response.json())
        .then((data) => {
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
            if (data.registrado != undefined) {
              console.log(data.registrado);
              // aca voy agregarlos a la tabla registrados
              data.registrado.forEach((element) => {
                let descrip = `
                          <tr>
                              <td>${element.tipoDocumento}: ${element.cedula}</td>
                              <td>${element.numeroFicha}</td>
                              <td>${element.codigoEmpresa}</td>
                              <td>${element.razones}</td>
                          </tr>
                          `;
                tblMatriculadosAgregados.innerHTML += descrip;
              });
              // -------------------------
            }
            if (data.no_aceptados != undefined) {
              console.log(data.no_aceptados);
              // aca voy agregar a la tabla los que no se registraron
              data.no_aceptados.forEach((element) => {
                let descrip = `
                          <tr>
                              <td>${element.tipoDocumento}: ${element.cedula}</td>
                              <td>${element.numeroFicha}</td>
                              <td>${element.codigoEmpresa}</td>
                              <td>${element.razones}</td>
                          </tr>
                          `;

                tblMatriculadosNoAgregados.innerHTML += descrip;
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
