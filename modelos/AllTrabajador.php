<?php
  //Incluímos inicialmente la conexión a la base de datos
  require "../config/Conexion.php";

  class AllTrabajador
  {
    //Implementamos nuestro constructor
    public function __construct()
    {
    }

    //Implementamos un método para insertar registros
    public function insertar( $nombre, $tipo_documento, $num_documento, $direccion, $telefono, $nacimiento, $edad,  $email, $imagen1)
    {
      //var_dump($nombre, $tipo_documento, $num_documento, $direccion, $telefono, $nacimiento, $edad, $c_bancaria, $email, $banco, $titular_cuenta, $imagen1, $imagen2, $imagen3, $cci, $tipo, $ocupacion, $ruc,);
      $sql="INSERT INTO trabajador (nombres, tipo_documento, numero_documento, fecha_nacimiento, edad,direccion, telefono, email, imagen_perfil)
      VALUES ( '$nombre', '$tipo_documento', '$num_documento', '$nacimiento', '$edad',  '$direccion', '$telefono', '$email', '$imagen1')";
      
      return ejecutarConsulta($sql);
        
    }

      //Implementamos un método para editar registros $cci, $tipo, $ocupacion, $ruc, $cv_documentado, $cv_nodocumentado
    public function editar($idtrabajador, $nombre, $tipo_documento, $num_documento, $direccion, $telefono, $nacimiento, $edad, $email, $imagen1)
    {
      $sql="UPDATE trabajador SET nombres='$nombre', tipo_documento='$tipo_documento', numero_documento='$num_documento', 
      fecha_nacimiento='$nacimiento', edad='$edad',direccion='$direccion', 
      telefono='$telefono', email='$email', imagen_perfil ='$imagen1'
      WHERE idtrabajador='$idtrabajador'";	
      
      return ejecutarConsulta($sql);
      
    }

    //Implementamos un método para desactivar categorías
    public function desactivar($idtrabajador, $descripcion)
    {
      $sql="UPDATE trabajador SET estado='0', descripcion_expulsion = '$descripcion' WHERE idtrabajador='$idtrabajador'";

      return ejecutarConsulta($sql);
    }
      //Implementamos un método para desactivar categorías
    public function desactivar_1($idtrabajador)
    {
      $sql="UPDATE trabajador SET estado='0' WHERE idtrabajador='$idtrabajador'";

      return ejecutarConsulta($sql);
    }

    //Implementamos un método para activar categorías
    public function activar($idtrabajador)
    {
      $sql="UPDATE trabajador SET estado='1' WHERE idtrabajador='$idtrabajador'";

      return ejecutarConsulta($sql);
    }

    //Implementamos un método para activar categorías
    public function eliminar($idtrabajador)
    {
      $sql="UPDATE trabajador SET estado_delete='0' WHERE idtrabajador='$idtrabajador'";

      return ejecutarConsulta($sql);
    }

    //Implementar un método para mostrar los datos de un registro a modificar
    public function mostrar($idtrabajador)
    {
      $sql="SELECT * FROM trabajador WHERE idtrabajador='$idtrabajador'";

      return ejecutarConsultaSimpleFila($sql);
    }

    //Implementar un método para mostrar los datos de un registro a modificar
    public function verdatos($idtrabajador)
    {
      $sql="SELECT 
      t.nombres as nombres, t.tipo_documento as tipo_documento, t.numero_documento as numero_documento,
      t.fecha_nacimiento as fecha_nacimiento, 
      t.direccion as direccion, t.telefono as telefono, t.email as email,
      t.imagen_perfil as imagen_perfil
      FROM trabajador t WHERE t.idtrabajador='$idtrabajador' ";

      return ejecutarConsultaSimpleFila($sql);
    }

    //Implementar un método para listar los registros
    public function listar()
    {
      $sql="SELECT t.idtrabajador,  t.nombres, t.tipo_documento, t.numero_documento, t.fecha_nacimiento, t.edad, t.telefono, t.imagen_perfil,t.estado
      FROM trabajador as t
      WHERE  t.estado = 1 AND t.estado_delete = 1 ORDER BY  t.nombres ASC ;";

      return ejecutarConsulta($sql);		
    }

    // obtebnemos los DOCS para eliminar
    public function obtenerImg($idtrabajador) {

      $sql = "SELECT imagen_perfil FROM trabajador WHERE idtrabajador='$idtrabajador'";

      return ejecutarConsulta($sql);
    }
  }

?>
