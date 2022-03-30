<?php
  ob_start();
  if (strlen(session_id()) < 1) {
    session_start(); //Validamos si existe o no la sesión
  }

  if (!isset($_SESSION["nombre"])) {

    header("Location: ../vistas/login.html"); //Validamos el acceso solo a los usuarios logueados al sistema.

  } else {

    if ($_SESSION['recurso'] == 1) {
      
      require_once "../modelos/Materiales.php";

      $materiales = new Materiales();

      $idproducto = isset($_POST["idproducto"]) ? limpiarCadena($_POST["idproducto"]) : "";
      $nombre_producto = isset($_POST["nombre_producto"]) ? limpiarCadena($_POST["nombre_producto"]) : "";
      $categoria = isset($_POST["categoria"]) ? encodeCadenaHtml($_POST["categoria"] ) : "";
      $marca = isset($_POST["marca"]) ? encodeCadenaHtml($_POST["marca"] ) : "";
      $modelo = isset($_POST["modelo"]) ? encodeCadenaHtml($_POST["modelo"]) : "";
      $serie = isset($_POST["serie"]) ? encodeCadenaHtml($_POST["serie"] ) : "";
      $unid_medida = isset($_POST["unid_medida"]) ? limpiarCadena($_POST["unid_medida"]) : "";
      $color = isset($_POST["color"]) ? limpiarCadena($_POST["color"]) : "";
      $stock = isset($_POST["stock"]) ? limpiarCadena($_POST["stock"]) : "";
      $precio_compra = isset($_POST["precio_compra"]) ? limpiarCadena($_POST["precio_compra"]) : "";
      $porcentaje = isset($_POST["porcentaje"]) ? limpiarCadena($_POST["porcentaje"]) : "";
      $precio_venta = isset($_POST["precio_venta"]) ? limpiarCadena($_POST["precio_venta"]) : "";
      $descripcion = isset($_POST["descripcion_material"]) ? encodeCadenaHtml($_POST["descripcion_material"]) : "";      
      $imagen_ficha = isset($_POST["doc2"]) ? limpiarCadena($_POST["doc2"]) : ""; 

      switch ($_GET["op"]) {

        case 'guardaryeditar':
        
          // ficha técnica
          if (!file_exists($_FILES['doc2']['tmp_name']) || !is_uploaded_file($_FILES['doc2']['tmp_name'])) {

            $ficha_tecnica = $_POST["doc_old_2"];

            $flat_ficha1 = false;

          } else {

            $ext1 = explode(".", $_FILES["doc2"]["name"]);

            $flat_ficha1 = true;

            $ficha_tecnica = rand(0, 20) . round(microtime(true)) . rand(21, 41) . '.' . end($ext1);

            move_uploaded_file($_FILES["doc2"]["tmp_name"], "../dist/docs/material/ficha_tecnica/" . $ficha_tecnica);
          }

          if (empty($idproducto)) {
            
            $rspta = $materiales->insertar($nombre_producto, $categoria, $marca, $modelo, $serie, $unid_medida, $color, $stock, $precio_compra, $porcentaje, $precio_venta, $descripcion, $ficha_tecnica);
            
            echo $rspta ? "ok" : "No se pudieron registrar todos los datos del proveedor";

          } else {

            // validamos si existe LA IMG para eliminarlo
            if ($flat_img1 == true) {

              $datos_f1 = $materiales->obtenerImg($idproducto);

              $img1_ant = $datos_f1->fetch_object()->imagen;

              if ($img1_ant != "") {

                unlink("../dist/docs/material/img_perfil/" . $img1_ant);
              }
            }
             
            $rspta = $materiales->editar($idproducto, $nombre_producto, $categoria, $marca, $modelo, $serie, $unid_medida, $color, $stock, $precio_compra, $porcentaje, $precio_venta, $descripcion, $ficha_tecnica);
            
            echo $rspta ? "ok" : "Trabador no se pudo actualizar";
          }
        break;
    
        case 'desactivar':

          $rspta = $materiales->desactivar($idproducto);

          echo $rspta ? "material Desactivado" : "material no se puede desactivar";

        break;
    
        case 'activar':

          $rspta = $materiales->activar($idproducto);

          echo $rspta ? "Material activado" : "material no se puede activar";

        break;

        case 'eliminar':

          $rspta = $materiales->eliminar($idproducto);

          echo $rspta ? "ok" : "material no se puede eliminar";

        break;
    
        case 'mostrar':

          $rspta = $materiales->mostrar($idproducto);
          //Codificar el resultado utilizando json
          echo json_encode($rspta);

        break;
    
        case 'listar':
          $rspta = $materiales->listar();
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
              "1" => $reg->estado ? '<button class="btn btn-warning btn-sm" onclick="mostrar(' . $reg->idproducto . ')"><i class="fas fa-pencil-alt"></i></button>' .
              ' <button class="btn btn-danger btn-sm" onclick="eliminar(' . $reg->idproducto . ')"><i class="fas fa-skull-crossbones"></i></button>' : 
              '<button class="btn btn-warning btn-sm" onclick="mostrar(' . $reg->idproducto . ')"><i class="fa fa-pencil-alt"></i></button>',
              "2" =>
                '<div class="user-block">
                  <img class="profile-user-img img-responsive img-circle" src="../dist/docs/material/img_perfil/' . $imagen . '" alt="user image" onerror="'.$imagen_error.'">
                  <span class="username"><p style="margin-bottom: 0px !important;">' . $reg->nombre . '</p></span>
                  <span class="description">' . substr($reg->marca, 0, 30) . '...</span>
                </div>',
              "3" => $reg->marca,
              "4" => $reg->modelo.'/'.$reg->serie,
              "5" => $reg->categoria,
              "6" => $reg->stock,
              "7" =>'S/. '. number_format($reg->precio_compra, 2, '.', ','),
              "8" => $reg->porcentaje_utilidad.' %',
              "9" =>'S/. '. number_format($reg->precio_venta, 2, '.', ','),
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
