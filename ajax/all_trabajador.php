<?php

  ob_start();

  if (strlen(session_id()) < 1) {

    session_start(); //Validamos si existe o no la sesión
  }

  if (!isset($_SESSION["nombre"])) {

    header("Location: ../vistas/login.html"); //Validamos el acceso solo a los usuarios logueados al sistema.

  } else {

    //Validamos el acceso solo al usuario logueado y autorizado.
    if ($_SESSION['recurso'] == 1) {

      require_once "../modelos/AllTrabajador.php";

      $trabajador = new AllTrabajador();

      //$idtrabajador,$nombre,$tipo_documento,$num_documento,$direccion,$telefono,$nacimiento,$tipo_trabajador,$desempenio,$c_bancaria,$email,$cargo,$banco,$tutular_cuenta,$sueldo_diario,$sueldo_mensual,$sueldo_hora,$imagen	
      $idtrabajador	  	= isset($_POST["idtrabajador"])? limpiarCadena($_POST["idtrabajador"]):"";
      $nombre 		      = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
      $tipo_documento 	= isset($_POST["tipo_documento"])? limpiarCadena($_POST["tipo_documento"]):"";
      $num_documento  	= isset($_POST["num_documento"])? limpiarCadena($_POST["num_documento"]):"";
      $direccion		    = isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
      $telefono		      = isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
      $nacimiento		    = isset($_POST["nacimiento"])? limpiarCadena($_POST["nacimiento"]):"";
      $edad		          = isset($_POST["edad"])? limpiarCadena($_POST["edad"]):"";
     
      $email			      = isset($_POST["email"])? limpiarCadena($_POST["email"]):"";

 
     
      $imagen1			    = isset($_POST["foto1"])? limpiarCadena($_POST["foto1"]):"";
      
  
      switch ($_GET["op"]) {

        case 'guardaryeditar':

          // imgen de perfil
          if (!file_exists($_FILES['foto1']['tmp_name']) || !is_uploaded_file($_FILES['foto1']['tmp_name'])) {

						$imagen1=$_POST["foto1_actual"]; $flat_img1 = false;

					} else {

						$ext1 = explode(".", $_FILES["foto1"]["name"]); $flat_img1 = true;						

            $imagen1 = rand(0, 20) . round(microtime(true)) . rand(21, 41) . '.' . end($ext1);

            move_uploaded_file($_FILES["foto1"]["tmp_name"], "../dist/docs/all_trabajador/perfil/" . $imagen1);
						
					}
          if (empty($idtrabajador)){

            $rspta=$trabajador->insertar($nombre, $tipo_documento, $num_documento, $direccion, $telefono, $nacimiento, $edad, $email, $imagen1);
            
            echo $rspta ? "ok" : "No se pudieron registrar todos los datos del Trabajador";
  
          }else {

            // validamos si existe LA IMG para eliminarlo
            if ($flat_img1 == true) {

              $datos_f1 = $trabajador->obtenerImg($idtrabajador);

              $img1_ant = $datos_f1->fetch_object()->imagen_perfil;

              if ($img1_ant != "") {

                unlink("../dist/docs/all_trabajador/perfil/" . $img1_ant);
              }
            }

            // editamos un trabajador existente
            $rspta=$trabajador->editar($idtrabajador, $nombre, $tipo_documento, $num_documento, $direccion, $telefono, $nacimiento, $edad, $email, $imagen1);
            
            echo $rspta ? "ok" : "Trabajador no se pudo actualizar";
          }            

        break;

        case 'desactivar':

          $ok = ['ok'=> true, 'redirected'=> true, 'status'=> 200];

          $error = ['ok'=> false, 'redirected'=> true, 'status'=> 404];

          $idtrabajador = $_GET["idtrabajador"];  $descripcion = $_GET["descripcion"];

          $rspta=$trabajador->desactivar($idtrabajador, $descripcion);

 				  echo $rspta ? json_encode($ok) : json_encode($error);

        break;

        case 'activar':

          $rspta=$trabajador->activar($idtrabajador);

 				  echo $rspta ? "Trabajador activado" : "Trabajador no se puede activar";

        break;
        
        case 'desactivar_1':

          $rspta=$trabajador->desactivar_1($idtrabajador);

 				  echo $rspta ? "Trabajador Descativado" : "Trabajador no se puede Descativar";

        break;

        case 'eliminar':

          $rspta=$trabajador->eliminar($idtrabajador);

 				  echo $rspta ? "ok" : "Trabajador no se puede eliminado";

        break;

        case 'mostrar':

          $rspta=$trabajador->mostrar($idtrabajador);
          //Codificar el resultado utilizando json
          echo json_encode($rspta);

        break;

        case 'listar':          

          $rspta=$trabajador->listar();
          //Vamos a declarar un array
          $data= Array();
          $cont=1;

          $imagen_error = "this.src='../dist/svg/user_default.svg'";
          
          while ($reg=$rspta->fetch_object()){
            $data[]=array(
              "0"=>$cont++,
              "1"=>($reg->estado)?'<button class="btn btn-warning btn-sm" onclick="mostrar('.$reg->idtrabajador.')"><i class="fas fa-pencil-alt"></i></button>'.
                ' <button class="btn btn-danger btn-sm" onclick="eliminar('.$reg->idtrabajador.')"><i class="fas fa-skull-crossbones"></i></button>'.
                ' <button class="btn btn-info btn-sm" onclick="verdatos('.$reg->idtrabajador.')"><i class="far fa-eye"></i></button>':
                ' <button class="btn btn-info btn-sm" onclick="verdatos('.$reg->idtrabajador.')"><i class="far fa-eye"></i></button>',
              "2"=>'<div class="user-block">
                <img class="img-circle" src="../dist/docs/all_trabajador/perfil/'. $reg->imagen_perfil .'" alt="User Image" onerror="'.$imagen_error.'">
                <span class="username"><p class="text-primary"style="margin-bottom: 0.2rem !important"; >'. $reg->nombres .'</p></span>
                <span class="description">'. $reg->tipo_documento .': '. $reg->numero_documento .' </span>
                </div>',
              "3"=>'<a href="tel:+51'.quitar_guion($reg->telefono).'" data-toggle="tooltip" data-original-title="Llamar al trabajador.">'. $reg->telefono . '</a>',
              "4"=>format_d_m_a($reg->fecha_nacimiento).'<b>: </b>'.$reg->edad,
              "5"=>($reg->estado)?'<span class="text-center badge badge-success">Activado</span>':
              '<span class="text-center badge badge-danger">Desactivado</span>'
              );
          }
          $results = array(
            "sEcho"=>1, //Información para el datatables
            "iTotalRecords"=>count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords"=>1, //enviamos el total registros a visualizar
            "data"=>$data);
          echo json_encode($results);

        break;  
        case 'verdatos':
          $rspta=$trabajador->verdatos($idtrabajador);
          //Codificar el resultado utilizando json
          echo json_encode($rspta);
        break;
      }

      //Fin de las validaciones de acceso
    } else {

      require 'noacceso.php';
    }
  }

  function quitar_guion($numero){ return str_replace("-", "", $numero); } 

   // convierte de una fecha(dd-mm-aa): 23-12-2021 a una fecha(aa-mm-dd): 2021-12-23
   function format_a_m_d( $fecha ) {

    if (!empty($fecha)) {

      $fecha_expl = explode("-", $fecha);

      $fecha_convert =  $fecha_expl[0]."-".$fecha_expl[1]."-".$fecha_expl[2];

    }else{

      $fecha_convert = "";
    }   

    return $fecha_convert;
  }

  // convierte de una fecha(aa-mm-dd): 2021-12-23 a una fecha(dd-mm-aa): 23-12-2021
  function format_d_m_a( $fecha ) {

    if (!empty($fecha)) {

      $fecha_expl = explode("-", $fecha);

      $fecha_convert =  $fecha_expl[2]."-".$fecha_expl[1]."-".$fecha_expl[0];

    }else{

      $fecha_convert = "";
    }   

    return $fecha_convert;
  }

  ob_end_flush();

?>
