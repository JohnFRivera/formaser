let inputFile = document.querySelector('input[type="file"]');
let arraySizes = ['Bytes', 'KB', 'MB', 'GB'];

inputFile.addEventListener('input', () => {
    var whileIndex = true;
    var fileSize = inputFile.files[0].size;
    var sizesIndex = 0;
    while (whileIndex) {
        if (fileSize > 1000) {
            sizesIndex++;
            fileSize = (fileSize/1024);
        } else {
            whileIndex = false;
        };
    }
    document.getElementById('fileInfo').innerHTML = `
    <div class="alert alert-dark fw-semibold cursor-default" role="alert">
            Nombre:  <span class="text-black-50 fw-normal">${inputFile.files[0].name}</span><br>
            Tamaño:  <span class="text-black-50 fw-normal">${fileSize.toFixed(2)} ${arraySizes[sizesIndex]}</span>
    </div>
    `;
    document.querySelector('label.btn.btn-outline-azul').classList.add('active');
});