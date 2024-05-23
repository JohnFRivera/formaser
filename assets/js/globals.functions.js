const GetHost = () => {
    return window.location.origin + '/formaser';
};
document.head.innerHTML += `
<link rel="icon" type="image/png" href="${GetHost()}/assets/img/sena-logo.png">
`;
const SetTitle = (title) => {
    document.title = title;
};
const CreateCss = (url) => {
    var link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = url;
    document.head.appendChild(link);
};
const CreateScript = (url) => {
    var script = document.createElement('script');
    script.scr = url;
    document.head.appendChild(script);
};
//components
const SetFooter = (id) => {
    document.getElementById(id).innerHTML = `
    <div class="col">
        <div class="row bg-verde d-flex justify-content-between px-3 py-3">
            <div class="col-auto">
                <p class="text-white-50 mb-0">
                    Front-end by 
                    <a class="link-light link-opacity-75 link-opacity-100-hover text-decoration-none" href="https://github.com/JohnFRivera" target="_blank">
                        <i class="bi bi-github"></i>
                        John Freddy Rivera Ayala
                    </a>&#169 2024
                </p>
            </div>
            <div class="col-auto">
                <p class="text-white-50 mb-0">
                    Back-end by 
                    <a class="link-light link-opacity-75 link-opacity-100-hover text-decoration-none" href="https://github.com/KevinJimenz" target="_blank">
                        <i class="bi bi-github"></i>
                        Kevin Camilo Jimenez
                    </a>, 
                    <a class="link-light link-opacity-75 link-opacity-100-hover text-decoration-none" href="https://github.com/HectorRestrepo13" target="_blank">
                        <i class="bi bi-github"></i>
                        Hector Fabio Retrepo
                    </a>&#169 2024
                </p>
            </div>
        </div>
    </div>
    `;
};
const SetError = (id, err) => {
    document.getElementById(id).innerHTML = `
    <i class="bi bi-exclamation-circle-fill fs-6"></i>
    ${err}
    `;
};
const GetLoading = () => {
    return `<span class="spinner-border spinner-border-sm" aria-hidden="true"></span><span role="status">Cargando...</span>`;
};
const SetModal = (modalContent) => {
    document.getElementById('staticBackdrop').innerHTML = modalContent;
};

export {
    GetHost,
    SetTitle,
    CreateCss,
    CreateScript,
    SetFooter,
    SetError,
    GetLoading,
    SetModal
};