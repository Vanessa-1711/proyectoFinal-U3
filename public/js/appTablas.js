$(document).ready(function() {
  $('#myTable').DataTable({
    sDom: '<"top"lf>rt<"bottom"Bp>',
    buttons: [
      {
        extend: 'excel',
        className: 'dt-button buttons-excel',
        text: '<i class="fas fa-file-excel"></i>',
        titleAttr: 'Excel'
      },
      {
        extend: 'pdf',
        className: 'dt-button buttons-pdf',
        text: '<i class="fas fa-file-pdf"></i>',
        titleAttr: 'PDF'
      },
      {
          extend: 'print',
          className: 'dt-button buttons-print',
          text: '<i class="fas fa-print"></i>',
          titleAttr: 'Imprimir'
      }
    ],
    language: {
      lengthMenu: 'Mostrar _MENU_ registros por página',
      info: 'Mostrando página _PAGE_ de _PAGES_',
      paginate: {
        first: 'Primero',
        last: 'Último',
        previous: 'Anterior',
        next: 'Siguiente'
      },
      search: 'Filtrar:',
      zeroRecords: 'No se encontraron registros coincidentes',
      emptyTable: 'No hay datos disponibles en la tabla',
      infoEmpty: 'Mostrando 0 de 0 registros',
      infoFiltered: '(filtrado de _MAX_ registros totales)'
    }
  });
});
