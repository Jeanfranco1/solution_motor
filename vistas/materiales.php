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
                      <h1><img src="../dist/svg/palana-ico-negro.svg" class="nav-icon" alt="" style="width: 21px !important;"> Productos</h1>
                    </div>
                    <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Productos</li>
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
                            <button type="button" class="btn bg-gradient-success" data-toggle="modal" data-target="#modal-agregar-material" onclick="limpiar();"><i class="fas fa-plus-circle"></i> Agregar</button>
                            Admnistra de manera eficiente los productos.
                          </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="tabla-productos" class="table table-bordered table-striped display" style="width: 100% !important;">
                            <thead>
                              <tr>
                                <th class="text-center">#</th>
                                <th class="">Acciones</th>
                                <th class="text-nowrap">Nombre</th>
                                <th>Marca</th>
                                <th>Modelo/Serie</th>
                                <th>Categor??a</th>
                                <th>Stock</th>
                                <th data-toggle="tooltip" data-original-title="Precio compra">Precio compra</th>
                                <th data-toggle="tooltip" data-original-title="porcentaje utilidad">P.U %</th>
                                <th data-toggle="tooltip" data-original-title="Precio Venta">Precio Venta</th>
                                <th>Codigo</th>
                                <th>Ubicacion</th>
                                <th>Estado</th>
                              </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                              <tr>
                              <th class="text-center">#</th>
                                <th class="">Acciones</th>
                                <th>Nombre</th>
                                <th>Marca</th>
                                <th>Modelo/Serie</th>
                                <th>Categor??a</th>
                                <th>Stock</th>
                                <th data-toggle="tooltip" data-original-title="Precio compra">Precio compra</th>
                                <th data-toggle="tooltip" data-original-title="porcentaje utilidad">P.U %</th>
                                <th data-toggle="tooltip" data-original-title="Precio Venta">Precio Venta</th>
                                <th>Codigo</th>
                                <th>Ubicacion</th>
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

                <!-- Modal agregar proveedores -->
                <div class="modal fade" id="modal-agregar-material">
                  <div class="modal-dialog modal-dialog-scrollable modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Agregar Producto</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span class="text-danger" aria-hidden="true">&times;</span>
                        </button>
                      </div>

                      <div class="modal-body">
                        <!-- form start -->
                        <form id="form-productos" name="form-productos" method="POST">
                          <div class="card-body">
                            <div class="row" id="cargando-1-fomulario">
                              <!-- id producto -->
                              <input type="hidden" name="idproducto" id="idproducto" />
                              <!-- Nombre -->
                              <div class="col-lg-12 class_pading">
                                <div class="form-group">
                                  <label for="nombre_producto">Nombre</label>
                                  <input type="text" name="nombre_producto" class="form-control" id="nombre_producto" placeholder="Nombre del Insumo." onchange="generar_cod();" onkeyup="generar_cod();" />
                                </div>
                              </div>

                              <!--Categoria-->
                              <div class="col-lg-6">
                                <div class="form-group">
                                  <label for="categoria">Categoria</label>
                                  <select name="categoria" id="categoria" class="form-control select2" style="width: 100%;"></select> 
                                  
                                </div>
                              </div>
                              <!--Marca-->
                              <div class="col-lg-6">
                                <div class="form-group">
                                  <label for="marca">Marca</label>
                                  <select name="marca" id="marca" class="form-control select2" style="width: 100%;"onchange="generar_cod();" onkeyup="generar_cod();"></select> 
                                  
                                </div>
                              </div>

                              <!-- Modelo -->
                              <div class="col-lg-6">
                                <div class="form-group">
                                  <label for="modelo">Modelo <sup class="text-danger">*</sup> </label>
                                  <input class="form-control" type="text" id="modelo" name="modelo" placeholder="Modelo." onchange="generar_cod();" onkeyup="generar_cod();"/>
                                </div>
                              </div>

                              <!-- Serie -->
                              <div class="col-lg-6">
                                <div class="form-group">
                                  <label for="serie">Serie </label>
                                  <input class="form-control" type="text" id="serie" name="serie" placeholder="Serie." />
                                </div>
                              </div>
                                <!-- Unnidad  onchange="mostrar_igv(); ocultar_comprob();"-->
                              <div class="col-lg-4" id="content-t-unidad">
                                <div class="form-group">
                                  <label for="Unidad-medida">Unidad-medida</label>
                                  <select name="unid_medida" id="unid_medida" class="form-control select2" style="width: 100%;"> 
                                   <option value="1">Unidad</option>
                                   <option value="2">Litros</option>
                                   <option value="3">Kilo</option>
                                  </select>
                                  <!--<input type="hidden" name="unid_medida_old" id="unid_medida_old" />-->
                                  
                                </div>
                              </div>
                              

                              <!-- Color -->
                              <div class="col-lg-4" >
                                <div class="form-group">
                                  <label for="color">Color</label>
                                  <select name="color" id="color" class="form-control select2" style="width: 100%;"></select>
                                  <!--<input type="hidden" name="color_old" id="color_old" />-->
                                </div>
                              </div>

                             <!--Stock-->
                             <div class="col-lg-4 class_pading">
                                <div class="form-group">
                                  <label for="stock">Stock</label>
                                  <input type="number" name="stock" id="stock" class="form-control total" placeholder="stock."/>
                                </div>
                              </div>

                              <!--Precio U-->
                              <div class="col-lg-4 class_pading">
                                <div class="form-group">
                                  <label for="precio_compra">Precio Compra</label>
                                  <input type="number" name="precio_compra" class="form-control miimput" id="precio_compra" placeholder="Precio Unitario." onchange="cal_precio_venta();" onkeyup="cal_precio_venta();" />
                                </div>
                              </div>


                              <!--Sub Total porcentaje monto_igv total-->
                              <div class="col-lg-4 class_pading">
                                <div class="form-group">
                                  <label for="porcentaje">Porcentaje_utilidad %</label> 
                                  <input type="number" name="porcentaje" class="form-control" id="porcentaje" placeholder="Ej. 30%" onchange="cal_precio_venta();" onkeyup="cal_precio_venta();"/>
                                </div>
                              </div>

                              <!--Total-->
                              <div class="col-lg-4 class_pading">
                                <div class="form-group">
                                  <label for="precio_venta">Precio Venta</label>
                                  <input type="text" name="precio_venta" class="form-control" id="precio_venta" placeholder="precio venta." readonly />
                                </div>
                              </div>
                              <!--Total-->
                              <div class="col-lg-4 class_pading">
                                <div class="form-group">
                                  <label for="codigo_producto">Codigo del Producto</label>
                                  <input type="text" name="codigo_producto" class="form-control" id="codigo_producto" placeholder="codigo producto." readonly/>
                                </div>
                              </div>
                              <!--Total-->
                              <div class="col-lg-4">
                                <div class="form-group">
                                  <label for="ubicacion_producto">Ubicacion del Producto </label>
                                  <select name="idubicacion_producto" id="idubicacion_producto" class="form-control select2" style="width: 100%;"></select>
                                </div>
                              </div>
                              <!--descripcion_producto-->
                              <div class="col-lg-12 class_pading">
                                <div class="form-group">
                                  <label for="descripcion">Descripci??n </label> <br />
                                  <textarea name="descripcion" id="descripcion" class="form-control" rows="2"></textarea>
                                </div>
                              </div>
                                             
                              <!-- Ficha tecnica -->
                              <div class="col-md-6 col-lg-6">
                                <label for="doc2_i" >Imagen Producto<b class="text-danger">(Imagen o PDF)</b> </label>  
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
                          <button type="submit" style="display: none;" id="submit-form-productos">Submit</button>
                        </form>
                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="limpiar();">Close</button>
                        <button type="submit" class="btn btn-success" id="guardar_registro">Guardar Cambios</button>
                      </div>
                    </div>
                  </div>
                </div>

                <!--Modal ver proveedores-->
                <div class="modal fade" id="modal-ver-proveedores">
                  <div class="modal-dialog modal-dialog-scrollable modal-xm">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Datos proveedores</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span class="text-danger" aria-hidden="true">&times;</span>
                        </button>
                      </div>

                      <div class="modal-body">
                        <div id="datosproveedores" class="class-style"></div>
                      </div>
                    </div>
                  </div>
                </div>

                <!--===============Modal-ver-ficha-t??cnica =========-->
                <div class="modal fade" id="modal-ver-ficha_tec">
                  <div class="modal-dialog modal-dialog-scrollable modal-xl">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Ficha T??cnica</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span class="text-danger" aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="class-style" style="text-align: center;">
                          <a class="btn btn-warning btn-block" href="#" id="iddescargar" download="Ficha T??cnica" style="padding: 0px 12px 0px 12px !important;" type="button"><i class="fas fa-download"></i></a>
                          <br />
                          <img onerror="this.src='../dist/img/default/img_defecto.png';" src="../dist/img/default/img_defecto.png" class="img-thumbnail" id="img-factura" style="cursor: pointer !important;" width="auto" />
                          <div id="ver_fact_pdf" style="cursor: pointer !important;" width="auto"></div>
                        </div>
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

        <script type="text/javascript" src="scripts/materiales.js"></script>

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
