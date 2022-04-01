<?php
ob_start();
if (strlen(session_id()) < 1){
	session_start();//Validamos si existe o no la sesión
}
require_once "../modelos/Ubicacion.php";

$ubicacion=new Ubicacion();

$idubicacion_producto=isset($_POST["idubicacion_producto"])? limpiarCadena($_POST["idubicacion_producto"]):"";
$nombre_ubicacion=isset($_POST["nombre_ubicacion"])? limpiarCadena($_POST["nombre_ubicacion"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idubicacion_producto)){
			$rspta=$ubicacion->insertar($nombre_ubicacion);
			echo $rspta ? "ok" : "ubicacion no se pudo registrar";
		}
		else {
			$rspta=$ubicacion->editar($idubicacion_producto,$nombre_ubicacion);
			echo $rspta ? "ok" : "ubicacion no se pudo actualizar";
		}
	break;

	case 'desactivar_ubicacion':
		$rspta=$ubicacion->desactivar($idubicacion_producto);
 		echo $rspta ? "ubicacion Desactivada" : "ubicacion no se puede desactivar";
	break;

	case 'activar':
		$rspta=$ubicacion->activar($idubicacion_producto);
 		echo $rspta ? "ubicacion activada" : "ubicacion no se puede activar";
	break;

	case 'eliminar_ubicacion':
		$rspta=$ubicacion->eliminar($idubicacion_producto);
 		echo $rspta ? "ubicacion Eliminada" : "ubicacion no se puede Eliminar";
	break;

	case 'mostrar_ubicacion':
		$rspta=$ubicacion->mostrar($idubicacion_producto);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$ubicacion->listar();
 		//Vamos a declarar un array
 		$data= Array();
		$cont=1;
 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>$cont++,
 				"1"=>($reg->estado)?'<button class="btn btn-warning btn-sm" onclick="mostrar_ubicacion('.$reg->idubicacion_producto.')"><i class="fas fa-pencil-alt"></i></button>'.
					 ' <button class="btn btn-danger  btn-sm" onclick="eliminar_ubicacion(' . $reg->idubicacion_producto . ')"><i class="fas fa-skull-crossbones"></i> </button>':
 					 '<button class="btn btn-warning btn-sm" onclick="mostrar('.$reg->idubicacion_producto.')"><i class="fa fa-pencil-alt"></i></button>'.
 					 ' <button class="btn btn-primary btn-sm" onclick="activar('.$reg->idubicacion_producto.')"><i class="fa fa-check"></i></button>',
 				"2"=>$reg->nombre,
 				"3"=>($reg->estado)?'<span class="text-center badge badge-success">Activado</span>':
 				'<span class="text-center badge badge-danger">Desactivado</span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
	case "selectubicacion":
        $rspta = $ubicacion->select();

        while ($reg = $rspta->fetch_object()) {
          echo '<option  value=' . $reg->idubicacion_producto . '>' . $reg->nombre . '</option>';
        }
    break;
	case "selectubicacion_2":
        $rspta = $ubicacion->select();

        while ($reg = $rspta->fetch_object()) {
          echo '<option  value=' . $reg->nombre . '>' . $reg->nombre . '</option>';
        }
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
ob_end_flush();
?>