

<?php
  //Activamos el almacenamiento en el buffer
  ob_start();

  session_start();
  if (!isset($_SESSION["nombre"])){
    header("Location: index.php");
  }else{
    ?>

    <!DOCTYPE html>
    <html lang="es">
      <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Admin Sevens | Insumos</title>
        <?php require 'head.php';  ?>       

        <link rel="stylesheet" href="../dist/css/switch_materiales.css">

      </head>
      <body class="hold-transition sidebar-collapse sidebar-mini layout-fixed layout-navbar-fixed">
        <!-- Content Wrapper. Contains page content -->
        <div class="wrapper">
          <?php
          require 'nav.php';
          require 'aside.php';
          if ($_SESSION['recurso']==1){
            ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
              <!-- Content Header (Page header) -->
              <section class="content-header">
                <div class="container-fluid">
                  <div class="row mb-2">
                    <div class="col-sm-6">
                      <h1><img src="../dist/svg/palana-ico-negro.svg" class="nav-icon" alt="" style="width: 21px !important;"> Servicios</h1>
                    </div>
                    <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Servicios</li>
                      </ol>
                    </div>
                  </div>
                </div>
                <!-- /.container-fluid -->
              </section>

              <!-- Main content -->
              <section class="content">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-12">
                      <div class="card card-primary card-outline">
                        <div class="card-header">
                          <h3 class="card-title">
                            <button type="button" class="btn bg-gradient-success" data-toggle="modal" data-target="#modal-agregar-servicio" onclick="limpiar();"><i class="fas fa-plus-circle"></i> Agregar</button>
                            Admnistra de manera eficiente los Servicios.
                          </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="tabla-servicio" class="table table-bordered table-striped display" style="width: 100% !important;">
                            <thead>
                              <tr>
                                <th class="text-center">#</th>
                                <th class="">Acciones</th>
                                <th>tipo_servicio</th>
                                <th>Fec.Ingreso</th>
                                <th>Fec.salida </th>
                                <th>fec.prox_mant</th>
                                <th>Km. ingreso</th>
                                <th>Prox.matenimiento</th>
                                <th>Informe de ingreso</th>
                                <th>Ficha Tecnica</th>                               
                                <th>Estado</th>
                              </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                              <tr>
                              <th class="text-center">#</th>
                                <th class="">Acciones</th>
                                <th>Tipo_servicio</th>
                                <th>Fec.Ingreso</th> 
                                <th>Fec.salida</th>
                                <th>Fec.prox_mant</th>
                                <th>Km. ingreso</th>
                                <th>Prox.matenimiento</th>
                                <th>Informe de ingreso</th>
                                <th>Ficha Tecnica</th>
                                <th>Estado</th>
                              </tr>
                            </tfoot>
                          </table>
                        </div>
                        <!-- /.card-body -->
                      </div>
                      <!-- /.card -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
                <!-- /.container-fluid -->

                <!-- Modal agregar Servicio -->
                <div class="modal fade" id="modal-agregar-servicio">
                  <div class="modal-dialog modal-dialog-scrollable modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Agregar Servicio</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span class="text-danger" aria-hidden="true">&times;</span>
                        </button>
                      </div>

                      <div class="modal-body">
                        <!-- form start -->
                        <form id="form-servicio" name="form-servicio" method="POST">
                          <div class="card-body">
                            <div class="row" id="cargando-1-fomulario">
                              <!-- id producto -->
                              <input type="hidden" name="idservicios" id="idservicios" />
                              
                              <!--tipo_servicio-->
                              <div class="col-lg-6">
                                <div class="form-group">
                                  <label for="tipo_servicio">Tipo de Servicio</label>
                                  <select name="tipo_servicio" id="tipo_servicio" class="form-control select2" style="width: 100%;"></select>                           
                                </div>
                              </div>
                              <!--Fec.Ingreso-->
                              <div class="col-lg-6">
                                <div class="form-group">
                                  <label for="fecha_ingreso">Fec.Ingreso</label>
                                  <input class="form-control" type="DATE" id="fecha_ingreso" name="fecha_ingreso" placeholder="fecha_ingreso." />
                                  
                                </div>
                              </div>

                              <!-- Frc.Salida -->
                              <div class="col-lg-6">
                                <div class="form-group">
                                  <label for="fecha_salida">Fec.Salida</label>
                                  <input class="form-control" type="DATE" id="fecha_salida" name="fecha_salida" placeholder="fecha_salida." />
                                  
                                </div>
                              </div>

                              <!-- Fec.prox_mant -->
                              <div class="col-lg-6">
                                <div class="form-group">
                                  <label for="fec_prox_mant">Fec.prox_mant </label>
                                  <input class="form-control" type="DATE" id="fec_prox_mant" name="fec_prox_mant" placeholder="Fec.prox_mant." />
                                </div>
                              </div>
                                <!-- KM. Ingreso-->
                              <div class="col-lg-6">
                                <div class="form-group">
                                  <label for="Km_ingreso">Km. ingreso </label>
                                  <input class="form-control" type="text" id="Km_ingreso" name="Km_ingreso" placeholder="Km. ingreso" />
                                </div>
                              </div>
                              

                              <!-- Proximo Mantenimiento -->
                              <div class="col-lg-6">
                                <div class="form-group">
                                  <label for="prox_mantenimiento">Prox.matenimiento </label>
                                  <input class="form-control" type="text" id="prox_mantenimiento" name="prox_mantenimiento" placeholder="Proximo Mantenimiento" />
                                </div>
                              </div>

                             <!--Informe de ingreso-->
                             <div class="col-lg-12 class_pading">
                                <div class="form-group">
                                  <label for="informe_ingreso">Informe de ingreso</label>
                                  <textarea name="informe_ingreso" id="informe_ingreso" class="form-control" rows="2" placeholder="informe de ingreso."></textarea>  
                                </div>
                              </div>

                              <!--Ficha Tecnica-->
                              <div class="col-lg-12 class_pading">
                                <div class="form-group">
                                  <label for="ficha_tecnica">Ficha Tecnica</label>
                                  <textarea name="ficha_tecnica" id="ficha_tecnica" class="form-control" rows="2" placeholder="Ficha Tecnica"></textarea> 
                                </div>
                              </div> 
                              <!-- Ficha tecnica -->
                              <div class="col-md-6 col-lg-6">
                                <label for="doc2_i" >Imagen<b class="text-danger">(Imagen o PDF)</b> </label>  
                                <div class="row text-center">                               
                                  <!-- Subir documento -->
                                  <div class="col-md-6 text-center">
                                    <button type="button" class="btn btn-success btn-block btn-xs" id="doc2_i">
                                      <i class="fas fa-upload"></i> Subir.
                                    </button>
                                    <input type="hidden" id="doc_old_2" name="doc_old_2" />
                                    <input style="display: none;" id="doc2" type="file" name="doc2" accept="application/pdf, image/*" class="docpdf" /> 
                                  </div>
                                  <!-- Recargar -->
                                  <div class="col-md-6 text-center comprobante">
                                    <button type="button" class="btn btn-info btn-block btn-xs" onclick="re_visualizacion(2, 'img_perfil');">
                                    <i class="fas fa-redo"></i> Recargar.
                                  </button>
                                  </div>                                  
                                </div>

                                <div id="doc2_ver" class="text-center mt-4">
                                  <img src="../dist/svg/pdf_trasnparent.svg" alt="" width="50%" >
                                </div>
                                <div class="text-center" id="doc2_nombre"><!-- aqui va el nombre del pdf --></div>
                              </div>
                            </div>

                            <div class="row" id="cargando-2-fomulario" style="display: none;">
                              <div class="col-lg-12 text-center">
                                <i class="fas fa-spinner fa-pulse fa-6x"></i><br />
                                <br />
                                <h4>Cargando...</h4>
                              </div>
                            </div>
                          </div>
                          <!-- /.card-body -->
                          <button type="submit" style="display: none;" id="submit-form-servicio">Submit</button>
                        </form>
                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="limpiar();">Close</button>
                        <button type="submit" class="btn btn-success" id="guardar_registro">Guardar Cambios</button>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              <!-- /.content -->
            </div>


            <?php
          }else{
            require 'noacceso.php';
          }
          require 'footer.php';
          ?>
        </div>
        <!-- /.content-wrapper -->

        <?php  require 'script.php'; ?>

        <style>
          .class-style label{
            font-size: 14px;
          }
          .class-style small {
            background-color: #f4f7ee;
            border: solid 1px #ce542a21;
            margin-left: 3px;
            padding: 5px;
            border-radius: 6px;
          }
        </style>
        <!-- Bootstrap 4 -->
        <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- jquery-validation -->
        <script src="../plugins/jquery-validation/jquery.validate.min.js"></script>
        <script src="../plugins/jquery-validation/additional-methods.min.js"></script>
        <!-- InputMask -->
        <script src="../plugins/moment/moment.min.js"></script>
        <script src="../plugins/inputmask/jquery.inputmask.min.js"></script>
        <!-- sweetalert2 -->
        <script src="../plugins/sweetalert2/sweetalert2.all.min.js"></script>

        <script type="text/javascript" src="scripts/servicio.js"></script>

        <script>
          $(function () {
            $('[data-toggle="tooltip"]').tooltip();
          });
        </script>

        <script>
          if ( localStorage.getItem('nube_idproyecto') ) {

            console.log("icon_folder_"+localStorage.getItem('nube_idproyecto'));

            $("#ver-proyecto").html('<i class="fas fa-tools"></i> Proyecto: ' +  localStorage.getItem('nube_nombre_proyecto'));

            $(".ver-otros-modulos-1").show();

            // $('#icon_folder_'+localStorage.getItem('nube_idproyecto')).html('<i class="fas fa-folder-open"></i>');

          }else{
            $("#ver-proyecto").html('<i class="fas fa-tools"></i> Selecciona un proyecto');

            $(".ver-otros-modulos-1").hide();
          }
          
        </script>
      </body>
    </html>

    <?php  
  }
  ob_end_flush();

?>
