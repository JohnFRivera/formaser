// funcion para llenar el modal de curso repetido curso

function func_datosMandarCursoRepetidoModal(
  nombreAprendiz,
  nombrePrograma,
  numeroFicha,
  fechaMatricula
) {
  console.log(
    `${nombreAprendiz} ${nombrePrograma} ${numeroFicha} ${fechaMatricula}`
  );

  let ano = new Date(fechaMatricula);
  ano = ano.getFullYear(); // obtengo solo el año

  document.querySelector(
    ".descripcion"
  ).innerHTML = `<p> Este Aprendiz hizo este mismo Curso en el año  ${ano}</p>`;
  document.querySelector(".contenedorConfirmacionDeAceptacion").innerHTML = "";
  document.getElementById("tituloModal").textContent = nombreAprendiz;
  document.getElementById("inputNombrePrograma").value = nombrePrograma;
  document.getElementById("inputNumeroFicha").value = numeroFicha;
  document.getElementById("inpuFecha").value = fechaMatricula;
}

// funcion para llenar el modal de Descripcion curso

const func_datosDescripcionCursosMandarModal = (
  cedulaAprendiz,
  nombreAprendiz,
  nombrePrograma,
  numeroFicha,
  fechaMatricula,
  numeroFichaUltimo
) => {
  document.querySelector(
    ".descripcion"
  ).innerHTML = `<p> Este Aprendiz se encuentra Cursando otro curso en el Año vigente </p>`;
  document.getElementById("tituloModal").textContent = nombreAprendiz;
  document.getElementById("inputNombrePrograma").value = nombrePrograma;
  document.getElementById("inputNumeroFicha").value = numeroFicha;
  document.getElementById("inpuFecha").value = fechaMatricula;
  document.getElementById("inputCedulaAprendiz").value = cedulaAprendiz;

  document.querySelector(
    ".contenedorConfirmacionDeAceptacion"
  ).innerHTML = `<div class="texto">
  <p>Deseas que este Aprendiz Se Matricule de todas formas en este Programa</p>
</div>

<div class="btnConfirmacion">
<button onclick="func_AprobarAprendiz('${cedulaAprendiz}','${numeroFichaUltimo}')" type="button" class="btn btn-success">Si</button>
<button onclick="func_denegarAprendiz('${cedulaAprendiz}','${numeroFichaUltimo}')" type="button" class="btn btn-danger">No</button>

</div>`;
};

// aca voy hacer la funcion De Aprobado el Aprendiz

const func_AprobarAprendiz = (cedula, ficha) => {
  console.log(ficha);
  console.log(cedula);

  const formData = new FormData();
  formData.append("cedula", cedula);
  formData.append("ficha", ficha);

  fetch(
    `${window.location.origin}/back/modulos/aprendizAprovado.php`,
    {
      method: "POST",
      body: formData,
    }
  )
    .then((response) => {
      if (!response.ok) {
        throw new Error("Error en la solicitud");
      }
      return response.text();
    })
    .then((data) => {
      console.log("da 1 si es true" + data);

      if (data == 1) {
        document.querySelector(
          ".contenedorConfirmacionDeAceptacion"
        ).innerHTML = `<div class="alert alert-success" role="alert">
  Aprendiz Preinscrito con exito!
</div>`;
      } else {
        console.log("hubo un error Verificar el aprendizAprovado ");
        document.querySelector(
          ".contenedorConfirmacionDeAceptacion"
        ).innerHTML = `<div class="alert alert-danger" role="alert">
  Hubo un error
</div>`;
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
};

// aca voy hacer la funcion De Denegado el Aprendiz

const func_denegarAprendiz = (cedula, ficha) => {
  console.log(ficha);
  console.log(cedula);

  const formData = new FormData();
  formData.append("cedula", cedula);
  formData.append("ficha", ficha);

  fetch(
    `${window.location.origin}/formaser/back/modulos/aprendizDenegado.php`,
    {
      method: "POST",
      body: formData,
    }
  )
    .then((response) => {
      if (!response.ok) {
        throw new Error("Error en la solicitud");
      }
      return response.text();
    })
    .then((data) => {
      console.log("da 1 si es true" + data);

      if (data == 1) {
        document.querySelector(
          ".contenedorConfirmacionDeAceptacion"
        ).innerHTML = `<div class="alert alert-danger" role="alert">
  Aprendiz Denegado!
</div>`;
      } else {
        console.log("hubo un error Verificar el aprendizAprovado ");
        document.querySelector(
          ".contenedorConfirmacionDeAceptacion"
        ).innerHTML = `<div class="alert alert-danger" role="alert">
  Hubo un error
</div>`;
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
};
