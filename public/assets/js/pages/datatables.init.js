/******/ (function() { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************************!*\
  !*** ./resources/js/pages/datatables.init.js ***!
  \***********************************************/
$(document).ready(function () {
  $("#datatable").DataTable(), $("#datatable-buttons").DataTable({
      ordering: false,
      lengthChange: !1,
      buttons: [
          {
              extend:    'copyHtml5',
              text:      '<i class="far fa-copy text-dark h4 mb-0"></i>',
              titleAttr: 'Copy'
          },
          {
              extend:    'excelHtml5',
              text:      '<i class="fas fa-file-excel text-success h4 mb-0"></i>',
              titleAttr: 'Excel'
          },
          {
              extend:    'csvHtml5',
              text:      '<i class="fas fa-file-csv text-info h4 mb-0"></i>',
              titleAttr: 'CSV'
          },
          {
              extend:    'pdfHtml5',
              text:      '<i class="fas fa-file-pdf text-danger h4 mb-0"></i>',
              titleAttr: 'PDF'
          }
      ]
  }).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)"), $(".dataTables_length select").addClass("form-select form-select-sm");
});
/******/ })()
;
