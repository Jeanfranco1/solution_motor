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
    require_once "../modelos/Categoria.php";

    $categoria = new Categoria();

    $idcategoria = isset($_POST["idcategoria"]) ? limpiarCadena($_POST["idcategoria"]) : "";
    $nombre_categoria = isset($_POST["nombre_categoria"]) ? limpiarCadena($_POST["nombre_categoria"]) : "";

    switch ($_GET["op"]) {
      case 'guardaryeditar':
        if (empty($idcategoria)) {
          $rspta = $categoria->insertar($nombre_categoria);
          echo $rspta ? "ok" : "Categoría no se pudo registrar";
        } else {
          $rspta = $categoria->editar($idcategoria, $nombre_categoria);
          echo $rspta ? "ok" : "Categoría no se pudo actualizar";
        }
        break;

      case 'desactivar_categoria':
        $rspta = $categoria->desactivar($idcategoria);
        echo $rspta ? "Categoría Desactivada" : "Categoría no se puede desactivar";
        break;

      case 'activar':
        $rspta = $categoria->activar($idcategoria);
        echo $rspta ? "Categoría activada" : "Categoría no se puede activar";
        break;

      case 'eliminar_categoria':
          $rspta=$categoria->eliminar($idcategoria);
           echo $rspta ? "categoria Eliminada" : "categoria no se puede Eliminar";
        break;

      case 'mostrar_categoria':
        $rspta = $categoria->mostrar($idcategoria);
        //Codificar el resultado utilizando json
        echo json_encode($rspta);
        break;

      case 'listar':
        $rspta = $categoria->listar();
        //Vamos a declarar un array
        $data = [];
        $cont=1;

        while ($reg = $rspta->fetch_object()) {
          $data[] = [
            "0"=>$cont++,
            "1"=>($reg->estado)?'<button class="btn btn-warning btn-sm" onclick="mostrar_categoria('.$reg->idcategoria.')"><i class="fas fa-pencil-alt"></i></button>'.
                ' <button class="btn btn-danger  btn-sm" onclick="eliminar_categoria(' . $reg->idcategoria. ')"><i class="fas fa-skull-crossbones"></i> </button>':
                '<button class="btn btn-warning btn-sm" onclick="mostrar('.$reg->idcategoria.')"><i class="fa fa-pencil-alt"></i></button>'.
                ' <button class="btn btn-primary btn-sm" onclick="activar('.$reg->idcategoria.')"><i class="fa fa-check"></i></button>',
            "2" => $reg->nombre,
            "3" => $reg->estado ? '<span class="label bg-green">Activado</span>' : '<span class="label bg-red">Desactivado</span>',
          ];
        }
        $results = array(
          "sEcho"=>1, //Información para el datatables
          "iTotalRecords"=>count($data), //enviamos el total registros al datatable
          "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
          "aaData"=>$data);
        echo json_encode($results);

        break;
        case "selectcategoria":
          $rspta = $categoria->select();
  
          while ($reg = $rspta->fetch_object()) {
            echo '<option  value=' . $reg->idcategoria . '>' . $reg->nombre . '</option>';
          }
      break;
      case 'selectcategoria2':
        $rspta = $categoria->select();
    
            while ($reg = $rspta->fetch_object()) {
              echo '<option  value=' . $reg->nombre . '>' . $reg->nombre . '</option>';
            }
        break;	
    }
    //Fin de las validaciones de acceso
  } else {
    require 'noacceso.php';
  }
}
ob_end_flush();
?>
