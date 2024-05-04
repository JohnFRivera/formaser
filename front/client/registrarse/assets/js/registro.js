let btnRegistro = document.getElementById("btnRegistro")
btnRegistro.addEventListener("click", () => {
  let nombre = document.getElementById("txtNombre").value;
  let identificacion = document.getElementById("txtIdentificacion").value;
  let apellido = document.getElementById("txtApellidos").value;
  let correo = document.getElementById("txtCorreo").value;
  let password = document.getElementById("txtPassword").value;
  var datos = {
    nombre: nombre,
    apellido: apellido,
    identificacion: identificacion,
    correo: correo,
    password: password,
  };
  $.ajax({
    data: datos,
    url: "http://localhost/formaser/front/client/registrarse/registro.php",
    type: "POST"
  }).done(function (res) {
    var datos = JSON.parse(res);
    if( datos.error == undefined)
      {
        // ? Le doy paso al login 
          window.location.href = "http://localhost/formaser/front/client/iniciar_sesion/index.php";
      }else if ( datos.error[0].code == "404" )
        {
            let contenedorMensaje = document.querySelector("#mensajeError");
            let mensaje = document.createElement("div");
            contenedorMensaje.removeChild(contenedorMensaje.firstChild)
            mensaje.innerHTML = `${datos.error[0].Des}, ${datos.error[0].Correo}`;
            mensaje.classList.add(
                "alert", "alert-warning", "alert-dismissible", "fade", "show"
            );
            mensaje.setAttribute("role", "alert");
            contenedorMensaje.appendChild(mensaje);
        }
  
  });
});
