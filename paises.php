<?php

//Mostramos los errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$_SESSION['pagina'] = 'Monedas - Paises y Divisas';

include_once 'includes/header.php';

//Vamos a obtener todas las monedas de España
$sql= "SELECT * FROM paises;";
$query = mysqli_query($con,$sql) or die(mysqli_errno($con));


?>

<div class="container text-center">
        <div class="container mt-3 mb-3">

            <!-- Div para mostrar resultado de operaciones -->
            <div id="mensajeResultado" class="alert alert-success" style="display: none;"></div>

            <table id="tablapaises" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Bandera</th>
                        <th>Divisa</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

        </div>
    </div>


<?php include_once 'includes/footer.php' ?>


<script>
    $(document).ready(function () {
        $('#tablapaises').DataTable({
            "ajax": {
                "url": "datos_paises.php",
                "dataSrc": ""
            },
            "lengthMenu": [[ 10, 25, 50, -1 ], [ 10, 25, 50, "Todos" ]], // Define las opciones de cantidad de registros por página
            "pageLength": 10, // Define la cantidad de registros por página por defecto
            "language":	{
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ países",
                "sZeroRecords":    "No se encontraron países",
                "sEmptyTable":     "Ningún país disponible en esta tabla",
                "sInfo":           "Mostrando estados del _START_ al _END_ de un total de _TOTAL_ países",
                "sInfoEmpty":      "Mostrando países del 0 al 0 de un total de 0 países",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ países)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
                },
                "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
                    },
            "columns": [
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return '<a href="#" class="ver-pais" data-bs-toggle="modal" data-bs-target="#paisModal-' + row.id + '" title="Ver país">' + row.id + '</a>';                    
                    },
                },
                { "data": "nombre" },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return '<img src="common/public/images/paises/' + row.bandera + '" title="' + row.nombre +'"></img>';
                    }
                },
                { "data": "divisa" },
                { 
                    "data": null,
                    "render": function (data, type, row) {
                        return '<a href="#" class="btn btn-primary btn-outline ver-pais" data-bs-toggle="modal" data-bs-target="#paisModal-' + row.id + '" title="Ver estado"><i class="fas fa-eye"></i></a> <a href="#" class="btn btn-danger btn-outline eliminar-estado" data-id="' + row.id + '" title="Eliminar pais"><i class="fas fa-trash"></i></a>';
                    }, 
                    "orderable": false, // Última columna no ordenable
                    "width": "100px" 
                }
            ],
        });

    });

</script>