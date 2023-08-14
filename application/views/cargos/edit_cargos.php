<?php $this->load->view('nav'); ?>
<div class="card">
	<div class="card-body">
		<div align="center">
			<h3 class="text-primary mb-3">
				Formulario de edicion de Cargos
			</h3>
		</div>	
		<?php $this->load->view('partials/form_cargos'); ?>
	</div>
</div>
<script type="text/javascript">
	window.idCargo = '<?php echo $cargo["ID_CARGO"]; ?>';
	window.view = 'edit';
</script>