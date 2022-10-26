


$("#listarUsuarios").click(function (e) { 
    e.preventDefault();
     listarUsuarios()
});


function listarUsuarios() {

	tabla = $('#tabla_listar').DataTable({
		ajax: {
			url: '../controllers/user.php',
			type: 'POST',
			dataType: 'JSON',
			data: { opcn: 'consultarUsuarios' },
			dataSrc: ''
		},
		columns: [
			{ data: 'id', title: 'ID' },
			{ data: 'contact_no', title: 'contact_no' },
			{ data: 'lastname', title: 'lastname' },
			{ data: 'createdtime', title: 'createdtime' },
		],
		destroy: true,
		"language": {
			"sProcessing": "Procesando...",
			"sLengthMenu": "Mostrar MENU registros",
			"sZeroRecords": "No se encontraron resultados",
			"sEmptyTable": "Ningun dato disponible en esta tabla",
			"sInfo": "Mostrando registros del START al END de un total de TOTAL registros",
			"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
			"sInfoFiltered": "(de MAX registros)",
			"sInfoPostFix": "",
			"sSearch": "Buscar:",
			"sUrl": "",
			"sInfoThousands": ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
				"sFirst": "Primero",
				"sLast": "0‰3ltimo",
				"sNext": "Siguiente",
				"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending": ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		}
		,
		dom: 'lBfrtip',
		pageLength: 5,
		buttons: [
			{
				extend: 'excelHtml5',
				text: '<i class="las la-file-excel">EXCEL</i>',
				filename: 'Reporte_usuarios',
			},
			{
				extend: 'pdfHtml5',
				text: '<i class="las la-file-pdf">PDF</i>',
				orientation: 'landscape',
				filename: 'Reporte_usuarios'
			},
			{ extend: 'print', text: '<i class="las la-print">IMPRIMIR</i>', filename: 'Reporte_usuarios' }
		]

	})
}
