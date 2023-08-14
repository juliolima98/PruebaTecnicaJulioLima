<?php
class Sucursal extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->helper("form");
		$this->load->model("Sucursal_model");
		$this->load->model("Cargo_model");
	}

	public function index(){
		$data['sucursales'] = $this->Sucursal_model->getAllSucursal();
		$this->load->view("sucursales/index_sucursal",$data);
	}

	public function newSucursal(){
		$data['listaCargo'] = $this->Cargo_model->getAllCargo();
		$this->load->view("sucursales/create_sucursales",$data);
	}

	public function saveSucursal(){
		$this->db->trans_start(FALSE);
		$sucursal = new Sucursal_model();
		$sucursal->setIdSucursal($sucursal->getIdSucursal);
		$sucursal->setCargo($this->input->post("cargo"));
		$sucursal->setNombreSucursal($this->input->post("nombreSucursal"));
		$sucursal->setDireccionSucursal($this->input->post("direccionSucursal"));
		$sucursal->setTelefonoSucursal($this->input->post("telefonoSucursal"));
		$this->db->trans_commit();
		$sucursalInsert = $sucursal->insertSucursal();

	}

	public function edit(){
		$idSucursal = $this->input->post("idSucursal");
		$data['listaCargo'] = $this->Cargo_model->getAllCargo();
		$data['sucursal'] = $this->Sucursal_model->getSucursalById($idSucursal);
		$this->load->view("sucursales/edit_sucursales",$data);
	}

	public function delete($id){
		$id = $this->uri->segment(3);
        if (empty($id)){
            show_404();
        }                
        $news_item = $this->Sucursal_model->getAllSucursal('', '', $id);
        if($this->Sucursal_model->deleteSucursal($id)){
			redirect(base_url());  
		}
	}

	public function update(){
		$this->db->trans_start(FALSE);
		$sucursal = new Sucursal_model();
		$sucursal->setIdSucursal($this->input->post("idSucursal"));
		$sucursal->setCargo($this->input->post("cargo"));
		$sucursal->setNombreSucursal($this->input->post("nombreSucursal"));
		$sucursal->setDireccionSucursal($this->input->post("direccionSucursal"));
		$sucursal->setTelefonoSucursal($this->input->post("telefonoSucursal"));
		$this->db->trans_commit();
		$sucursalUpdate = $sucursal->updateSucursal();
	}
}