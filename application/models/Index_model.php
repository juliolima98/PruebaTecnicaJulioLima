<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Index_model extends CI_Model{
	public function getDatosEmpleados(){
		$this->db->select("*");
		$this->db->from("EMPLEADO EMP");
		$this->db->order_by("ID_EMPLEADO","ASC");
        $this->db->join("SUCURSAL SUC","SUC.ID_SUCURSAL = EMP.ID_SUCURSAL",'LEFT');
        $this->db->join("CARGO CAR","CAR.ID_CARGO = EMP.ID_CARGO",'LEFT');
        $this->db->join("ESTADO_EMPLEADO EST","EST.ID_ESTADO = EMP.ID_ESTADO",'LEFT');
        //echo $this->db->get_compiled_select();
        return $result = $this->db->get()->result_array();
	}
}