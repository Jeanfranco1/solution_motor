var tabla;
var tabla_imagen;

//Función que se ejecuta al inicio
function init() {
  listar();
  $("#bloc_Recurso").addClass("menu-open");

  $("#mServicio").addClass("active");

  $("#guardar_registro").on("click", function (e) { $("#submit-form-servicio").submit(); });
  $("#guardar_registro_imagen").on("click", function (e) { $("#submit-form-imagen").submit(); });

  //Mostramos tipo_servicio
  $.post("../ajax/tipo_servicio.php?op=selecttipo_servicio", function (r) { $("#tipo_servicio").html(r); });
  

  //Initialize Select2 tipo_servicio
  $("#tipo_servicio").select2({
    theme: "bootstrap4",
    placeholder: "Seleccinar tipo de servicio",
    allowClear: true,
  });

  //============Tipo de Servicio================
  $("#tipo_servicio").val("null").trigger("change");
 
}

// abrimos el navegador de archivos

//ficha tecnica
$("#doc2_i").click(function() {  $('#doc2').trigger('click'); });
$("#doc2").change(function(e) {  addDocs(e,$("#doc2").attr("id")) });


// Eliminamos el doc 2
function doc2_eliminar() {

	$("#doc2").val("");

	$("#doc2_ver").html('<img src="../dist/svg/pdf_trasnparent.svg" alt="" width="50%" >');

	$("#doc2_nombre").html("");
}

//Función limpiar
function limpiar() {
  //Mostramos los servicio

  $("#idservicios").val("");
  $("#tipo_servicio").val("null").trigger("change");
  $("#fecha_ingreso").val("");
  $("#fecha_salida").val("");
  $("#fec_prox_mant").val("");
  $("#Km_ingreso").val("");
  $("#prox_mantenimiento").val("");
  $("#informe_ingreso").val("");
  $("#ficha_tecnica").val("");

  $(".form-control").removeClass("is-valid");
  $(".is-invalid").removeClass("error is-invalid");
}
function limpiar_imagen() {
  //Mostramos los servicio

  $("#idimagen_servicio").val("");
  $("#tipo_imagen").val("");
  $("#doc_old_2").val("");
  $("#doc2").val("");  
  $('#doc2_ver').html(`<img src="../dist/svg/pdf_trasnparent.svg" alt="" width="50%" >`);
  $('#doc2_nombre').html("");


  $(".form-control").removeClass("is-valid");
  $(".is-invalid").removeClass("error is-invalid");
}

function table_show_hide(estado) {
 
  if (estado==1) {

    //toastr.success('Equipo de computo agregado');
    console.log('oooooooooo');
    $("#tabla_principal").show();
    $("#tabla_imagen").hide();
    $("#add_servicio").show();
    $("#btn-regresar").hide();
    $("#btn-agregar_img").hide();

 
  }
  if (estado==2) {

    //toastr.success('Equipo de computo agregado');
    console.log('oooooooooo');
    $("#tabla_principal").hide();
    $("#tabla_imagen").show();
    $("#add_servicio").hide();
    $("#btn-regresar").show();
    $("#btn-agregar_img").show();

 
  } 

  
}
//Función Listar
function listar() {
  tabla = $("#tabla-servicio")
    .dataTable({
      responsive: true,
      lengthMenu: [5, 10, 25, 75, 100], //mostramos el menú de registros a revisar
      aProcessing: true, //Activamos el procesamiento del datatables
      aServerSide: true, //Paginación y filtrado realizados por el servidor
      dom: "<Bl<f>rtip>", //Definimos los elementos del control de tabla
      buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdf", "colvis"],
      ajax: {
        url: "../ajax/servicio.php?op=listar",
        type: "get",
        dataType: "json",
        error: function (e) {
          console.log(e.responseText);
        },
      },
      createdRow: function (row, data, ixdex) {    
  
        // columna: #
        if (data[0] != '') {
          $("td", row).eq(0).addClass("text-center");   
            
        }
        // columna: 1
        if (data[1] != '') {
          $("td", row).eq(1).addClass("text-center text-nowrap");   
            
        }
        // columna: # 5
        if (data[5] != '') {
          $("td", row).eq(5).addClass("text-right text-nowrap");   
            
        }
        // columna: # 6
        if (data[6] != '') {
          $("td", row).eq(6).addClass("text-right text-nowrap");   
            
        }
        // columna: # 7
        if (data[7] != '') {
          $("td", row).eq(7).addClass("text-right text-nowrap");   
            
        }
        // columna: #8
        if (data[8] != '') {
          $("td", row).eq(8).addClass("text-right text-nowrap");   
            
        }
      },
      language: {
        lengthMenu: "Mostrar : _MENU_ registros",
        buttons: {
          copyTitle: "Tabla Copiada",
          copySuccess: {
            _: "%d líneas copiadas",
            1: "1 línea copiada",
          },
        },
      },
      bDestroy: true,
      iDisplayLength: 10, //Paginación
      order: [[0, "asc"]], //Ordenar (columna,orden)
    })
    .DataTable();
}
//Función para guardar o editar
function guardaryeditar(e) {
  // e.preventDefault(); //No se activará la acción predeterminada del evento
  var formData = new FormData($("#form-servicio")[0]);

  $.ajax({
    url: "../ajax/servicio.php?op=guardaryeditar",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,

    success: function (datos) {
      if (datos == "ok") {
        Swal.fire("Correcto!", "Insumo guardado correctamente", "success");

        tabla.ajax.reload();

        limpiar();

        $("#modal-agregar-servicio").modal("hide");
      } else {
        Swal.fire("Error!", datos, "error");
      }
    },
  });
}

function guardaryeditar_imagen(e) {
  // e.preventDefault(); //No se activará la acción predeterminada del evento
  var formData = new FormData($("#form-imagen")[0]);

  $.ajax({
    url: "../ajax/imagen_servicio.php?op=guardaryeditar_imagen",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,

    success: function (datos) {
      if (datos == "ok") {
        Swal.fire("Correcto!", "Insumo guardado correctamente", "success");

        tabla.ajax.reload();

        limpiar();

        $("#modal-agregar-imagen").modal("hide");
      } else {
        Swal.fire("Error!", datos, "error");
      }
    },
  });
}
function mostrar(idservicios) {
  limpiar(); //console.log(idservicios);

  //$("#proveedor").val("").trigger("change");
  $("#cargando-1-fomulario").hide();
  $("#cargando-2-fomulario").show();

  $("#modal-agregar-servicio").modal("show");

  $("#tipo_servicio").val("").trigger("change");

  $.post("../ajax/servicio.php?op=mostrar", { idservicios: idservicios }, function (data, status) {
    
    data = JSON.parse(data); console.log(data);

    $("#cargando-1-fomulario").show();
    $("#cargando-2-fomulario").hide();

    $("#idservicios").val(data.idservicios);
    $("#tipo_servicio").val(data.idtipo_servicio).trigger("change");
    $("#fecha_ingreso").val(data.fecha_ingreso);
    $("#fecha_salida").val(data.fecha_salida); 
    $("#fec_prox_mant").val(data.fec_prox_mant);
    $("#Km_ingreso").val(data.Km_ingreso);           
    $("#prox_mantenimiento").val(data.prox_mantenimiento);
    $("#informe_ingreso").val(data.informe_ingreso);
    $("#imagen").val(data.imagen);
    $("#ficha_tecnica").val(data.ficha_tecnica);
    

    // FICHA TECNICA
    if (data.imagen == "" || data.imagen == null  ) {

      $("#doc2_ver").html('<img src="../dist/svg/pdf_trasnparent.svg" alt="" width="50%" >');

      $("#doc2_nombre").html('');

      $("#doc_old_2").val(""); $("#doc2").val("");

    } else {

      $("#doc_old_2").val(data.imagen); 

      $("#doc2_nombre").html(`<div class="row"> <div class="col-md-12"><i>Ficha-tecnica.${extrae_extencion(data.imagen)}</i></div></div>`);
      
      // cargamos la imagen adecuada par el archivo
      if ( extrae_extencion(data.imagen) == "pdf" ) {

        $("#doc2_ver").html('<iframe src="../dist/docs/material/img_perfil/'+data.imagen+'" frameborder="0" scrolling="no" width="100%" height="210"> </iframe>');

      }else{
        if (
          extrae_extencion(data.imagen) == "jpeg" || extrae_extencion(data.imagen) == "jpg" || extrae_extencion(data.imagen) == "jpe" ||
          extrae_extencion(data.imagen) == "jfif" || extrae_extencion(data.imagen) == "gif" || extrae_extencion(data.imagen) == "png" ||
          extrae_extencion(data.imagen) == "tiff" || extrae_extencion(data.imagen) == "tif" || extrae_extencion(data.imagen) == "webp" ||
          extrae_extencion(data.imagen) == "bmp" || extrae_extencion(data.imagen) == "svg" ) {

          $("#doc2_ver").html(`<img src="../dist/docs/material/img_perfil/${data.imagen}" alt="" width="50%" onerror="this.src='../dist/svg/error-404-x.svg';" >`); 
          
        } else {
          $("#doc2_ver").html('<img src="../dist/svg/doc_si_extencion.svg" alt="" width="50%" >');
        }        
      }      
    }
  });
}
function mostrar_imagen(idimagen_servicio) {
  limpiar(); //console.log(idimagen_servicio);

  //$("#proveedor").val("").trigger("change");
  $("#cargando-1-fomulario").hide();
  $("#cargando-2-fomulario").show();

  $("#modal-agregar-imagen").modal("show");

  $("#tipo_servicio").val("").trigger("change");

  $.post("../ajax/imagen_servicio.php?op=mostrar_imagen", { idimagen_servicio: idimagen_servicio}, function (data, status) {
    
    data = JSON.parse(data); console.log(data);

    $("#cargando-1-fomulario").show();
    $("#cargando-2-fomulario").hide();

    $("#idimagen_servicio").val(data.idimagen_servicio);
    $("#idservicios").val(data.idservicios);
    $("#tipo_imagen").val(data.tipo_imagen).trigger("change");
    $("#imagen").val(data.imagen);
    

    // FICHA TECNICA
    if (data.imagen == "" || data.imagen == null  ) {

      $("#doc2_ver").html('<img src="../dist/svg/pdf_trasnparent.svg" alt="" width="50%" >');

      $("#doc2_nombre").html('');

      $("#doc_old_2").val(""); $("#doc2").val("");

    } else {

      $("#doc_old_2").val(data.imagen); 

      $("#doc2_nombre").html(`<div class="row"> <div class="col-md-12"><i>Ficha-tecnica.${extrae_extencion(data.imagen)}</i></div></div>`);
      
      // cargamos la imagen adecuada par el archivo
      if ( extrae_extencion(data.imagen) == "pdf" ) {

        $("#doc2_ver").html('<iframe src="../dist/docs/material/img_perfil/'+data.imagen+'" frameborder="0" scrolling="no" width="100%" height="210"> </iframe>');

      }else{
        if (
          extrae_extencion(data.imagen) == "jpeg" || extrae_extencion(data.imagen) == "jpg" || extrae_extencion(data.imagen) == "jpe" ||
          extrae_extencion(data.imagen) == "jfif" || extrae_extencion(data.imagen) == "gif" || extrae_extencion(data.imagen) == "png" ||
          extrae_extencion(data.imagen) == "tiff" || extrae_extencion(data.imagen) == "tif" || extrae_extencion(data.imagen) == "webp" ||
          extrae_extencion(data.imagen) == "bmp" || extrae_extencion(data.imagen) == "svg" ) {

          $("#doc2_ver").html(`<img src="../dist/docs/material/img_perfil/${data.imagen}" alt="" width="50%" onerror="this.src='../dist/svg/error-404-x.svg';" >`); 
          
        } else {
          $("#doc2_ver").html('<img src="../dist/svg/doc_si_extencion.svg" alt="" width="50%" >');
        }        
      }      
    }
  });
}
//Función para desactivar registros
function desactivar(idservicios) {
  Swal.fire({
    title: "¿Está Seguro de  Desactivar el registro?",
    text: "",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#28a745",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, desactivar!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post("../ajax/servicio.php?op=desactivar", { idservicios: idservicios }, function (e) {
        Swal.fire("Desactivado!", "Tu registro ha sido desactivado.", "success");

        tabla.ajax.reload();
      });
    }
  });
}
function desactivar_imagen(idimagen_servicio) {
  Swal.fire({
    title: "¿Está Seguro de  Desactivar el registro?",
    text: "",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#28a745",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, desactivar!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post("../ajax/imagen_servicio.php?op=desactivar_imagen", { idimagen_servicio: idimagen_servicio }, function (e) {
        Swal.fire("Desactivado!", "Tu registro ha sido desactivado.", "success");

        tabla.ajax.reload();
      });
    }
  });
}
//Función para activar registros
function activar(idservicios) {
  Swal.fire({
    title: "¿Está Seguro de  Activar el registro?",
    text: "Este proveedor tendra acceso al sistema",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#28a745",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, activar!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post("../ajax/servicio.php?op=activar", { idservicios: idservicios }, function (e) {
        Swal.fire("Activado!", "Tu registro ha sido activado.", "success");

        tabla.ajax.reload();
      });
    }
  });
}
function activar_imagen(idimagen_servicio) {
  Swal.fire({
    title: "¿Está Seguro de  Activar el registro?",
    text: "Este proveedor tendra acceso al sistema",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#28a745",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, activar!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post("../ajax/imagen_servicio.php?op=activar_imagen", { idimagen_servicio: idimagen_servicio }, function (e) {
        Swal.fire("Activado!", "Tu registro ha sido activado.", "success");

        tabla.ajax.reload();
      });
    }
  });
}
//Función para desactivar registros
function eliminar(idservicios) {
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
    $.post("../ajax/servicio.php?op=desactivar", { idservicios: idservicios }, function (e) {
      Swal.fire("Desactivado!", "Tu registro ha sido desactivado.", "success");

      tabla.ajax.reload();
    });

  }else if (result.isDenied) {
   //op=eliminar
    $.post("../ajax/servicio.php?op=eliminar", { idservicios: idservicios }, function (e) {
      Swal.fire("Eliminado!", "Tu registro ha sido Eliminado.", "success");

      tabla.ajax.reload();
    });

  }

});
}
function eliminar_imagen(idimagen_servicio) {
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
   $.post("../ajax/imagen_servicio.php?op=desactivar_imagen", { idimagen_servicio: idimagen_servicio }, function (e) {
     Swal.fire("Desactivado!", "Tu registro ha sido desactivado.", "success");

     tabla.ajax.reload();
   });

 }else if (result.isDenied) {
  //op=eliminar
   $.post("../ajax/imagen_servicio.php?op=eliminar_imagen", { idimagen_servicio: idimagen_servicio }, function (e) {
     Swal.fire("Eliminado!", "Tu registro ha sido Eliminado.", "success");

     tabla.ajax.reload();
   });

 }

});
}

function ver_datos(idservicios) {

  $("#modal-ver-transporte").modal("show")
  var comprobante=''; var btn_comprobante='';
  $.post("../ajax/servicio.php?op=mostrar", { idservicios: idservicios }, function (data, status) {

    data = JSON.parse(data);  console.log(data); 
    

    verdatos=`                                                                            
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <table class="table table-hover table-bordered">        
            <tbody>
              <tr data-widget="expandable-table" aria-expanded="false">
                <th>Tipo Servicio</th>
                <td>${data.tipo_servicio}</td>  
              </tr>
              <tr data-widget="expandable-table" aria-expanded="false">
                <th>Fec.Ingreso</th>
                <td>${data.fecha_ingreso}</td>
              </tr>
              <tr data-widget="expandable-table" aria-expanded="false">
                <th>Fec.Salida</th>
                <td>${data.fecha_salida}</td>
              </tr>
              <tr data-widget="expandable-table" aria-expanded="false">
                <th>Fec.prox_mant</th>
                <td>${data.fec_prox_mant}</td>
              </tr>
              <tr data-widget="expandable-table" aria-expanded="false">
                <th>Km. ingreso</th>
                <td>${data.Km_ingreso}</td>
              </tr>
              <tr data-widget="expandable-table" aria-expanded="false">
                <th>Prox.matenimiento</th>
                  <td>${data.prox_mantenimiento}</td>
              </tr>
              <tr data-widget="expandable-table" aria-expanded="false">
                <th>Informe de ingreso</th>
                <td>${data.informe_ingreso}</td>
              </tr>
              <tr data-widget="expandable-table" aria-expanded="false">
                <th>Ficha Tecnica </th>
                <td>${data.ficha_tecnica}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>`;
  
    $("#datostransporte").html(verdatos);

  });
}
//Función Listar
function seccion_img(idservicios) {

  $('#idservicio_img').val(idservicios);
  table_show_hide(2);
  tabla_imagen = $("#tabla-imagen")
    .dataTable({
      responsive: true,
      lengthMenu: [5, 10, 25, 75, 100], //mostramos el menú de registros a revisar
      aProcessing: true, //Activamos el procesamiento del datatables
      aServerSide: true, //Paginación y filtrado realizados por el servidor
      dom: "<Bl<f>rtip>", //Definimos los elementos del control de tabla
      buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdf", "colvis"],
      ajax: {
        url: "../ajax/imagen_servicio.php?op=listar_imagen",
        type: "get",
        dataType: "json",
        error: function (e) {
          console.log(e.responseText);
        },
      },
      createdRow: function (row, data, ixdex) {    
  
        // columna: #
        if (data[0] != '') {
          $("td", row).eq(0).addClass("text-center");   
            
        }
        // columna: 1
        if (data[1] != '') {
          $("td", row).eq(1).addClass("text-center text-nowrap");   
            
        }
        // columna: # 5
        if (data[5] != '') {
          $("td", row).eq(5).addClass("text-right text-nowrap");   
            
        }
        // columna: # 6
        if (data[6] != '') {
          $("td", row).eq(6).addClass("text-right text-nowrap");   
            
        }
        // columna: # 7
        if (data[7] != '') {
          $("td", row).eq(7).addClass("text-right text-nowrap");   
            
        }
        // columna: #8
        if (data[8] != '') {
          $("td", row).eq(8).addClass("text-right text-nowrap");   
            
        }
      },
      language: {
        lengthMenu: "Mostrar : _MENU_ registros",
        buttons: {
          copyTitle: "Tabla Copiada",
          copySuccess: {
            _: "%d líneas copiadas",
            1: "1 línea copiada",
          },
        },
      },
      bDestroy: true,
      iDisplayLength: 10, //Paginación
      order: [[0, "asc"]], //Ordenar (columna,orden)
    })
    .DataTable();
}
function ver_img_perfil(img_perfil,tipo_imagen){
  console.log(img_perfil,tipo_imagen);

  $('#modal-ver-imagen').modal("show");
  $('#tipo_imagen').html(tipo_imagen);

  if (img_perfil == "" || img_perfil == null  ) {

    $("#ver_imagen").html('<img src="../dist/svg/drag-n-drop.svg" alt="" width="50%" >');

  } else {
    $("#doc1_nombre").html(`<div class="row"> <div class="col-md-12"><i>Baucher.${extrae_extencion(img_perfil)}</i></div></div>`);
    
    // cargamos la imagen adecuada par el archivo
    if ( extrae_extencion(img_perfil) == "pdf" ) {

      $("#ver_imagen").html('<iframe src="../dist/docs/material/img_perfil/'+img_perfil+'" frameborder="0" scrolling="no" width="100%" height="210"> </iframe>');

    }else{
      if (
      extrae_extencion(img_perfil) == "jpeg" || extrae_extencion(img_perfil) == "jpg" || extrae_extencion(img_perfil) == "jpe" ||
      extrae_extencion(img_perfil) == "jfif" || extrae_extencion(img_perfil) == "gif" || extrae_extencion(img_perfil) == "png" ||
      extrae_extencion(img_perfil) == "tiff" || extrae_extencion(img_perfil) == "tif" || extrae_extencion(img_perfil) == "webp" ||
      extrae_extencion(img_perfil) == "bmp" || extrae_extencion(img_perfil) == "svg" ) {

      $("#ver_imagen").html(`<img src="../dist/docs/material/img_perfil/${img_perfil}" alt="" width="80%" onerror="this.src='../dist/svg/error-404-x.svg';" >`); 
      
    } else {
      $("#ver_imagen").html('<img src="../dist/svg/doc_si_extencion.svg" alt="" width="50%" >');
    }        
  }      
}

}


init();

$(function () {
  $.validator.setDefaults({
    submitHandler: function (e) {
      guardaryeditar(e);
    },
  });

  $("#form-servicio").validate({
    rules: {
      tipo_servicio: { required: true },
      fecha_ingreso: {required: true},
      fecha_salida: { required: true}, 
      informe_ingreso: { required: true },
      ficha_tecnica: { required: true },
      doc2_i: {required: true},
      
      
    },
    messages: {
      tipo_servicio: {
        required: "Por favor ingrese el tipo de servicio",
      },
      fecha_ingreso: {
        required: "Ingrese Fecha de Ingreso",
      },
      fecha_salida: {
        required: "Ingrese Fecha de Salida",
      },
      informe_ingreso: {
        required: "Informe",
      },
      ficha_tecnica: {
        required: "Ficha Tecnica",
      },
      doc2_i: {
        required: "Selecione imagen",
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

$(function () {
  $.validator.setDefaults({
    submitHandler: function (e) {
      guardaryeditar_imagen(e);
    },
  });

  $("#form-imagen").validate({
    rules: {
      tipo_imagen: { required: true },
  
      
    },
    messages: {
      tipo_imagen: {
        required: "Por favor ingrese el tipo de imagen",
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



// .....::::::::::::::::::::::::::::::::::::: F U N C I O N E S    A L T E R N A S  :::::::::::::::::::::::::::::::::::::::..

/* PREVISUALIZAR LAS IMAGENES */
function addImage(e, id) {
  // colocamos cargando hasta que se vizualice
  $("#" + id + "_ver").html('<i class="fas fa-spinner fa-pulse fa-6x"></i><br><br>');

  console.log(id);

  var file = e.target.files[0], imageType = /image.*/;

  if (e.target.files[0]) {
    var sizeByte = file.size;

    var sizekiloBytes = parseInt(sizeByte / 1024);

    var sizemegaBytes = sizeByte / 1000000; 

    if (!file.type.match(imageType)) {
       
      // toastr.error("Este tipo de ARCHIVO no esta permitido <br> elija formato: <b>.png .jpeg .jpg .webp etc... </b>");
      Swal.fire({
        position: 'top-end',
        icon: 'error',
        title: 'Este tipo de ARCHIVO no esta permitido elija formato: .png .jpeg .jpg .webp etc...',
        showConfirmButton: false,
        timer: 1500
      });

      $("#" + id + "_i").attr("src", "../dist/img/default/img_defecto_materiales.png");

    } else {

      if (sizekiloBytes <= 10240) {

        var reader = new FileReader();

        reader.onload = fileOnload;

        function fileOnload(e) {

          var result = e.target.result;

          $(`#${id}_i`).attr("src", result);

          $(`#${id}_nombre`).html(
            
            `<div class="row">
              <div class="col-md-12"> <i> ${file.name} </i></div>
              <div class="col-md-12">                
                <button class="btn btn-danger btn-block btn-xs" onclick="${id}'_eliminar();" type="button" >
                  <i class="far fa-trash-alt"></i>
                </button>
              </div>               
            </div>`               
          );

          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: `El documento: ${file.name.toUpperCase()} es aceptado.`,
            showConfirmButton: false,
            timer: 1500
          });
        }

        reader.readAsDataURL(file);
      } else {
         
        Swal.fire({
          position: 'top-end',
          icon: 'warning',
          title: `El documento: ${file.name.toUpperCase()} es muy pesado. Tamaño máximo 10mb`,
          showConfirmButton: false,
          timer: 1500
        })
        $("#" + id + "_i").attr("src", "../dist/img/default/img_error.png");

        $("#" + id).val("");
      }
    }
  } else {
    Swal.fire({
      position: 'top-end',
      icon: 'error',
      title: 'Seleccione un documento',
      showConfirmButton: false,
      timer: 1500
    })

    $("#" + id + "_i").attr("src", "../dist/img/default/img_defecto_materiales.png");

    $("#" + id + "_nombre").html("");
  }
}

/* PREVISUALIZAR LOS DOCUMENTOS */
function addDocs(e,id) {

  $("#"+id+"_ver").html('<i class="fas fa-spinner fa-pulse fa-6x"></i><br><br>');	console.log(id);

	var file = e.target.files[0], archivoType = /image.*|application.*/;
	
	if (e.target.files[0]) {
    
		var sizeByte = file.size; console.log(file.type);

		var sizekiloBytes = parseInt(sizeByte / 1024);

		var sizemegaBytes = (sizeByte / 1000000);
		// alert("KILO: "+sizekiloBytes+" MEGA: "+sizemegaBytes)

		if (!file.type.match(archivoType) ){
			// return;
      Swal.fire({
        position: 'top-end',
        icon: 'error',
        title: 'Este tipo de ARCHIVO no esta permitido elija formato: .pdf, .png. .jpeg, .jpg, .jpe, .webp, .svg',
        showConfirmButton: false,
        timer: 1500
      });

      $("#"+id+"_ver").html('<img src="../dist/svg/pdf_trasnparent.svg" alt="" width="50%" >'); 

		}else{

			if (sizekiloBytes <= 40960) {

				var reader = new FileReader();

				reader.onload = fileOnload;

				function fileOnload(e) {

					var result = e.target.result;

          // cargamos la imagen adecuada par el archivo
				  if ( extrae_extencion(file.name) == "doc") {
            $("#"+id+"_ver").html('<img src="../dist/svg/doc.svg" alt="" width="50%" >');
          } else {
            if ( extrae_extencion(file.name) == "docx" ) {
              $("#"+id+"_ver").html('<img src="../dist/svg/docx.svg" alt="" width="50%" >');
            }else{
              if ( extrae_extencion(file.name) == "pdf" ) {
                $("#"+id+"_ver").html(`<iframe src="${result}" frameborder="0" scrolling="no" width="100%" height="310"></iframe>`);
              }else{
                if ( extrae_extencion(file.name) == "csv" ) {
                  $("#"+id+"_ver").html('<img src="../dist/svg/csv.svg" alt="" width="50%" >');
                } else {
                  if ( extrae_extencion(file.name) == "xls" ) {
                    $("#"+id+"_ver").html('<img src="../dist/svg/xls.svg" alt="" width="50%" >');
                  } else {
                    if ( extrae_extencion(file.name) == "xlsx" ) {
                      $("#"+id+"_ver").html('<img src="../dist/svg/xlsx.svg" alt="" width="50%" >');
                    } else {
                      if ( extrae_extencion(file.name) == "xlsm" ) {
                        $("#"+id+"_ver").html('<img src="../dist/svg/xlsm.svg" alt="" width="50%" >');
                      } else {
                        if (
                          extrae_extencion(file.name) == "jpeg" || extrae_extencion(file.name) == "jpg" || extrae_extencion(file.name) == "jpe" ||
                          extrae_extencion(file.name) == "jfif" || extrae_extencion(file.name) == "gif" || extrae_extencion(file.name) == "png" ||
                          extrae_extencion(file.name) == "tiff" || extrae_extencion(file.name) == "tif" || extrae_extencion(file.name) == "webp" ||
                          extrae_extencion(file.name) == "bmp" || extrae_extencion(file.name) == "svg" ) {

                          $("#"+id+"_ver").html(`<img src="${result}" alt="" width="50%" onerror="this.src='../dist/svg/error-404-x.svg';" >`); 
                          
                        } else {
                          $("#"+id+"_ver").html('<img src="../dist/svg/doc_si_extencion.svg" alt="" width="50%" >');
                        }
                        
                      }
                    }
                  }
                }
              }
            }
          } 
					$("#"+id+"_nombre").html(`<div class="row">
            <div class="col-md-12">
              <i> ${file.name} </i>
            </div>
            <div class="col-md-12">
              <button class="btn btn-danger btn-block btn-xs" onclick="${id}_eliminar();" type="button" ><i class="far fa-trash-alt"></i></button>
            </div>
          </div>`);

          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: `El documento: ${file.name.toUpperCase()} es aceptado.`,
            showConfirmButton: false,
            timer: 1500
          });
				}

				reader.readAsDataURL(file);

			} else {
        Swal.fire({
          position: 'top-end',
          icon: 'warning',
          title: `El documento: ${file.name.toUpperCase()} es muy pesado.`,
          showConfirmButton: false,
          timer: 1500
        });

        $("#"+id+"_ver").html('<img src="../dist/svg/pdf_trasnparent.svg" alt="" width="50%" >');
        $("#"+id+"_nombre").html("");
				$("#"+id).val("");
			}
		}
	}else{
    Swal.fire({
      position: 'top-end',
      icon: 'error',
      title: 'Seleccione un documento',
      showConfirmButton: false,
      timer: 1500
    });
		 
    $("#"+id+"_ver").html('<img src="../dist/svg/pdf_trasnparent.svg" alt="" width="50%" >');
		$("#"+id+"_nombre").html("");
    $("#"+id).val("");
	}	
}

// recargar un doc para ver
function re_visualizacion(id, carpeta) {

  $("#doc"+id+"_ver").html('<i class="fas fa-spinner fa-pulse fa-6x"></i><br><br>'); console.log(id);

  pdffile     = document.getElementById("doc"+id+"").files[0];

  var antiguopdf  = $("#doc_old_"+id+"").val();

  if(pdffile === undefined){

    if (antiguopdf == "") {

      Swal.fire({
        position: 'top-end',
        icon: 'error',
        title: 'Seleccione un documento',
        showConfirmButton: false,
        timer: 1500
      })

      $("#doc"+id+"_ver").html('<img src="../dist/svg/pdf_trasnparent.svg" alt="" width="50%" >');

		  $("#doc"+id+"_nombre").html("");

    } else {
      if ( extrae_extencion(antiguopdf) == "doc") {
        $("#doc"+id+"_ver").html('<img src="../dist/svg/doc.svg" alt="" width="50%" >');
        toastr.error('Documento NO TIENE PREVIZUALIZACION!!!')
      } else {
        if ( extrae_extencion(antiguopdf) == "docx" ) {
          $("#doc"+id+"_ver").html('<img src="../dist/svg/docx.svg" alt="" width="50%" >');
          toastr.error('Documento NO TIENE PREVIZUALIZACION!!!')
        } else {
          if ( extrae_extencion(antiguopdf) == "pdf" ) {
            $("#doc"+id+"_ver").html(`<iframe src="../dist/material/${carpeta}/${antiguopdf}" frameborder="0" scrolling="no" width="100%" height="310"></iframe>`);
            toastr.success('Documento vizualizado correctamente!!!')
          } else {
            if ( extrae_extencion(antiguopdf) == "csv" ) {
              $("#doc"+id+"_ver").html('<img src="../dist/svg/csv.svg" alt="" width="50%" >');
              toastr.error('Documento NO TIENE PREVIZUALIZACION!!!')
            } else {
              if ( extrae_extencion(antiguopdf) == "xls" ) {
                $("#doc"+id+"_ver").html('<img src="../dist/svg/xls.svg" alt="" width="50%" >');
                toastr.error('Documento NO TIENE PREVIZUALIZACION!!!')
              } else {
                if ( extrae_extencion(antiguopdf) == "xlsx" ) {
                  $("#doc"+id+"_ver").html('<img src="../dist/svg/xlsx.svg" alt="" width="50%" >');
                  toastr.error('Documento NO TIENE PREVIZUALIZACION!!!')
                } else {
                  if ( extrae_extencion(antiguopdf) == "xlsm" ) {
                    $("#doc"+id+"_ver").html('<img src="../dist/svg/xlsm.svg" alt="" width="50%" >');
                    toastr.error('Documento NO TIENE PREVIZUALIZACION!!!')
                  } else {
                    if (
                      extrae_extencion(antiguopdf) == "jpeg" || extrae_extencion(antiguopdf) == "jpg" || extrae_extencion(antiguopdf) == "jpe" ||
                      extrae_extencion(antiguopdf) == "jfif" || extrae_extencion(antiguopdf) == "gif" || extrae_extencion(antiguopdf) == "png" ||
                      extrae_extencion(antiguopdf) == "tiff" || extrae_extencion(antiguopdf) == "tif" || extrae_extencion(antiguopdf) == "webp" ||
                      extrae_extencion(antiguopdf) == "bmp" || extrae_extencion(antiguopdf) == "svg" ) {
  
                      $("#doc"+id+"_ver").html(`<img src="../dist/material/${carpeta}/${antiguopdf}" alt="" onerror="this.src='../dist/svg/error-404-x.svg';" width="50%" >`);
                      toastr.success('Documento vizualizado correctamente!!!');
                    } else {
                      $("#doc"+id+"_ver").html('<img src="../dist/svg/doc_si_extencion.svg" alt="" width="50%" >');
                      toastr.error('Documento NO TIENE PREVIZUALIZACION!!!')
                    }                    
                  }
                }
              }
            }
          }
        }
      }      
    }
    // console.log('hola'+dr);
  }else{

    pdffile_url=URL.createObjectURL(pdffile);

    // cargamos la imagen adecuada par el archivo
    if ( extrae_extencion(pdffile.name) == "doc") {
      $("#doc"+id+"_ver").html('<img src="../dist/svg/doc.svg" alt="" width="50%" >');
      toastr.error('Documento NO TIENE PREVIZUALIZACION!!!')
    } else {
      if ( extrae_extencion(pdffile.name) == "docx" ) {
        $("#doc"+id+"_ver").html('<img src="../dist/svg/docx.svg" alt="" width="50%" >');
        toastr.error('Documento NO TIENE PREVIZUALIZACION!!!')
      }else{
        if ( extrae_extencion(pdffile.name) == "pdf" ) {
          $("#doc"+id+"_ver").html('<iframe src="'+pdffile_url+'" frameborder="0" scrolling="no" width="100%" height="310"> </iframe>');
          toastr.success('Documento vizualizado correctamente!!!');
        }else{
          if ( extrae_extencion(pdffile.name) == "csv" ) {
            $("#doc"+id+"_ver").html('<img src="../dist/svg/csv.svg" alt="" width="50%" >');
            toastr.error('Documento NO TIENE PREVIZUALIZACION!!!');
          } else {
            if ( extrae_extencion(pdffile.name) == "xls" ) {
              $("#doc"+id+"_ver").html('<img src="../dist/svg/xls.svg" alt="" width="50%" >');
              toastr.error('Documento NO TIENE PREVIZUALIZACION!!!');
            } else {
              if ( extrae_extencion(pdffile.name) == "xlsx" ) {
                $("#doc"+id+"_ver").html('<img src="../dist/svg/xlsx.svg" alt="" width="50%" >');
                toastr.error('Documento NO TIENE PREVIZUALIZACION!!!');
              } else {
                if ( extrae_extencion(pdffile.name) == "xlsm" ) {
                  $("#doc"+id+"_ver").html('<img src="../dist/svg/xlsm.svg" alt="" width="50%" >');
                  toastr.error('Documento NO TIENE PREVIZUALIZACION!!!');
                } else {
                  if (
                    extrae_extencion(pdffile.name) == "jpeg" || extrae_extencion(pdffile.name) == "jpg" || extrae_extencion(pdffile.name) == "jpe" ||
                    extrae_extencion(pdffile.name) == "jfif" || extrae_extencion(pdffile.name) == "gif" || extrae_extencion(pdffile.name) == "png" ||
                    extrae_extencion(pdffile.name) == "tiff" || extrae_extencion(pdffile.name) == "tif" || extrae_extencion(pdffile.name) == "webp" ||
                    extrae_extencion(pdffile.name) == "bmp" || extrae_extencion(pdffile.name) == "svg" ) {

                    $("#doc"+id+"_ver").html(`<img src="${pdffile_url}" alt="" width="50%" >`);
                    toastr.success('Documento vizualizado correctamente!!!');
                  } else {
                    $("#doc"+id+"_ver").html('<img src="../dist/svg/doc_si_extencion.svg" alt="" width="50%" >');
                    toastr.error('Documento NO TIENE PREVIZUALIZACION!!!');
                  }                  
                }
              }
            }
          }
        }
      }
    }     	
    console.log(pdffile);
  }
}

/**Redondear */
function redondearExp(numero, digitos) {
  function toExp(numero, digitos) {
    let arr = numero.toString().split("e");
    let mantisa = arr[0],
      exponente = digitos;
    if (arr[1]) exponente = Number(arr[1]) + digitos;
    return Number(mantisa + "e" + exponente.toString());
  }
  let entero = Math.round(toExp(Math.abs(numero), digitos));
  return Math.sign(numero) * toExp(entero, -digitos);
}

function extrae_extencion(filename) {
  return filename.split(".").pop();
}
