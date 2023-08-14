<?php
class EstadoEmpleado_model extends CI_Model{
	    private function findOrFail($filter){
        $this->db->select("*");
        $this->db->from("ESTADO_EMPLEADO");

        if(!empty($filter["estadoEmpleado"])) {
            $this->db->where("DESCRIPCION_ESTADO", $filter["estadoEmpleado"]);
        }
        
        $this->db->order_by("DESCRIPCION_ESTADO", "ASC");	

        if ($filter["queryResult"] == 'rowArray'){
	    	$result = $this->db->get()->row_array();
	    }else if($filter["queryResult"] == 'resultArray'){
	    	$result = $this->db->get()->result_array();
	    }else if($filter["queryResult"] == 'dropdown'){
    	    $arrayTemp = array();
	    	$collections = $this->db->get()->result_array();
    	    foreach($collections as $item ){
    	        $arrayTemp[$item["ID_ESTADO"]] = $item["DESCRIPCION_ESTADO"];
    	    }
    	    $result = $arrayTemp;
	    }else{
	    	$result = [];
	    }
	    return $result;	   


    }
    
    // metodos que invocan al find
	public function getAllEstados(){
		$filter["queryResult"] = 'dropdown';
		return $this->findOrFail($filter);
	}
}