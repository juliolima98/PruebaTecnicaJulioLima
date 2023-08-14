<?php
class Cargos extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model("Cargo_model");
		$this->load->helper("form");
	}

	public function index(){
		$data['cargos'] = $this->Cargo_model->getCargos();
		$this->load->view("cargos/index_cargos",$data);
	}

	public function newCargo(){
		$this->load->view("cargos/create_cargos");
	}

	public function saveCargo(){
		$this->db->trans_start(FALSE);
		$cargo = new Cargo_model();
		$cargo->setIdCargo($cargo->getIdCargo);
		$cargo->setNombreCargo($this->input->post("nombreCargo"));
		$cargo->setDescripcionCargo($this->input->post("descripcionCargo"));
		$this->db->trans_commit();
		$cargoInsert = $cargo->insertCargo();
	}

	public function edit(){
		$idCargo = $this->input->post("idCargo");
		$data['cargo'] = $this->Cargo_model->getCargoById($idCargo);
		$this->load->view("cargos/edit_cargos",$data);
	}

	public function delete($id){
		$id = $this->uri->segment(3);
        if (empty($id)){
            show_404();
        }                
        $news_item = $this->Cargo_model->getCargos('', '', $id);
        if($this->Cargo_model->deleteCargo($id)){
			redirect(base_url());  
		}
	}

	public function update(){
		$this->db->trans_start(FALSE);
		$cargo = new Cargo_model();
		$cargo->setIdCargo($this->input->post("idCargo"));
		$cargo->setNombreCargo($this->input->post("nombreCargo"));
		$cargo->setDescripcionCargo($this->input->post("descripcionCargo"));
		$this->db->trans_commit();
		$cargoUpdate = $cargo->updateCargo();
	}
}