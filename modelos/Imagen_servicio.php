<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

class Imagen_servicio
{
  //Implementamos nuestro constructor
  public function __construct()
  {
  }

  //Implementamos un método para insertar registros
  public function insertar_imagen($idservicio_img, $tipo_imagen, $imagen)
  {
    //var_dump();die();
    $sql = "INSERT INTO imagen_servicio (idservicios,tipo_imagen,imagen) 
		VALUES ('$idservicio_img','$tipo_imagen','$imagen')";
    return ejecutarConsulta($sql);
  }

  //Implementamos un método para editar registros
  public function editar_imagen($idimagen_servicio,$idservicio_img,$tipo_imagen, $imagen)
  {
  //var_dump($idimagen_servicio, $nombre_producto, $fecha_ingreso, $fecha_salida, $	fecha_prox_mantenimiento, $kilometraje_entrada, $prox_mantenimiento, $informe_tecnico_entrada, $imagen_informe, $stock, $ficha_tecnica, $porcentaje, $precio_venta, $codigo_producto, $descripcion, $ficha_tecnica);die();
    $sql = "UPDATE imagen_servicio SET 
        idservicios='$idservicio_img',
        tipo_imagen= '$tipo_imagen',
        imagen= '$imagen'
		WHERE idimagen_servicio='$idimagen_servicio'";
    return ejecutarConsulta($sql);
  }

  //Implementamos un método para desactivar categorías
  public function desactivar_imagen($idimagen_servicio)  
  {
    $sql = "UPDATE imagen_servicio SET estado='0' WHERE idimagen_servicio ='$idimagen_servicio'";
    return ejecutarConsulta($sql);
  }

  //Implementamos un método para activar categorías
  public function activar_imagen($idimagen_servicio)
  {
    $sql = "UPDATE imagen_servicio SET estado='1' WHERE idimagen_servicio ='$idimagen_servicio'";
    return ejecutarConsulta($sql);
  }

  //Implementamos un método para activar categorías
  public function eliminar_imagen($idimagen_servicio)
  {
    $sql = "UPDATE imagen_servicio SET estado_delete='0' WHERE idimagen_servicio ='$idimagen_servicio'";
    return ejecutarConsulta($sql);
  }

  //Implementar un método para mostrar los datos de un registro a modificar
  public function mostrar_imagen($idimagen_servicio)
  {
    $data = Array();

    $sql = "SELECT 
    i.idimagen_servicio as idimagen_servicio,
    s.idservicios as idservicios,
    i.tipo_imagen as tipo_imagen,
    i.imagen as imagen
  
    FROM imagen_servicio as i, servicios as s

    WHERE i.idimagen_servicio ='$idimagen_servicio'";
    
    $imagen_servicio = ejecutarConsultaSimpleFila($sql);
    
    $data = array(
      'idimagen_servicio'  => ($retVal_1 = empty($imagen_servicio['idimagen_servicio']) ? '' : $imagen_servicio['idimagen_servicio']),
      'idservicios'     => ($retVal_2 = empty($imagen_servicio['idservicios']) ? '' : decodeCadenaHtml($imagen_servicio['idservicios'])),
      'tipo_imagen' => ($retVal_3 = empty($imagen_servicio['tipo_imagen']) ? '' : decodeCadenaHtml($imagen_servicio['tipo_imagen'])),
      'imagen'     => ($retVal_4 = empty($imagen_servicio['imagen']) ? '' : $imagen_servicio['imagen']),
    );
    return $data;
  }

  //Implementar un método para listar los registros
  public function listar_imagen($idservicios) {
    $sql = "SELECT i.idimagen_servicio, i.tipo_imagen, i.imagen, i.estado 
    FROM imagen_servicio as i WHERE i.idservicios='$idservicios' AND i.estado=1 AND i.estado_delete=1;";
    return ejecutarConsulta($sql);
  }
  
  //Seleccionar Trabajador Select2
  public function obtenerImg($idimagen_servicio)
  {
    $sql = "SELECT imagen FROM imagen_servicio WHERE idimagen_servicio='$idimagen_servicio'";
    return ejecutarConsulta($sql);
  }


}

?>
