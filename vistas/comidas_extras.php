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
        <title>Admin Sevens</title>
        <?php
        require 'head.php';
        ?>
        
        <!--CSS  switch_MATERIALES-->

    <link rel="stylesheet" href="../dist/css/switch_materiales.css">

    </head>
    <body class="hold-transition sidebar-collapse sidebar-mini layout-fixed layout-navbar-fixed">
        <!-- Content Wrapper. Contains page content -->
        <div class="wrapper">
            <?php
          require 'nav.php';
          require 'aside.php';
          if ($_SESSION['viatico']==1){
          ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Comidas Extras</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">Comidas Extras</li>
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
                                            <button type="button" class="btn bg-gradient-success" data-toggle="modal" data-target="#modal-agregar-comidas_ex" onclick="limpiar();"><i class="fas fa-plus-circle"></i> Agregar</button>
                                            Admnistra comidas extras.
                                        </h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="tabla-hospedaje" class="table table-bordered table-striped display" style="width: 100% !important;">
                                            <thead>
                                                <tr>
                                                    <th class="">#</th>
                                                    <th class="">Acciones</th>
                                                    <th data-toggle="tooltip" data-original-title="Forma Pago">Forma P.</th>
                                                    <th data-toggle="tooltip" data-original-title="Tipo Comprobante">Comprob</th>
                                                    <th>Fecha</th>
                                                    <th>Sub total</th>
                                                    <th>Igv</th>
                                                    <th>Total </th>
                                                    <th>Descripci??n </th>
                                                    <th data-toggle="tooltip" data-original-title="Comprobante">Comprob</th>
                                                    <th>Estado</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                            <tfoot>
                                                <tr>
                                                    <th class="">#</th>
                                                    <th class="">Acciones</th>
                                                    <th data-toggle="tooltip" data-original-title="Forma Pago">Forma P.</th>
                                                    <th data-toggle="tooltip" data-original-title="Tipo Comprobante">Comprob</th>
                                                    <th>Fecha</th>
                                                    <th>Sub total</th>
                                                    <th>Igv</th>
                                                    <th style="background-color: #ffdd00;" class="text-right text-nowrap" id="total_monto"></th>
                                                    <th>Descripci??n </th>
                                                    <th data-toggle="tooltip" data-original-title="Comprobante">Comprob</th>
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
                    <div class="modal fade" id="modal-agregar-comidas_ex">
                        <div class="modal-dialog modal-dialog-scrollable modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"> <b>Agregar: </b> Comida extra </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span class="text-danger" aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <!-- form start -->
                                    <form id="form-comidas_ex" name="form-comidas_ex" method="POST">
                                        <div class="card-body">
                                            <div class="row" id="cargando-1-fomulario">
                                                <!-- id proyecto -->
                                                <input type="hidden" name="idproyecto" id="idproyecto" />
                                                <!-- id hospedaje -->
                                                <input type="hidden" name="idcomida_extra" id="idcomida_extra" />

                                                <!-- Fecha 1 onchange="calculando_cantidad(); restrigir_fecha_ant();" onkeyup="calculando_cantidad(); -->
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                    <label for="forma_pago">Forma Pago <sup class="text-danger">*</sup></label>
                                                    <select name="forma_pago" id="forma_pago" class="form-control select2" style="width: 100%;">
                                                        <option value="Transferencia">Transferencia</option>
                                                        <option value="Efectivo">Efectivo</option>
                                                        <option value="Cr??dito">Cr??dito</option>
                                                    </select>
                                                    </div>
                                                </div>
                                                <!-- Tipo de comprobante -->
                                                <div class="col-lg-6" id="content-t-comprob">
                                                    <div class="form-group">
                                                    <label for="tipo_comprobante">Tipo Comprobante <sup class="text-danger">*</sup></label>
                                                    <select name="tipo_comprobante" id="tipo_comprobante" class="form-control select2" onchange="comprob_factura();" placeholder="Seleccinar un tipo de comprobante">
                                                        <option value="Ninguno">Ninguno</option>
                                                        <option value="Boleta">Boleta</option>
                                                        <option value="Factura">Factura</option>
                                                        <option value="Nota_de_venta">Nota de venta</option>
                                                    </select>
                                                    </div>
                                                </div>
                                                <!-- RUC style="display: none;"-->
                                                <div class="col-lg-4 div_ruc" style="display: none;"  >
                                                    <div class="form-group">
                                                    <label for="ruc">R.U.C</label>
                                                    <div class="input-group">
                                                        <input type="number" name="ruc" class="form-control" id="ruc" placeholder="N?? de documento" />
                                                        <div class="input-group-append" data-toggle="tooltip" data-original-title="Buscar raz??n social" onclick="buscar_sunat();">
                                                        <span class="input-group-text" style="cursor: pointer;">
                                                            <i class="fas fa-search text-primary" id="search"></i>
                                                            <i class="fa fa-spinner fa-pulse fa-fw fa-lg text-primary" id="charge" style="display: none;"></i>
                                                        </span>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                                <!-- Raz??n social--> 
                                                <div class="col-lg-8 div_razon_social" style="display: none;">
                                                    <div class="form-group">
                                                    <label class="razon_social" for="razon_social">Raz??n social </label>
                                                    <input type="text" name="razon_social" id="razon_social" class="form-control" placeholder="Raz??n social" readonly />
                                                    <input type="hidden" name="direccion" id="direccion"   />
                                                    </div>
                                                </div>
                                                <!-- C??digo-->
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="codigo" class="nro_comprobante">N??m. comprobante </label>                               
                                                        <input type="text"  name="nro_comprobante" id="nro_comprobante" class="form-control"  placeholder="C??digo"> 
                                                    </div>                                                        
                                                </div>
                                                <!--Fecha-->
                                                <div class="col-lg-6 class_pading">
                                                    <div class="form-group">
                                                        <label for="fecha">Fecha <sup class="text-danger">*</sup></label>
                                                        <input type="date" name="fecha" class="form-control" id="fecha" />
                                                    </div>
                                                </div>
                                                <!-- Sub total -->
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="subtotal">Sub total</label>
                                                        <input class="form-control subtotal" type="number" placeholder="Sub total" readonly/>
                                                        <input class="form-control" type="hidden"  id="subtotal" name="subtotal"/>
                                                    </div>
                                                </div>
                                                <!-- Fecha Emisi??n -->
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="igv">IGV</label>
                                                        <input class="form-control igv" type="number" placeholder="IGV"  readonly />
                                                        <input class="form-control" type="hidden"  id="igv" name="igv"/>
                                                    </div>
                                                </div>
                                                <!--Precio Parcial-->
                                                <div class="col-lg-4 class_pading">
                                                    <div class="form-group">
                                                        <label for="marca">Monto total </label>
                                                        <input type="number" class="form-control precio_parcial" onkeyup="comprob_factura();" placeholder="Precio Parcial" />
                                                        <input type="hidden" name="precio_parcial" id="precio_parcial"/>
                                                       
                                                    </div>                                                  
                                                </div>
                                                <!--Descripcion-->
                                                <div class="col-lg-12 class_pading">
                                                    <div class="form-group">
                                                        <label for="descripcion_pago">Descripci??n <sup class="text-danger">*</sup> <span style="font-size: 12px;font-weight: normal;" >ej. Almuerzo, aniversario de la empresa</span> </label> <br>
                                                        <textarea name="descripcion" id="descripcion" class="form-control" rows="2"></textarea>
                                                    </div>                                              
                                                </div>
                                                <!-- Factura -->
                                                <div class="col-md-6" >                               
                                                    <div class="row text-center">
                                                    <div class="col-md-12" style="padding-top: 15px; padding-bottom: 5px;">
                                                        <label for="cip" class="control-label" > Comprobante </label>
                                                    </div>
                                                    <div class="col-md-6 text-center">
                                                        <button type="button" class="btn btn-success btn-block btn-xs" id="doc1_i">
                                                        <i class="fas fa-upload"></i> Subir.
                                                        </button>
                                                        <input type="hidden" id="doc_old_1" name="doc_old_1" />
                                                        <input style="display: none;" id="doc1" type="file" name="doc1" accept="application/pdf, image/*" class="docpdf" /> 
                                                    </div>
                                                    <div class="col-md-6 text-center">
                                                        <button type="button" class="btn btn-info btn-block btn-xs" onclick="re_visualizacion(1, 'comprobante');">
                                                        <i class="fas fa-redo"></i> Recargar.
                                                        </button>
                                                    </div>
                                                    </div>                              
                                                    <div id="doc1_ver" class="text-center mt-4">
                                                    <img src="../dist/svg/doc_uploads.svg" alt="" width="50%" >
                                                    </div>
                                                    <div class="text-center" id="doc1_nombre"><!-- aqui va el nombre del pdf --></div>
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
                                        <button type="submit" style="display: none;" id="submit-form-comidas-ex">Submit</button>
                                    </form>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="limpiar();">Close</button>
                                    <button type="submit" class="btn btn-success" id="guardar_registro">Guardar Cambios</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--===============Modal-ver-ficha-t??cnica =========-->
                    <div class="modal fade" id="modal-ver-comprobante">
                          <div class="modal-dialog modal-dialog-scrollable modal-xl ">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h4 class="modal-title">Comprobante comida extra</h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span class="text-danger" aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                      <div  class="class-style" style="text-align: center;"> 
                                      <a class="btn btn-warning  btn-block" href="#" id="iddescargar" download="Comprobante comida extra" style="padding:0px 12px 0px 12px !important;" type="button"><i class="fas fa-download"></i></a>
                                        <br>
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
        <?php
        
        require 'script.php';
        ?>
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
            .text_area_clss {
                width: 100%;
                background: rgb(215 224 225 / 22%);
                border-block-color: inherit;
                border-bottom: aliceblue;
                border-left: aliceblue;
                border-right: aliceblue;
                border-top: hidden;
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

       <!-- <script type="text/javascript" src="scripts/moment.min.js"></script>-->
        <script type="text/javascript" src="scripts/comidas_extras.js"></script>

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
