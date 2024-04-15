<style>
  .code {
    color: rgb(0, 0, 0);
    width: 50px;
  }

  .field {
    display: flex;
    justify-content: center;
    align-items: center;
  }
</style>

<table id="datatable_users" class=" px-4 py-2 hover dataTable no-footer" style="width: 100%"
  aria-describedby="datatable_users_info">
  {{ $head }}
  <tbody id="tableBody_users">{{ $slot }}</tbody>
</table>

<script>
  let dataTable;
  let dataTableIsInitialized = false;

  const dataTableOptions = {
    //scrollX: "2000px",
    lengthMenu: [6, 10, 15, 20, 100, 200, 500],
    columnDefs: [{
        className: "centered",
        
      },
      // { orderable: false, targets: [1, ] },
      {
        searchable: true,
       
      },
      // { width: "100%", targets: [0, 1, 2, 3] }
    ],
    pageLength: 3,
    destroy: true,
    language: {
      lengthMenu: "Mostrar _MENU_ registros por página",
      zeroRecords: "Ningún usuario encontrado",
      info: "Mostrando de _START_ a _END_ de un total de _TOTAL_ registros",
      infoEmpty: "Ningún usuario encontrado",
      infoFiltered: "(filtrados desde _MAX_ registros totales)",
      search: "Buscar:",
      loadingRecords: "Cargando...",
      paginate: {
        first: "Primero",
        last: "Último",
        next: "Siguiente",
        previous: "Anterior",
      },
    },
  };

  const initDataTable = async () => {
    if (dataTableIsInitialized) {
      dataTable.destroy();
    }

    dataTable = $("#datatable_users").DataTable(dataTableOptions);

    dataTableIsInitialized = true;
  };


  window.addEventListener("load", async () => {
    await initDataTable();
  });
</script>
