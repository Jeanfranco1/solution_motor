var tabla_categoria;

//Función que se ejecuta al inicio
function init() {
  listar_categoria();
  $("#bloc_Recurso").addClass("menu-open");

  $("#mRecurso").addClass("active");

  //$("#lAllMateriales").addClass("active");


  $("#guardar_categoria").on("click", function (e) {
    
    $("#submit-form-categoria").submit();
    
  });

  // Formato para telefono
  $("[data-mask]").inputmask();


}
//Función limpiar
function limpiar_categoria() {
  //Mostramos los Materiales
  $("#idcategoria").val("");
  $("#nombre_categoria").val(""); 

  // Limpiamos las validaciones
  $(".form-control").removeClass('is-valid');
  $(".is-invalid").removeClass("error is-invalid");
}

//Función Listar
function listar_categoria() {

  tabla_categoria=$('#tabla-categoria').dataTable({
    "responsive": true,
    lengthMenu: [[5, 10, 25, 75, 100, 200, -1], [5, 10, 25, 75, 100, 200, "Todos"]],//mostramos el menú de registros a revisar
    "aProcessing": true,//Activamos el procesamiento del datatables
    "aServerSide": true,//Paginación y filtrado realizados por el servidor
    dom: '<Bl<f>rtip>',//Definimos los elementos del control de tabla
    buttons: ['copyHtml5', 'excelHtml5','pdf'],
    "ajax":{
        url: '../ajax/categoria.php?op=listar',
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

function guardaryeditar_categoria(e) {
  // e.preventDefault(); //No se activará la acción predeterminada del evento
  var formData = new FormData($("#form-categoria")[0]);
 
  $.ajax({
    url: "../ajax/categoria.php?op=guardaryeditar",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,

    success: function (datos) {
             
      if (datos == 'ok') {

				toastr.success('Registrado correctamente')				 

	      tabla_categoria.ajax.reload();
         
				limpiar_categoria();

        $("#modal-agregar-categoria").modal("hide");

			}else{

				toastr.error(datos)
			}
    },
  });
}

function mostrar_categoria(idcategoria) {
  limpiar_categoria();

  $("#modal-agregar-categoria").modal("show")

  $.post("../ajax/categoria.php?op=mostrar_categoria", { idcategoria: idcategoria }, function (data, status) {

    data = JSON.parse(data);  console.log(data);  

    $("#cargando-1-fomulario").show();
    $("#cargando-2-fomulario").hide();

    $("#idcategoria").val(data.idcategoria);
    $("#nombre_categoria").val(data.nombre); 
  });
}

//Función para desactivar registros
function desactivar_categoria(idcategoria) {
  Swal.fire({
    title: "¿Está Seguro de  Desactivar el registro?",
    text: "Unidad de medida",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#28a745",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, desactivar!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post("../ajax/categoria.php?op=desactivar_categoria", { idcategoria: idcategoria }, function (e) {

        Swal.fire("Desactivado!", "Tu registro ha sido desactivado.", "success");
    
        tabla_categoria.ajax.reload();
      });      
    }
  });   
}

//Función para activar registros
function activar_categoria(idcategoria) {
  Swal.fire({
    title: "¿Está Seguro de  Activar el registro?",
    text: "Unidad de medida",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#28a745",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, activar!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post("../ajax/categoria.php?op=activar_categoria", { idcategoria: idcategoria }, function (e) {

        Swal.fire("Activado!", "Tu registro ha sido activado.", "success");

        tabla_categoria.ajax.reload();
      });
      
    }
  });      
}

//Función para eliminar registros
function eliminar_categoria(idcategoria) {
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
    $.post("../ajax/categoria.php?op=desactivar_categoria", { idcategoria: idcategoria }, function (e) {

      Swal.fire("Desactivado!", "Tu registro ha sido desactivado.", "success");

      tabla_categoria.ajax.reload();
    }); 

  }else if (result.isDenied) {
   //op=eliminar
    $.post("../ajax/categoria.php?op=eliminar_categoria", { idcategoria: idcategoria }, function (e) {

      Swal.fire("Eliminado!", "Tu registro ha sido Eliminado.", "success");

      tabla_categoria.ajax.reload();
    }); 

  }

});
}

init();

$(function () {

  nombre_categoria
  $.validator.setDefaults({

    submitHandler: function (e) {
        guardaryeditar_categoria(e);
      
    },
  });

  $("#form-categoria").validate({
    rules: {
      nombre_categoria: { required: true }      // terms: { required: true },
    },
    messages: {
      nombre_categoria: {
        required: "Por favor ingrese nombre_categoria.", 
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

