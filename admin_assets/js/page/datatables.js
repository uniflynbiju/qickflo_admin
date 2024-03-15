"use strict";
$("[data-checkboxes]").each(function () {
  var me = $(this),
    group = me.data('checkboxes'),
    role = me.data('checkbox-role');
  me.change(function () {
    var all = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"])'),
      checked = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"]):checked'),
      dad = $('[data-checkboxes="' + group + '"][data-checkbox-role="dad"]'),
      total = all.length,
      checked_length = checked.length;
    if (role == 'dad') {
      if (me.is(':checked')) {
        all.prop('checked', true);
      } else {
        all.prop('checked', false);
      }
    } else {
      if (checked_length >= total) {
        dad.prop('checked', true);
      } else {
        dad.prop('checked', false);
      }
    }
  });
});
$("#table-1").dataTable({
  "columnDefs": [
    { "sortable": false, "targets": [2, 3] }
  ]
});
$("#table-2").dataTable({
  "columnDefs": [
    { "sortable": false, "targets": [0, 2, 3] }
  ],
  order: [[1, "asc"]] //column indexes is zero based
});
$('#save-stage').DataTable({
  "scrollX": true,
  stateSave: true
});
// Initialize DataTable() for #tableExport with buttons
$('#tableExport').DataTable({
  dom: 'Bfrtip',
  buttons: [
    {
      extend: 'copy',
      text: 'Copy',
      className: 'copyButton' // add a class for the button
    },
    {
      extend: 'csv',
      text: 'CSV',
      className: 'csvButton' // add a class for the button
    },
    {
      extend: 'excel',
      text: 'Excel',
      className: 'excelButton' // add a class for the button
    },
    {
      extend: 'pdf',
      text: 'PDF',
      className: 'pdfButton' // add a class for the button
    },
    {
      extend: 'print',
      text: 'Print',
      className: 'printButton' // add a class for the button
    }
  ]
});
// Add background color to buttons
$('.copyButton').css('background-color', '#666');
$('.csvButton').css({ 'background-color': 'rgba(42, 185, 208, 0.16)', 'color': '#2ab9d0' });

$('.excelButton').css({
  'color': '#59bf70',
  'background-color': 'rgba(89, 191, 112, 0.16)'
});
$('.pdfButton').css({
  'color': '#e91e63',
  'background-color': 'rgba(233, 30, 99, 0.16)'
});


$('.printButton').css({
    'color': '#696cff',
    'background-color': 'rgba(105, 108, 255, 0.16)'
});
