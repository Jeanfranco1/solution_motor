<?php
  ob_start();
  if (strlen(session_id()) < 1) {
    session_start(); //Validamos si existe o no la sesión
  }

  if (!isset($_SESSION["nombre"])) {

    header("Location: ../vistas/login.html"); //Validamos el acceso solo a los usuarios logueados al sistema.

  } else {

    if ($_SESSION['recurso'] == 1) {
      
      require_once "../modelos/Imagen_servicio.php";

      $img_servicio = new Imagen_servicio();

      $idimagen_servicio = isset($_POST["idimagen_servicio"]) ? limpiarCadena($_POST["idimagen_servicio"]) : "";
      $idservicio_img = isset($_POST["idservicio_img"]) ? limpiarCadena($_POST["idservicio_img"]) : "";
      $tipo_imagen = isset($_POST["tipo_imagen"]) ? limpiarCadena($_POST["tipo_imagen"]) : "";
      $imagen = isset($_POST["doc2"]) ? encodeCadenaHtml($_POST["doc2"] ) : "";
      switch ($_GET["op"]) {

        case 'guardaryeditar_imagen':
        
          // ficha técnica
          if (!file_exists($_FILES['doc2']['tmp_name']) || !is_uploaded_file($_FILES['doc2']['tmp_name'])) {

            $imagen = $_POST["doc_old_2"];

            $flat_img1 = false;

          } else {

            $ext1 = explode(".", $_FILES["doc2"]["name"]);

            $flat_img1 = true;

            $imagen = rand(0, 20) . round(microtime(true)) . rand(21, 41) . '.' . end($ext1);

            move_uploaded_file($_FILES["doc2"]["tmp_name"], "../dist/docs/material/img_perfil/" . $imagen);
          }

          if (empty($idservicios)) {
            
            $rspta = $img_servicio->insertar_imagen($idservicio_img, $tipo_imagen, $imagen);
            
            echo $rspta ? "ok" : "No se pudieron registrar todos los datos del proveedor";

          } else {

            // validamos si existe LA IMG para eliminarlo
            if ($flat_img1 == true) {

              $datos_f1 = $img_servicio->obtenerImg($idservicios);

              $img1_ant = $datos_f1->fetch_object()->imagen;

              if ($img1_ant != "") {

                unlink("../dist/docs/material/img_perfil/" . $img1_ant);
              }
            }
             
            $rspta = $img_servicio->editar_imagen($idimagen_servicio, $idservicio_img, $tipo_imagen, $imagen);
            
            echo $rspta ? "ok" : "Trabador no se pudo actualizar";
          }
        break;
    
        case 'desactivar_imagen':

          $rspta = $img_servicio->desactivar_imagen($idservicios);

          echo $rspta ? "material Desactivado" : "material no se puede desactivar";

        break;
    
        case 'activar_imagen':

          $rspta = $img_servicio->activar_imagen($idservicios);

          echo $rspta ? "Material activado" : "material no se puede activar";

        break;

        case 'eliminar_imagen':

          $rspta = $img_servicio->eliminar_imagen($idservicios);

          echo $rspta ? "ok" : "material no se puede eliminar";

        break;
    
        case 'mostrar_imagen':

          $rspta = $img_servicio->mostrar_imagen($idservicios);
          //Codificar el resultado utilizando json
          echo json_encode($rspta);

        break;
    
        case 'listar_imagen':
          $rspta = $img_servicio->listar_imagen();
          //Vamos a declarar un array
          $data = [];
          $imagen = '';
          $ficha_tecnica = '';
          $monto_igv = '';
          $imagen_error = "this.src='../dist/svg/default_producto.svg'";
          $cont=1;

          while ($reg = $rspta->fetch_object()) {

            if (empty($reg->imagen)) { $imagen = 'img_material_defect.jpg';  } else { $imagen = $reg->imagen;   }
           
            $data[] = [
              "0"=>$cont++,
              "1" =>'<button class="btn btn-warning btn-sm" onclick="mostrar_imagen(' . $reg->idimagen_servicio . ')"><i class="fas fa-pencil-alt"></i></button>' .
              ' <button class="btn btn-danger btn-sm" onclick="eliminar_imagen(' . $reg->idimagen_servicio . ')"><i class="fas fa-skull-crossbones"></i></button>',
              "2" =>$reg->tipo_imagen,
              "3" => '<div class="user-block">
              <a onclick="ver_img_perfil(\'' .$imagen. '\',\'' . $reg->tipo_imagen . '\')">
              <img class="profile-user-img img-responsive img-circle" src="../dist/docs/material/img_perfil/' . $imagen . '" alt="user image" onerror="'.$imagen_error.'">
              </a>
              </div>',

              "4" => $reg->estado ? '<span class="text-center badge badge-success">Activado</span>' : '<span class="text-center badge badge-danger">Desactivado</span>',
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
