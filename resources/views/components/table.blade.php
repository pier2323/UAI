<table id="datatable_users" class="hover dataTable no-footer px-4 py-2" style="width: 100%" aria-describedby="datatable_users_info">
{{ $head }}
<tbody id="tableBody_users">{{ $slot }}</tbody>
</table>

<script>
  let dataTable;
  let dataTableIsInitialized = false;
  let spanish = {
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
    }
  }

  const dataTableOptions = {
    //scrollX: "2000px",
    lengthMenu: [5, 10, 15, 20, 30, 50],
    columnDefs: [{ className: "centered"}, { orderable: true }, { searchable: true},],
    pageLength: 10,
    destroy: true,
    language: spanish,
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