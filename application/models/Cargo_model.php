<?php
class Cargo_model extends CI_Model{
	//atributos
	public $idCargo;
	public $nombreCargo;
	public $descripcionCargo;

	//metodos setter
	public function setIdCargo($idCargo){
		$this->idCargo = $idCargo;
	}

	public function setNombreCargo($nombreCargo){
		$this->nombreCargo = $nombreCargo;
	}

	public function setDescripcionCargo($descripcionCargo){
		$this->descripcionCargo = $descripcionCargo;
	}

	//metodos getter
	public function getIdCargo(){
		$lastID = $this->db->insert_id();
		return $lastID;
	}
	
	private function findOrFail($filter){
        $this->db->select("*");
        $this->db->from("CARGO");

        if(!empty($filter["cargo"])) {
            $this->db->where("NOMBRE_CARGO", $filter["cargo"]);
        }
        
        $this->db->order_by("NOMBRE_CARGO", "ASC");	

        if ($filter["queryResult"] == 'rowArray'){
	    	$result = $this->db->get()->row_array();
	    }else if($filter["queryResult"] == 'resultArray'){
	    	$result = $this->db->get()->result_array();
	    }else if($filter["queryResult"] == 'dropdown'){
    	    $arrayTemp = array();
	    	$collections = $this->db->get()->result_array();
    	    foreach($collections as $item ){
    	        $arrayTemp[$item["ID_CARGO"]] = $item["NOMBRE_CARGO"];
    	    }
    	    $result = $arrayTemp;
	    }else{
	    	$result = [];
	    }
	    return $result;	   
    }
    
    // metodos que invocan al find
	public function getAllCargo(){
		$filter["queryResult"] = 'dropdown';
		return $this->findOrFail($filter);
	}

	public function getCargos(){
		$this->db->select("*");
		$this->db->from("CARGO");
		return $result = $this->db->get()->result_array();
	}

	public function deleteCargo($id){
		$this->db->where("ID_CARGO",$id);
		return $this->db->delete("CARGO");
	}

	public function insertCargo(){
		$this->db->set("ID_CARGO", $this->idCargo);
		$this->db->set("NOMBRE_CARGO", $this->nombreCargo);
		$this->db->set("DESCRIPCION_CARGO", $this->descripcionCargo);
		return $result = $this->db->insert("CARGO");
	}

	public function getCargoById($id){
		$this->db->select("*");
		$this->db->where("ID_CARGO", $id);
		$this->db->from("CARGO");
		return $result = $this->db->get()->row_array();
	}

	public function updateCargo(){
		$this->db->set("NOMBRE_CARGO", $this->nombreCargo);
		$this->db->set("DESCRIPCION_CARGO", $this->descripcionCargo);
		$this->db->where("ID_CARGO", $this->idCargo)->update("CARGO");
		return $this->db->affected_rows() == 1 ? true : false;
	}
}