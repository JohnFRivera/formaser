import {
  getPageName,
  setNavBar,
  setFooter,
} from "../../../assets/js/globals.js";

function setAsideActive() {
  let links = document.querySelectorAll(".btn-aside");
  links.forEach((Link) => {
    if (getPageName().toUpperCase() == Link.innerText) {
      Link.classList.add("active");
    }
  });
}
function setAsideBoard() {
  var folderOrigin = window.location.origin + "/formaser/front/admin/gestiones";
  var asideBoard = document.getElementById("asideBoard");
  asideBoard.innerHTML = `
    <ul class="nav nav-fill d-flex flex-nowrap flex-sm-column overflow-x-auto">
        <li class="nav-item">
            <a class="nav-link bg-body-secondary h-100 text-nowrap d-flex align-items-center btn-aside" href="${folderOrigin}/usuarios/">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="mx-3" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                </svg>
                USUARIOS
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link bg-body-secondary h-100 d-flex align-items-center btn-aside" href="${folderOrigin}/pre-inscripciones/">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="mx-3" viewBox="0 0 16 16">
                  <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.354-5.854 1.5 1.5a.5.5 0 0 1-.708.708L13 11.707V14.5a.5.5 0 0 1-1 0v-2.793l-.646.647a.5.5 0 0 1-.708-.708l1.5-1.5a.5.5 0 0 1 .708 0M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                  <path d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4" />
                </svg>
                PRE-INSCRIPCIONES
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link bg-body-secondary h-100 text-nowrap d-flex align-items-center btn-aside" href="${folderOrigin}/inscripciones/">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="mx-3" viewBox="0 0 16 16">
                <path d="M12.5 9a3.5 3.5 0 1 1 0 7 3.5 3.5 0 0 1 0-7m.354 5.854 1.5-1.5a.5.5 0 0 0-.708-.708l-.646.647V10.5a.5.5 0 0 0-1 0v2.793l-.646-.647a.5.5 0 0 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                <path d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4"/>
                </svg>
                INSCRIPCIONES
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link bg-body-secondary h-100 text-nowrap d-flex align-items-center btn-aside" href="${folderOrigin}/matriculas/">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="mx-3" viewBox="0 0 16 16">
                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                <path d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4"/>
                </svg>
                MATRICULAS
            </a>
        </li>
    </ul>
    `;
  //setAsideActive();
}

setNavBar();
setAsideBoard();
setFooter();
