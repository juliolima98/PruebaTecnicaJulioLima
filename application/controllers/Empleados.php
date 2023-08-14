<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Empleados extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Empleados_model');
		$this->load->model('Sucursal_model');
		$this->load->model('Cargo_model');
		$this->load->model('EstadoEmpleado_model');
		$this->load->helper('form');
	}

	public function index(){
		$data['empleados'] = $this->Empleados_model->getAllEmpleados();
		$this->load->view('empleados/index_empleados',$data);
	}

	public function newEmpleado(){
		$data['listaSucursal'] = $this->Sucursal_model->getAllSucursales();
		$data['listaCargo'] = $this->Cargo_model->getAllCargo();
		$data['listaEstadoEmpleado'] = $this->EstadoEmpleado_model->getAllEstados();
		$this->load->view('empleados/create_empleados',$data);
	}

	public function saveEmpleado(){
		$this->db->trans_start(FALSE);
		$empleado = new Empleados_model();
		$empleado->setIdEmpleado($empleado->getIdEmpleado());
		$empleado->setSucursal($this->input->post("sucursal"));
		$empleado->setNombreEmpleado($this->input->post("nombreEmpleado"));
		$empleado->setApellidoEmpleado($this->input->post("apellidosEmpleado"));
		$empleado->setDireccionEmpleado($this->input->post("direccionEmpleado"));
		$empleado->setTelefonoEmpleado($this->input->post("telefonoEmpleado"));
		$empleado->setCargo($this->input->post("cargo"));
		$empleado->setEstadoEmpleado($this->input->post("estadoEmpleado"));
		$this->db->trans_commit();
		$empleadoInsert = $empleado->insertEmpleado();
	}

	public function delete($id){
		$id = $this->uri->segment(3);
        if (empty($id)){
            show_404();
        }                
        $news_item = $this->Empleados_model->getAllEmpleados('', '', $id);
        if($this->Empleados_model->deleteEmpleado($id)){
			redirect(base_url());  
		}
	}

	public function edit(){
		$idEmpleado = $this->input->post("idEmpleado");
		$data['listaSucursal'] = $this->Sucursal_model->getAllSucursales();
		$data['listaCargo'] = $this->Cargo_model->getAllCargo();
		$data['listaEstadoEmpleado'] = $this->EstadoEmpleado_model->getAllEstados();
		$data['empleado'] = $this->Empleados_model->getEmpleadoById($idEmpleado);
		$this->load->view('empleados/edit_empleados', $data);
	}

	public function update(){
		$this->db->trans_start(FALSE);
		$empleado = new Empleados_model();
		$empleado->setIdEmpleado($this->input->post("idEmpleado"));
		$empleado->setSucursal($this->input->post("sucursal"));
		$empleado->setNombreEmpleado($this->input->post("nombreEmpleado"));
		$empleado->setApellidoEmpleado($this->input->post("apellidosEmpleado"));
		$empleado->setDireccionEmpleado($this->input->post("direccionEmpleado"));
		$empleado->setTelefonoEmpleado($this->input->post("telefonoEmpleado"));
		$empleado->setCargo($this->input->post("cargo"));
		$empleado->setEstadoEmpleado($this->input->post("estadoEmpleado"));
		$this->db->trans_commit();
		$empleadoUpdate = $empleado->updateEmpleado();
	}
}