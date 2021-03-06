var tabla;

//Función que se ejecuta al inicio
function init() {
  listar();
  $("#bloc_Recurso").addClass("menu-open");

  $("#mRecurso").addClass("active");

 // $("#lBancoColor").addClass("active");


  $("#guardar_registro_tipo_servicio").on("click", function (e) {
    //console.log('jjjjjjjjjjjjjjjjjjjj');
    $("#submit-form-tipo_servicio").submit();
  });

  // Formato para telefono
  $("[data-mask]").inputmask();


}
//Función limpiar
function limpiar() {
  //Mostramos los Materiales
  $("#idtipo_servicio").val("");
  $("#nombre").val(""); 

  // Limpiamos las validaciones
  $(".form-control").removeClass('is-valid');
  $(".is-invalid").removeClass("error is-invalid");
}

//Función Listar
function listar() {

  tabla=$('#tabla-tipo_servicio').dataTable({
    "responsive": true,
    lengthMenu: [[5, 10, 25, 75, 100, 200, -1], [5, 10, 25, 75, 100, 200, "Todos"]],//mostramos el menú de registros a revisar
    "aProcessing": true,//Activamos el procesamiento del datatables
    "aServerSide": true,//Paginación y filtrado realizados por el servidor
    dom: '<Bl<f>rtip>',//Definimos los elementos del control de tabla
    buttons: ['copyHtml5', 'excelHtml5','pdf'],
    "ajax":{
        url: '../ajax/tipo_servicio.php?op=listar',
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

function guardaryeditar_tipo_servicio(e) {
  // e.preventDefault(); //No se activará la acción predeterminada del evento
  var formData = new FormData($("#form-tipo_servicio")[0]);
 
  $.ajax({
    url: "../ajax/tipo_servicio.php?op=guardaryeditar",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,

    success: function (datos) {
             
      if (datos == 'ok') {

				toastr.success('Registrado correctamente')				 

	      tabla.ajax.reload();
         
				limpiar();

        $("#modal-agregar-tipo_servicio").modal("hide");

			}else{

				toastr.error(datos)
			}
    },
  });
}

function mostrar(idtipo_servicio) {
  limpiar();
  console.log(idtipo_servicio);

  $("#modal-agregar-tipo_servicio").modal("show")

  $.post("../ajax/tipo_servicio.php?op=mostrar", { idtipo_servicio: idtipo_servicio }, function (data, status) {

    data = JSON.parse(data);  console.log(data);  

    $("#cargando-1-fomulario").show();
    $("#cargando-2-fomulario").hide();

    $("#idtipo_servicio").val(data.idtipo_servicio);
    $("#nombre").val(data.nombre); 
  });
}

//Función para desactivar registros
function desactivar(idtipo_servicio) {
  Swal.fire({
    title: "¿Está Seguro de  Desactivar el registro?",
    text: "tipo_servicio",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#28a745",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, desactivar!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post("../ajax/tipo_servicio.php?op=desactivar", { idtipo_servicio: idtipo_servicio }, function (e) {

        Swal.fire("Desactivado!", "Tu registro ha sido desactivado.", "success");
    
        tabla.ajax.reload();
      });      
    }
  });   
}

//Función para activar registros
function activar(idtipo_servicio) {
  Swal.fire({
    title: "¿Está Seguro de  Activar el registro?",
    text: "tipo_servicio",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#28a745",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, activar!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post("../ajax/tipo_servicio.php?op=activar", { idtipo_servicio: idtipo_servicio }, function (e) {

        Swal.fire("Activado!", "Tu registro ha sido activado.", "success");

        tabla.ajax.reload();
      });
      
    }
  });      
}
//Función para eliminar registros
function eliminar_tipo_servicio(idtipo_servicio) {
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
    $.post("../ajax/tipo_servicio.php?op=desactivar", { idtipo_servicio: idtipo_servicio }, function (e) {

      Swal.fire("Desactivado!", "Tu registro ha sido desactivado.", "success");

      tabla.ajax.reload();
    });  

  }else if (result.isDenied) {
   //op=eliminar
    $.post("../ajax/tipo_servicio.php?op=eliminar", { idtipo_servicio: idtipo_servicio }, function (e) {

      Swal.fire("Eliminado!", "Tu registro ha sido Eliminado.", "success");

      tabla.ajax.reload();
    }); 

  }

}); 
}

init();

$(function () {

  
  $.validator.setDefaults({

    submitHandler: function (e) {
      console.log('kkkkkk');
      guardaryeditar_tipo_servicio(e);
      
    },
  });

  $("#form-tipo_servicio").validate({
    rules: {
      nombre: { required: true }      // terms: { required: true },
    },
    messages: {
      nombre: {
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

