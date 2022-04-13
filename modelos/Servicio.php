<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

class Servicio
{
  //Implementamos nuestro constructor
  public function __construct()
  {
  }

  //Implementamos un método para insertar registros
  public function insertar($tipo_servicio, $fecha_ingreso, $fecha_salida, $fec_prox_mant, $Km_ingreso, $prox_mantenimiento, $informe_ingreso,$imagen_informe, $ficha_tecnica)
  {
    //var_dump();die();
    $sql = "INSERT INTO servicios (idtipo_servicio, fecha_ingreso, fecha_salida,fecha_prox_mantenimiento, kilometraje_entrada, prox_mantenimiento,informe_tecnico_entrada, imagen_informe, ficha_tecnica) 
		VALUES ('$tipo_servicio', '$fecha_ingreso', '$fecha_salida',  '$fec_prox_mant', '$Km_ingreso', '$prox_mantenimiento', '$informe_ingreso', '$imagen_informe','$ficha_tecnica')";
    return ejecutarConsulta($sql);
  }

  //Implementamos un método para editar registros
  public function editar($idservicios,$tipo_servicio, $fecha_ingreso, $fecha_salida, $fec_prox_mant, $Km_ingreso, $prox_mantenimiento, $informe_ingreso,$imagen_informe, $ficha_tecnica)
  {
  //var_dump($idservicios, $nombre_producto, $fecha_ingreso, $fecha_salida, $	fecha_prox_mantenimiento, $kilometraje_entrada, $prox_mantenimiento, $informe_tecnico_entrada, $imagen_informe, $stock, $ficha_tecnica, $porcentaje, $precio_venta, $codigo_producto, $descripcion, $ficha_tecnica);die();
    $sql = "UPDATE servicios SET 
        idtipo_servicio='$tipo_servicio',
        fecha_ingreso= '$fecha_ingreso',
        fecha_salida= '$fecha_salida',
        fecha_prox_mantenimiento='$fec_prox_mant', 
        kilometraje_entrada = '$Km_ingreso', 
        prox_mantenimiento='$prox_mantenimiento', 
        informe_tecnico_entrada='$informe_ingreso',
        imagen_informe='$imagen_informe',
        ficha_tecnica='$ficha_tecnica'
		WHERE idservicios='$idservicios'";
    return ejecutarConsulta($sql);
  }

  //Implementamos un método para desactivar categorías
  public function desactivar($idservicios)  
  {
    $sql = "UPDATE servicios SET estado='0' WHERE idservicios ='$idservicios'";
    return ejecutarConsulta($sql);
  }

  //Implementamos un método para activar categorías
  public function activar($idservicios)
  {
    $sql = "UPDATE servicios SET estado='1' WHERE idservicios ='$idservicios'";
    return ejecutarConsulta($sql);
  }

  //Implementamos un método para activar categorías
  public function eliminar($idservicios)
  {
    $sql = "UPDATE servicios SET estado_delete='0' WHERE idservicios ='$idservicios'";
    return ejecutarConsulta($sql);
  }

  //Implementar un método para mostrar los datos de un registro a modificar
  public function mostrar($idservicios)
  {
    $data = Array();

    $sql = "SELECT 
    s.idservicios as idservicios, 
	  s.idtipo_servicio as idtipo_servicio,
    s.fecha_ingreso as fecha_ingreso, 
    s.fecha_salida as fecha_salida,
    s.fecha_prox_mantenimiento as fec_prox_mant,  
    s.kilometraje_entrada as Km_ingreso,
    s.prox_mantenimiento as prox_mantenimiento,
    s.informe_tecnico_entrada as informe_ingreso, 
    s.imagen_informe as imagen_informe,
    s.ficha_tecnica as  ficha_tecnica
    
    FROM servicios as s, tipo_servicio as ts

    WHERE s.idservicios ='$idservicios' AND ts.idtipo_servicio = s.idtipo_servicio";
    
    $servicios = ejecutarConsultaSimpleFila($sql);
    
    $data = array(
      'idservicios'  => ($retVal_1 = empty($servicios['idservicios']) ? '' : $servicios['idservicios']),
      'idtipo_servicio'     => ($retVal_2 = empty($servicios['idtipo_servicio']) ? '' : decodeCadenaHtml($servicios['idtipo_servicio'])),
      'fecha_ingreso' => ($retVal_3 = empty($servicios['fecha_ingreso']) ? '' : decodeCadenaHtml($servicios['fecha_ingreso'])),
      'fecha_salida'     => ($retVal_4 = empty($servicios['fecha_salida']) ? '' : $servicios['fecha_salida']),
      'fec_prox_mant'      => ($retVal_5 = empty($servicios['fec_prox_mant']) ? '' :decodeCadenaHtml($servicios['fec_prox_mant'])),
      'Km_ingreso'      => ($retVal_6 = empty($servicios['Km_ingreso']) ? '' :decodeCadenaHtml($servicios['Km_ingreso'])),
      'prox_mantenimiento'       => ($retVal_7 = empty($servicios['prox_mantenimiento']) ? '' :decodeCadenaHtml($servicios['prox_mantenimiento'])),
      'informe_ingreso' => ($retVal_8 = empty($servicios['informe_ingreso']) ? '' : $servicios['informe_ingreso']),
      'imagen_informe'=> ($retVal_9 = empty($servicios['imagen_informe']) ? '' : $servicios['imagen_informe']),
      'ficha_tecnica'=> ($retVal_10 = empty($servicios['ficha_tecnica']) ? '' : $servicios['ficha_tecnica']),
    );
    return $data;
  }

  //Implementar un método para listar los registros
  public function listar() {
    $sql = "SELECT 
     s.idservicios,
     s.idtipo_servicio,
     s.fecha_ingreso, 
     s.fecha_salida, 
     s.fecha_prox_mantenimiento,
     s.kilometraje_entrada, 
     s.prox_mantenimiento, 
     s.informe_tecnico_entrada,
     s.imagen_informe,
     s.ficha_tecnica, 
     s.estado,
     ts.nombre as tipo_servicio
    FROM servicios as s, tipo_servicio as ts
    WHERE s.idtipo_servicio=ts.idtipo_servicio
    AND s.estado=1 
    AND s.estado_delete=1 ORDER BY s.idtipo_servicio ASC;";
    return ejecutarConsulta($sql);
  }
  
  //Seleccionar Trabajador Select2
  public function obtenerImg($idservicios)
  {
    $sql = "SELECT imagen_informe FROM servicios WHERE idservicios='$idservicios'";
    return ejecutarConsulta($sql);
  }


}

?>
