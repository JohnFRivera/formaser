let btnIngresar = document.getElementById("btnIngresar");
btnIngresar.addEventListener("click", () => {
    let correo = document.getElementById("correo").value;
    let contra = document.getElementById("password").value;
    var datos = {
      correo: correo,
      contra: contra,
    };
  $.ajax({
    data: datos,
    url: "http://localhost/formaser/front/client/iniciar_sesion/iniciarSesion.php",
    type: "POST" // ? Envio los datos por post para que haga las validaciones
    }).done(function(res){ // ? Una vez hecho el proceso de validacion, 
                          // ? revisa que respuesta le manda iniciarSesion.php
      var datos = JSON.parse(res) ;
      if( datos.mes[0].Des == "Exitoso" )
        {
          // ? Le doy paso al dashboard principal
          window.location.href = "http://localhost/formaser/front/admin/dashboard/index.php";
        }
        else{
          let contenedor = document.querySelector('#ContenedorMensaje');
          let mensaje = document.createElement('div');
          contenedor.removeChild(contenedor.firstChild);
          mensaje.classList.add("alert", "alert-warning", "alert-dismissible", "fade", "show");
          mensaje.setAttribute('role','alert');
          mensaje.innerHTML = datos.mes[0].Des;
          contenedor.appendChild(mensaje);
        }
    })
})