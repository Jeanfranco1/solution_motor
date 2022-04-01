<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";
Class Ubicacion
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre)
	{
		$sql="INSERT INTO ubicacion_producto(nombre)VALUES ('$nombre')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idubicacion_producto,$nombre)
	{
		$sql="UPDATE ubicacion_producto SET nombre='$nombre' WHERE idubicacion_producto='$idubicacion_producto'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar ubicacion_producto
	public function desactivar($idubicacion_producto)
	{
		$sql="UPDATE ubicacion_producto SET estado='0' WHERE idubicacion_producto='$idubicacion_producto'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar ubicacion_producto
	public function activar($idubicacion_producto)
	{
		$sql="UPDATE ubicacion_producto SET estado='1' WHERE idubicacion_producto='$idubicacion_producto'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar ubicacion_producto
	public function eliminar($idubicacion_producto)
	{
		$sql="UPDATE ubicacion_producto SET estado_delete='0' WHERE idubicacion_producto='$idubicacion_producto'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idubicacion_producto)
	{
		$sql="SELECT * FROM ubicacion_producto WHERE idubicacion_producto='$idubicacion_producto'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM ubicacion_producto 	WHERE estado=1  AND estado_delete=1  ORDER BY nombre ASC";
		return ejecutarConsulta($sql);		
	}
	//Implementar un método para listar los registros y mostrar en el select
	public function select()
	{
		$sql="SELECT * FROM ubicacion_producto where estado=1";
		return ejecutarConsulta($sql);		
	}
}
?>