fetch(`${window.location.origin}/formaser/back/modulos/segundoFormato.php`, {
  method: "POST",
  body: formData,
})
.then(response => response.json())
.then(data => {
    
})
