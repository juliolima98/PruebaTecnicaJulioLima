<?php
class Empleados_model extends CI_Model{
	//atributos
	public $idEmpleado;
	public $nombreEmpleado;
	public $apellidoEmpleado;
	public $direccionEmpleado;
	public $telefonoEmpleado;
	public $sucursal;
	public $cargo;
	public $estadoEmpleado;

	//metodos setter
	public function setIdEmpleado($idEmpleado){
		$this->idEmpleado = $idEmpleado;
	}

	public function setNombreEmpleado($nombreEmpleado){
		$this->nombreEmpleado = $nombreEmpleado;
	}

	public function setApellidoEmpleado($apellidoEmpleado){
		$this->apellidoEmpleado = $apellidoEmpleado;
	}

	public function setDireccionEmpleado($direccionEmpleado){
		$this->direccionEmpleado = $direccionEmpleado;
	}

	public function setTelefonoEmpleado($telefonoEmpleado){
		$this->telefonoEmpleado = $telefonoEmpleado;
	}

	public function setSucursal($sucursal){
		$this->sucursal = $sucursal;
	}

	public function setCargo($cargo){
		$this->cargo = $cargo;
	}

	public function setEstadoEmpleado($estadoEmpleado){
		$this->estadoEmpleado = $this->validateNumber($estadoEmpleado);
	}

	public function validateNumber($attribute){
		return $attribute ? $attribute = $attribute : $attribute = 'null';
	}

	//metodos getter
	public function getIdEmpleado(){
		$lastId = $this->db->insert_id();
		return $lastId;
	}

	public function getAllEmpleados(){
		$this->db->select("*");
		$this->db->from("EMPLEADO EMP");
		$this->db->order_by("ID_EMPLEADO","ASC");
		$this->db->join("SUCURSAL SUC","SUC.ID_SUCURSAL = EMP.ID_SUCURSAL",'LEFT');
		$this->db->join("CARGO CAR","CAR.ID_CARGO = EMP.ID_CARGO",'LEFT');
		$this->db->join("ESTADO_EMPLEADO EST","EST.ID_ESTADO = EMP.ID_ESTADO",'LEFT');
		return $result = $this->db->get()->result_array();
	}

	public function insertEmpleado(){
		$this->db->set("ID_EMPLEADO", $this->idEmpleado);
		$this->db->set("ID_SUCURSAL", $this->sucursal);
		$this->db->set("NOMBRE_EMPLEADO", $this->nombreEmpleado);
		$this->db->set("APELLIDO_EMPLEADO", $this->apellidoEmpleado);
		$this->db->set("DIRECCION_EMPLEADO", $this->direccionEmpleado);
		$this->db->set("TELEFONO_EMPLEADO", $this->telefonoEmpleado);
		$this->db->set("ID_CARGO", $this->cargo);
		$this->db->set("ID_ESTADO", $this->estadoEmpleado);
		return $this->db->insert("EMPLEADO");
	}

	public function deleteEmpleado($id){
		$this->db->where("ID_EMPLEADO",$id);
		return $this->db->delete("EMPLEADO");
	}

	public function getEmpleadoById($id){
		$this->db->select("*");
		$this->db->where("ID_EMPLEADO",$id);
		$this->db->from("EMPLEADO EMP");
		$this->db->join("SUCURSAL SUC","SUC.ID_SUCURSAL = EMP.ID_SUCURSAL");
		$this->db->join("CARGO CAR","CAR.ID_CARGO = EMP.ID_CARGO");
		return $result = $this->db->get()->row_array();
	}

	public function updateEmpleado(){
		$this->db->set("ID_EMPLEADO", $this->idEmpleado);
		$this->db->set("ID_SUCURSAL", $this->sucursal);
		$this->db->set("NOMBRE_EMPLEADO", $this->nombreEmpleado);
		$this->db->set("APELLIDO_EMPLEADO", $this->apellidoEmpleado);
		$this->db->set("DIRECCION_EMPLEADO", $this->direccionEmpleado);
		$this->db->set("TELEFONO_EMPLEADO", $this->telefonoEmpleado);
		$this->db->set("ID_CARGO", $this->cargo);
		$this->db->set("ID_ESTADO", $this->estadoEmpleado);
		$this->db->where("ID_EMPLEADO", $this->idEmpleado)->update("EMPLEADO");
		//echo $this->db->affected_rows();
		//exit;
        return $this->db->affected_rows() == 1 ? true : false;
	}
}