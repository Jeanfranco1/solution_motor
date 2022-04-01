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
        <title>Admin Sevens | Proveedor</title>
        <?php
        require 'head.php';
        ?>

        <!--CSS  switch_MATERIALES-->
        <link rel="stylesheet" href="../dist/css/switch_materiales.css" />
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
              <div class="row">
                
                <!--====Color============-->
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                  <!-- Content Header (Page header) -->
                  <section class="content-header">
                    <div class="container-fluid">
                      <div class="row mb-2">
                        <div class="col-sm-6">
                          <h1>Colores</h1>
                        </div>
                        <div class="col-sm-6">
                          <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Colores</li>
                          </ol>
                        </div>
                      </div>
                    </div>
                    <!-- /.container-fluid -->
                  </section>

                  <!-- Main content -->

                  <!-- Main content -->
                  <section class="content">
                    <div class="container-fluid">
                      <div class="card card-primary card-outline">
                        <div class="card-header">
                          <h3 class="card-title">
                            <button type="button" class="btn bg-gradient-success" data-toggle="modal" data-target="#modal-agregar-color" onclick="limpiar();"><i class="fas fa-plus-circle"></i> Agregar</button>
                            Admnistrar Colores.
                          </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="tabla-colores" class="table table-bordered table-striped display" style="width: 100% !important;">
                            <thead>
                              <tr>
                                 <th class="text-center">#</th>
                                <th class="">Acciones</th>
                                <th>Nombre</th>
                                <th>Estado</th>
                              </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                              <tr>
                                <th class="text-center">#</th>
                                <th class="">Acciones</th>
                                <th>Nombre</th>
                                <th>Estado</th>
                              </tr>
                            </tfoot>
                          </table>
                        </div>
                        <!-- /.card-body -->
                      </div>
                      <!-- /.card -->
                    </div>
                    <!-- /.container-fluid -->
                  </section>
                  <!-- /.content -->
                </div>

                <!--====Categoria==-->
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                  <!-- Content Header (Page header) -->
                  <section class="content-header">
                    <div class="container-fluid">
                      <div class="row mb-2">
                        <div class="col-sm-6">
                          <h1>Categoria</h1>
                        </div>
                        <div class="col-sm-6">
                          <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Categoria</li>
                          </ol>
                        </div>
                      </div>
                    </div>
                    <!-- /.container-fluid -->
                  </section>

                  <!-- Main content -->

                  <!-- Main content -->
                  <section class="content">
                    <div class="container-fluid">
                      <div class="card card-primary card-outline">
                        <div class="card-header">
                          <h3 class="card-title">
                            <button type="button" class="btn bg-gradient-success" data-toggle="modal" data-target="#modal-agregar-categoria" onclick="limpiar_unidades_m();"><i class="fas fa-plus-circle"></i> Agregar</button>
                            Admnistrar Categoria.
                          </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="tabla-categoria" class="table table-bordered table-striped display" style="width: 100% !important;">
                            <thead>
                              <tr>
                                <th class="text-center">#</th>
                                <th class="">Acciones</th>
                                <th>Nombre</th>                          
                                <th>Estado</th>
                              </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                              <tr>
                                <th class="text-center">#</th>
                                <th class="">Acciones</th>
                                <th>Nombre</th>
                                <th>Estado</th>
                              </tr>
                            </tfoot>
                          </table>
                        </div>
                        <!-- /.card-body -->
                      </div>
                      <!-- /.card -->
                    </div>
                    <!-- /.container-fluid -->
                  </section>
                  <!-- /.content -->
                </div>

                <!--====Marca==-->
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                  <!-- Content Header (Page header) -->
                  <section class="content-header">
                    <div class="container-fluid">
                      <div class="row mb-2">
                        <div class="col-sm-6">
                          <h1>Marca</h1>
                        </div>
                      </div>
                    </div>
                    <!-- /.container-fluid -->
                  </section>

                  <!-- Main content -->

                  <!-- Main content -->
                  <section class="content">
                    <div class="container-fluid">
                      <div class="card card-primary card-outline">
                        <div class="card-header">
                          <h3 class="card-title">
                            <button type="button" class="btn bg-gradient-success" data-toggle="modal" data-target="#modal-agregar-marca" onclick="limpiar_ocupacion();"><i class="fas fa-plus-circle"></i> Agregar</button>
                            Admnistrar Marcas.
                          </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="tabla-marca" class="table table-bordered table-striped display" style="width: 100% !important;">
                            <thead>
                              <tr>
                                <th class="text-center">#</th>
                                <th class="">Acciones</th>
                                <th>Nombre</th>
                                <th>Estado</th>
                              </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                              <tr>
                                <th class="text-center">#</th>
                                <th class="">Acciones</th>
                                <th>Nombre</th>
                                <th>Estado</th>
                              </tr>
                            </tfoot>
                          </table>
                        </div>
                        <!-- /.card-body -->
                      </div>
                      <!-- /.card -->
                    </div>
                    <!-- /.container-fluid -->
                  </section>
                  <!-- /.content -->
                </div>

                <!--====Ubicacion==-->
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                  <!-- Content Header (Page header) -->
                  <section class="content-header">
                    <div class="container-fluid">
                      <div class="row mb-2">
                        <div class="col-sm-6">
                          <h1>Ubicacion</h1>
                        </div>
                      </div>
                    </div>
                    <!-- /.container-fluid -->
                  </section>

                  <!-- Main content -->

                  <!-- Main content -->
                  <section class="content">
                    <div class="container-fluid">
                      <div class="card card-primary card-outline">
                        <div class="card-header">
                          <h3 class="card-title">
                            <button type="button" class="btn bg-gradient-success" data-toggle="modal" data-target="#modal-agregar-ubicacion" onclick="limpiar_ubicacion();"><i class="fas fa-plus-circle"></i> Agregar</button>
                            Admnistrar Ubicacion.
                          </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="tabla-ubicacion" class="table table-bordered table-striped display" style="width: 100% !important;">
                            <thead>
                              <tr>
                                <th class="text-center">#</th>
                                <th class="">Acciones</th>
                                <th>Nombre</th>
                                <th>Estado</th>
                              </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                              <tr>
                                <th class="text-center">#</th>
                                <th class="">Acciones</th>
                                <th>Nombre</th>
                                <th>Estado</th>
                              </tr>
                            </tfoot>
                          </table>
                        </div>
                        <!-- /.card-body -->
                      </div>
                      <!-- /.card -->
                    </div>
                    <!-- /.container-fluid -->
                  </section>
                  <!-- /.content -->
                </div>
              </div>

              
              <!--================  modals-Color  ======================-->
              <div class="modal fade" id="modal-agregar-color">
                <div class="modal-dialog modal-dialog-scrollable modal-md">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Agregar Color</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-danger" aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <div class="modal-body">
                      <!-- form start -->
                      <form id="form-color" name="form-color" method="POST" autocomplete="off">
                        <div class="card-body">
                          <div class="row" id="cargando-1-fomulario">
                            <!-- id banco -->
                            <input type="hidden" name="idcolor" id="idcolor" />
                            <!-- Nombre -->
                            <div class="col-lg-12 class_pading">
                              <div class="form-group">
                                <label for="nombre_color">Nombre</label>
                                <input type="text" name="nombre_color" class="form-control" id="nombre_color" placeholder="Nombre del color." />
                              </div>
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
                        <button type="submit" style="display: none;" id="submit-form-color">Submit</button>
                      </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="limpiar();">Close</button>
                      <button type="submit" class="btn btn-success" id="guardar_registro_color">Guardar Cambios</button>
                    </div>
                  </div>
                </div>
              </div>
              <!--================ modals-Categoria  ======================-->
              <div class="modal fade" id="modal-agregar-categoria">
                <div class="modal-dialog modal-dialog-scrollable modal-md">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Agregar Categoria</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-danger" aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <div class="modal-body">
                      <!-- form start -->
                      <form id="form-categoria" name="form-categoria" method="POST" autocomplete="off">
                        <div class="card-body">
                          <div class="row" id="cargando-1-fomulario">
                            <!-- id idcategoria -->
                            <input type="hidden" name="idcategoria" id="idcategoria" />
                            <!-- nombre -->
                            <div class="col-lg-12 class_pading">
                              <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" name="nombre_categoria" class="form-control" id="nombre_categoria" placeholder="Nombre de categoria" />
                              </div>
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
                        <button type="submit" style="display: none;" id="submit-form-categoria">Submit</button>
                      </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="limpiar_unidades_m();">Close</button>
                      <button type="submit" class="btn btn-success" id="guardar_categoria">Guardar Cambios</button>
                    </div>
                  </div>
                </div>
              </div>
              <!--================ modals-marca  ======================-->
              <div class="modal fade" id="modal-agregar-marca">
                <div class="modal-dialog modal-dialog-scrollable modal-md">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Agregar Marca</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-danger" aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <div class="modal-body">
                      <!-- form start -->
                      <form id="form-marca" name="form-marca" method="POST" autocomplete="off">
                        <div class="card-body">
                          <div class="row" id="cargando-1-fomulario">
                            <!-- id idunidad_medida -->
                            <input type="hidden" name="idmarca" id="idmarca" />
                            <!-- nombre_medida -->
                            <div class="col-lg-12 class_pading">
                              <div class="form-group">
                                <label for="nombre">Nombre marca</label>
                                <input type="text" name="nombre_marca" id="nombre_marca" class="form-control" placeholder="Nombre de la Marca" />
                              </div>
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
                        <button type="submit" style="display: none;" id="submit-form-marca">Submit</button>
                      </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="limpiar_marca();">Close</button>
                      <button type="submit" class="btn btn-success" id="guardar_registro_marca">Guardar Cambios</button>
                    </div>
                  </div>
                </div>
              </div>
              <!--================ modals-Ubicacion  ======================-->
              <div class="modal fade" id="modal-agregar-ubicacion">
                <div class="modal-dialog modal-dialog-scrollable modal-md">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Agregar Ubicacion</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-danger" aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <div class="modal-body">
                      <!-- form start -->
                      <form id="form-ubicacion" name="form-ubicacion" method="POST" autocomplete="off">
                        <div class="card-body">
                          <div class="row" id="cargando-1-fomulario">
                            <!-- id idunidad_medida -->
                            <input type="hidden" name="idubicacion_producto" id="idubicacion_producto" />
                            <!-- nombre_medida -->
                            <div class="col-lg-12 class_pading">
                              <div class="form-group">
                                <label for="nombre">Nombre Ubicacion</label>
                                <input type="text" name="nombre_ubicacion" id="nombre_ubicacion" class="form-control" placeholder="Nombre de la Ubicacion" />
                              </div>
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
                        <button type="submit" style="display: none;" id="submit-form-ubicacion">Submit</button>
                      </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="limpiar_ubicacion();">Close</button>
                      <button type="submit" class="btn btn-success" id="guardar_registro_ubicacion">Guardar Cambios</button>
                    </div>
                  </div>
                </div>
              </div>
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
          .class-style label {
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

        <script type="text/javascript" src="scripts/color.js"></script>
        <script type="text/javascript" src="scripts/categoria.js"></script> 
        <script type="text/javascript" src="scripts/marca.js"></script>
        <script type="text/javascript" src="scripts/ubicacion.js"></script>

        <script>
          $(function () {
              $('[data-toggle="tooltip"]').tooltip();
          });
        </script>

        <script>
          if (localStorage.getItem("nube_idproyecto")) {
            console.log("icon_folder_" + localStorage.getItem("nube_idproyecto"));

            $("#ver-proyecto").html('<i class="fas fa-tools"></i> Proyecto: ' + localStorage.getItem("nube_nombre_proyecto"));

            $(".ver-otros-modulos-1").show();

            // $('#icon_folder_'+localStorage.getItem('nube_idproyecto')).html('<i class="fas fa-folder-open"></i>');
          } else {
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
