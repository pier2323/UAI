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

<table id="datatable_users" class="hover dataTable no-footer" style="width: 100%" aria-describedby="datatable_users_info">
    {{ $head }}
    <tbody id="tableBody_users">{{ $slot }}</tbody>
</table>



   {{-- links styles --}}
   <link rel="stylesheet" href="/css/app.css" />
   <link rel="stylesheet" href="/css/styles.css" />
   <link rel="stylesheet" href="/css/all.min.css" />


   {{-- links bootstrap --}}
   <link href="/css/bootstrap/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="/css/bootstrap.min.css" />
   <link rel="stylesheet" href="/css/dataTables.bootstrap5.min.css" />


<script src=""></script>
<script>
    let dataTable;
    let dataTableIsInitialized = false;

    const dataTableOptions = {
        //scrollX: "2000px",
        lengthMenu: [5, 10, 15, 20, 100, 200, 500],
        columnDefs: [{
                className: "centered",
                targets: [0, 1]
            },
            // { orderable: false, targets: [1, ] },
            {
                searchable: false,
                targets: [1]
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
<!-- Bootstrap-->
<script src="js/bootstrap/bootstrap.bundle.min.js"></script>

<!-- jQuery -->
<script src="/js/jquery-dataTables/jquery.min.js"></script>
<!-- DataTable -->
<script src="/js/jquery-dataTables/jquery.dataTables.min.js"></script>
<script src="/js/jquery-dataTables/dataTables.bootstrap5.min.js"></script>