<?php
ob_start();
if (strlen(session_id()) < 1){
	session_start();//Validamos si existe o no la sesión
}
require_once "../modelos/Marca.php";

$marca=new Marca();

$idmarca=isset($_POST["idmarca"])? limpiarCadena($_POST["idmarca"]):"";
$nombre=isset($_POST["nombre_marca"])? limpiarCadena($_POST["nombre_marca"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idmarca)){
			$rspta=$marca->insertar($nombre);
			echo $rspta ? "ok" : "marca no se pudo registrar";
		}
		else {
			$rspta=$marca->editar($idmarca,$nombre);
			echo $rspta ? "ok" : "marca no se pudo actualizar";
		}
	break;

	case 'desactivar_marca':
		$rspta=$marca->desactivar($idmarca);
 		echo $rspta ? "marca de medida Desactivada" : "marca de medida no se puede desactivar";
	break;

	case 'activar':
		$rspta=$marca->activar($idmarca);
 		echo $rspta ? "marca de medida activada" : "marca de medida no se puede activar";
	break;

	case 'eliminar_marca':
		$rspta=$marca->eliminar($idmarca);
 		echo $rspta ? "marca de medida eliminda" : "marca de medida no se puede eliminar";
	break;

	case 'mostrar_marca':
		$rspta=$marca->mostrar($idmarca);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar_marca':
		$rspta=$marca->listar();
 		//Vamos a declarar un array
 		$data= Array();
		 $cont=1;
 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>$cont++,
 				"1"=>($reg->estado)?'<button class="btn btn-warning btn-sm" onclick="mostrar_marca('.$reg->idmarca.')"><i class="fas fa-pencil-alt"></i></button>'.
					' <button class="btn btn-danger  btn-sm" onclick="eliminar_marca(' . $reg->idmarca . ')"><i class="fas fa-skull-crossbones"></i> </button>':
 					'<button class="btn btn-warning btn-sm" onclick="mostrar('.$reg->idmarca.')"><i class="fas fa-pencil-alt"></i></button>'.
 					' <button class="btn btn-primary btn-sm" onclick="activar('.$reg->idmarca.')"><i class="fa fa-check"></i></button>',
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
	case "selectmarca":
        $rspta = $marca->select();

        while ($reg = $rspta->fetch_object()) {
          echo '<option  value=' . $reg->idmarca . '>' . $reg->nombre_marca . '</option>';
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