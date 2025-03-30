/*
Template Name: PDSI - Admin & Dashboard Template
Author: ICT PDSI
Version: 1.5.0
Website: https://ICT PDSI.com/
Contact: ICT PDSI@gmail.com
File: Common Plugins Js File
*/

//Common plugins
if (document.querySelectorAll("[toast-list]") || document.querySelectorAll('[data-choices]') || document.querySelectorAll("[data-provider]")) {
  document.writeln("<script type='text/javascript' src='https://cdn.jsdelivr.net/npm/toastify-js'></script>");
  document.writeln("<script type='text/javascript' src='build/libs/choices.js/public/assets/scripts/choices.min.js'></script>");
  document.writeln("<script type='text/javascript' src='build/libs/flatpickr/flatpickr.min.js'></script>");
}
