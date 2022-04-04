<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Proveedor
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre, $tipo_documento, $num_documento, $direccion, $telefono, )
	{
		$sql="INSERT INTO proveedor ( nombre, tipo_documento,numero_documento, direccion, telefono)
		VALUES ('$nombre', '$tipo_documento', '$num_documento', '$direccion', '$telefono')";
		
		return ejecutarConsulta($sql);
			
	}

	//Implementamos un método para editar registros
	public function editar($idproveedor, $nombre, $tipo_documento, $num_documento, $direccion, $telefono, )
	{
		//var_dump($idproveedor,$nombre,$tipo_documento,$num_documento,$direccion,$telefono,$c_bancaria,$c_detracciones,$banco,$titular_cuenta);die;
		
		$sql="UPDATE proveedor SET 
		nombre='$nombre',
		tipo_documento='$tipo_documento', 
        numero_documento ='$num_documento',
		direccion='$direccion',
		telefono='$telefono'
		WHERE idproveedor='$idproveedor'";	
		return ejecutarConsulta($sql);
		
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($idproveedor)
	{
		$sql="UPDATE proveedor SET estado='0' WHERE idproveedor='$idproveedor'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($idproveedor)
	{
		$sql="UPDATE proveedor SET estado='1' WHERE idproveedor='$idproveedor'";
		return ejecutarConsulta($sql);
	}
	//Implementamos un método para eliminar
	public function eliminar($idproveedor)
	{
		$sql="UPDATE proveedor SET estado_delete='0' WHERE idproveedor='$idproveedor'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idproveedor)
	{
		$sql="SELECT * FROM proveedor WHERE idproveedor='$idproveedor'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT p.idproveedor,  p.nombre, p.tipo_documento, p.numero_documento,p.direccion, p.telefono,p.estado
		FROM proveedor as p
		WHERE  p.estado = 1 AND p.estado_delete = 1 ORDER BY  p.nombre ASC;";
  
		return ejecutarConsulta($sql);			
	}
	public function listar_compra()
	{
		$sql="SELECT * FROM proveedor where estado=1 AND estado_delete=1";
		return ejecutarConsulta($sql);		
	}	

}

?>