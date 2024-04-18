let inputsFile = document.querySelectorAll('input[type="file"]');
let arraySizes = ["Bytes", "KB", "MB", "GB"];

inputsFile.forEach((Input) => {
  Input.addEventListener("input", () => {
    var whileIndex = true;
    var fileSize = Input.files[0].size;
    var sizesIndex = 0;
    while (whileIndex) {
      if (fileSize > 1000) {
        sizesIndex++;
        fileSize = fileSize / 1024;
      } else {
        whileIndex = false;
      }
    }
    document.getElementById("fileInfo-" + Input.id).innerHTML = `
          <div class="alert alert-dark fw-semibold cursor-default" role="alert">
                  Nombre:  <p class="text-black-50 fw-normal mb-0 text-truncate">${
                    Input.files[0].name
                  }</p>
                  Tamaño:  <p class="text-black-50 fw-normal mb-0">${fileSize.toFixed(
                    2
                  )} ${arraySizes[sizesIndex]}</p>
          </div>
          `;
    document
      .querySelector(`label.btn.btn-outline-azul.${Input.id}`)
      .classList.add("active");
  });
});
