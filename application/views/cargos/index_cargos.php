<!DOCTYPE html>
<html>
<head>
	<title>Pagina de inicio</title>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

</head>
<body>
<?php $this->load->view("nav") ?>
	
	<div class="card">
		<div class="text text-center">
			<b><h1 class="mt-3">Pagina de Cargos</h1></b>
		</div>
	<div class="card-body">
		<a class="mt-3" href="<?php echo base_url(); ?>index.php/cargos/newCargo">Nuevo Cargo</a>
	</div>
		<div class="card-body">
			<table class="table">
			  <thead>
			    <tr>
			      <th scope="col">Nombre</th>
			      <th scope="col">Descripcion</th>
			      <th scope="col">Acciones</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php foreach ($cargos as $cargo): ?>
				    <tr>
				      <td><?php echo $cargo['NOMBRE_CARGO']; ?></td>
				      <td><?php echo $cargo['DESCRIPCION_CARGO']; ?>
				      <td><a 
                               class="btn btn-xs btn-danger btn-icon-text btn-rounded btn-fw mb-1" 
                               href="<?php echo base_url("/index.php/cargos/delete/".$cargo['ID_CARGO']); ?>"
                               data-toggle="tooltip" data-placement="top" title data-original-title="Eliminar" title="Eliminar">
                               <i class="fa-solid fa-trash"></i><br>
                           </a>
                            <?php 
                                $attributes = array('method' => 'POST');
                                $hidden = array('idCargo' => $cargo['ID_CARGO']);
                                echo form_open('cargos/edit',$attributes,$hidden);
                                echo 
                                    '<button type="submit" class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top" title data-original-title="Editar">
                                        <i class="fas fa-edit text-primary"></i>
                                    </button><br>';
                                echo form_close();
                            ?>
                      </td>
				    </tr>
				<?php endforeach; ?>
			  </tbody>
			</table>
		</div>

	</div> 
</body>
<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
</html>