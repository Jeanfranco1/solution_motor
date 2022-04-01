var tabla_ubicacion;

//Función que se ejecuta al inicio
function init() {
  listar();
  $("#bloc_Recurso").addClass("menu-open");

  $("#mRecurso").addClass("active");

 // $("#lBancoColor").addClass("active");


  $("#guardar_registro_ubicacion").on("click", function (e) {
    //console.log('jjjjjjjjjjjjjjjjjjjj');
    $("#submit-form-ubicacion").submit();
  });

  // Formato para telefono
  $("[data-mask]").inputmask();


}
//Función limpiar
function limpiar_ubicacion() {
  //Mostramos los Materiales
  $("#idubicacion_producto").val("");
  $("#nombre_ubicacion").val(""); 

  // Limpiamos las validaciones
  $(".form-control").removeClass('is-valid');
  $(".is-invalid").removeClass("error is-invalid");
}

//Función Listar
function listar() {

  tabla_ubicacion=$('#tabla-ubicacion').dataTable({
    "responsive": true,
    lengthMenu: [[5, 10, 25, 75, 100, 200, -1], [5, 10, 25, 75, 100, 200, "Todos"]],//mostramos el menú de registros a revisar
    "aProcessing": true,//Activamos el procesamiento del datatables
    "aServerSide": true,//Paginación y filtrado realizados por el servidor
    dom: '<Bl<f>rtip>',//Definimos los elementos del control de tabla
    buttons: ['copyHtml5', 'excelHtml5','pdf'],
    "ajax":{
        url: '../ajax/ubicacion.php?op=listar',
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

function guardaryeditar_ubicacion(e) {
  // e.preventDefault(); //No se activará la acción predeterminada del evento
  var formData = new FormData($("#form-ubicacion")[0]);
 
  $.ajax({
    url: "../ajax/ubicacion.php?op=guardaryeditar",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,

    success: function (datos) {
             
      if (datos == 'ok') {

				toastr.success('Registrado correctamente')				 

	      tabla_ubicacion.ajax.reload();
         
				limpiar();

        $("#modal-agregar-ubicacion").modal("hide");

			}else{

				toastr.error(datos)
			}
    },
  });
}

function mostrar_ubicacion(idubicacion_producto) {
  limpiar_ubicacion();
  console.log(idubicacion_producto);

  $("#modal-agregar-ubicacion").modal("show")

  $.post("../ajax/ubicacion.php?op=mostrar_ubicacion", { idubicacion_producto: idubicacion_producto }, function (data, status) {

    data = JSON.parse(data);  console.log(data);  

    $("#cargando-1-fomulario").show();
    $("#cargando-2-fomulario").hide();

    $("#idubicacion_producto").val(data.idubicacion_producto);
    $("#nombre_ubicacion").val(data.nombre); 
  });
}

//Función para desactivar registros
function desactivar(idubicacion_producto) {
  Swal.fire({
    title: "¿Está Seguro de  Desactivar el registro?",
    text: "Color",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#28a745",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, desactivar!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post("../ajax/ubicacion.php?op=desactivar", { idubicacion_producto: idubicacion_producto }, function (e) {

        Swal.fire("Desactivado!", "Tu registro ha sido desactivado.", "success");
    
        tabla.ajax.reload();
      });      
    }
  });   
}

//Función para activar registros
function activar(idubicacion_producto) {
  Swal.fire({
    title: "¿Está Seguro de  Activar el registro?",
    text: "Color",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#28a745",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, activar!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post("../ajax/ubicacion.php?op=activar", { idubicacion_producto: idubicacion_producto }, function (e) {

        Swal.fire("Activado!", "Tu registro ha sido activado.", "success");

        tabla.ajax.reload();
      });
      
    }
  });      
}
//Función para eliminar registros
function eliminar_ubicacion(idubicacion_producto) {
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
    $.post("../ajax/ubicacion.php?op=desactivar_ubicacion", { idubicacion_producto: idubicacion_producto }, function (e) {

      Swal.fire("Desactivado!", "Tu registro ha sido desactivado.", "success");

      tabla_ubicacion.ajax.reload();
    });  

  }else if (result.isDenied) {
   //op=eliminar
    $.post("../ajax/ubicacion.php?op=eliminar_ubicacion", { idubicacion_producto: idubicacion_producto }, function (e) {

      Swal.fire("Eliminado!", "Tu registro ha sido Eliminado.", "success");

      tabla_ubicacion.ajax.reload();
    }); 

  }

}); 
}

init();

$(function () {

  
  $.validator.setDefaults({

    submitHandler: function (e) {
      console.log('kkkkkk');
      guardaryeditar_ubicacion(e);
      
    },
  });

  $("#form-ubicacion").validate({
    rules: {
      nombre_ubicacion: { required: true }      // terms: { required: true },
    },
    messages: {
      nombre_ubicacion: {
        required: "Por favor ingrese nombre", 
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

