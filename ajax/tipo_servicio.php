<?php
ob_start();
if (strlen(session_id()) < 1){
	session_start();//Validamos si existe o no la sesión
}
require_once "../modelos/Tipo_servicio.php";

$tipo_servicio=new Tipo_Servicio();

$idtipo_servicio=isset($_POST["idtipo_servicio"])? limpiarCadena($_POST["idtipo_servicio"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idtipo_servicio)){
			$rspta=$tipo_servicio->insertar($nombre);
			echo $rspta ? "ok" : "tipo_servicio no se pudo registrar";
		}
		else {
			$rspta=$tipo_servicio->editar($idtipo_servicio,$nombre);
			echo $rspta ? "ok" : "tipo_servicio no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$tipo_servicio->desactivar($idtipo_servicio);
 		echo $rspta ? "tipo_servicio Desactivada" : "tipo_servicio no se puede desactivar";
	break;

	case 'activar':
		$rspta=$tipo_servicio->activar($idtipo_servicio);
 		echo $rspta ? "tipo_servicio activada" : "tipo_servicio no se puede activar";
	break;

	case 'eliminar':
		$rspta=$tipo_servicio->eliminar($idtipo_servicio);
 		echo $rspta ? "tipo_servicio Eliminada" : "tipo_servicio no se puede Eliminar";
	break;

	case 'mostrar':
		$rspta=$tipo_servicio->mostrar($idtipo_servicio);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$tipo_servicio->listar();
 		//Vamos a declarar un array
 		$data= Array();
		$cont=1;
 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>$cont++,
 				"1"=>($reg->estado)?'<button class="btn btn-warning btn-sm" onclick="mostrar('.$reg->idtipo_servicio.')"><i class="fas fa-pencil-alt"></i></button>'.
					 ' <button class="btn btn-danger  btn-sm" onclick="eliminar(' . $reg->idtipo_servicio . ')"><i class="fas fa-skull-crossbones"></i> </button>':
 					'<button class="btn btn-warning btn-sm" onclick="mostrar('.$reg->idtipo_servicio.')"><i class="fa fa-pencil-alt"></i></button>'.
 					' <button class="btn btn-primary btn-sm" onclick="activar('.$reg->idtipo_servicio.')"><i class="fa fa-check"></i></button>',
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
	case "selecttipo_servicio":
        $rspta = $tipo_servicio->select();

        while ($reg = $rspta->fetch_object()) {
          echo '<option  value=' . $reg->idtipo_servicio . '>' . $reg->nombre . '</option>';
        }
    break;
	case "selecttipo_servicio_2":
        $rspta = $tipo_servicio->select();

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