<?php
  ob_start();
  if (strlen(session_id()) < 1) {
    session_start(); //Validamos si existe o no la sesión
  }

  if (!isset($_SESSION["nombre"])) {

    header("Location: ../vistas/login.html"); //Validamos el acceso solo a los usuarios logueados al sistema.

  } else {

    if ($_SESSION['recurso'] == 1) {
      
      require_once "../modelos/Servicio.php";

      $servicio = new Servicio();

      $idservicios = isset($_POST["idservicios"]) ? limpiarCadena($_POST["idservicios"]) : "";
      $tipo_servicio = isset($_POST["tipo_servicio"]) ? limpiarCadena($_POST["tipo_servicio"]) : "";
      $fecha_ingreso = isset($_POST["fecha_ingreso"]) ? encodeCadenaHtml($_POST["fecha_ingreso"] ) : "";
      $fecha_salida = isset($_POST["fecha_salida"]) ? encodeCadenaHtml($_POST["fecha_salida"] ) : "";
      $fec_prox_mant = isset($_POST["fec_prox_mant"]) ? encodeCadenaHtml($_POST["fec_prox_mant"]) : "";
      $Km_ingreso = isset($_POST["Km_ingreso"]) ? encodeCadenaHtml($_POST["Km_ingreso"] ) : "";
      $prox_mantenimiento = isset($_POST["prox_mantenimiento"]) ? limpiarCadena($_POST["prox_mantenimiento"]) : "";
      $informe_ingreso = isset($_POST["informe_ingreso"]) ? limpiarCadena($_POST["informe_ingreso"]) : "";
      $imagen_informe = isset($_POST["doc2"]) ? limpiarCadena($_POST["doc2"]) : ""; 
      $ficha_tecnica = isset($_POST["ficha_tecnica"]) ? limpiarCadena($_POST["ficha_tecnica"]) : "";
     

      switch ($_GET["op"]) {

        case 'guardaryeditar':
        
          // ficha técnica
          if (!file_exists($_FILES['doc2']['tmp_name']) || !is_uploaded_file($_FILES['doc2']['tmp_name'])) {

            $imagen_informe = $_POST["doc_old_2"];

            $flat_img1 = false;

          } else {

            $ext1 = explode(".", $_FILES["doc2"]["name"]);

            $flat_img1 = true;

            $imagen_informe = rand(0, 20) . round(microtime(true)) . rand(21, 41) . '.' . end($ext1);

            move_uploaded_file($_FILES["doc2"]["tmp_name"], "../dist/docs/material/img_perfil/" . $imagen_informe);
          }

          if (empty($idservicios)) {
            
            $rspta = $servicio->insertar($tipo_servicio, $fecha_ingreso, $fecha_salida, $fec_prox_mant, $Km_ingreso, $prox_mantenimiento, $informe_ingreso,$imagen_informe, $ficha_tecnica);
            
            echo $rspta ? "ok" : "No se pudieron registrar todos los datos del proveedor";

          } else {

            // validamos si existe LA IMG para eliminarlo
            if ($flat_img1 == true) {

              $datos_f1 = $servicio->obtenerImg($idservicios);

              $img1_ant = $datos_f1->fetch_object()->imagen_informe;

              if ($img1_ant != "") {

                unlink("../dist/docs/material/img_perfil/" . $img1_ant);
              }
            }
             
            $rspta = $servicio->editar($idservicios, $tipo_servicio, $fecha_ingreso, $fecha_salida,$fec_prox_mant, $Km_ingreso, $prox_mantenimiento, $informe_ingreso,$imagen_informe, $ficha_tecnica);
            
            echo $rspta ? "ok" : "Trabador no se pudo actualizar";
          }
        break;
    
        case 'desactivar':

          $rspta = $servicio->desactivar($idservicios);

          echo $rspta ? "material Desactivado" : "material no se puede desactivar";

        break;
    
        case 'activar':

          $rspta = $servicio->activar($idservicios);

          echo $rspta ? "Material activado" : "material no se puede activar";

        break;

        case 'eliminar':

          $rspta = $servicio->eliminar($idservicios);

          echo $rspta ? "ok" : "material no se puede eliminar";

        break;
    
        case 'mostrar':

          $rspta = $servicio->mostrar($idservicios);
          //Codificar el resultado utilizando json
          echo json_encode($rspta);

        break;
    
        case 'listar':
          $rspta = $servicio->listar();
          //Vamos a declarar un array
          $data = [];
          $imagen = '';
          $ficha_tecnica = '';
          $monto_igv = '';
          $imagen_error = "this.src='../dist/svg/default_producto.svg'";
          $cont=1;

          while ($reg = $rspta->fetch_object()) {

            if (empty($reg->imagen_informe)) { $imagen = 'img_material_defect.jpg';  } else { $imagen = $reg->imagen_informe;   }
           
            $data[] = [
              "0"=>$cont++,
              "1" => $reg->estado ? '<button class="btn btn-warning btn-sm" onclick="mostrar(' . $reg->idservicios . ')"><i class="fas fa-pencil-alt"></i></button>' .
              ' <button class="btn btn-danger btn-sm" onclick="eliminar(' . $reg->idservicios . ')"><i class="fas fa-skull-crossbones"></i></button>' : 
              ' <button class="btn btn-warning btn-sm" onclick="mostrar(' . $reg->idservicios . ')"><i class="fa fa-pencil-alt"></i></button>'.
              ' <button class="btn btn-primary btn-sm" onclick="activar('.$reg->idservicios.')"><i class="fa fa-check"></i></button>',
              "2" => '<div class="user-block">
              <img class="profile-user-img img-responsive img-circle" src="../dist/docs/material/img_perfil/' . $imagen . '" alt="user image" onerror="'.$imagen_error.'">
              <span class="username"><p style="margin-bottom: 0px !important;">' .  $reg->tipo_servicio. '</p></span>
              </div>',
              "3" => $reg->fecha_ingreso,
              "4" => $reg->fecha_salida,
              "5" => $reg->fecha_prox_mantenimiento,
              "6" => $reg->kilometraje_entrada,
              "7" => $reg->prox_mantenimiento,
              "8" => $reg->informe_tecnico_entrada,
              "9" => $reg->ficha_tecnica,
              "10" => $reg->estado ? '<span class="text-center badge badge-success">Activado</span>' : '<span class="text-center badge badge-danger">Desactivado</span>',
            ];
          }

          $results = [
            "sEcho" => 1, //Información para el datatables
            "iTotalRecords" => count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords" => 1, //enviamos el total registros a visualizar
            "data" => $data,
          ];

          echo json_encode($results);
          
        break;
    
        case 'salir':
          //Limpiamos las variables de sesión
          session_unset();
          //Destruìmos la sesión
          session_destroy();
          //Redireccionamos al login
          header("Location: ../index.php");
    
        break;
      }
    } else {
      require 'noacceso.php';
    }  
  } 
  
  ob_end_flush();
?>
