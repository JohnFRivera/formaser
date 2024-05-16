import { Hosting, setNavBar, setFooter } from '../assets/js/globals.js';
setNavBar();
var dateNow = new Date();
document.getElementById('dateNow').innerHTML = `${dateNow.toLocaleString().split(',')[0]}`;
setFooter();