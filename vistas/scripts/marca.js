var tabla_marca;

//Función que se ejecuta al inicio
function init() {
  listar_marca();
  $("#bloc_Recurso").addClass("menu-open");

  $("#mRecurso").addClass("active");

  //$("#lAllMateriales").addClass("active");

  $("#guardar_registro_marca").on("click", function (e) {
    
    $("#submit-form-marca").submit();
  });

  // Formato para telefono
  $("[data-mask]").inputmask();

}
//Función limpiar
function limpiar_marca() {
  //Mostramos los Materiales
  $("#idmarca").val("");
  $("#nombre_marca").val(""); 

  // Limpiamos las validaciones
  $(".form-control").removeClass('is-valid');
  $(".is-invalid").removeClass("error is-invalid");
}

//Función Listar
function listar_marca() {

  tabla_marca=$('#tabla-marca').dataTable({
    "responsive": true,
    lengthMenu: [[5, 10, 25, 75, 100, 200, -1], [5, 10, 25, 75, 100, 200, "Todos"]],//mostramos el menú de registros a revisar
    "aProcessing": true,//Activamos el procesamiento del datatables
    "aServerSide": true,//Paginación y filtrado realizados por el servidor
    dom: '<Bl<f>rtip>',//Definimos los elementos del control de tabla
    buttons: ['copyHtml5', 'excelHtml5', 'pdf'],
    "ajax":{
        url: '../ajax/marca.php?op=listar_marca',
        type : "get",
        dataType : "json",						
        error: function(e){
          console.log(e.responseText);	
        }
      },
      createdRow: function (row, data, ixdex) {    
  
        // columna: #
        if (data[0] != '') {
          $("td", row).eq(0).addClass("text-center");   
           
        }
        // columna: #
        if (data[1] != '') {
          $("td", row).eq(1).addClass("text-nowrap");   
            
        }
      },
    "language": {
      "lengthMenu": "Mostrar : _MENU_ registros",
      "buttons": {
        "copyTitle": "Tabla Copiada",
        "copySuccess": {
          _: '%d líneas copiadas',
          1: '1 línea copiada'
        }
      }
    },
    "bDestroy": true,
    "iDisplayLength": 5,//Paginación
    "order": [[ 0, "asc" ]]//Ordenar (columna,orden)
  }).DataTable();
}

//Función para guardar o editar

function guardaryeditar_marca(e) {
  // e.preventDefault(); //No se activará la acción predeterminada del evento
  var formData = new FormData($("#form-marca")[0]);
 
  $.ajax({
    url: "../ajax/marca.php?op=guardaryeditar",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,

    success: function (datos) {
             
      if (datos == 'ok') {

				toastr.success('Registrado correctamente')				 

	      tabla_marca.ajax.reload();
         
				limpiar_marca();

        $("#modal-agregar-marca").modal("hide");

			}else{

				toastr.error(datos)
			}
    },
  });
}

function mostrar_marca(idmarca) {
  limpiar_marca(); //console.log(idmarca);

  $("#modal-agregar-marca").modal("show")

  $.post("../ajax/marca.php?op=mostrar_marca", { idmarca: idmarca }, function (data, status) {

    data = JSON.parse(data);  console.log(data);  

    $("#cargando-1-fomulario").show();
    $("#cargando-2-fomulario").hide();

    $("#idmarca").val(data.idmarca);
    $("#nombre_marca").val(data.nombre);
  });
}

//Función para desactivar registros
function desactivar_marca(idmarca) {
  Swal.fire({
    title: "¿Está Seguro de  Desactivar el registro?",
    text: "Ocupación",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#28a745",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, desactivar!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post("../ajax/marca.php?op=desactivar_marca", { idmarca: idmarca }, function (e) {

        Swal.fire("Desactivado!", "Tu registro ha sido desactivado.", "success");
    
        tabla_marca.ajax.reload();
      });      
    }
  });   
}

//Función para activar registros
function activar_marca(idmarca) {
  Swal.fire({
    title: "¿Está Seguro de  Activar el registro?",
    text: "Ocupación",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#28a745",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, activar!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post("../ajax/marca.php?op=activar_marca", { idmarca: idmarca }, function (e) {

        Swal.fire("Activado!", "Tu registro ha sido activado.", "success");

        tabla_marca.ajax.reload();
      });
      
    }
  });      
}

//Función para desactivar registros
function eliminar_marca(idmarca) {
  //----------------------------
 Swal.fire({

  title: "!Elija una opción¡",
  html: "En <b>papelera</b> encontrará este registro! <br> Al <b>eliminar</b> no tendrá acceso a recuperar este registro!",
  icon: "warning",
  showCancelButton: true,
  showDenyButton: true,
  confirmButtonColor: "#17a2b8",
  denyButtonColor: "#d33",
  cancelButtonColor: "#6c757d",    
  confirmButtonText: `<i class="fas fa-times"></i> Papelera`,
  denyButtonText: `<i class="fas fa-skull-crossbones"></i> Eliminar`,

}).then((result) => {

  if (result.isConfirmed) {
   //op=desactivar
    $.post("../ajax/marca.php?op=desactivar_marca", { idmarca: idmarca }, function (e) {

      Swal.fire("Desactivado!", "Tu registro ha sido desactivado.", "success");

      tabla_marca.ajax.reload();
    });  

  }else if (result.isDenied) {
   //op=eliminar
    $.post("../ajax/marca.php?op=eliminar_marca", { idmarca: idmarca }, function (e) {

      Swal.fire("Eliminado!", "Tu registro ha sido Eliminado.", "success");

      tabla_marca.ajax.reload();
    }); 

  }

});   
}

init();

$(function () {

  
  $.validator.setDefaults({

    submitHandler: function (e) {
        guardaryeditar_marca(e);
      
    },
  });

  $("#form-marca").validate({
    rules: {
      nombre_marca: { required: true }      // terms: { required: true },
    },
    messages: {
      nombre_marca: {
        required: "Por favor ingrese nombre.", 
      },

    },
        
    errorElement: "span",

    errorPlacement: function (error, element) {

      error.addClass("invalid-feedback");

      element.closest(".form-group").append(error);
    },

    highlight: function (element, errorClass, validClass) {

      $(element).addClass("is-invalid");
    },

    unhighlight: function (element, errorClass, validClass) {

      $(element).removeClass("is-invalid").addClass("is-valid");
   
    },


  });
});

