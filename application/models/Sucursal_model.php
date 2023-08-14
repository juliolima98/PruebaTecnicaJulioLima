<?php
class Sucursal_model extends CI_Model{
	//atributos
	public $idSucursal;
	public $cargo;
	public $nombreSucursal;
	public $direccionSucursal;
	public $telefonoSucursal;

	//metodos setter
	public function setIdSucursal($idSucursal){
		$this->idSucursal = $idSucursal;
	}

	public function setCargo($cargo){
		$this->cargo = $cargo;
	}

	public function setNombreSucursal($nombreSucursal){
		$this->nombreSucursal = $nombreSucursal;
	}

	public function setDireccionSucursal($direccionSucursal){
		$this->direccionSucursal = $direccionSucursal;
	}

	public function setTelefonoSucursal($telefonoSucursal){
		$this->telefonoSucursal = $telefonoSucursal;
	}

	//metodos getter
	public function getIdSucursal(){
		$lastID = $this->db->insert_id();
		return $lastID;
	}

	public function getAllSucursal(){
		$this->db->select("*");
		$this->db->from("SUCURSAL");
		$this->db->order_by("ID_SUCURSAL","ASC");
		return $result = $this->db->get()->result_array();
	}

	private function findOrFail($filter){
        $this->db->select("*");
        $this->db->from("SUCURSAL");

        if(!empty($filter["sucursal"])) {
            $this->db->where("NOMBRE_SUCURSAL", $filter["sucursal"]);
        }
        
        $this->db->order_by("NOMBRE_SUCURSAL", "ASC");	

        if ($filter["queryResult"] == 'rowArray'){
	    	$result = $this->db->get()->row_array();
	    }else if($filter["queryResult"] == 'resultArray'){
	    	$result = $this->db->get()->result_array();
	    }else if($filter["queryResult"] == 'dropdown'){
    	    $arrayTemp = array();
	    	$collections = $this->db->get()->result_array();
    	    foreach($collections as $item ){
    	        $arrayTemp[$item["ID_SUCURSAL"]] = $item["NOMBRE_SUCURSAL"];
    	    }
    	    $result = $arrayTemp;
	    }else{
	    	$result = [];
	    }
	    return $result;	   
    }
    
    // metodos que invocan al find
	public function getAllSucursales(){
		$filter["queryResult"] = 'dropdown';
		return $this->findOrFail($filter);
	}

	public function getSucursalById($id){
		$this->db->select("*");
		$this->db->where("ID_SUCURSAL", $id);
		$this->db->from("SUCURSAL SUC");
		//$this->db->join("CARGO CAR", "CAR.ID_SUCURSAL = SUC.ID_SUCURSAL");
		return $result = $this->db->get()->row_array();
	}

	public function deleteSucursal($id){
		$this->db->where("ID_SUCURSAL",$id);
		return $this->db->delete("SUCURSAL");
	}

	public function insertSucursal(){
		$this->db->set("ID_SUCURSAL", $this->idSucursal);
		$this->db->set("ID_CARGO", $this->cargo);
		$this->db->set("NOMBRE_SUCURSAL", $this->nombreSucursal);
		$this->db->set("DIRECCION_SUCURSAL", $this->direccionSucursal);
		$this->db->set("TELEFONO_SUCURSAL", $this->telefonoSucursal);
		return $result = $this->db->insert("SUCURSAL");
	}

	public function updateSucursal(){
		$this->db->set("ID_CARGO", $this->cargo);
		$this->db->set("NOMBRE_SUCURSAL", $this->nombreSucursal);
		$this->db->set("DIRECCION_SUCURSAL", $this->direccionSucursal);
		$this->db->set("TELEFONO_SUCURSAL", $this->telefonoSucursal);
		$this->db->where("ID_SUCURSAL", $this->idSucursal)->update("SUCURSAL");
		return $this->db->affected_rows() == 1 ? true : false;
	}
}