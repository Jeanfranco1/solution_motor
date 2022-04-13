<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";
Class Tipo_Servicio
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre)
	{
		//var_dump($nombre);die();
		$sql="INSERT INTO tipo_servicio(nombre)VALUES('$nombre')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idtipo_servicio, $nombre)
	{
		$sql="UPDATE tipo_servicio SET nombre='$nombre' WHERE idtipo_servicio='$idtipo_servicio'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar tipo_servicio
	public function desactivar($idtipo_servicio)
	{
		$sql="UPDATE tipo_servicio SET estado='0' WHERE idtipo_servicio='$idtipo_servicio'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar tipo_servicio
	public function activar($idtipo_servicio)
	{
		$sql="UPDATE tipo_servicio SET estado='1' WHERE idtipo_servicio='$idtipo_servicio'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para eliminar tipo_servicio
	public function eliminar($idtipo_servicio)
	{
		$sql="UPDATE tipo_servicio SET estado_delete='0' WHERE idtipo_servicio='$idtipo_servicio'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idtipo_servicio)
	{
		$sql="SELECT * FROM tipo_servicio WHERE idtipo_servicio='$idtipo_servicio'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM tipo_servicio WHERE idtipo_servicio>'1'  AND estado_delete=1 ORDER BY nombre ASC";
		return ejecutarConsulta($sql);		
	}
	//Implementar un método para listar los registros y mostrar en el select
	public function select()
	{
		$sql="SELECT * FROM tipo_servicio where estado=1";
		return ejecutarConsulta($sql);		
	}
}
?>