<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="escritorio.php" class="brand-link">
    <img src="../dist/img/logo_blanco.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: 0.8;" />
    <span class="brand-text font-weight-light">Solution motors</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar"> 
    <!-- Sidebar user panel (optional) -->
    <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="../dist/svg/empresa-logo.svg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Construccion del baño portodoloque parte de no se</a>
      </div>
    </div>     -->

    <!-- SidebarSearch Form -->
    <div class="form-inline mt-4">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search" />
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        
        <?php if ($_SESSION['escritorio']==1) {  ?>
          <!-- ESCRITORIO -->
          <li class="nav-item">
            <a href="escritorio.php" class="nav-link" id="mEscritorio">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Escritorio
                <span class="right badge badge-danger">Home</span>
              </p>
            </a>
          </li>
        <?php  }  ?>

        <?php if ($_SESSION['acceso']==1) {  ?>
          <!-- ACCESOS -->
          <li class="nav-item" id="bloc_Accesos">
            <a href="#" class="nav-link" id="mAccesos">
              <i class="nav-icon fas fa-shield-alt"></i>
              <p>
                Accesos
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">2</span>
              </p>
            </a>
            <ul class="nav nav-treeview ">
              <!-- Usuarios del sistema -->
              <li class="nav-item ">
                <a href="usuario.php" class="nav-link " id="lUsuario">
                  <i class="nav-icon fas fa-users-cog"></i>
                  <p>Usuarios</p>
                </a>
              </li>
              <!-- Permisos de los usuarios del sistema -->
              <li class="nav-item ">
                <a href="permiso.php" class="nav-link" id="lPermiso">
                  <i class="nav-icon fas fa-lock"></i>
                  <p>Permisos</p>
                </a>
              </li>      
            </ul>
          </li>
        <?php  }  ?>


        <?php if ($_SESSION['recurso']==1) {  ?>
          <!-- Recursos -->
          <li class="nav-item" id="bloc_Recurso">
            <a href="#" class="nav-link" id="mRecurso">
              <i class="nav-icon fas fa-project-diagram"></i>
              <p>
                Recursos
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">4</span>
              </p>
            </a>
            <ul class="nav nav-treeview ">
              <!-- Usuarios del sistema -->
              <li class="nav-item ">
                <a href="all_trabajador.php" class="nav-link" id="lAllTrabajador">
                  <i class="nav-icon fas fa-users"></i>
                  <p>Trabajador</p>
                </a>
              </li>
              <!-- Proveedores de la empresa -->
              <li class="nav-item ">
                <a href="all_proveedor.php" class="nav-link" id="lAllProveedor">
                  <i class="nav-icon fas fa-truck"></i>
                  <p>Proveedor</p>
                </a>
              </li>  
              <!-- productos para la empresa -->
              <li class="nav-item ">
                <a href="materiales.php" class="nav-link" id="lAllMateriales">
                  
                <img src="../dist/svg/palana-ico.svg" class="nav-icon" alt="" style="width: 21px !important;" >
                  <p>Producto</p>
                </a>
              </li>
              <!-- Datos Generales marca y color -->
              <li class="nav-item ">
                <a href="otros.php" class="nav-link" id="lBancoColor">
                  <i class="nav-icon fas fa-coins"></i>
                  <p>Otros</p>
                </a>
              </li>
            </ul>
          </li>
        <?php  }  ?>

        <?php if ($_SESSION['compra']==1) {  ?>
          <!-- Recursos -->
          <li class="nav-item" id="bloc_Recurso">
            <a href="#" class="nav-link" id="mRecurso">
              <i class="nav-icon fas fa-project-diagram"></i>
              <p>
                Compras
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">4</span>
              </p>
            </a>
            <ul class="nav nav-treeview ">
              <!-- Usuarios del sistema -->
              <li class="nav-item ">
                <a href="compra.php" class="nav-link" id="compras">
                  <i class="nav-icon fas fa-users"></i>
                  <p>compras</p>
                </a>
              </li>
            </ul>
          </li>
        <?php  }  ?>
        
        <?php if ($_SESSION['venta']==1) {  ?>
          <!-- Recursos -->
          <li class="nav-item" id="bloc_Recurso">
            <a href="#" class="nav-link" id="mRecurso">
              <i class="nav-icon fas fa-project-diagram"></i>
              <p>
                Venta
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">4</span>
              </p>
            </a>
            <ul class="nav nav-treeview ">
              <!-- Usuarios del sistema -->
              <li class="nav-item ">
                <a href="venta.php" class="nav-link" id="venta">
                  <i class="nav-icon fas fa-users"></i>
                  <p>Venta</p>
                </a>
              </li>
            </ul>
          </li>
        <?php  }  ?>

        <?php if ($_SESSION['servicio']==1) {  ?>
          <!-- ALL ACTIVOS FIJOS -->
          <li class="nav-item">
            <a href="servicio.php" class="nav-link" id="mServicio">
              <i class="nav-icon fas fa-hand-holding-usd"></i>
              <p>Servicio</p>
            </a>
          </li>
        <?php  }  ?>
        
        <li class="nav-header">MÓDULOS</li>

        <!-- cargando -->     
        <li class="nav-item ver-otros-modulos-2" style="display: none !important;">
          <a href="#" class="nav-link" >
          <i class="fas fa-spinner fa-pulse "></i>
            <p>
              Cargando...
            </p>
          </a>
        </li>

        <!-- <li class="nav-header bg-color-2c2c2c">TÉCNICO</li>  -->
         
        <li class="nav-item ver-otros-modulos-1" id="bloc_Tecnico">
          <a href="#" class="nav-link bg-color-2c2c2c" id="mTecnico" style="padding-left: 7px;">
            <i class="nav-icon far fa-circle"></i>
            <p class="font-size-14px">TÉCNICO <i class="fas fa-angle-left right"></i><span class="badge badge-info right">4</span></p>
          </a>
          <ul class="nav nav-treeview">
            <?php if ($_SESSION['valorizacion']==1) {  ?>
              <!-- VALORIZACIONES -->
              <li class="nav-item ver-otros-modulos-1">
                <a href="valorizacion.php" class="nav-link" id="lValorizacion">
                  <i class="nav-icon far fa-file-alt"></i>
                  <p>
                    Valorizaciones
                  </p>
                </a>
              </li>
            <?php  }  ?>

            <?php if ($_SESSION['asistencia_trabajador']==1) {  ?>
              <!-- REGISTRO DE ASISTENCIA -->
              <li class="nav-item ver-otros-modulos-1">
                <a href="registro_asistencia.php" class="nav-link" id="lAsistencia">
                  <i class="fas fa-clipboard-list nav-icon"></i>
                  <p>
                    Asistencia del obrero
                  </p>
                </a>
              </li>
            <?php  }  ?>

            <?php if ($_SESSION['calendario']==1) {  ?>
              <!-- CALENDARIO -->       
              <li class="nav-item ver-otros-modulos-1">
                <a href="calendario.php" class="nav-link" id="lCalendario">
                  <i class="nav-icon far fa-calendar-alt"></i>
                  <p>
                    Calendario                 
                  </p>
                </a>
              </li>
            <?php  }  ?>

            <?php if ($_SESSION['plano_otro']==1) {  ?>
              <!-- PLANOS Y OTROS -->       
              <li class="nav-item ver-otros-modulos-1">
                <a href="plano_otro.php" class="nav-link" id="lPlanoOtro">
                  <i class="nav-icon fas fa-map-marked-alt"></i>
                  <p>
                    Planos y otros                 
                  </p>
                </a>
              </li>
            <?php  }  ?>
          </ul>
        </li>        

        <!-- <li class="nav-header bg-color-2c2c2c">LOGÍSTICA Y ADQUISICIONES</li> -->
        
        <!-- LOGÍSTICA Y ADQUISICIONES -->      
        <li class="nav-item ver-otros-modulos-1" id="bloc_LogisticaAdquisiciones">
          <a href="#" class="nav-link bg-color-2c2c2c" id="mLogisticaAdquisiciones" style="padding-left: 7px;">
            <i class="nav-icon far fa-circle"></i>
            <p class="font-size-14px">LOGÍSTICA Y ADQUISICIONES <i class="fas fa-angle-left right"></i></p>
          </a>
          <ul class="nav nav-treeview">

            <?php if ($_SESSION['trabajador']==1) {  ?>
              <!-- TRABAJADORES -->
              <li class="nav-item ver-otros-modulos-1">
                <a href="trabajador.php" class="nav-link" id="lTrabajador">
                  <!-- <i class="nav-icon fas fa-hard-hat"></i> -->
                  <img src="../dist/svg/constructor-ico.svg" class="nav-icon" alt="" style="width: 21px !important;" >
                  <p>
                    Trabajadores
                  </p>
                </a>
              </li>
            <?php  }  ?>

            <?php if ($_SESSION['compra']==1) {  ?>   
              <!-- COMPRAS -->      
              <li class="nav-item ver-otros-modulos-1" id="bloc_Compras">
                <a href="#" class="nav-link" id="mCompra">
                  <i class="fas fa-shopping-cart nav-icon"></i>
                  <p>
                    Compras
                    <i class="fas fa-angle-left right"></i>
                    <span class="badge badge-info right">3</span>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <!-- Compras del proyecto -->
                  <li class="nav-item ">
                    <a href="compra.php" class="nav-link" id="lCompras">
                      <i class="nav-icon fas fa-cart-plus"></i>
                      <p>Compras</p>
                    </a>
                  </li>
                  <!-- Resumend de Insumos -->
                  <li class="nav-item ">
                    <a href="resumen_insumos.php" class="nav-link" id="lResumenInsumos">
                      <i class="nav-icon fas fa-tasks"></i>
                      <p>Resumen de insumos</p>
                    </a>
                  </li> 
                  <!-- Resumend de Insumos -->
                  <li class="nav-item ">
                    <a href="resumen_activos_fijos.php" class="nav-link" id="lResumenActivosFijos">
                      <i class="nav-icon fas fa-tasks"></i>
                      <p>Resumen de Activos Fijos</p>
                    </a>
                  </li> 
                </ul>
              </li>
            <?php  }  ?>           

            <?php if ($_SESSION['servicio_maquina']==1) {  ?>  
              <!-- SERVICIO -->       
              <li class="nav-item ver-otros-modulos-1">
                <a href="servicio_maquina.php" class="nav-link" id="lMaquina">
                  <!-- <i class="nav-icon fas fa-tractor"></i> -->
                  <img src="../dist/svg/excabadora-ico.svg" class="nav-icon" alt="" style="width: 21px !important;" >
                  <p>
                    Servicio - Maquina
                    <!-- <span class="badge badge-info right">2</span> -->
                  </p>
                </a>
              </li>
            <?php  }  ?>

            <?php if ($_SESSION['servicio_equipo']==1) {  ?>  
              <!-- EQUIPOS -->       
              <li class="nav-item ver-otros-modulos-1">
                <a href="servicio_equipos.php" class="nav-link" id="lEquipo">
                  <!-- <i class="nav-icon fas fa-tractor"></i> -->
                  <img src="../dist/svg/estacion-total-ico.svg" class="nav-icon" alt="" style="width: 21px !important;" >
                  <p>
                    Servicio - Equipos
                    <!-- <span class="badge badge-info right">2</span> -->
                  </p>
                </a>
              </li>
            <?php  }  ?>
            <?php if ($_SESSION['subcontrato']==1) {  ?>  
            <li class="nav-item ver-otros-modulos-1">
              <a href="sub_contrato.php" class="nav-link" id="lSubContrato">
                <i class="nav-icon fas fa-hands-helping"></i>
                <p>
                  Sub Contrato              
                </p>
              </a>
            </li>
            <?php  }  ?>
            <?php if ($_SESSION['planilla_seguro']==1) {  ?>
              <!-- PLANILLAS Y SEGUROS -->       
              <li class="nav-item ver-otros-modulos-1">
                <a href="planillas_seguros.php" class="nav-link" id="lPlanillaSeguro">
                  <!--<i class="nav-icon fas fa-map-marked-alt"></i>lanilla-seguro-ico.svg-->
                  <img src="../dist/svg/planilla-seguro-ico.svg" class="nav-icon" alt="" style="width: 21px !important;" >
                  <p>
                    Planillas y seguros                 
                  </p>
                </a>
              </li>
            <?php  }  ?>

            <?php if ($_SESSION['otro_gasto']==1) {  ?>
              <!-- OTROS GASTOS -->       
              <li class="nav-item ver-otros-modulos-1">
                <a href="otro_gasto.php" class="nav-link" id="lOtroGasto">
                  <i class="nav-icon fas fa-network-wired"></i>
                  <p>
                    Otros Gastos                
                  </p>
                </a>
              </li>
            <?php  }  ?>

            <?php if ($_SESSION['resumen_general']==1) {  ?>
              <!-- OTROS SERVICIOS -->       
              <li class="nav-item ver-otros-modulos-1">
                <a href="resumen_general.php" class="nav-link" id="lresumen_general">
                  
                <i class="nav-icon fas fa-list-ul"></i>
                  <p>
                  Resumen general               
                  </p>
                </a>
              </li>
            <?php  }  ?>
            
            <?php if ($_SESSION['viatico']==1) {  ?>
              <!-- BIÁTICOS -->
              <li class="nav-item ver-otros-modulos-1"  id="bloc_Viaticos">
                <a href="#" class="nav-link" id="mViatico">
                  <i class="nav-icon fas fa-plane"></i>
                  <p>
                    Viáticos
                    <i class="right fas fa-angle-left"></i>
                    <span class="badge badge-info right">3</span>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <!-- TRANSPORTE -->
                  <li class="nav-item">
                    <a href="transporte.php" class="nav-link" id="lTransporte">
                      <i class="fas fa-shuttle-van nav-icon"></i>
                      <p>Transporte</p>
                    </a>
                  </li>
                  <!-- HOSPEDAJE -->
                  <li class="nav-item">
                    <a href="hospedaje.php" class="nav-link" id="lHospedaje"> 
                      <i class="fas fa-hotel nav-icon"></i>
                      <p>Hospedaje</p>
                    </a>
                  </li>
                  <!-- COMIDA -->
                  <li class="nav-item" id="sub_bloc_comidas">
                    <a href="#" class="nav-link"  id="sub_mComidas">
                      <i class="fas fa-fish nav-icon"></i>
                      <p>
                        Comida
                        <i class="right fas fa-angle-left"></i> 
                        <span class="badge badge-info right">3</span>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="pension.php" class="nav-link" id="lPension">
                          <i class="fas fa-utensils nav-icon"></i>
                          <p>Pensión</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="break.php" class="nav-link" id="lBreak" >
                          <i class="fas fa-hamburger nav-icon"></i>
                          <p>Break</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="comidas_extras.php" class="nav-link" id="lComidasExtras" >
                          <i class="fas fa-drumstick-bite nav-icon"></i>
                          <p>Comidas - extras</p>
                        </a>
                      </li>
                    </ul>
                  </li>              
                </ul>
              </li>
            <?php  }  ?>
          </ul>
        </li>        

        <!-- <li class="nav-header bg-color-2c2c2c">CONTABLE Y FINANCIERO</li> -->
         
        <li class="nav-item ver-otros-modulos-1" id="bloc_ContableFinanciero">
          <a href="#" class="nav-link bg-color-2c2c2c" id="mContableFinanciero" style="padding-left: 7px;">
            <i class="nav-icon far fa-circle"></i>
            <p class="font-size-14px">CONTABLE Y FINANCIERO<i class="fas fa-angle-left right"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <?php if ($_SESSION['pago_trabajador']==1) {  ?>          
              <!-- PAGOS DE TRABAJADORES -->
              <li class="nav-item ver-otros-modulos-1" id="bloc_PagosTrabajador">
                <a href="#" class="nav-link" id="mPagosTrabajador">
                  <i class="fas fa-dollar-sign nav-icon"></i>
                  <p>
                    Pago Trabajador
                    <i class="fas fa-angle-left right"></i>
                    <span class="badge badge-info right">2</span>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <!-- Obreros  -->
                  <li class="nav-item ">
                    <a href="pago_obrero.php" class="nav-link" id="lPagosObrero">
                      <i class="nav-icon fas fa-users"></i>
                      <p>Obreros</p>
                    </a>
                  </li>
                  <!-- Administradores -->
                  <li class="nav-item ">
                    <a href="pago_administrador.php" class="nav-link" id="lPagosAdministrador">
                      <i class="nav-icon fas fa-briefcase"></i>
                      <p>Administradores</p>
                    </a>
                  </li> 
                </ul>
              </li>
            <?php  }  ?>

            <li class="nav-item ver-otros-modulos-1">
              <a href="prestamo.php" class="nav-link" id="lPrestamo">
                <i class="nav-icon fas fa-university"></i>
                <p>
                  Prestamos               
                </p>
              </a>
            </li>           
            

            <li class="nav-item ver-otros-modulos-1">
              <a href="estado_financiero.php" class="nav-link" id="lEstadoFinanciero">             
                <i class="nav-icon fas fa-balance-scale-left"></i>
                <p>
                  Estado Financiero               
                </p>
              </a>
            </li>
          </ul>
        </li>

      </ul>      
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
