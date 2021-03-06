<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

class Papelera
{
  //Implementamos nuestro constructor
  public function __construct()
  {
  }

  //INSERTAR - DEPOSTOS
  public function tabla_principal($nube_idproyecto)
  {
    $data = Array();   

    $sql_1 = "SELECT idbancos,  nombre, alias, created_at, updated_at, estado FROM bancos WHERE estado = '0' AND estado_delete= '1';";
    $banco = ejecutarConsultaArray($sql_1);

    if (!empty($banco)) {
      foreach ($banco as $key => $value1) {
        $data[] = array(
          'nombre_tabla'    => 'bancos',
          'nombre_id_tabla' => 'idbancos',
          'id_tabla'        => $value1['idbancos'],
          'modulo'          => 'Bancos',
          'nombre_archivo'  => $value1['nombre'] .' - ' . $value1['alias'],
          'descripcion'     => '- - -',
          'nombre_royecto'  => 'General',
          'created_at'      => $value1['created_at'],
          'updated_at'      => $value1['updated_at'],
        );
      }
    }

    $sql_2 = "SELECT idcargo_trabajador,  nombre, estado, created_at, updated_at FROM cargo_trabajador WHERE estado = '0' AND estado_delete = '1';";
    $cargo_trabajador = ejecutarConsultaArray($sql_2);

    if (!empty($cargo_trabajador)) {
      foreach ($cargo_trabajador as $key => $value2) {
        $data[] = array(
          'nombre_tabla'    => 'cargo_trabajador',
          'nombre_id_tabla' => 'idcargo_trabajador',
          'id_tabla'        => $value2['idcargo_trabajador'],
          'modulo'          => 'Cargo Trabajdor',
          'nombre_archivo'  => $value2['nombre'],
          'descripcion'     => '- - -',
          'nombre_royecto'  => 'General',
          'created_at'      => $value2['created_at'],
          'updated_at'      => $value2['updated_at'],
        );
      }
    }

    $sql_3 = "SELECT cpt.idcarpeta, cpt.nombre, cpt.estado, cpt.created_at, cpt.updated_at,p.nombre_codigo
    FROM carpeta_plano_otro as cpt, proyecto as p
    WHERE cpt.estado = '0' AND cpt.estado_delete = '1' AND cpt.idproyecto = '$nube_idproyecto' AND cpt.idproyecto=p.idproyecto";
    $carpeta_plano_otro = ejecutarConsultaArray($sql_3);

    if (!empty($carpeta_plano_otro)) {
      foreach ($carpeta_plano_otro as $key => $value3) {
        $data[] = array(
          'nombre_tabla'    => 'carpeta_plano_otro',
          'nombre_id_tabla' => 'idcarpeta',
          'id_tabla'        => $value3['idcarpeta'],
          'modulo'          => 'Planos y Otros',
          'nombre_archivo'  => $value3['nombre'],
          'descripcion'     => '- - -',
          'nombre_royecto'  => $value3['nombre_codigo'],
          'created_at'      => $value3['created_at'],
          'updated_at'      => $value3['updated_at'],
        );
      }
    }
    
    $sql_4 = "SELECT idcategoria_insumos_af, nombre, estado, created_at, updated_at FROM categoria_insumos_af WHERE estado = '0' AND estado_delete = '1';";
    $categoria_insumos_af = ejecutarConsultaArray($sql_4);

    if (!empty($categoria_insumos_af)) {
      foreach ($categoria_insumos_af as $key => $value4) {
        $data[] = array(
          'nombre_tabla'    => 'categoria_insumos_af',
          'nombre_id_tabla' => 'idcategoria_insumos_af',
          'id_tabla'        => $value4['idcategoria_insumos_af'],
          'modulo'          => 'Clasificación de Productos',
          'nombre_archivo'  => $value4['nombre'],
          'descripcion'     => '- - -',
          'nombre_royecto'  => 'General',
          'created_at'      => $value4['created_at'],
          'updated_at'      => $value4['updated_at'],
        );
      }
    }

    $sql_5 = "SELECT idcolor, nombre_color, estado, created_at, updated_at FROM color WHERE estado = '0' AND estado_delete = '1';";
    $color = ejecutarConsultaArray($sql_5);

    if (!empty($color)) {
      foreach ($color as $key => $value5) {
        $data[] = array(
          'nombre_tabla'    => 'color',
          'nombre_id_tabla' => 'idcolor',
          'id_tabla'        => $value5['idcolor'],
          'modulo'          => 'Color',
          'nombre_archivo'  => $value5['nombre_color'],
          'descripcion'     => '- - -',
          'nombre_royecto'  => 'General',
          'created_at'      => $value5['created_at'],
          'updated_at'      => $value5['updated_at'],
        );
      }
    }

    $sql_6 = "SELECT cx.idcomida_extra, cx.tipo_comprobante, cx.numero_comprobante, cx.descripcion, cx.estado, cx.created_at, cx.updated_at, p.nombre_codigo
    FROM comida_extra as cx, proyecto as p
    WHERE cx.estado = '0' AND cx.estado_delete = '1' AND cx.idproyecto ='$nube_idproyecto' AND  cx.idproyecto=p.idproyecto;";
    $comida_extra = ejecutarConsultaArray($sql_6);

    if (!empty($comida_extra)) {
      foreach ($comida_extra as $key => $value6) {
        $data[] = array(
          'nombre_tabla'    => 'comida_extra',
          'nombre_id_tabla' => 'idcomida_extra',
          'id_tabla'        => $value6['idcomida_extra'],
          'modulo'          => 'Comida Extras',
          'nombre_archivo'  => $value6['tipo_comprobante'] . ' ─ ' . $value6['numero_comprobante'],
          'descripcion'     => $value6['descripcion'],
          'nombre_royecto'  => $value6['nombre_codigo'],
          'created_at'      => $value6['created_at'],
          'updated_at'      => $value6['updated_at'],
        );
      }
    }

    $sql_7 = "SELECT idcompra_af_general, tipo_comprobante, serie_comprobante, descripcion, estado, created_at, updated_at 
    FROM compra_af_general WHERE estado = '0' AND estado_delete = '1'";
    $comida_extra = ejecutarConsultaArray($sql_7);

    if (!empty($compra_af_general)) {
      foreach ($compra_af_general as $key => $value7) {
        $data[] = array(
          'nombre_tabla'    => 'compra_af_general',
          'nombre_id_tabla' => 'idcompra_af_general',
          'id_tabla'        => $value7['idcompra_af_general'],
          'modulo'          => 'All Activos Fijo',
          'nombre_archivo'  => $value7['tipo_comprobante'] . ' ─ ' . $value7['serie_comprobante'],
          'descripcion'     => $value7['descripcion'],
          'nombre_royecto'  => 'General',
          'created_at'      => $value7['created_at'],
          'updated_at'      => $value7['updated_at'],
        );
      }
    }

    $sql_8 = "SELECT cpp.idcompra_proyecto, cpp.tipo_comprobante, cpp.serie_comprobante, cpp.descripcion,  cpp.estado, cpp.created_at, cpp.updated_at,p.nombre_codigo
    FROM compra_por_proyecto as cpp, proyecto as p
    WHERE cpp.estado = '0' AND cpp.estado_delete = '1' AND cpp.idproyecto = '$nube_idproyecto' AND  cpp.idproyecto=p.idproyecto";
    $compra_por_proyecto = ejecutarConsultaArray($sql_8);

    if (!empty($compra_por_proyecto)) {
      foreach ($compra_por_proyecto as $key => $value8) {
        $data[] = array(
          'nombre_tabla'    => 'compra_por_proyecto',
          'nombre_id_tabla' => 'idcompra_proyecto',
          'modulo'          => 'Compras',
          'id_tabla'        => $value8['idcompra_proyecto'],
          'nombre_archivo'  => $value8['tipo_comprobante'] . ' ─ ' . $value8['serie_comprobante'],
          'descripcion'     => $value8['descripcion'],
          'nombre_royecto'  => $value8['nombre_codigo'],
          'created_at'      => $value8['created_at'],
          'updated_at'      => $value8['updated_at'],
        );
      }
    }

    $sql_9 = "SELECT f.idfactura, f.codigo, f.descripcion, f.estado, f.created_at, f.updated_at,p.nombre_codigo
    FROM factura AS f, maquinaria AS m, proyecto AS p
    WHERE f.idmaquinaria = m.idmaquinaria AND m.tipo = '1' AND f.estado = '0' AND f.estado_delete = '1' AND 
    f.idproyecto = '$nube_idproyecto' AND  f.idproyecto=p.idproyecto;";
    $factura_m = ejecutarConsultaArray($sql_9);

    if (!empty($factura_m)) {
      foreach ($factura_m as $key => $value9) {
        $data[] = array(
          'nombre_tabla'    => 'factura',
          'nombre_id_tabla' => 'idfactura',
          'modulo'          => 'Servicio Maquina',
          'id_tabla'        => $value9['idfactura'],
          'nombre_archivo'  => 'Factura ─ ' . $value9['codigo'],
          'descripcion'     => $value9['descripcion'],
          'nombre_royecto'  => $value9['nombre_codigo'],
          'created_at'      => $value9['created_at'],
          'updated_at'      => $value9['updated_at'],
        );
      }
    }

    $sql_10 = "SELECT f.idfactura, f.codigo, f.descripcion, f.estado, f.created_at, f.updated_at,p.nombre_codigo
    FROM factura AS f, maquinaria AS m, proyecto AS p
    WHERE f.idmaquinaria = m.idmaquinaria AND m.tipo = '2' AND f.estado = '0' AND f.estado_delete = '1' AND 
    f.idproyecto = '$nube_idproyecto' AND  f.idproyecto=p.idproyecto;";

    $factura_e = ejecutarConsultaArray($sql_10);

    if (!empty($factura_e)) {
      foreach ($factura_e as $key => $value10) {
        $data[] = array(
          'nombre_tabla'    => 'factura',
          'nombre_id_tabla' => 'idfactura',
          'modulo'          => 'Servicio Equipo',
          'id_tabla'        => $value10['idfactura'],
          'nombre_archivo'  => 'Factura ─ ' . $value10['codigo'],
          'descripcion'     => $value10['descripcion'],
          'nombre_royecto'  => $value10['nombre_codigo'],
          'created_at'      => $value10['created_at'],
          'updated_at'      => $value10['updated_at'],
        );
      }
    }

    $sql_11 = "SELECT fb.idfactura_break, fb.tipo_comprobante, fb.nro_comprobante, fb.descripcion, fb.estado, fb.created_at, fb.updated_at,p.nombre_codigo
    FROM factura_break AS fb, semana_break AS sb, proyecto AS p
    WHERE fb.idsemana_break = sb.idsemana_break AND fb.estado = '0' AND fb.estado_delete = '1' AND sb.idproyecto = '$nube_idproyecto'  AND sb.idproyecto = p.idproyecto";
    $factura_break = ejecutarConsultaArray($sql_11);

    if (!empty($factura_break)) {
      foreach ($factura_break as $key => $value11) {
        $data[] = array(
          'nombre_tabla'    => 'factura',
          'nombre_id_tabla' => 'idfactura_break',
          'modulo'          => 'Breack',
          'id_tabla'        => $value11['idfactura_break'],
          'nombre_archivo'  => $value11['tipo_comprobante'] .' ─ ' . $value11['nro_comprobante'],
          'descripcion'     => $value11['descripcion'],
          'nombre_royecto'  => $value11['nombre_codigo'],
          'created_at'      => $value11['created_at'],
          'updated_at'      => $value11['updated_at'],
        );
      }
    }

    $sql_12 = "SELECT fp.idfactura_pension, fp.tipo_comprobante, fp.nro_comprobante, fp.descripcion, fp.estado,  fp.created_at, fp.updated_at, proy.nombre_codigo
    FROM factura_pension AS fp, pension AS p, proyecto AS proy
    WHERE fp.idpension = p.idpension AND fp.estado = '0' AND fp.estado_delete = '1' AND p.idproyecto = '$nube_idproyecto' AND p.idproyecto = proy.idproyecto;";
    $factura_pension = ejecutarConsultaArray($sql_12);

    if (!empty($factura_pension)) {
      foreach ($factura_pension as $key => $value12) {
        $data[] = array(
          'nombre_tabla'    => 'factura_pension',
          'nombre_id_tabla' => 'idfactura_pension',
          'modulo'          => 'Pensión',
          'id_tabla'        => $value12['idfactura_pension'],
          'nombre_archivo'  => $value12['tipo_comprobante'] .' ─ ' . $value12['nro_comprobante'],
          'descripcion'     => $value12['descripcion'],
          'nombre_royecto'  => $value12['nombre_codigo'],
          'created_at'      => $value12['created_at'],
          'updated_at'      => $value12['updated_at'],
        );
      }
    }

    $sql_13 = "SELECT h.idhospedaje, h.tipo_comprobante, h.numero_comprobante, h.descripcion, h.estado, h.estado_delete, h.created_at, h.updated_at, p.nombre_codigo
    FROM hospedaje as h, proyecto AS p 
    WHERE h.estado = '0' AND h.estado_delete = '1' AND h.idproyecto = '$nube_idproyecto' AND h.idproyecto = p.idproyecto;";
    $hospedaje = ejecutarConsultaArray($sql_13);

    if (!empty($hospedaje)) {
      foreach ($hospedaje as $key => $value13) {
        $data[] = array(
          'nombre_tabla'    => 'hospedaje',
          'nombre_id_tabla' => 'idhospedaje',
          'modulo'          => 'Hospedaje',
          'id_tabla'        => $value13['idhospedaje'],
          'nombre_archivo'  => $value13['tipo_comprobante'] .' ─ ' . $value13['numero_comprobante'],
          'descripcion'     => $value13['descripcion'],
          'nombre_royecto'  => $value13['nombre_codigo'],
          'created_at'      => $value13['created_at'],
          'updated_at'      => $value13['updated_at'],
        );
      }
    }

    $sql_14 = "SELECT m.idmaquinaria,  m.nombre, p.razon_social AS proveedor, m.tipo, m.estado, m.created_at, m.updated_at
    FROM maquinaria AS m, proveedor AS p
    WHERE m.idproveedor = p.idproveedor AND m.estado = '0' AND m.estado_delete = '1';";
    $maquinaria = ejecutarConsultaArray($sql_14);

    if (!empty($maquinaria)) {
      foreach ($maquinaria as $key => $value14) {
        $data[] = array(
          'nombre_tabla'    => 'maquinaria',
          'nombre_id_tabla' => 'idmaquinaria',
          'modulo'          => 'Maquinaria y Equipos',
          'id_tabla'        => $value14['idmaquinaria'],
          'nombre_archivo'  => $value14['nombre'] . ' ─ ' .  ($value14['tipo'] == '1' ? 'Maquina' : 'Equipo' ),
          'descripcion'     => $value14['proveedor'],
          'nombre_royecto'  => 'General',
          'created_at'      => $value14['created_at'],
          'updated_at'      => $value14['updated_at'],
        );
      }
    }

    $sql_15 = "SELECT idocupacion, nombre_ocupacion, estado, created_at, updated_at FROM ocupacion WHERE estado  = '0' AND estado_delete = '1';";
    $ocupacion = ejecutarConsultaArray($sql_15);

    if (!empty($ocupacion)) {
      foreach ($ocupacion as $key => $value15) {
        $data[] = array(
          'nombre_tabla'    => 'ocupacion',
          'nombre_id_tabla' => 'idocupacion',
          'modulo'          => 'Ocupación',
          'id_tabla'        => $value15['idocupacion'],
          'nombre_archivo'  => $value15['nombre_ocupacion'],
          'descripcion'     => '- - -',
          'nombre_royecto'  => 'General',
          'created_at'      => $value15['created_at'],
          'updated_at'      => $value15['updated_at'],
        );
      }
    }
    
    $sql_16 = "SELECT os.idotro_servicio, os.tipo_comprobante, os.numero_comprobante, os.descripcion, os.estado, os.created_at, os.updated_at, p.nombre_codigo
    FROM otro_servicio as os, proyecto AS p 
    WHERE os.estado = '0' AND os.estado_delete = '1' AND  os.idproyecto  = '$nube_idproyecto' AND os.idproyecto = p.idproyecto;";
    $otro_servicio = ejecutarConsultaArray($sql_16);

    if (!empty($otro_servicio)) {
      foreach ($otro_servicio as $key => $value16) {
        $data[] = array(
          'nombre_tabla'    => 'otro_servicio',
          'nombre_id_tabla' => 'idotro_servicio',
          'modulo'          => 'Otros Gastos',
          'id_tabla'        => $value16['idotro_servicio'],
          'nombre_archivo'  => $value16['tipo_comprobante'] . ' ─ ' . $value16['numero_comprobante'] ,
          'descripcion'     => $value16['descripcion'],
          'nombre_royecto'  => $value16['nombre_codigo'],
          'created_at'      => $value16['created_at'],
          'updated_at'      => $value16['updated_at'],
        );
      }
    }

    $sql_17 = "SELECT pqso.idpagos_q_s_obrero, pqso.monto_deposito, t.nombres AS trabajador, pqso.descripcion, pqso.estado,  pqso.created_at, pqso.updated_at, p.nombre_codigo 
    FROM pagos_q_s_obrero AS pqso, resumen_q_s_asistencia AS rqsa, trabajador_por_proyecto AS tpp, trabajador AS t, proyecto AS p 
    WHERE pqso.idresumen_q_s_asistencia = rqsa.idresumen_q_s_asistencia AND rqsa.idtrabajador_por_proyecto = tpp.idtrabajador_por_proyecto AND tpp.idtrabajador = t.idtrabajador AND
    tpp.idproyecto = '$nube_idproyecto' AND pqso.estado = '0' AND pqso.estado_delete = '1' AND tpp.idproyecto = p.idproyecto; ";
    $pagos_q_s_obrero = ejecutarConsultaArray($sql_17);

    if (!empty($pagos_q_s_obrero)) {
      foreach ($pagos_q_s_obrero as $key => $value17) {
        $data[] = array(
          'nombre_tabla'    => 'pagos_q_s_obrero',
          'nombre_id_tabla' => 'idpagos_q_s_obrero',
          'modulo'          => 'Pago Obrero',
          'id_tabla'        => $value17['idpagos_q_s_obrero'],
          'nombre_archivo'  => $value17['trabajador'] . ' ─ S/.' . $value17['monto_deposito'] ,
          'descripcion'     => $value17['descripcion'],
          'nombre_royecto'  => $value17['nombre_codigo'],
          'created_at'      => $value17['created_at'],
          'updated_at'      => $value17['updated_at'],
        );
      }
    }

    $sql_18 = "SELECT pxma.idpagos_x_mes_administrador, t.nombres AS trabajador, pxma.monto, pxma.descripcion, pxma.estado, pxma.created_at, pxma.updated_at, p.nombre_codigo 
    FROM pagos_x_mes_administrador AS pxma, fechas_mes_pagos_administrador AS fmpa, trabajador_por_proyecto AS tpp, trabajador AS t, proyecto AS p 
    WHERE pxma.idfechas_mes_pagos_administrador = fmpa.idfechas_mes_pagos_administrador AND fmpa.idtrabajador_por_proyecto = tpp.idtrabajador_por_proyecto 
    AND tpp.idtrabajador = t.idtrabajador AND pxma.estado = '0' AND pxma.estado_delete = '1' AND tpp.idproyecto = '$nube_idproyecto' AND tpp.idproyecto = p.idproyecto;";
    $pagos_x_mes_administrador = ejecutarConsultaArray($sql_18);

    if (!empty($pagos_x_mes_administrador)) {
      foreach ($pagos_x_mes_administrador as $key => $value18) {
        $data[] = array(
          'nombre_tabla'    => 'pagos_x_mes_administrador',
          'nombre_id_tabla' => 'idpagos_x_mes_administrador',
          'modulo'          => 'Pago Administrador',
          'id_tabla'        => $value18['idpagos_x_mes_administrador'],
          'nombre_archivo'  => $value18['trabajador'] . ' ─ S/.' . $value18['monto'] ,
          'descripcion'     => $value18['descripcion'],
          'nombre_royecto'  => $value18['nombre_codigo'],
          'created_at'      => $value18['created_at'],
          'updated_at'      => $value18['updated_at'],
        );
      }
    }

    $sql_19 = "SELECT idpago_af_general,beneficiario,monto,descripcion,created_at,updated_at
    FROM pago_af_general WHERE  estado='0' AND estado_delete='1'";
    $pago_af_general = ejecutarConsultaArray($sql_19);

    if (!empty($pago_af_general)) {
      foreach ($pago_af_general as $key => $value19) {
        $data[] = array(
          'nombre_tabla'    => 'pago_af_general',
          'nombre_id_tabla' => 'idpago_af_general',
          'modulo'          => 'Pago activo general',
          'id_tabla'        => $value19['idpago_af_general'],
          'nombre_archivo'  => $value19['beneficiario'] . ' ─ S/.' . $value19['monto'] ,
          'descripcion'     => $value19['descripcion'],
          'nombre_royecto'  => 'General',
          'created_at'      => $value19['created_at'],
          'updated_at'      => $value19['updated_at'],
        );
      }
    }

    $sql_20 = "SELECT pc.idpago_compras, pc.beneficiario, pc.descripcion, pc.monto, pc.created_at, pc.updated_at, p.nombre_codigo
    FROM pago_compras as pc, compra_por_proyecto as cpp, proyecto as p
    WHERE pc.estado='0' AND pc.estado_delete='1' AND cpp.idproyecto='$nube_idproyecto' AND pc.idcompra_proyecto=cpp.idcompra_proyecto AND cpp.idproyecto=p.idproyecto";

    $pago_compras = ejecutarConsultaArray($sql_20);

    if (!empty($pago_compras)) {
      foreach ($pago_compras as $key => $value20) {
        $data[] = array(
          'nombre_tabla'    => 'pago_compras',
          'nombre_id_tabla' => 'idpago_compras',
          'modulo'          => 'Pago compras',
          'id_tabla'        => $value20['idpago_compras'],
          'nombre_archivo'  => $value20['beneficiario'] . ' ─ S/.' . $value20['monto'] ,
          'descripcion'     => $value20['descripcion'],
          'nombre_royecto'  => $value20['nombre_codigo'],
          'created_at'      => $value20['created_at'],
          'updated_at'      => $value20['updated_at'],
        );
      }
    }
    
    $sql21 = "SELECT pc.idpago_compras, pc.beneficiario, pc.descripcion, pc.monto, pc.created_at, pc.updated_at, p.nombre_codigo
    FROM pago_compras as pc, compra_por_proyecto as cpp, proyecto as p
    WHERE pc.estado='0' AND pc.estado_delete='1' AND cpp.idproyecto='$nube_idproyecto' AND pc.idcompra_proyecto=cpp.idcompra_proyecto AND cpp.idproyecto=p.idproyecto";

    $pago_compras = ejecutarConsultaArray($sql21);

    if (!empty($pago_compras)) {
      foreach ($pago_compras as $key => $value21) {
        $data[] = array(
          'nombre_tabla'    => 'pago_compras',
          'nombre_id_tabla' => 'idpago_compras',
          'modulo'          => 'Pago compras',
          'id_tabla'        => $value21['idpago_compras'],
          'nombre_archivo'  => $value21['beneficiario'] . ' ─ S/.' . $value21['monto'] ,
          'descripcion'     => $value21['descripcion'],
          'nombre_royecto'  => $value21['nombre_codigo'],
          'created_at'      => $value21['created_at'],
          'updated_at'      => $value21['updated_at'],
        );
      }
    }

    return $data;
  }

  //Desactivar DEPOSITO
  public function recuperar($nombre_tabla, $nombre_id_tabla, $id_tabla)
  {
    $sql = "UPDATE $nombre_tabla SET estado='1' WHERE $nombre_id_tabla ='$id_tabla'";
    return ejecutarConsulta($sql);
  }

  //Activar DEPOSITO
  public function eliminar_permanente($nombre_tabla, $nombre_id_tabla, $id_tabla)
  {
    $sql = "UPDATE $nombre_tabla SET estado_delete='0' WHERE $nombre_id_tabla ='$id_tabla'";
    return ejecutarConsulta($sql);
  }
}

?>
