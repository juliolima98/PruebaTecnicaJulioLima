<!DOCTYPE html>
<html>
<head>
	<title>Pagina de inicio</title>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

</head>
<body>
<?php $this->load->view("nav.php") ?>
	
	<div class="card">
		<div class="text text-center">
			<b><h1 class="mt-3">Pagina de Sucursales</h1></b>
		</div>
	<div class="card-body">
		<a class="mt-3" href="<?php echo base_url(); ?>index.php/sucursal/newSucursal">Nueva Sucursal</a>
	</div>
		<div class="card-body">
			<table class="table">
			  <thead>
			    <tr>
			      <th scope="col">Sucursal</th>
			      <th scope="col">Direccion</th>
			      <th scope="col">Telefono</th>
			      <th scope="col">Acciones</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php foreach ($sucursales as $sucursal): ?>
				    <tr>
				      <td><?php echo $sucursal['NOMBRE_SUCURSAL']; ?></td>
				      <td><?php echo $sucursal['DIRECCION_SUCURSAL']; ?>
				      <td><?php echo $sucursal['TELEFONO_SUCURSAL']; ?></td>
				      <td><a 
                               class="btn btn-xs btn-danger btn-icon-text btn-rounded btn-fw mb-1" 
                               href="<?php echo base_url("/index.php/sucursal/delete/".$sucursal['ID_SUCURSAL']); ?>"
                               data-toggle="tooltip" data-placement="top" title data-original-title="Eliminar" title="Eliminar">
                               <i class="fa-solid fa-trash"></i><br>
                           </a>
                            <?php 
                                $attributes = array('method' => 'POST');
                                $hidden = array('idSucursal' => $sucursal['ID_SUCURSAL']);
                                echo form_open('sucursal/edit',$attributes,$hidden);
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