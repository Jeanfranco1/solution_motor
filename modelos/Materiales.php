<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

class Materiales
{
  //Implementamos nuestro constructor
  public function __construct()
  {
  }

  //Implementamos un método para insertar registros
  public function insertar($nombre_producto, $categoria, $marca, $idubicacion_producto, $modelo, $serie, $unid_medida, $color, $stock, $precio_compra, $porcentaje, $precio_venta, $codigo_producto, $descripcion, $ficha_tecnica)
  {
    //var_dump($idproducto,$idproveedor);die();
    $sql = "INSERT INTO producto (nombre, idcategoria, idmarca, idubicacion_producto, modelo, serie, unidad_medida, idcolor, stock, precio_compra, porcentaje_utilidad, precio_venta, codigo_producto, descripcion, imagen) 
		VALUES ('$nombre_producto', '$categoria', '$marca',  '$idubicacion_producto', '$modelo', '$serie', '$unid_medida', '$color', '$stock', '$precio_compra', '$porcentaje', '$precio_venta', '$codigo_producto','$descripcion', '$ficha_tecnica')";
    return ejecutarConsulta($sql);
  }

  //Implementamos un método para editar registros
  public function editar($idproducto, $nombre_producto, $categoria, $marca, $idubicacion_producto, $modelo, $serie, $unid_medida, $color, $stock, $precio_compra, $porcentaje, $precio_venta, $codigo_producto, $descripcion, $ficha_tecnica)
  {
  //var_dump($idproducto, $nombre_producto, $categoria, $marca, $idubicacion_producto, $modelo, $serie, $unid_medida, $color, $stock, $precio_compra, $porcentaje, $precio_venta, $codigo_producto, $descripcion, $ficha_tecnica);die();
    $sql = "UPDATE producto SET 
        nombre='$nombre_producto',
        idcategoria= '$categoria',
        idmarca= '$marca',
        idubicacion_producto='$idubicacion_producto', 
        modelo = '$modelo', 
        serie='$serie', 
        unidad_medida='$unid_medida',
        idcolor='$color',
        stock= '$stock', 
        precio_compra='$precio_compra', 
        porcentaje_utilidad='$porcentaje', 
        precio_venta='$precio_venta', 
        codigo_producto='$codigo_producto', 
        descripcion='$descripcion', 
        imagen='$ficha_tecnica'
		WHERE idproducto='$idproducto'";
    return ejecutarConsulta($sql);
  }

  //Implementamos un método para desactivar categorías
  public function desactivar($idproducto)
  {
    $sql = "UPDATE producto SET estado='0' WHERE idproducto ='$idproducto'";
    return ejecutarConsulta($sql);
  }

  //Implementamos un método para activar categorías
  public function activar($idproducto)
  {
    $sql = "UPDATE producto SET estado='1' WHERE idproducto ='$idproducto'";
    return ejecutarConsulta($sql);
  }

  //Implementamos un método para activar categorías
  public function eliminar($idproducto)
  {
    $sql = "UPDATE producto SET estado_delete='0' WHERE idproducto ='$idproducto'";
    return ejecutarConsulta($sql);
  }

  //Implementar un método para mostrar los datos de un registro a modificar
  public function mostrar($idproducto)
  {
    $data = Array();

    $sql = "SELECT 
    p.idproducto as idproducto , 
    p.idmarca as idmarca, 
    p.idcategoria as idcategoria, 
    p.idcolor as idcolor,
		p.nombre as nombre,
    p.modelo as modelo,
    p.serie as serie,
    p.unidad_medida as unidad_medida, 
    p.precio_compra as precio_compra, 
    p.porcentaje_utilidad as porcentaje_utilidad, 
    p.precio_venta as precio_venta, 
    p.stock as stock, 
    p.codigo_producto as codigo_producto, 
    p.idubicacion_producto as idubicacion_producto, 
    p.descripcion as descripcion,
    p.imagen as imagen
    FROM producto as p, marca as m, categoria as c, ubicacion_producto as up 
    WHERE p.idproducto ='$idproducto' AND m.idmarca = p.idmarca AND c.idcategoria = p.idcategoria 
    AND up.idubicacion_producto = p.idubicacion_producto";
    
    $producto = ejecutarConsultaSimpleFila($sql);
    
    $data = array(
      'idproducto'  => ($retVal_1 = empty($producto['idproducto']) ? '' : $producto['idproducto']),
      'idmarca'     => ($retVal_2 = empty($producto['idmarca']) ? '' : decodeCadenaHtml($producto['idmarca'])),
      'idcategoria' => ($retVal_3 = empty($producto['idcategoria']) ? '' : decodeCadenaHtml($producto['idcategoria'])),
      'idcolor'     => ($retVal_4 = empty($producto['idcolor']) ? '' : $producto['idcolor']),
      'nombre'      => ($retVal_5 = empty($producto['nombre']) ? '' :decodeCadenaHtml($producto['nombre'])),
      'modelo'      => ($retVal_6 = empty($producto['modelo']) ? '' :decodeCadenaHtml($producto['modelo'])),
      'serie'       => ($retVal_7 = empty($producto['serie']) ? '' :decodeCadenaHtml($producto['serie'])),
      'unidad_medida' => ($retVal_8 = empty($producto['unidad_medida']) ? '' : $producto['unidad_medida']),
      'precio_compra' => ($retVal_9 = empty($producto['precio_compra']) ? '' : $producto['precio_compra']),
      'porcentaje_utilidad' => ($retVal_10 = empty($producto['porcentaje_utilidad']) ? '' : $producto['porcentaje_utilidad']),
      'precio_venta'  => ($retVal_11 = empty($producto['precio_venta']) ? '' : $producto['precio_venta']),
      'stock'  => ($retVal_12 = empty($producto['stock']) ? '' : $producto['stock']),
      'codigo_producto'=> ($retVal_13 = empty($producto['codigo_producto']) ? '' : $producto['codigo_producto']),
      'idubicacion_producto'      => ($retVal_14 = empty($producto['idubicacion_producto']) ? '' : $producto['idubicacion_producto']),
      'descripcion' => ($retVal_14 = empty($producto['descripcion']) ? '' : $producto['descripcion']),
      'ficha_tecnica'=> ($retVal_15 = empty($producto['imagen']) ? '' : $producto['imagen']),
    );
    return $data;
  }

  //Implementar un método para listar los registros
  public function listar() {
    $sql = "SELECT p.idproducto, 
    p.idmarca, 
    p.idcategoria, 
    p.idcolor, 
    p.nombre, 
    p.modelo, 
    p.serie, 
    p.unidad_medida, 
    p.precio_compra,
    p.porcentaje_utilidad,
    p.precio_venta, 
    p.stock, p.codigo_producto, p.descripcion,
    up.nombre as ubicacion, 
    p.imagen, p.estado, m.nombre as marca, 
    c.nombre as categoria 
    FROM producto as p,marca as m, 
    categoria as c, ubicacion_producto 
    as up WHERE p.idmarca=m.idmarca 
    AND p.idcategoria=c.idcategoria 
    AND p.idubicacion_producto=up.idubicacion_producto 
    AND p.estado=1 AND p.estado_delete=1 ORDER BY p.nombre ASC;";
    return ejecutarConsulta($sql);
  }
  
  //Seleccionar Trabajador Select2
  public function obtenerImg($idproducto)
  {
    $sql = "SELECT imagen FROM producto WHERE idproducto='$idproducto'";
    return ejecutarConsulta($sql);
  }


}

?>